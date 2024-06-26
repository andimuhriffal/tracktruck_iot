<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Detection;

class DetectionController extends Controller
{
    public function index()
    {
        $detections = Detection::all();
        return view('detections.index', compact('detections'));
    }
}