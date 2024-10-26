<?php

namespace App\Http\Controllers;

use App\Models\Income_and_Expense;
use Illuminate\Http\Request;

class IncomeAndExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Income_and_Expense $income_and_Expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Income_and_Expense $income_and_Expense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Income_and_Expense $income_and_Expense)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Income_and_Expense $income_and_Expense)
    {
        //
    }

    public function delta(request $request,Income_and_Expense $delta) 
    {
        // 入力された数値を取得
        $new_delta = $request->input('in_price');
        
        //直前までのすべてのデータを取得して合計値を返す
        $old_delta = Income_and_Expense::latest()->sum('$delta')??0;

        // 計算
        $result = $new_delta + $old_delta;


return view('', compact('result'));
    }
}
