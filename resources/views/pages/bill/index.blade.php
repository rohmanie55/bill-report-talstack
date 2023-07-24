<x-auth-layout>
    <div class="flex justify-between px-4 py-8">
        <h2 class="text-xl font-semibold">Bill</h2>
        <div>
            <a class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" href="{{ route('bill.create') }}"><i class="fas fa-plus"></i> Add Bill</a>
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
            ['label'=>'Note','key'=>'admin_note'],
            [
                'label'=>'Action',
                'key'=>'id', 
                'width'=> 10,
                'render'=>function($id){
                    return '
                        <div class="flex justify-between">
                        <a href="'.route('bill.edit',$id).'"><i class="fas fa-edit"></i></a>
                        <form method="POST" action="'.route('bill.destroy',$id).'" onsubmit="return confirm(\'Are you sure to delete?\')">
                            <input type="hidden" name="_method" value="DELETE">
                            '.csrf_field().'
                            <button><i class="fas fa-trash"></i></button>
                        </form>
                        </div>
                    ';
                }
            ],
            ];
    @endphp
    <x-data-table :columns="$columns" :datas="$bills">
    </x-data-table>
</x-auth-layout>