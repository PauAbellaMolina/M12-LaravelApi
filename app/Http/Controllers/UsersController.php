<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function index() {
        try {
            $users = User::all();
            return response()->json(['status' => 1, 'users' => $users]);
        } catch(\Exception $e) {
            return response()->json(['status' => 0, 'users' => []], 500);
        }
    }
}
