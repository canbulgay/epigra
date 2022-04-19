<?php

namespace App\Http\Controllers;

use App\Models\Capsule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CapsuleController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->input('capsule_status');

        $capsules = DB::table('capsules')->when($status, function ($query, $status) {
            return $query->where('capsule_status', $status);
        })->get();

        return view('index', [
            'capsules' => $capsules,
        ]);
    }

    public function show(Capsule $capsule)
    {
        $capsule = $capsule->load('missions');
        return view('show', [
            'capsule' => $capsule,
        ]);
    }
}
