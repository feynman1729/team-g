@php
    $region = [
        ['region' => '川津', 'value' => '福岡県飯塚市川津のスーパー'],
        ['region' => '幸袋', 'value' => '福岡県飯塚市幸袋のスーパー'],
        ['region' => '立岩', 'value' => '福岡県飯塚市立岩のスーパー'],
        ['region' => '二瀬', 'value' => '福岡県飯塚市二瀬のスーパー'],
        ['region' => '伊岐須', 'value' => '福岡県飯塚市伊岐須のスーパー'],
    ];
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('お買い物へ行く') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="p-6 text-gray-900">
                        <x-bladewind::table compact="true" divider="thin" no_data_message="買い物リストが空です" :data="$purchase_list" />
                    </div>
                    <form method="POST" id="regist_item" action="{{ route('buyItemSelect') }}">
                        @csrf
                        <input type="hidden" name="store_id_list" value="{{ json_encode($store_id_list) }}">
                        <input type="hidden" name="purchase_data" value="{{ json_encode($purchase_list) }}">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            商品を選択する
                            <div class="text-gray-900">
                                <x-bladewind::dropdown name="name" label_key="name" value_key="name"
                                    :data="$result" />
                            </div>
                        </div>
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <x-bladewind::button
                                onclick="document.getElementById('regist_item').submit();">商品選択する</x-bladewind::button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
