<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            
            貯金額:
        </h2>
    </x-slot>

    <x-bladewind::card class="mx-16">

    <x-bladewind::list-view>
        @foreach ($income_and_expense as $key => $items)
        <h2 class="text-4xl font-bold">{{ $key }}月</h2> <!-- 年-月の形式で表示 -->
        @foreach ($items as $item)
        <x-bladewind::list-item>

        <div class="ml-3">
            
                <ul>
                    
                        <li>
                            <div class="text-sm font-medium text-slate-900">
                                日付: {{ $item->date }} <br>
                            </div>
                            <div class="text-xl font-medium text-slate-900">
                                @if ($item->delta >= 0)
                                    <span class="text-green-600">収入: </span>
                                @else
                                    <span class="text-red-600">支出: </span>
                                @endif
                                {{ abs($item->delta) }} <br>
                            </div>
                            <div class="text-sm font-medium text-slate-900">
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
        @endforeach
        
    </x-bladewind::list-view>

</x-bladewind::card>
</x-app-layout>
