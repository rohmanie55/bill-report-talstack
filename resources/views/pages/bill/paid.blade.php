<x-auth-layout>
    <div class="flex justify-between px-4 py-8">
        <h2 class="text-xl font-semibold">Bill</h2>
        <div>

        </div>
    </div>
    @php
        $columns = [
            ['label'=>'Invoice','key'=>'code'],
            ['label'=>'Date','key'=>'pay_date'],
            ['label'=>'Costumer','key'=>'user', 'render'=>function($user){
                return $user->name;
            }],
            ['label'=>'Purchase','key'=>'type', 'render'=>function($type){
                return $type->name;
            }],
            ['label'=>'Status','key'=>'status', 'render'=>function($status){
                $statusList=[
                'submited'=>'text-emerald-500 bg-emerald-100/60',
                'created'=>'text-orange-500 bg-orange-100',
                'paid'=>'text-blue-500 bg-blue-100',
                'canceled'=>'text-red-500 bg-red-100/60'
            ];
                return '
                <div class="inline-flex items-center px-3 py-1 rounded-full gap-x-2 '.($statusList[$status]).' dark:bg-gray-800">
                    <h2 class="text-sm font-normal">'.($status).'</h2>
                </div>
                ';
            }],
            ['label'=>'Note Admin','key'=>'admin_note', 'width'=>20],
            ];
    @endphp
    <x-data-table :columns="$columns" :datas="$bills">
    </x-data-table>
</x-auth-layout>