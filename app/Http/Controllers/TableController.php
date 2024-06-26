<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Models\FuelLevel;

class TableController extends BaseController
{
    public function index()
    {
        // Mengambil data dari FuelLevel terbaru
        $fuelLevel = FuelLevel::latest()->first();

        // Data untuk ditampilkan pada tabel
        $data = [
            ['no' => 1, 'bahan_bakar' => 'Solar', 'status' => 'Operasional'],
            ['no' => 2, 'bahan_bakar' => 'Premium', 'status' => 'Tidak Operasional'],
            ['no' => 3, 'bahan_bakar' => 'Solar', 'status' => 'Operasional'],
            ['no' => 4, 'bahan_bakar' => 'Diesel', 'status' => 'Operasional'],
        ];

        return view('table', compact('data'));
    }
}
