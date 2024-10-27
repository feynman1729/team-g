<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Store;
use App\Models\Supply;

class CheapSearchController extends Controller
{
    public function selectRegion(Request $request)
    {
        // 入力から地域情報を取得
        $region = $request->input('region');

        // Google Places APIのエンドポイント
        $apiKey = env('GOOGLE_MAPS_API_KEY');

        // Google Places APIへのリクエストURL
        $url = "https://maps.googleapis.com/maps/api/place/textsearch/json?query={$region}&language=ja&key={$apiKey}";

        // HTTPリクエストを送信し、レスポンスを取得
        $response = Http::get($url);

        // レスポンスを解析
        $data = $response->json();

        // スーパーマーケットのリストを作成
        $store_id_list = [];
        if (isset($data['results'])) {
            foreach ($data['results'] as $place) {
                // store_id_listの配列を作成
                $store_id_list[] = $place['place_id'];
            }
        }
        $purchase_list = [];
        $result = "";
        
        return view('cheapSearch.itemList', compact(['store_id_list','purchase_list','result']));
    }

    public function search(Request $request)
    {
        $id_data = $request->input('store_id_list');
        $store_id_list = json_decode($id_data, true);
        
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
            return view('cheapSearch.itemList', compact(['store_id_list','purchase_list','result']));
        } else {
            foreach ($result_name as $name) {
                $result[] = [
                    'name' => $name,
                    'value' => $name
                ];
            }
        }
        return view('cheapSearch.search', compact(['result','store_id_list','purchase_list']));
    }

    public function itemSelect(Request $request)
    {
        $id_data = $request->input('store_id_list');
        $store_id_list = json_decode($id_data, true);
        $select_name = $request->input('name');
        $data = $request->input('purchase_data');
        $purchase_list = json_decode($data, true);
        $purchase_list = array_merge($purchase_list ?: [], [
            [
                'name' => $select_name,
            ]
        ]);
        $result = "";
        return view('cheapSearch.itemList', compact(['result','store_id_list','purchase_list']));
    }

    public function cheapSearch(Request $request)
    {
        //requestからstore_id_listとpurchase_dataを取得
        $id_data = $request->input('store_id_list');
        $store_id_list = json_decode($id_data, true);
        
        $data = $request->input('purchase_data');
        $purchase_list = json_decode($data, true);
        $item_names = array_column($purchase_list, 'name');

        //dd($id_data, $store_id_list, $item_names);

        $store_prices = [];  // 各店舗ごとの合計価格を格納する配列        

        foreach ($store_id_list as $store_id) {
            // 各店舗のplace_idと一致するStoreテーブルを取得
            //$store = Store::select('id')
                            //->where('place_id', $store_id)
                            //->first();

            $store = Store::select('stores.id', 'supplies.price')
                            ->join('supplies', 'stores.id', '=', 'supplies.store_id')
                            ->where('stores.place_id', $store_id)
                            ->whereIn('supplies.name', $item_names) // テーブル名を複数形に変更
                            ->first();
            //$storeの中身を確認
            //dd($store);
            //$db_store_id = $store->id;
            //dd($db_store_id);
            $total_price = 0;
            $all_items_available = true;

            //$sample = [];
            //$flag = 0;

            foreach ($item_names as $item_name) {
                
                //$sample[] = $store->price;

                if ($store) {
                    // 商品が見つかった場合、その商品の価格を合計に加算
                    $total_price += $store->price;
                } else {
                    // 商品が見つからない場合、その店舗での購入は不可能とし、フラグを変更
                    $all_items_available = false;
                    break;
                }

                //$flag++;
                //if($flag == 2){
                    //dd($total_price, $store->id);
                //}
            }

            if ($all_items_available) {
                // 全商品が揃っている店舗のみを対象にする
                $store_prices[$store_id] = $total_price;
            }
        }

        //dd($sample);

        // 最も安価な店舗を見つける
        if (!empty($store_prices)) {
            // 配列から最も低い合計金額を持つ店舗のIDを取得
            $min_price_store_id = array_keys($store_prices, min($store_prices))[0];
            $sum = $store_prices[$min_price_store_id];
            
            // `place_id` を使用して該当店舗を取得
            $store = Store::where('place_id', $min_price_store_id)->first();
            $store_name = $store ? $store->name : "店舗名不明";
        } else {
            // 全ての店舗で商品の在庫が不足している場合
            $sum = "該当する店舗が見つかりません";
            $store_name = "";
            $min_price_store_id = "";
        }

        // Google Places APIのエンドポイント
        $apiKey = env('GOOGLE_MAPS_API_KEY');

        return view('cheapSearch.result', compact(['sum', 'store_name','min_price_store_id','apiKey']));
    }
}
