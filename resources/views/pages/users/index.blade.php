<x-auth-layout>
    <div class="flex justify-between px-4 py-8">
        <h2 class="text-xl font-semibold">Users</h2>
        <div>
            <a class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" href="{{ route('users.create') }}"><i class="fas fa-plus"></i> Add User</a>
        </div>
    </div>
    @php
        $columns = [
            ['label'=>'Name','key'=>'name'],
            ['label'=>'Email','key'=>'email'],
            ['label'=>'Role','key'=>'role'],
            ['label'=>'Status','key'=>'is_active', 'render'=>function($status){
                return '
                <div class="inline-flex items-center px-3 py-1 rounded-full gap-x-2 '.($status?'text-emerald-500 bg-emerald-100/60':'text-red-500 bg-red-100/60').' dark:bg-gray-800">
                    <h2 class="text-sm font-normal">'.($status?'Active':'Inactive').'</h2>
                </div>
                ';
            }],
            [
                'label'=>'Action',
                'key'=>'id', 
                'width'=> 10,
                'render'=>function($id){
                    return '
                        <div class="flex justify-between">
                        <a href="'.route('users.edit',$id).'"><i class="fas fa-edit"></i></a>
                        <form method="POST" action="'.route('users.destroy',$id).'" onsubmit="return confirm(\'Are you sure to delete?\')">
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
    <x-data-table :columns="$columns" :datas="$users"/>
</x-auth-layout>