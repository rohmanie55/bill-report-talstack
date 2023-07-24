<x-auth-layout>
    <div class="flex justify-between px-4 py-8">
        <h2 class="text-xl font-semibold">Bill Type</h2>
        <div>
            <a class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" href="{{ route('type.create') }}"><i class="fas fa-plus"></i> Add Bill Type</a>
        </div>
    </div>
    @php
        $columns = [
            ['label'=>'Code','key'=>'code'],
            ['label'=>'Name','key'=>'name'],
            ['label'=>'Amount','key'=>'amount', 'render'=>function($amount){
                return 'Rp ' . number_format($amount, 0, ',', '.');
            }],
            ['label'=>'Description','key'=>'description'],
            [
                'label'=>'Action',
                'key'=>'id', 
                'width'=> 10,
                'render'=>function($id){
                    return '
                        <div class="flex justify-between">
                        <a href="'.route('type.edit',$id).'"><i class="fas fa-edit"></i></a>
                        <form method="POST" action="'.route('type.destroy',$id).'" onsubmit="return confirm(\'Are you sure to delete?\')">
                            <input type="hidden" name="_method" value="DELETE">
                            '.csrf_field().'
                            <button><i class="fas fa-trash"></i></button>
                        </form>
                        </div>
                    ';
                }
            ],
        ]
    @endphp
    <x-data-table :columns="$columns" :datas="$types"/>
</x-auth-layout>