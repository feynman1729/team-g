<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResultController extends Controller
{
    //
    public function map(Request $request)
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

         // ビューに$dataを渡す
        return view('result', compact('data'));

    }
}
