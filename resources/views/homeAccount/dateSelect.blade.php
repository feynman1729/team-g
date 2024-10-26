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
                <form method="POST" action={{ route('listRegist') }} id="select_date">
                    @csrf
                    <input type="hidden" name="store_name" value="{{ $store_name }}">
                    <input type="hidden" name="purchase_data" value="{{ json_encode($purchase_list) }}">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        日付を選択する
                        <div class="text-gray-900">

                            <input type="date"
                                class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm" id="date"
                                name="date" placeholder="日付を入力" required>
                        </div>
                    </div>
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <x-bladewind::button
                            onclick="document.getElementById('select_date').submit();">店舗選択画面へ</x-bladewind::button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
