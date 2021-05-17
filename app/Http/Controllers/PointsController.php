<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
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
            if($points == null) {
                $points = array('points' => 0);
            }
            return response()->json(['status' => 1, 'res' => $points]);
        } catch(\Exception $e) {
            return response()->json(['status' => 0, 'res' => []], 500);
        }
    }

    public function addPointsById(Request $request) {
        try {
            $actualPoints = \DB::table('points')->where('id_user', $request->id_user)->where('id_commerce', $request->id_commerce)->first();

            if(!$actualPoints) {
                \DB::table('points')->insert(['id_user' => $request->id_user, 'id_commerce' => $request->id_commerce, 'points' => 0]);
                $actualPoints = \DB::table('points')->where('id_user', $request->id_user)->where('id_commerce', $request->id_commerce)->first();
            }

            \DB::table('points')->where('id_user', $request->id_user)->where('id_commerce', $request->id_commerce)->update(['points' => $actualPoints->points+$request->points]);

            $user = User::find($request->id_user)->first();
            $actualUserPoints = $user->points;
            $user->update(['points' => $actualUserPoints+$request->points]);

            $newTransaction = new Transaction;
            $newTransaction->id_user = $request->id_user;
            $newTransaction->id_commerce = $request->id_commerce;
            $newTransaction->points = $request->points;
            $newTransaction->save();

            $points = \DB::table('points')->where('id_user', $request->id_user)->where('id_commerce', $request->id_commerce)->first();
            return response()->json(['status' => 1, 'res' => $points]);
        } catch(\Exception $e) {
            dd($e);die();
            return response()->json(['status' => 0, 'res' => []], 500);
        }
    }
}
