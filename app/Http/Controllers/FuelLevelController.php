<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\FuelLevel;
use Illuminate\Support\Facades\Validator;

class FuelLevelController extends Controller
{
    private $serverName;

    public function __construct()
    {
        $this->serverName = env('SERVER_NAME');
    }

    public function latest()
    {
        $fuelLevel = FuelLevel::latest()->first();

        if (!$fuelLevel) {
            return response()->json(['message' => 'No data found'], 404);
        }

        return response()->json([
            'jarak' => $fuelLevel->jarak,
            'persentase_bahan_bakar' => $fuelLevel->persentase_bahan_bakar,
            'created_at' => $fuelLevel->created_at,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jarak' => 'required|numeric',
            'persentase_bahan_bakar' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $fuelLevel = FuelLevel::create([
            'jarak' => $request->jarak,
            'persentase_bahan_bakar' => $request->persentase_bahan_bakar,
        ]);

        $response = Http::post($this->serverName, [
            'jarak' => $request->jarak,
            'persentase_bahan_bakar' => $request->persentase_bahan_bakar,
        ]);

        if ($response->successful()) {
            return response()->json(['message' => 'Data berhasil disimpan dan dikirim'], 201);
        } else {
            return response()->json(['message' => 'Data berhasil disimpan tetapi gagal dikirim ke server eksternal'], 500);
        }
    }
}
