<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recompense;

class RecompensesController extends Controller
{
    public function getRecompensesByCommerce(Request $request) {
        try {
            $recompenses = Recompense::where('id_commerce', $request->id_commerce)->get();
            return response()->json(['status' => 1, 'res' => $recompenses]);
        } catch(\Exception $e) {
            return response()->json(['status' => 0, 'res' => []], 500);
        }
    }
}
