<x-app-layout>
    
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('家計簿登録') }}
            </h2>
        </x-slot>
        <x-bladewind::tab-group
            name="sys-blue-tab"
            style="system">

            <x-slot:headings>
                <x-bladewind::tab-heading
                    name="sys-blue" active="true" label="収入入力" />
                <x-bladewind::tab-heading
                    name="inactive-sys-blue" label="支出入力" />
            </x-slot:headings>

            <x-bladewind::tab-body>
                <x-bladewind::tab-content
                    name="sys-blue" active="true">
                    
                                <!DOCTYPE html>
                                <html lang="ja">
                                <head>
                                    <meta charset="UTF-8">
                                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
                                    <title>収入入力</title>
                                    <style>
                                        /* Tailwind CSSの設定で背景色を設定 */
                                        body {
                                            background-color: #f3f4f6 /* 明るいグレーの背景色 */
                                        }
                                    </style>
                                </head>
                                <body>
                                    <div class="container mx-auto py-20 flex justify-center items-center h-screen">
                                        <div class="bg-white p-8 rounded-lg shadow-md w-1/2">
                                            <h2 class="text-center text-2xl font-semibold text-blue-600 mb-4">収入を入力</h2>
                                            
                                            <form action="{{ route('income_and_expenses.store') }}" method="POST">
                                                @csrf
                                                
                                                <div class="mb-4">
                                                    <label for="in_price" class="block text-gray-700">金額</label>
                                                    <input type="text" class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm" id="in_price" name="in_price" placeholder="金額を入力" readonly required>
                                                    
                                                    <!-- 電卓ボタン -->
                                                    <div class="grid grid-cols-4 gap-2 mt-2">
                                                        <button type="button" onclick="addNumber('1')" class="bg-blue-600 text-white py-2 rounded">1</button>
                                                        <button type="button" onclick="addNumber('2')" class="bg-blue-600 text-white py-2 rounded">2</button>
                                                        <button type="button" onclick="addNumber('3')" class="bg-blue-600 text-white py-2 rounded">3</button>
                                                        <button type="button" onclick="clearInput()" class="bg-gray-400 text-white py-2 rounded">C</button>
                                                        <button type="button" onclick="addNumber('4')" class="bg-blue-600 text-white py-2 rounded">4</button>
                                                        <button type="button" onclick="addNumber('5')" class="bg-blue-600 text-white py-2 rounded">5</button>
                                                        <button type="button" onclick="addNumber('6')" class="bg-blue-600 text-white py-2 rounded">6</button>
                                                        <button type="button" onclick="addNumber('0')" class="bg-blue-600 text-white py-2 rounded">0</button>
                                                        <button type="button" onclick="addNumber('7')" class="bg-blue-600 text-white py-2 rounded">7</button>
                                                        <button type="button" onclick="addNumber('8')" class="bg-blue-600 text-white py-2 rounded">8</button>
                                                        <button type="button" onclick="addNumber('9')" class="bg-blue-600 text-white py-2 rounded">9</button>
                                                        <button type="button" onclick="deleteNumber()" class="bg-gray-400 text-white py-2 rounded">←</button>
                                                    </div>
                                                </div>
                                                
                                                <div class="mb-4">
                                                    <label for="description" class="block text-gray-700">内容</label>
                                                    <input type="text" class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm" id="description" name="description" placeholder="内容を入力" required>
                                                </div>
                                                
                                                <div class="text-center">
                                                    <button type="submit" class="bg-blue-600 text-white py-2 rounded w-full">保存</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    
                                    <div class="absolute bottom-5 right-5 text-2xl text-blue-600">team-g</div>

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
                                </body>
                                </html>


                   </x-bladewind::tab-content>
                <x-bladewind::tab-content
                name="inactive-sys-blue">
                <!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>支出入力</title>
    <style>
        /* Tailwind CSSの設定で背景色を設定 */
        body {
            background-color: #f3f4f6; /* 明るいグレーの背景色 */
        }
    </style>
</head>
<body>
    <div class="container mx-auto py-20 flex justify-center items-center h-screen">
        <div class="bg-white p-8 rounded-lg shadow-md w-1/2">
            <h2 class="text-center text-2xl font-semibold text-blue-600 mb-4">支出を入力</h2>
            
            <form action="{{ route('income_and_expenses.store') }}" method="POST">
                @csrf
                
                <div class="mb-4">
                    <label for="out_price" class="block text-gray-700">金額</label>
                    <input type="text" class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm" id="out_price" name="out_price" placeholder="金額を入力" readonly required>
                    
                    <!-- 電卓ボタン -->
                    <div class="grid grid-cols-4 gap-2 mt-2">
                        <button type="button" onclick="add_Number('1')" class="bg-blue-600 text-white py-2 rounded">1</button>
                        <button type="button" onclick="add_Number('2')" class="bg-blue-600 text-white py-2 rounded">2</button>
                        <button type="button" onclick="add_Number('3')" class="bg-blue-600 text-white py-2 rounded">3</button>
                        <button type="button" onclick="clear_Input()" class="bg-gray-400 text-white py-2 rounded">C</button>
                        <button type="button" onclick="add_Number('4')" class="bg-blue-600 text-white py-2 rounded">4</button>
                        <button type="button" onclick="add_Number('5')" class="bg-blue-600 text-white py-2 rounded">5</button>
                        <button type="button" onclick="add_Number('6')" class="bg-blue-600 text-white py-2 rounded">6</button>
                        <button type="button" onclick="add_Number('0')" class="bg-blue-600 text-white py-2 rounded">0</button>
                        <button type="button" onclick="add_Number('7')" class="bg-blue-600 text-white py-2 rounded">7</button>
                        <button type="button" onclick="add_Number('8')" class="bg-blue-600 text-white py-2 rounded">8</button>
                        <button type="button" onclick="add_Number('9')" class="bg-blue-600 text-white py-2 rounded">9</button>
                        <button type="button" onclick="delete_Number()" class="bg-gray-400 text-white py-2 rounded">←</button>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label for="description" class="block text-gray-700">内容</label>
                    <input type="text" class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm" id="description" name="description" placeholder="内容を入力" required>
                </div>
                
                
                <div class="text-center">
                    <button type="submit" class="bg-blue-600 text-white py-2 rounded w-full">保存</button>
                </div>
            </form>
        </div>
    </div>
    
    <div class="absolute bottom-5 right-5 text-2xl text-blue-600">team-g</div>

    <script>
        // 電卓入力を管理するスクリプト
        function add_Number(number) {
            let inputField = document.getElementById('out_price');
            inputField.value += number;
        }
        
        function clear_Input() {
            document.getElementById('out_price').value = '';
        }

        function delete_Number() {
            let inputField = document.getElementById('out_price');
            inputField.value = inputField.value.slice(0, -1);
        }
    </script>
</body>
</html>



                </x-bladewind::tab-content>
            </x-bladewind::tab-body>

        </x-bladewind::tab-group>

        
    
</x-app-layout>
