@php
    $region = [
        ['region' => '川津', 'value' => 'fukuokaken iiduka kawazu'],
        ['region' => '幸袋', 'value' => 'fukuokaken iiduka koubukuro'],
        ['region' => '立岩', 'value' => 'fukuokaken iiduka tateiwa'],
        ['region' => '二瀬', 'value' => 'fukuokaken iiduka hutase'],
        ['region' => '伊岐須', 'value' => 'fukuokaken iiduka igisu'],
    ];
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('家計簿登録') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">

                <form method="POST" action={{ route('shopSelect') }} id="select_region">
                    @csrf
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        地域を選択する
                        <div class="text-gray-900">
                            <x-bladewind::dropdown name="region" label_key="region" value_key="value"
                                :data="$region" />
                        </div>
                    </div>
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <x-bladewind::button
                            onclick="document.getElementById('select_region').submit();">店舗選択画面へ</x-bladewind::button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
