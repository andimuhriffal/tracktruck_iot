<?php

namespace App\Http\Controllers;

use App\Models\DriverCamera;
use App\Models\GPSData;
use App\Models\FuelLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // dd($user); // Debugging: cek data pengguna
        // return view('dashboard', compact('user'));

       
        $gpsData = GPSData::latest()->first();
        $fuelLevel = FuelLevel::latest()->first();

        return view('dashboard', compact('user', 'gpsData', 'fuelLevel'));
    }
}
