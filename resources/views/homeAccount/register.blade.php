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
                @if ($result)
                    <form method="POST" id="regist_item">
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
                @endif

                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <x-bladewind::button
                        onclick="document.getElementById('regist_item').submit();">商品登録画面へ</x-bladewind::button>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
