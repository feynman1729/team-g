<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('最安値検索') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="p-6 text-gray-900">
                        <x-bladewind::table compact="true" divider="thin" no_data_message="買い物リストが空です" :data="$purchase_list" />
                    </div>
                    <form method="POST" id="search_item" action="{{ route('buyItemSearch') }}">
                        @csrf
                        <input type="hidden" name="store_id_list" value="{{ json_encode($store_id_list) }}">
                        <input type="hidden" name="purchase_data" value="{{ json_encode($purchase_list) }}">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            商品名検索
                            <div class="text-gray-900">
                                <x-bladewind::input type="text" name="search_word" />
                            </div>
                        </div>
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            {{ $result }}
                        </div>
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <x-bladewind::button
                                onclick="document.getElementById('search_item').submit();">商品検索する</x-bladewind::button>
                        </div>
                    </form>
                    <form method="POST" id="regist_list" action="{{ route('cheapSearchResult') }}">
                        @csrf
                        <input type="hidden" name="purchase_data" value="{{ json_encode($purchase_list) }}">
                        <input type="hidden" name="store_id_list" value="{{ json_encode($store_id_list) }}">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <x-bladewind::button
                                onclick="document.getElementById('regist_list').submit();">最安値検索する</x-bladewind::button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</x-app-layout>
