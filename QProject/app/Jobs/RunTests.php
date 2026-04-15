<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Bus\Batchable;

class RunTests implements ShouldQueue
{
    use Queueable,Batchable;

    private string $repo_name;
    private string $branch;

    public function __construct(string $repo_name, string $branch)
    {
        $this->repo_name = $repo_name;
        $this->branch    = $branch;
    }

    public function handle(): void
    {
        $repoPath = storage_path("app/repos/{$this->repo_name}_{$this->branch}");

        if (! is_dir($repoPath)) {
            Log::error('Repository folder not found', [
                'repo_name' => $this->repo_name,
                'branch'    => $this->branch,
                'repo_path' => $repoPath,
            ]);
            throw new \Exception('Repository folder not found');
        }

        $steps = [
            'composer install'        => "composer install --no-interaction --prefer-dist",
            'composer dump-autoload'  => "composer dump-autoload --no-interaction",
            'copy .env'               => "cp .env.example .env",
            'key generate'            => "php artisan key:generate --no-interaction",
            'migrate'                 => "php artisan migrate --force --no-interaction",
            'tests'                   => "php artisan test",
        ];

        foreach ($steps as $label => $command) {
            $output   = [];
            $exitCode = 0;

            // Use proc_open-style exec so we control cwd and env cleanly
            exec(
                sprintf('cd %s && %s 2>&1', escapeshellarg($repoPath), $command),
                $output,
                $exitCode
            );

            $outputStr = implode("\n", $output);

            if ($exitCode !== 0) {
                Log::error("RunTests step failed: {$label}", [
                    'repo_name' => $this->repo_name,
                    'branch'    => $this->branch,
                    'command'   => $command,
                    'exit_code' => $exitCode,
                    'output'    => $outputStr,
                ]);

                throw new \Exception("RunTests step failed: {$label}");
            }

        }
        Log::info("RunTests step succeeded: {$label}", [
            'repo_name' => $this->repo_name,
            'branch'    => $this->branch,
            'output'    => $outputStr,
        ]);
    }
    
}
