<?php

namespace App\Console\Commands;

use App\Interfaces\CapsuleRepositoryInterface;
use Illuminate\Console\Command;
use App\Events\DbSyncDoneEvent as DbSyncDone;

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
    public function handle(CapsuleRepositoryInterface $capsuleRepository)
    {
        $this->info('Ready to get all capsule data from SpaceX Api..');
        $capsulesFromSpaceX = $capsuleRepository->getAllCapsules();
        $syncCapsulesToDb = $capsuleRepository->SyncCapsulesToDb($capsulesFromSpaceX);

        if ($syncCapsulesToDb) {
            $this->info('All data from SpaceX Api has been synced to database.');
            DbSyncDone::dispatch($capsulesFromSpaceX);
        } else {
            $this->error('Something went wrong while syncing data from SpaceX Api to database.');
        }
    }
}
