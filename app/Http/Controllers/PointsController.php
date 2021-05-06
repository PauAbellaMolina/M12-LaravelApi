<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PointsController extends Controller
{
    public function index() {
        try {
            $points = \DB::table('points')->get();
            return response()->json(['status' => 1, 'res' => $points]);
        } catch(\Exception $e) {
            return response()->json(['status' => 0, 'res' => []], 500);
        }
    }

    public function getPointsById(Request $request) {
        try {
            $points = \DB::table('points')->where('id_user', $request->id_user)->where('id_commerce', $request->id_commerce)->first();
            return response()->json(['status' => 1, 'res' => $points]);
        } catch(\Exception $e) {
            return response()->json(['status' => 0, 'res' => []], 500);
        }
    }

    public function addPointsById(Request $request) {
        try {
            $actualPoints = \DB::table('points')->where('id_user', $request->id_user)->where('id_commerce', $request->id_commerce)->first()->points;
            \DB::table('points')->where('id_user', $request->id_user)->where('id_commerce', $request->id_commerce)->update(['points' => $actualPoints+$request->points]);
            $points = \DB::table('points')->where('id_user', $request->id_user)->where('id_commerce', $request->id_commerce)->first();
            return response()->json(['status' => 1, 'res' => $points]);
        } catch(\Exception $e) {
            return response()->json(['status' => 0, 'res' => []], 500);
        }
    }
}
