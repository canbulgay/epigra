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
     * @OA\Get(
     *      path="/api/capsules",
     *      operationId="getCapsules",
     *      tags={"Capsule"},
     *      summary="Get all capsules",
     *      description="Returns all capsules",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="App/Models/Capsule.php")
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
    public function index()
    {
        $capsules = $this->capsuleRepository->getAllCapsules();
        return response()->json($capsules, 200);
    }

    /**
     * @OA\Get(
     *      path="/api/{status}/capsules",
     *      operationId="getCapsulesByStatus",
     *      tags={"Capsule"},
     *      summary="Get all capsules by status",
     *      description="Returns all capsules by status",
     *      @OA\Parameter(
     *          name="status",
     *          description="Status of the capsule",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="App/Models/Capsule.php")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     *
     * 
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
     * @OA\Get(
     *     path="/api/capsules/{serial}",
     *     tags={"Capsule"},
     *     summary="Find capsule by serial",
     *     description="Returns a single capsule details",
     *     operationId="getCapsuleBySerial",
     *     @OA\Parameter(
     *         name="serial",
     *         in="path",
     *         description="Serial number of the capsule",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     * 
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(ref="App\Models\Capsule.php"),  
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid serial number"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Capsule not found"
     *     ),
     * )
     * 
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
