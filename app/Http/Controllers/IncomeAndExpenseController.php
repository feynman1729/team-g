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
        $income_and_expense = Income_and_Expense::selectRaw('YEAR(date) as year, MONTH(date) as month, delta, date, description, store_id')
        ->orderByDesc('date')
        ->get()
        ->groupBy(function ($date) {
            return $date->year . '-' . $date->month; // 年と月でグループ化
        });

        //直前までのすべてのデータを取得して合計値を返す
        $result = Income_and_Expense::latest()->sum('delta')??0;

        return view('dashboard', compact('income_and_expense', 'result'));
        
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
        $request->validate([
            'in_price' => 'required|numeric',
            'description' => 'nullable|string',
        ]);
    
        // トグルの状態による収入/支出の符号
        $delta = $request->has('toggle') ? -abs($request->input('in_price')) : abs($request->input('in_price'));

        // 日付を取得
        $date = $request->input('date');
        // データの保存
        Income_and_Expense::create([
            'delta' => $delta,
            'date' => $date, // または指定があればフォームから受け取る
            'description' => $request->input('description'),
            'store_id' => null, // 必要に応じて設定
        ]);
    
        return view('homeAccount.regionSelect')->with('success', 'データが保存されました。');
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

}
