<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\IncomeAndExpenseController;
use App\Http\Controllers\ShopSelectController;
use App\Http\Controllers\RegistItemController;
use App\Http\Controllers\CheapSearchController;
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

// 買い物リスト登録
Route::get('/cheap-search', function () {
    return view('cheapSearch.register');
})->middleware(['auth', 'verified'])->name('cheapSearch');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('income_and_expenses', IncomeAndExpenseController::class);
    Route::post('/home-account/shop-select', [ShopSelectController::class, 'select'])->name('shopSelect');
    Route::post('/home-account/register', [RegistItemController::class, 'select'])->name('itemRegister');
    Route::post('/home-account/item-search', [RegistItemController::class, 'search'])->name('itemSearch'); 
    Route::post('/home-account/item-select', [RegistItemController::class, 'itemSelect'])->name('itemSelect');
    Route::post('/home-account/price-select', [RegistItemController::class, 'priceSelect'])->name('priceSelect');
    Route::post('/home-account/date-select', [RegistItemController::class, 'dateSelect'])->name('dateSelect');
    Route::post('/home-account/regist', [RegistItemController::class, 'listRegist'])->name('listRegist');
    Route::post('cheap-search/item-list',[CheapSearchController::class, 'selectRegion'])->name('selectGoTo');
    Route::post('cheap-search/search',[CheapSearchController::class, 'search'])->name('buyItemSearch');
    Route::post('cheap-search/select-item',[CheapSearchController::class, 'itemSelect'])->name('buyItemSelect');
    Route::post('cheap-search/result',[CheapSearchController::class, 'cheapSearch'])->name('cheapSearchResult');
    Route::get('/dashboard', [IncomeAndExpenseController::class, 'index'])->name('dashboard');
});

require __DIR__.'/auth.php';
