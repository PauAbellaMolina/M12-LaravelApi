<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commerce;

class CommerceController extends Controller
{
    public function index() {
        try {
            $commerces = Commerce::all();
            return response()->json(['status' => 1, 'res' => $commerces]);
        } catch(\Exception $e) {
            return response()->json(['status' => 0, 'res' => []], 500);
        }
    }

    public function getCommerceById(Request $request) {
        try {
            $commerce = Commerce::findOrFail($request->id);
            return response()->json(['status' => 1, 'res' => $commerce]);
        } catch(\Exception $e) {
            return response()->json(['status' => 0, 'res' => []], 500);
        }
    }
}
