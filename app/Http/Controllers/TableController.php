<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Models\FuelLevel;
use App\Models\GPSData;

class TableController extends BaseController
{
    public function index()
    {
        // Mengambil 4 data FuelLevel terbaru
        $fuelLevels = FuelLevel::latest()->take(4)->get();
        
        // Mengambil 4 data GPSData terbaru
        $gpsDataList = GPSData::latest()->take(4)->get();

        // Data untuk ditampilkan pada tabel
        $data = [];
        foreach ($fuelLevels as $key => $fuelLevel) {
            $gpsData = $gpsDataList->get($key);
            $data[] = [
                'id' => $key + 1, // Sesuaikan dengan ID unit yang sesuai
                'nama' => 'Unit ' . ($key + 1),
                'latitude' => $gpsData->latitude ?? '-6.200000',
                'longitude' => $gpsData->longitude ?? '106.816666',
                'jam_operasi' => '08:00 - 17:00', // Sesuaikan jika ada data operasional spesifik
                'persentase_bahan_bakar' => $fuelLevel->persentase_bahan_bakar,
            ];
        }

        return view('table', compact('data'));
    }
}
