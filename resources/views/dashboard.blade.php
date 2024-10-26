<x-app-layout>
    <div class="p-6 bg-white dark:bg-gray-800 shadow-sm">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">

                貯金額:{{$result}}円
            </h2>
        </x-slot>
    </div>

    <div class="p-6 gap-4 flex flex-col">
        @foreach ($income_and_expense as $key => $items)
            <x-bladewind::card class="mx-16 bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <x-bladewind::list-view class="text-gray-900 dark:text-gray-100">
                    <h2 class="py-2 text-4xl font-bold">{{ $key }}月</h2> <!-- 年-月の形式で表示 -->
                    @foreach ($items as $item)
                        <x-bladewind::list-item>
                            <div class="ml-3">

                                <ul>

                                    <li>
                                        <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                            日付: {{ $item->date }} <br>
                                        </div>
                                        <div class="text-xl font-medium text-gray-900 dark:text-gray-100">
                                            @if ($item->delta >= 0)
                                                <span class="text-green-600">収入: </span>
                                            @else
                                                <span class="text-red-600">支出: </span>
                                            @endif
                                            {{ abs($item->delta) }} <br>
                                        </div>
                                        <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                            内容: {{ $item->description }} <br>
                                            @if ($item->description = null)
                                                <span>店舗情報: なし</span>
                                            @else
                                                <span>店舗情報: {{ $item->store_id }}</span>
                                            @endif
                                        </div>

                                    </li>

                                </ul>

                            </div>
                        </x-bladewind::list-item>
                    @endforeach
                </x-bladewind::list-view>
            </x-bladewind::card>
        @endforeach

    </div>
</x-app-layout>
