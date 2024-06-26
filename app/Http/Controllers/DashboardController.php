<?php

namespace App\Http\Controllers;

use App\Models\DriverCamera;
use App\Models\GPSData;
use App\Models\FuelLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        // Ambil data terbaru untuk GPS dan level bahan bakar
        $gpsData = GPSData::latest()->first();
        $fuelLevel = FuelLevel::latest()->first();

        // Tampilkan view dashboard dengan data yang diperlukan
        return view('dashboard', compact('user', 'gpsData', 'fuelLevel'));
    }
}
