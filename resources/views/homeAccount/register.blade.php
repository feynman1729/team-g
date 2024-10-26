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
                    選択されたお店 : {{ $store_name }}
                </div>
                <div class="p-6 text-gray-900">
                    <x-bladewind::table compact="true" divider="thin" no_data_message="購入した物リストが空です" :data="$purchase_list" />
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
                        <input type="hidden" name="store_id" value="{{ $store_id }}">
                        <input type="hidden" name="store_name" value="{{ $store_name }}">
                        <input type="hidden" name="select_item" value="{{ $select_item }}">
                        <input type="hidden" name="purchase_data" value="{{ json_encode($purchase_list) }}">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            {{ $select_item }}が選択されています。
                        </div>
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            価格(円)
                            <div class="text-gray-900">
                                <x-bladewind::input type="text" name="item_price" />
                            </div>
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                <x-bladewind::button
                                    onclick="document.getElementById('regist_price').submit();">商品登録する</x-bladewind::button>
                            </div>
                        </div>
                    </form>
                @else
                    <!-- 検索用のフォーム -->
                    <form method="POST" id="search_item" action="{{ route('itemSearch') }}">
                        @csrf
                        <input type="hidden" name="store_id" value="{{ $store_id }}">
                        <input type="hidden" name="store_name" value="{{ $store_name }}">
                        <input type="hidden" name="purchase_data" value="{{ json_encode($purchase_list) }}">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            商品名検索
                            <div class="text-gray-900">
                                <x-bladewind::input type="text" name="search_word" />
                            </div>
                        </div>
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <x-bladewind::button
                                onclick="document.getElementById('search_item').submit();">商品検索する</x-bladewind::button>
                        </div>
                    </form>

                    <form method="POST" id="regist_list" action="{{ route('dateSelect') }}">
                        @csrf
                        <input type="hidden" name="store_name" value="{{ $store_name }}">
                        <input type="hidden" name="store_id" value="{{ $store_id }}">
                        <input type="hidden" name="purchase_data" value="{{ json_encode($purchase_list) }}">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <x-bladewind::button
                                onclick="document.getElementById('regist_list').submit();">日付選択へ</x-bladewind::button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
