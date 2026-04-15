<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Bus\Batchable;

class Deploy implements ShouldQueue
{
    use Queueable,Batchable;

    private String $repo_name;

    /**
     * Create a new job instance.
     */
    public function __construct(String $repo_name)
    {
        $this->repo_name = $repo_name;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // deploy the repo 
        Log::info('Deploying repository: ' . $this->repo_name . ' successfully');
    }
}
