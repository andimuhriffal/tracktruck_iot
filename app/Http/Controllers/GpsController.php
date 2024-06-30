<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GPSData;
use Carbon\Carbon;

class GpsController extends Controller
{
    public function latest(Request $request)
    {
        $gpsData = GPSData::latest()->first();

        if (!$gpsData) {
            return response()->json(['message' => 'No data found'], 404);
        }

        return response()->json([
            'latitude' => $gpsData->latitude,
            'longitude' => $gpsData->longitude,
            'recorded_at' => $gpsData->recorded_at,
        ]);
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'recorded_at' => 'required|date_format:Y-m-d\TH:i:s\Z',
        ]);

        // Konversi format datetime
        $recordedAt = Carbon::parse($request->input('recorded_at'))->format('Y-m-d H:i:s');

        // Simpan data ke database
        $gpsData = new GPSData();
        $gpsData->latitude = $request->input('latitude');
        $gpsData->longitude = $request->input('longitude');
        $gpsData->recorded_at = $recordedAt;
        $gpsData->save();

        return response()->json(['message' => 'Data berhasil disimpan'], 201);
    }
}
