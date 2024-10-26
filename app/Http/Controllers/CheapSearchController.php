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
        $id_data = $request->input('store_id_list');
        $store_id_list = json_decode($id_data, true);
        /* example
            array:20 [▼ // app/Http/Controllers/CheapSearchController.php:98
            0 => "ChIJseNCfEF_QTUR17p0LUa3xgs"
            1 => "ChIJS7f4HyN-QTURV19WCcf2SsY"
            2 => "ChIJHW23E_HVQzURdTO7AEBuZpE"
            3 => "ChIJKcAIY4vVQzURjsjccz2TgtA"
            4 => "ChIJ6ZMjwhx-QTURhl2ck0k9C1k"
            5 => "ChIJUZ1s4Uh-QTUR-JUYBSne7f0"
            6 => "ChIJIaiWzVF-QTUR_c-p4geEaGU"
            7 => "ChIJ4_ySbUZ-QTURKmBMaA1uuic"
            8 => "ChIJ3ZjTkzp-QTURjExlIl2swu0"
            9 => "ChIJh7sVManVQzURQUZ8qYtG8Tc"
            10 => "ChIJYSaPWlB-QTURmsTG-uil2Dc"
            11 => "ChIJm8tiVtJ_QTURxhgfYPhFkq8"
            12 => "ChIJdxqmtl_VQzURRjQfgWmpXqM"
            13 => "ChIJKxlcPZCRQTURzGw_ET6drDg"
            14 => "ChIJp18lmeB9QTURVumulcUe-vs"
            15 => "ChIJG-5UQvPVQzURwSIMYN1hIeE"
            16 => "ChIJc-rcBenVQzURt-1QRLTe6Wo"
            17 => "ChIJSf6RFaR_QTURoGAmy2kZEfk"
            18 => "ChIJKWaNEPTVQzUR6_h1zDrf88I"
            19 => "ChIJv2zZTIjVQzURPcImlDQTgtQ"
            ]
        */
        $data = $request->input('purchase_data');
        $purchase_list = json_decode($data, true);
        $item_names = array_column($purchase_list, 'name');
        /*example
        array:3 [▼ // app/Http/Controllers/CheapSearchController.php:123
            0 => "刺身醬油"
            1 => "ケチャップ"
            2 => "マヨネーズ"
            ]
        */
        $sum = 0;
        $store_name = "ファインマン商店";
        return view('cheapSearch.result', compact(['sum', 'store_name']));
    }

}
