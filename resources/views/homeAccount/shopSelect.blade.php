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
                    選択された地域: {{ $region }}
                </div>
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    店舗を選択する
                    <div class="text-gray-900">
                        <x-bladewind::dropdown name="shop" label_key="name" value_key="value" :data="$shops" />
                    </div>
                </div>

                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href={{ route('shopSelect') }}>
                        <x-bladewind::button onclick="">商品登録画面へ</x-bladewind::button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
