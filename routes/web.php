<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

Route::post('/home-account/shop-select', function (Request $request) {
    
    $region = $request->input('region');
    
    $shops = [
        ['name' => 'ハローデイ', 'value' => json_encode(['name' => 'ハローデイ', 'lat' => 33.583415, 'lon' => 130.402002])],
        ['name' => 'マックスバリュ', 'value' => json_encode(['name' => 'マックスバリュ', 'lat' => 33.589412, 'lon' => 130.395964])],
        ['name' => 'サニー', 'value' => json_encode(['name' => 'サニー', 'lat' => 33.581751, 'lon' => 130.412029])],
        ['name' => '西鉄ストア', 'value' => json_encode(['name' => '西鉄ストア', 'lat' => 33.588596, 'lon' => 130.406362])],
        ['name' => 'トライアル', 'value' => json_encode(['name' => 'トライアル', 'lat' => 33.595352, 'lon' => 130.410582])],
    ];
    return view('homeAccount.shopSelect', compact(['shops', 'region']));
})->middleware(['auth', 'verified'])->name('shopSelect');

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
});

require __DIR__.'/auth.php';
