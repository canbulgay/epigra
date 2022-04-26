<?php

namespace App\Http\Controllers;

use App\Interfaces\CapsuleRepositoryInterface;

class CapsuleController extends Controller
{
    private $capsuleRepository;

    /**
     * Create a new controller instance.
     * @param CapsuleRepositoryInterface $capsuleRepository
     */
    public function __construct(CapsuleRepositoryInterface $capsuleRepository)
    {
        $this->capsuleRepository = $capsuleRepository;
    }

    /**
     * Display a listing of capsules.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $capsules = $this->capsuleRepository->getAllCapsules();
        return response()->json($capsules, 200);
    }

    /**
     * Display a listing of capsules by status.
     * 
     * @param  string  $status
     * @return \Illuminate\Http\Response
     */
    public function getCapsulesByStatus($status)
    {
        $capsules = $this->capsuleRepository->getAllCapsulesByStatus($status);
        return response()->json($capsules, 200);
    }

    /**
     * Display a capsule by serial.
     * 
     * @param  string  $serial
     * @return \Illuminate\Http\Response
     */
    public function show($serial)
    {
        $capsule = $this->capsuleRepository->getCapsuleBySerial($serial);
        return response()->json($capsule, 200);
    }
}
