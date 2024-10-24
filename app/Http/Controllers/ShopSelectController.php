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

        // 緯度経度を取得
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');

        // Google Places APIのエンドポイント
        $apiKey = env('GOOGLE_MAPS_API_KEY');
        $radius = 2000; // 半径2km
        $type = 'supermarket';

        // Google Places APIへのリクエストURL
        $url = "https://maps.googleapis.com/maps/api/place/nearbysearch/json?location={$latitude},{$longitude}&radius={$radius}&type={$type}&key={$apiKey}";

        // HTTPリクエストを送信し、レスポンスを取得
        $response = Http::get($url);

        // レスポンスを解析
        $data = $response->json();

        // スーパーマーケットのリストを作成
        $supermarkets = [];
        if (isset($data['results'])) {
            foreach ($data['results'] as $place) {
                $supermarkets[] = [
                    'name' => $place['name'],
                    'place_id' => $place['place_id'],
                ];
            }
        }

        // 結果をビューに渡す
        $shops = $supermarkets;

        return view('homeAccount.shopSelect', compact(['shops', 'region']));
    }
}
