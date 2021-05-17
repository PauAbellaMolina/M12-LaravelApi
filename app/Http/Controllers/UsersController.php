<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function index() {
        try {
            $users = User::all();
            return response()->json(['status' => 1, 'res' => $users]);
        } catch(\Exception $e) {
            return response()->json(['status' => 0, 'res' => []], 500);
        }
    }

    public function getUserById(Request $request) {
        try {
            $user = User::findOrFail($request->id);
            return response()->json(['status' => 1, 'res' => $user]);
        } catch(\Exception $e) {
            return response()->json(['status' => 0, 'res' => []], 500);
        }
    }

    public function storeUserFcmToken(Request $request) {
        try {
            $user = User::findOrFail($request->id_user)->update(['fcm_token' => $request->token]);
            return response()->json(['status' => 1, 'res' => $user]);
        } catch(\Exception $e) {
            return response()->json(['status' => 0, 'res' => []], 500);
        }
    }
}
