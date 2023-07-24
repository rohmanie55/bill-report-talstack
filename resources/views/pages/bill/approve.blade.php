<x-auth-layout>
    <div  x-data="{data:null, getData: (data)=>{
            if(!data) return;
            return JSON.parse(atob(data))
        }}">
    <div class="flex justify-between px-4 py-8">
        <h2 class="text-xl font-semibold">Bill Approve</h2>
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
            ['label'=>'Note User','key'=>'user_note', 'width'=>20],
            [
                'label'=>'Action',
                'key'=>null, 
                'width'=> 10,
                'render'=>function($data){
                    return '
                        <div class="flex justify-between">
                            <button x-on:click.prevent="$dispatch(\'open-modal\', \'confirm-approve\'); data=\''.base64_encode(json_encode($data)).'\'"><i class="fas fa-check"></i></button>
                        </div>
                    ';
                }
            ],
            ];
    @endphp
    <x-data-table :columns="$columns" :datas="$bills">
    </x-data-table>
    <x-modal name="confirm-approve" :show="false">
        <form action="{{ route('bill.approve') }}" method="post" class="p-6">
            @csrf

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Approve Bill Data') }}
            </h2>

            <div class="mt-6 px-4">
                <ul class="list-disc">
                    <input type="hidden" name="id" :value="getData(data)?.id">
                    <li>Costumer Name: <strong x-text="getData(data)?.user.name"></strong></li>
                    <li>Billing Type: <strong x-text="getData(data)?.type.name"></strong></li>
                    <li>Billing Amount: <strong x-text="getData(data)?.bill_amount"></strong></li>
                    <li>Billing Paid: <strong x-text="getData(data)?.pay_amount"></strong></li>
                    <li>Billing Date: <strong x-text="getData(data)?.pay_date"></strong></li>
                    <li>Billing Slip: <a x-bind:href="getData(data)?.slip_url"><strong x-text="getData(data)?.pay_slip"></strong></a></li>
                    <li>Costumer Note: <strong x-text="getData(data)?.user_note"></strong></li>
                    <li>Admin Note: <strong x-text="getData(data)?.admin_note"></strong></li>
                </ul>
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>
                {{-- <x-danger-button name="approve" value="N" class="ml-3">
                    {{ __('Reject') }}
                </x-danger-button> --}}
                <x-primary-button name="approve" value="Y" class="ml-3">
                    {{ __('Approve') }}
                </x-primary-button>
            </div>
        </form>
    </x-modal>
</div>
</x-auth-layout>