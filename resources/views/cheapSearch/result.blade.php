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
      height: 300px; /* 必要に応じて高さを調整 */
      width: 100%;
      border-radius: 0 0 0.5rem 0.5rem; /* カードの角丸に合わせて調整 */
    }
  </style>
</head>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    最も安く買える店舗は 
                    <span class = "text-blue-600">{{ $store_name }}</span>で<br />
                    <span class = "text-blue-600">{{ $sum }}円</span>で購入することができます！！
                </div>
            </div>
        </div>
    </div>

     <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div id="map"></div>
                </div>
            </div>
        </div>
    </div>

      <!-- Google Maps APIのスクリプトをロード -->
  <script async src='https://maps.googleapis.com/maps/api/js?key={{$apiKey}}&libraries=places&callback=initMap'></script>
  <script>
    function initMap() {
      // Place IDを指定
      const placeId = '{{$min_price_store_id}}';
      console.log(placeId);
      // マップを初期化
      const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 15,
      });

      // Places Serviceを使用してPlace IDに基づいてランドマークを取得
      const service = new google.maps.places.PlacesService(map);
      service.getDetails({ placeId: placeId }, (place, status) => {
        if (status === google.maps.places.PlacesServiceStatus.OK) {
          // 場所の位置を中心に地図を表示
          map.setCenter(place.geometry.location);

          // ランドマークのマーカーを表示
          new google.maps.Marker({
            position: place.geometry.location,
            map: map,
            title: place.name,
          });
        } else {
          console.error("ランドマークの詳細情報を取得できませんでした:", status);
        }
      });
    }

    // ページロード時にマップを初期化
    window.onload = initMap;
  </script>

</x-app-layout>
