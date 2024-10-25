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
            {{ __('家計簿登録') }}
        </h2>
    </x-slot>
    <div class="pt-6 text-gray-900 dark:text-gray-100">
        <x-bladewind::tab-group name="sys-blue-tab" style="system">
            <x-slot:headings>
                <x-bladewind::tab-heading name="sys-blue" active="true" label="支出入入力" />
                <x-bladewind::tab-heading name="inactive-sys-blue" label="店舗での購入" />
            </x-slot:headings>
            <x-bladewind::tab-body>
                <x-bladewind::tab-content name="sys-blue" active="true">
                    <div class="container mx-auto py-20 flex justify-center items-center h-screen">
                        <div class="bg-white p-8 rounded-lg shadow-md w-1/2">
                            <h2 class="text-center text-2xl font-semibold text-blue-600 mb-4">支出入を入力</h2>
                            <form action="{{ route('income_and_expenses.store') }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <div class="flex items-center justify-center space-x-4">
                                        <!-- 左側のラベル：収入 -->
                                        <span class="text-gray-700 font-semibold">収入</span>

                                        <!-- トグルスイッチ -->
                                        <x-bladewind::toggle bar="thicker" name="toggle" />

                                        <!-- 右側のラベル：支出 -->
                                        <span class="text-gray-700 font-semibold">支出</span>
                                    </div>

                                    <label for="in_price" class="block text-gray-700">金額</label>
                                    <div class="p-6 text-gray-900">
                                        <input type="text"
                                            class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                            id="in_price" name="in_price" placeholder="金額を入力" readonly required>
                                    </div>
                                    <!-- 電卓ボタン -->
                                    <div class="grid grid-cols-4 gap-2 mt-2">
                                        <button type="button" onclick="addNumber('1')"
                                            class="bg-blue-600 text-white py-2 rounded">1</button>
                                        <button type="button" onclick="addNumber('2')"
                                            class="bg-blue-600 text-white py-2 rounded">2</button>
                                        <button type="button" onclick="addNumber('3')"
                                            class="bg-blue-600 text-white py-2 rounded">3</button>
                                        <button type="button" onclick="clearInput()"
                                            class="bg-gray-400 text-white py-2 rounded">C</button>
                                        <button type="button" onclick="addNumber('4')"
                                            class="bg-blue-600 text-white py-2 rounded">4</button>
                                        <button type="button" onclick="addNumber('5')"
                                            class="bg-blue-600 text-white py-2 rounded">5</button>
                                        <button type="button" onclick="addNumber('6')"
                                            class="bg-blue-600 text-white py-2 rounded">6</button>
                                        <button type="button" onclick="addNumber('0')"
                                            class="bg-blue-600 text-white py-2 rounded">0</button>
                                        <button type="button" onclick="addNumber('7')"
                                            class="bg-blue-600 text-white py-2 rounded">7</button>
                                        <button type="button" onclick="addNumber('8')"
                                            class="bg-blue-600 text-white py-2 rounded">8</button>
                                        <button type="button" onclick="addNumber('9')"
                                            class="bg-blue-600 text-white py-2 rounded">9</button>
                                        <button type="button" onclick="deleteNumber()"
                                            class="bg-gray-400 text-white py-2 rounded">←</button>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="description" class="block text-gray-700">内容</label>
                                    <div class="p-6 text-gray-900">
                                        <input type="text"
                                            class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                            id="description" name="description" placeholder="内容を入力" required>
                                    </div>
                                </div>
                                <button type="submit" class="bg-blue-600 text-white py-2 rounded w-full">保存</button>

                            </form>
                        </div>
                    </div>


                    <script>
                        // 電卓入力を管理するスクリプト
                        function addNumber(number) {
                            let inputField = document.getElementById('in_price');
                            inputField.value += number;
                        }

                        function clearInput() {
                            document.getElementById('in_price').value = '';
                        }

                        function deleteNumber() {
                            let inputField = document.getElementById('in_price');
                            inputField.value = inputField.value.slice(0, -1);
                        }
                    </script>
                </x-bladewind::tab-content>
                <x-bladewind::tab-content name="inactive-sys-blue">
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
                </x-bladewind::tab-content>
            </x-bladewind::tab-body>
        </x-bladewind::tab-group>
    </div>
</x-app-layout>
