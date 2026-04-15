<?php

use App\Jobs\Deploy;
use App\Jobs\ProcessingPayment;
use App\Jobs\PullRepo;
use App\Jobs\RunTests;
use Illuminate\Support\Facades\Route;
use App\Jobs\SendEmailsJob;
use Illuminate\Bus\Batch;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/send-email', function () {

    // foreach (range(1, 10) as $i) {
    //     SendEmailsJob::dispatch();
    // }

    ProcessingPayment::dispatch()->onQueue('emran');

    return '<h1>Email sent</h1>';
});



Route::get('/deploy-chain', function () {

    $repoDeploymentChain = [
        new PullRepo('https://github.com/emran-alhaddad/bagisto.git', '2.3'),
        new RunTests('bagisto', '2.3'),
        new Deploy('bagisto_2.3'),
    ];

    Bus::chain($repoDeploymentChain)->onQueue('deployments')->dispatch();

    return '<h1>Repository deployed successfully and tests run successfully</h1>';
});


Route::get('/pull-repos-batch', function () {
    $reposJobs = [
        [
            new PullRepo('https://github.com/laravel/laravel.git', 'master'),
            new RunTests('laravel', 'master'),
            new Deploy('laravel_master'),
        ],
        [
            new PullRepo('https://github.com/statamic/cms.git', '6.x'),
            new RunTests('cms', '6.x'),
            new Deploy('cms_6.x'),
        ],
        [
            new PullRepo('https://github.com/statamic/cms.git', '6.x'),
            new PullRepo('https://github.com/laravel/laravel-.git', 'master'),
            new PullRepo('https://github.com/statamic/cms.git', '6.x'),
        ],
        function () {
            Bus::chain([
                new PullRepo('https://github.com/laravel/laravel.git', 'master'),
                new RunTests('laravel', 'master'),
                new Deploy('laravel_master'),
            ])->onQueue('deployments')->dispatch();
            Bus::chain([
                new PullRepo('https://github.com/statamic/cms.git', '6.x'),
                new RunTests('cms', '6.x'),
                new Deploy('cms_6.x'),
            ])->onQueue('deployments')->dispatch();
        }
    ];

    $batch2 = [
        new PullRepo('https://github.com/statamic/cms.git', '3.0'),
        // new PullRepo('https://github.com/statamic/cms.git', '3.1'),
        // new PullRepo('https://github.com/statamic/cms.git', '3.2'),
        // new PullRepo('https://github.com/statamic/cms.git', '3.3'),
        // new PullRepo('https://github.com/statamic/cms.git', '3.4'),
        // new PullRepo('https://github.com/statamic/cms.git', '4.x'),
        // new PullRepo('https://github.com/statamic/cms.git', '5.x'),
        // new PullRepo('https://github.com/statamic/cms.git', '6.x'),
    ];
    Bus::batch($batch2)->onQueue('pull-repos')
        ->dispatch();

        // Bus::batch($batch2)->onQueue('pull-repos')
        // ->allowFailures()
        // ->catch(function (Batch $batch, Throwable $e) {
        //     Log::error('Batch failed', ['batch' => $batch, 'error' => $e]);
        // })
        // ->onConnection('failover')
        // ->then(function (Batch $batch) {
        //     Log::info('Batch completed', ['batch' => $batch]);
        // })
        // ->finally(function (Batch $batch) {
        //     Log::info('Batch finally', ['batch' => $batch]);
        // })
        // ->dispatch();
    return '<h1>Repositories pulled successfully</h1>';
});
