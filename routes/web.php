<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\IncomeAndExpenseController;
use App\Models\Income_and_Expense;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/homeAccount', function () {
    return view('homeAccount.register');
})->middleware(['auth', 'verified'])->name('homeAccount');

Route::get('/cheapSearch', function () {
    return view('cheapSearch.register');
})->middleware(['auth', 'verified'])->name('cheapSearch');

Route::get('/cheapSearch/result', function () {
    return view('cheapSearch.result');
})->middleware(['auth', 'verified'])->name('cheapSearchResult');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('income_and_expenses', IncomeAndExpenseController::class);
});

require __DIR__.'/auth.php';
