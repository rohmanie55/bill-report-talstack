<x-auth-layout>
    <div class="flex justify-between px-4 py-8">
        <h2 class="text-xl font-semibold">Bill Data</h2>
        <div style="width: 100px">
            <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" x-on:change="window.location='{{ url()->current()}}?year='+event.target.value">
                @for ($year=now()->year;$year>=$minYear;$year--)
                    <option value="{{$year}}" {{ request('year')==$year?'selected': ''}}>{{ $year}}</option>
                @endfor
            </select>
        </div>
    </div>
    @php
        $columns = [
            ['label'=>'Costumer','key'=>'name'],
            ['label'=>'Jan','key'=>'jan', 'render'=>function($num){ return 'Rp. '.number_format($num, 0, ',', '.');}],
            ['label'=>'Feb','key'=>'feb', 'render'=>function($num){ return 'Rp. '.number_format($num, 0, ',', '.');}],
            ['label'=>'Mar','key'=>'mar', 'render'=>function($num){ return 'Rp. '.number_format($num, 0, ',', '.');}],
            ['label'=>'Apr','key'=>'apr', 'render'=>function($num){ return 'Rp. '.number_format($num, 0, ',', '.');}],
            ['label'=>'Mei','key'=>'mei', 'render'=>function($num){ return 'Rp. '.number_format($num, 0, ',', '.');}],
            ['label'=>'Jun','key'=>'jun', 'render'=>function($num){ return 'Rp. '.number_format($num, 0, ',', '.');}],
            ['label'=>'Jul','key'=>'jul', 'render'=>function($num){ return 'Rp. '.number_format($num, 0, ',', '.');}],
            ['label'=>'Aug','key'=>'aug', 'render'=>function($num){ return 'Rp. '.number_format($num, 0, ',', '.');}],
            ['label'=>'Sep','key'=>'sep', 'render'=>function($num){ return 'Rp. '.number_format($num, 0, ',', '.');}],
            ['label'=>'Okt','key'=>'okt', 'render'=>function($num){ return 'Rp. '.number_format($num, 0, ',', '.');}],
            ['label'=>'Nov','key'=>'nov', 'render'=>function($num){ return 'Rp. '.number_format($num, 0, ',', '.');}],
            ['label'=>'Des','key'=>'des', 'render'=>function($num){ return 'Rp. '.number_format($num, 0, ',', '.');}],
            ['label'=>'Total Bill','key'=>'total_bill', 'render'=>function($num){ return 'Rp. '.number_format($num, 0, ',', '.');}],
            ['label'=>'Total Pay','key'=>'total_pay', 'render'=>function($num){ return 'Rp. '.number_format($num, 0, ',', '.');}],
            ['label'=>'Difference','key'=>'sum_bill', 'render'=>function($num){
                return $num>0? 'Kurang Rp. '.number_format($num, 0, ',', '.') : 'Lebih Rp. '.number_format(abs($num), 0, ',', '.');
            }]
        ];
    @endphp
    <x-data-table :columns="$columns" :datas="$reports">
    </x-data-table>
</x-auth-layout>