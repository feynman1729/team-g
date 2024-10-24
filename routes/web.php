<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\IncomeAndExpenseController;
use App\Http\Controllers\ShopSelectController;
use App\Models\Income_and_Expense;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//家計簿入力
Route::get('/home-account', function () {
    return view('homeAccount.regionSelect');
})->middleware(['auth', 'verified'])->name('regionSelect');

// 家計簿選択
Route::get('/cheap-search', function () {
    return view('cheapSearch.register');
})->middleware(['auth', 'verified'])->name('cheapSearch');


//最安値検索
Route::get('/cheap-search/result', function () {
    return view('cheapSearch.result');
})->middleware(['auth', 'verified'])->name('cheapSearchResult');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('income_and_expenses', IncomeAndExpenseController::class);
});

require __DIR__.'/auth.php';
