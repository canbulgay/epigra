<?php


namespace App\Interfaces;

interface CapsuleRepositoryInterface
{
    public function getAllCapsules();

    public function SyncCapsulesToDb($capsules);
}
