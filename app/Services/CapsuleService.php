<?php

namespace App\Services;

use App\Models\Capsule;
use App\Models\Mission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class CapsuleService
{
    public function fetchAllDataFromApi(): array
    {
        try {
            $capsules = Http::get('https://api.spacexdata.com/v3/capsules');
            return $capsules->json();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function createCapsulesWithMissions($capsules): bool
    {
        DB::table('capsules')->delete();
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
