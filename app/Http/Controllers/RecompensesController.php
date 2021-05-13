<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recompense;
use App\Models\RecompenseUsed;

class RecompensesController extends Controller
{
    public function getRecompensesByCommerceOnly(Request $request) {
        try {
            $recompenses = Recompense::where('id_commerce', $request->id_commerce)->get();

            foreach ($recompenses as $key => $recompense) {
                $recompenseUsedToday = RecompenseUsed::where('id_recompense', $recompense->id)->whereDate('created_at', \Carbon\Carbon::today())->count();

                $recompense->usedToday = $recompenseUsedToday;
            }

            return response()->json(['status' => 1, 'res' => $recompenses]);
        } catch(\Exception $e) {
            return response()->json(['status' => 0, 'res' => []], 500);
        }
    }

    public function getRecompensesByCommerce(Request $request) {
        try {
            $recompenses = Recompense::where('id_commerce', $request->id_commerce)->get();

            foreach ($recompenses as $key => $recompense) {
                $recompenseUsed = RecompenseUsed::where('id_recompense', $recompense->id)->where('id_user', $request->id_user);

                if($recompenseUsed->whereDate('created_at', \Carbon\Carbon::today())->first()) {
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
            \DB::table('points')->where('id_user', $request->id_user)->where('id_commerce', $request->id_commerce)->update(['points' => $recompense->points-$actualPoints]);

            $newRecompenseUsed = new RecompenseUsed;
            $newRecompenseUsed->id_user = $request->id_user;
            $newRecompenseUsed->id_recompense = $request->id_recompense;
            $newRecompenseUsed->save();

            return response()->json(['status' => 1, 'res' => $recompense]);
        } catch(\Exception $e) {
            dump($e);
            return response()->json(['status' => 0, 'res' => []], 500);
        }
    }

    public function swapActiveRecompense(Request $request) {
        try {
            $recompense = Recompense::findOrFail($request->id_recompense);
            if($recompense->active == 0) {
                $recompense->update(['active' => 1]);
            } else {
                $recompense->update(['active' => 0]);
            }

            $recompense->save();

            return response()->json(['status' => 1, 'res' => $recompense]);
        } catch(\Exception $e) {
            dump($e);
            return response()->json(['status' => 0, 'res' => []], 500);
        }
    }
}
