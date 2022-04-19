<?php

use App\Http\Controllers\CapsuleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('capsules', [CapsuleController::class, 'index'])->middleware('auth:sanctum');
Route::get('capsules/{capsule:capsule_serial}', [CapsuleController::class, 'show'])->middleware('auth:sanctum');
