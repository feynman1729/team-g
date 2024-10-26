<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Store;
use App\Models\Supply;
use App\Models\Income_and_Expense;

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
        $purchase_list = [];
        $select_item = "";
        return view('homeAccount.register', compact(['store_name','result','store_id','select_item','purchase_list']));
    }

    public function search(Request $request)
    {
        $store_id = $request->input('store_id');
        $store_name = $request->input('store_name');
        
        $data = $request->input('purchase_data');
        $purchase_list = json_decode($data, true);
        $result = [];
        $search_word = $request->input('search_word');
        
        // supplyテーブルから検索search_wordを含む商品を取得またnameの重複を無しにする
        $result_item = Supply::select('name')
            ->groupBy('name')
            ->where('name', 'like', "%$search_word%")
            ->get();
        // nameだけの配列を作成
        $result_name = $result_item->pluck('name')->all();
        
        if ($result_item->isEmpty()) {
            $result = "該当する商品がありません";
        } else {
            foreach ($result_name as $name) {
                $result[] = [
                    'name' => $name,
                    'value' => $name
                ];
            }
        }
    
        $select_item = "";
        return view('homeAccount.register', compact(['store_name','result','store_id','select_item','purchase_list']));
    }

    public function itemSelect(Request $request)
    {
        $select_item = "";
        $store_id = $request->input('store_id');
        $store_name = $request->input('store_name');
        $input_data = $request->input('item_name');
        $select_name = $request->input('name');
        $data = $request->input('purchase_data');
        $purchase_list = json_decode($data, true);
        if($input_data != null){
            $select_item = $input_data;
        }else{
            $select_item = $select_name;
        }
        $result = [];

        return view('homeAccount.register', compact(['store_name','result','store_id','select_item','purchase_list']));
    }

    public function priceSelect(Request $request)
    {
        $store_id = $request->input('store_id');
        $store_name = $request->input('store_name');
        $save_price = $request->input('item_price');
        $save_item = $request->input('select_item');
        // nameに$save_itemかつstore_idに$store_idを持つsupplyテーブルのpriceを取得
        Supply::where('name', $save_item)
            ->where('store_id', $store_id)
            ->delete();
        // supplyテーブルに新しく登録
        $supply = new Supply();
        $supply->name = $save_item;
        $supply->price = $save_price;
        $supply->store_id = $store_id;
        $supply->save();
        $data = $request->input('purchase_data');
        $purchase_list = json_decode($data, true);
        // purcahse_listに追加
        $purchase_list = array_merge($purchase_list ?: [], [
            [
                'name' => $save_item,
                'price' => $save_price
            ]
        ]);
        $result = [];
        $select_item = "";

        return view('homeAccount.register', compact(['store_name','result','store_id','select_item','purchase_list']));
    }

    public function dateSelect(Request $request)
    {
        $store_name = $request->input('store_name');
        $store_id = $request->input('store_id');
        $data = $request->input('purchase_data');
        $purchase_list = json_decode($data, true);

        return view('homeAccount.dateSelect', compact(['store_name','store_id','purchase_list']));
    }

    public function listRegist(Request $request)
    {
        $store_name = $request->input('store_name');
        $data = $request->input('purchase_data');
        $purchase_list = json_decode($data, true);
        $date = $request->input('date');

        //Income_and_Expenseテーブルに保存
        Income_and_Expense::create([
            'delta' => -array_sum(array_column($purchase_list, 'price')),
            'date' => $date,
            'description' => $store_name . 'での買い物',
            'store_id' => $request->input('store_id'),
        ]);

        return redirect()->route('dashboard');;
    }
}
