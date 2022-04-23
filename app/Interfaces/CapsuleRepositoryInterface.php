<?php


namespace App\Interfaces;

interface CapsuleRepositoryInterface
{
    public function getAllCapsules();

    public function getAllCapsulesByStatus($status);

    public function getCapsuleBySerial($serial);
}
