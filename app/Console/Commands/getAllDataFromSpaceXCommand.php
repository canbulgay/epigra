<?php

namespace App\Console\Commands;

use App\Services\CapsuleService;
use Illuminate\Console\Command;
use App\Events\DbSyncDoneEvent;;

class getAllDataFromSpaceXCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get all data from SpaceX Api';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(CapsuleService $capsuleService)
    {
        $this->info('Ready to get all capsule data from SpaceX Api..');
        $capsulesFromSpaceX = $capsuleService->fetchAllDataFromApi();
        $isSyncSuccessful = $capsuleService->createCapsulesWithMissions($capsulesFromSpaceX);

        if ($isSyncSuccessful) {
            $this->info('All data from SpaceX Api has been synced to database.');
            DbSyncDoneEvent::dispatch($capsulesFromSpaceX);
        } else {
            $this->error('Something went wrong while syncing data from SpaceX Api to database.');
        }
    }
}
