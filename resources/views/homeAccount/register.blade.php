<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('家計簿登録') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    選択されたお店 : {{ $store_name }} store_id : {{ $store_id }}
                </div>
                <div class="p-6 text-gray-900">
                    <x-bladewind::table compact="true" divider="thin">
                        <x-slot name="header">
                            <th>商品名</th>
                            <th>価格</th>
                        </x-slot>
                    </x-bladewind::table>
                </div>
                @if ($result === '該当する商品がありません')
                    <!-- 商品がない場合のフォーム -->
                    <form method="POST" id="regist_new_item" action="{{ route('itemSelect') }}">
                        @csrf
                        <input type="hidden" name="store_id" value="{{ $store_id }}">
                        <input type="hidden" name="store_name" value="{{ $store_name }}">
                        <input type="hidden" name="purchase_data" value="{{ json_encode($purchase_list) }}">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            {{ $result }}
                        </div>
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            商品が無い場合はこちらに入力してください。
                            <x-bladewind::input type="text" name="item_name" />
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                <x-bladewind::button
                                    onclick="document.getElementById('regist_new_item').submit();">商品選択する</x-bladewind::button>
                            </div>
                        </div>
                    </form>
                @elseif ($result !== [])
                    <!-- 商品がある場合のフォーム -->
                    <form method="POST" id="regist_item" action="{{ route('itemSelect') }}">
                        @csrf
                        <input type="hidden" name="store_id" value="{{ $store_id }}">
                        <input type="hidden" name="store_name" value="{{ $store_name }}">
                        <input type="hidden" name="purchase_data" value="{{ json_encode($purchase_list) }}">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            商品を選択する
                            <div class="text-gray-900">
                                <x-bladewind::dropdown name="name" label_key="name" value_key="name"
                                    :data="$result" />
                            </div>
                        </div>
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            商品が無い場合は新規登録してください。
                            <x-bladewind::input type="text" name="item_name" />
                        </div>
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <x-bladewind::button
                                onclick="document.getElementById('regist_item').submit();">商品選択する</x-bladewind::button>
                        </div>
                    </form>
                @elseif($select_item)
                    <!-- 既に選択されている場合のフォーム -->
                    <form method="POST" id="regist_price" action="{{ route('priceSelect') }}">
                        @csrf
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            店舗を選択する
                            <div class="text-gray-900">
                                <x-bladewind::dropdown name="shop" label_key="name" value_key="value"
                                    :data="$stores" />
                            </div>
                        </div>
                    </form>
                @else
                    <form method="POST" id="regist_item">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            商品名検索
                            <div class="text-gray-900">
                                <x-bladewind::input type="text" name="item_name" />
                            </div>
                        </div>
                    </form>
                @endif

                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <x-bladewind::button
                        onclick="document.getElementById('regist_item').submit();">商品登録画面へ</x-bladewind::button>
                </div>
            </div>
        </div>
    </div>
    </div>
    
    <div class="absolute bottom-5 right-5 text-2xl text-blue-600">team-g</div>

    <script>
        // 電卓入力を管理するスクリプト
        function add_Number(number) {
            let inputField = document.getElementById('out_price');
            inputField.value += number;
        }
        
        function clear_Input() {
            document.getElementById('out_price').value = '';
        }

        function delete_Number() {
            let inputField = document.getElementById('out_price');
            inputField.value = inputField.value.slice(0, -1);
        }
    </script>
</body>
</html>



                </x-bladewind::tab-content>
            </x-bladewind::tab-body>

        </x-bladewind::tab-group>

        
    
</x-app-layout>
