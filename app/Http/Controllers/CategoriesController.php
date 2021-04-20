<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;

class CategoriesController extends Controller
{
    public function index() {
        try {
            $categories = Categorie::all();
            return response()->json(['status' => 1, 'categories' => $categories]);
        } catch(\Exception $e) {
            return response()->json(['status' => 0, 'categories' => []], 500);
        }
    }
}
