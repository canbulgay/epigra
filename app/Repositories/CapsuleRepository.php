<?php

namespace App\Repositories;

use App\Interfaces\CapsuleRepositoryInterface;
use App\Models\Capsule;
use App\Models\Mission;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Schema;

class CapsuleRepository implements CapsuleRepositoryInterface
{
    public function getAllCapsules(): array
    {
        try {
            $capsules = Http::get('https://api.spacexdata.com/v3/capsules');
        } catch (\Throwable $th) {
            throw $th;
        }

        return $capsules->json();
    }

    public function SyncCapsulesToDb($capsules): bool
    {
        foreach ($capsules as $capsule) {
            Capsule::create([
                'capsule_serial' => $capsule['capsule_serial'],
                'capsule_id' => $capsule['capsule_id'],
                'capsule_status' => $capsule['status'],
                'original_launch' => $capsule['original_launch'],
                'original_launch_unix' => $capsule['original_launch_unix'],
                'landings' => $capsule['landings'],
                'type' => $capsule['type'],
                'details' => $capsule['details'],
                'reuse_count' => $capsule['reuse_count'],
            ]);

            if (count($capsule['missions']) > 0) {

                foreach ($capsule['missions'] as $mission) {
                    Mission::create([
                        'capsule_serial' => $capsule['capsule_serial'],
                        'name' => $mission['name'],
                        'flight' => $mission['flight'],
                    ]);
                }
            }
        }
        return true;
    }
}
