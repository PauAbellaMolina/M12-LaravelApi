<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Level;

class LevelsController extends Controller
{
    public function index() {
        try {
            $levels = Level::all();
            return response()->json(['status' => 1, 'res' => $levels]);
        } catch(\Exception $e) {
            return response()->json(['status' => 0, 'res' => []], 500);
        }
    }

    public function getLevelByPoints(Request $request) {
        try {
            $level = Level::where('from_points', '<=', $request->points)->where('to_points', '>=', $request->points)->first();
            return response()->json(['status' => 1, 'res' => $level]);
        } catch(\Exception $e) {
            return response()->json(['status' => 0, 'res' => []], 500);
        }
    }
}
