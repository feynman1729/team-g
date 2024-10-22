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
                    ここに買いたいものを登録する
                </div>
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('cheapSearchResult') }}">
                        <x-bladewind::button>
                            このリストで最安値を検索する
                        </x-bladewind::button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
