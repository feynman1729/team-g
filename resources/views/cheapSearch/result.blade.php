<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('最安値検索結果') }}
        </h2>
    </x-slot>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    /* 地図のサイズを指定 */
    #map {
      height: 400px;
      width: 100%;
    }
  </style>
</head>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    最も安く買える店舗は {{ $store_name }}で<br />
                    <span class = "text-blue-600">
                    {{ $sum }}円
                    </span>で購入することができます！！
                </div>
            </div>
        </div>
    </div>
    <div id="map"></div>

  <script>
    function initMap() {
      // 東京タワーの緯度と経度
      const location = { lat: 35.6586, lng: 139.7454 };

      // マップを指定の場所に表示
      const map = new google.maps.Map(document.getElementById("map"), {
        center: location,
        zoom: 15, // ズームレベル
      });

      // マーカーを追加
      new google.maps.Marker({
        position: location,
        map: map,
      });
    }
  </script>

  <!-- Google Maps APIのスクリプトをロード -->
  <script src="https://maps.googleapis.com/maps/api/js?key=GOOGLE_MAPS_API_KEY&callback=initMap" async defer></script>
</x-app-layout>
