<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Level;

class LevelsController extends Controller
{
    public function index() {
        try {
            $levels = Level::all();
            return response()->json(['status' => 1, 'levels' => $levels]);
        } catch(\Exception $e) {
            return response()->json(['status' => 0, 'levels' => []], 500);
        }
    }
}
