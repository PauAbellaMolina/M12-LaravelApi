<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recompense;
use App\Models\RecompenseUsed;

class RecompensesController extends Controller
{
    public function getRecompensesByCommerce(Request $request) {
        try {
            $recompenses = Recompense::where('id_commerce', $request->id_commerce)->get();

            foreach ($recompenses as $key => $recompense) {
                $recompenseUsed = RecompenseUsed::where('id_recompense', $recompense->id)->where('id_user', $request->id_user)->first();

                if($recompenseUsed) {
                    $recompense->used = true;
                } else {
                    $recompense->used = false;
                }
            }

            return response()->json(['status' => 1, 'res' => $recompenses]);
        } catch(\Exception $e) {
            return response()->json(['status' => 0, 'res' => []], 500);
        }
    }

    public function useRecompense(Request $request) {
        try {
            $actualPoints = \DB::table('points')->where('id_user', $request->id_user)->where('id_commerce', $request->id_commerce)->first()->points;
            $recompense = Recompense::findOrFail($request->id_recompense);
            \DB::table('points')->where('id_user', $request->id_user)->where('id_commerce', $request->id_commerce)->update(['points' => $actualPoints-$recompense->points]);

            $newRecompenseUsed = new RecompenseUsed;
            $newRecompenseUsed->id_user = $request->id_user;
            $newRecompenseUsed->id_recompense = $request->id_recompense;
            $newRecompenseUsed->save();

            return response()->json(['status' => 1, 'res' => $recompense]);
        } catch(\Exception $e) {
            return response()->json(['status' => 0, 'res' => []], 500);
        }
    }
}
