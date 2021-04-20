<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commerce;

class CommerceController extends Controller
{
    public function index() {
        try {
            $commerces = Commerce::all();
            return response()->json(['status' => 1, 'commerces' => $commerces]);
        } catch(\Exception $e) {
            return response()->json(['status' => 0, 'commerces' => []], 500);
        }
    }
}
