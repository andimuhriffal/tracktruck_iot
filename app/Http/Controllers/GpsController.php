<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GPSData;

class GpsController extends Controller
{
    public function latest()
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
        // Validasi request
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'recorded_at' => 'required|date',
        ]);

        // Simpan data GPS baru
        $gpsData = new GPSData();
        $gpsData->latitude = $request->latitude;
        $gpsData->longitude = $request->longitude;
        $gpsData->recorded_at = $request->recorded_at;
        $gpsData->save();

        return response()->json(['message' => 'GPS data saved successfully'], 201);
    }
}
