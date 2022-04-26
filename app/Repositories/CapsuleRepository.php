<?php

namespace App\Repositories;

use App\Interfaces\CapsuleRepositoryInterface;
use App\Models\Capsule;

class CapsuleRepository implements CapsuleRepositoryInterface
{
    public function getAllCapsules()
    {
        return Capsule::all();
    }

    public function getAllCapsulesByStatus($status)
    {
        return Capsule::where('capsule_status', $status)->get();
    }

    public function getCapsuleBySerial($serial)
    {
        return Capsule::with('missions')->where('capsule_serial', $serial)->firstOrFail();
    }
}
