<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransactionsHistoryController extends Controller
{
    public function index() {
        try {
            $transactions = \DB::table('transactions_history')->get();
            return response()->json(['status' => 1, 'res' => $transactions]);
        } catch(\Exception $e) {
            return response()->json(['status' => 0, 'res' => []], 500);
        }
    }

    public function getPointsByCommerce(Request $request) {
        try {
            $transactions = \DB::table('transactions_history')->where('id_user', $request->id_commerce)->get();
            return response()->json(['status' => 1, 'res' => $transactions]);
        } catch(\Exception $e) {
            return response()->json(['status' => 0, 'res' => []], 500);
        }
    }

    public function getPointsByUser(Request $request) {
        try {
            $transactions = \DB::table('transactions_history')->where('id_commerce', $request->id_user)->get();
            return response()->json(['status' => 1, 'res' => $transactions]);
        } catch(\Exception $e) {
            return response()->json(['status' => 0, 'res' => []], 500);
        }
    }
}
