<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FavCommerceUser;

class FavCommerceUserController extends Controller
{
    public function isCommerceUsersFavourite(Request $request) {
        try {
            $response = false;

            $favExists = FavCommerceUser::where('id_commerce', $request->id_commerce)->where('id_user', $request->id_user)->first();

            if($favExists) {
                $response = true;
            }

            return response()->json(['status' => 1, 'res' => $response]);
        } catch(\Exception $e) {
            return response()->json(['status' => 0, 'res' => []], 500);
        }
    }

    public function addCommerceUsersFavourite(Request $request) {
        try {
            $newFav = new FavCommerceUser;
            $newFav->id_commerce = $request->id_commerce;
            $newFav->id_user = $request->id_user;
            $newFav->save();

            return response()->json(['status' => 1, 'res' => true]);
        } catch(\Exception $e) {
            return response()->json(['status' => 0, 'res' => []], 500);
        }
    }

    public function removeCommerceUsersFavourite(Request $request) {
        try {
            $fav = FavCommerceUser::where('id_commerce', $request->id_commerce)->where('id_user', $request->id_user)->first();
            $fav->delete();

            return response()->json(['status' => 1, 'res' => false]);
        } catch(\Exception $e) {
            return response()->json(['status' => 0, 'res' => []], 500);
        }
    }
}
