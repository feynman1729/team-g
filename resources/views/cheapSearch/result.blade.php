<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('最安値検索結果') }}
        </h2>
    </x-slot>

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
</x-app-layout>
