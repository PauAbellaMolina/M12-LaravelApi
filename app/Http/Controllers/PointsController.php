<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PointsController extends Controller
{
    public function index() {
        try {
            $points = \DB::table('points')->get();
            return response()->json(['status' => 1, 'points' => $points]);
        } catch(\Exception $e) {
            return response()->json(['status' => 0, 'points' => []], 500);
        }
    }
}
