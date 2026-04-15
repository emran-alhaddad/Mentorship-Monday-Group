<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use ZipArchive;
use Illuminate\Bus\Batchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Queue\Middleware\WithoutOverlapping;
use Illuminate\Support\Facades\Cache;

class PullRepo implements ShouldQueue, ShouldBeUnique
{
    
    use Queueable, Batchable;

    private string $repoUrl;
    private string $branch;

    public function __construct(string $repoUrl, string $branch)
    {
        $this->repoUrl = $repoUrl;
        $this->branch = $branch;
    }

    // public function uniqueId(): string
    // {
    //     return $this->repoUrl . '-' . $this->branch;
    // }

    public function uniqueFor(): int
    {
        return 60 * 60 * 24; // 1 day
    }

    public function handle(): void
    {
        Cache::lock('pull-repo-' . $this->repoUrl . '-' . $this->branch, 10)->get(function () {

            $repoName = pathinfo(parse_url($this->repoUrl, PHP_URL_PATH), PATHINFO_FILENAME) ?: 'repo';
            $basePath = storage_path('app/repos/');
            $targetDir = $basePath . $repoName . '_' . $this->branch;
            $zipPath   = $targetDir . '.zip';

            try {
                // Skip if already deployed
                if (is_dir($targetDir)) {
                    Log::info('PullRepo skipped: repo already exists', [
                        'repo_url'   => $this->repoUrl,
                        'branch'     => $this->branch,
                        'target_dir' => $targetDir,
                    ]);

                    return;
                }

                // Ensure base directory exists
                if (! is_dir($basePath)) {
                    mkdir($basePath, 0755, true);
                }

                // Download zip archive
                $archiveUrl = rtrim(preg_replace('/\.git$/', '', $this->repoUrl), '/') . "/archive/refs/heads/{$this->branch}.zip";
                $response   = Http::timeout(60)->get($archiveUrl);

                if (! $response->successful()) {
                    Log::error('PullRepo failed: unable to download repo zip', [
                        'repo_url' => $this->repoUrl,
                        'branch'   => $this->branch,
                        'status'   => $response->status(),
                    ]);

                    throw new \Exception('Unable to download repo zip');
                }

                file_put_contents($zipPath, $response->body());

                // Open and extract zip
                $zip = new ZipArchive();

                if ($zip->open($zipPath) !== true) {
                    Log::error('PullRepo failed: unable to open zip archive', [
                        'zip_path' => $zipPath,
                    ]);

                    throw new \Exception('Unable to open zip archive');
                }

                // Extract to a temp directory first to avoid the nested folder issue.
                // GitHub zips always contain a single root folder like "reponame-branch/",
                // so we extract there then move its contents up to $targetDir.
                $tempDir = $basePath . $repoName . '_' . $this->branch . '_tmp';
                mkdir($tempDir, 0755, true);

                $zip->extractTo($tempDir);
                $zip->close();
                @unlink($zipPath);

                // Find the single root folder GitHub placed inside the zip
                $extracted = glob($tempDir . '/*', GLOB_ONLYDIR);

                if (count($extracted) === 1) {
                    rename($extracted[0], $targetDir);
                    rmdir($tempDir);
                } else {
                    // Fallback: just use the temp dir as-is if structure is unexpected
                    rename($tempDir, $targetDir);
                }

                Log::info('PullRepo completed successfully', [
                    'repo_url'   => $this->repoUrl,
                    'branch'     => $this->branch,
                    'target_dir' => $targetDir,
                ]);
            } catch (\Throwable $e) {
                // Cleanup any partial files on failure
                @unlink($zipPath);

                Log::error('Deploy failed with exception', [
                    'repo_url' => $this->repoUrl,
                    'branch'   => $this->branch,
                    'message'  => $e->getMessage(),
                ]);
                throw $e;
            }
        });
    }


    // public function middleware(): array
    // {
    //     return [new WithoutOverlapping('pull-repo')];
    // }
}
