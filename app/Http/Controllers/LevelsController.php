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

    public function getLevelById(Request $request) {
        try {
            $level = Level::findOrFail($request->id);
            return response()->json(['status' => 1, 'res' => $level]);
        } catch(\Exception $e) {
            return response()->json(['status' => 0, 'res' => []], 500);
        }
    }
}
