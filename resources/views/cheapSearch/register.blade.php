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
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                </div>
                <form method="POST" action={{ route('selectGoTo') }} id="select_region">
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
                            onclick="document.getElementById('select_region').submit();">買い物リスト作成へ</x-bladewind::button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
