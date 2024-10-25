<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Store;

class RegistItemController extends Controller
{
    public function select(Request $request)
    {
        $store_data = $request->input('store_data');
        // jsonをデコード
        $store_data = json_decode($store_data, true);
        $store_id = $store_data[0];
        $store_name = $store_data[1];

        // storeテーブルに存在するか確認し、存在しない場合は新規登録
        $store = Store::firstOrCreate(['place_id' => $store_id], ['name' => $store_name]);
        // storeテーブルからidを取得
        $store_id = $store->id;

        $result = [];
        return view('homeAccount.register', compact(['store_name','result','store_id']));
    }

}
