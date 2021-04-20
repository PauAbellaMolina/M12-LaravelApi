<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;

class CategoriesController extends Controller
{
    public function index() {
        try {
            $categories = Categorie::all();
            return response()->json(['status' => 1, 'res' => $categories]);
        } catch(\Exception $e) {
            return response()->json(['status' => 0, 'res' => []], 500);
        }
    }

    public function getCategorieById(Request $request) {
        try {
            $categorie = Categorie::findOrFail($request->id);
            return response()->json(['status' => 1, 'res' => $categorie]);
        } catch(\Exception $e) {
            return response()->json(['status' => 0, 'res' => []], 500);
        }
    }
}
