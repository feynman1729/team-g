<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ShopSelectController extends Controller
{
    public function select(Request $request)
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
        $supermarkets = [];
        if (isset($data['results'])) {
            foreach ($data['results'] as $place) {
                // 必要な情報を整形して配列に追加
                $supermarkets[] = [
                    'name' => $place['name'],
                    'place_id' => $place['place_id'],
                ];
            }
        }

        $stores = $supermarkets;
        return view('homeAccount.shopSelect', compact('stores', 'region'));
        // $stores をセッションに保存
        //session(['stores' => $supermarkets]);
        //return redirect()->route('dashboard');
    }

}
