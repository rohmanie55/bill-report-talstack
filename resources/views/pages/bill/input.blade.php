<x-auth-layout>
  <div class="flex items-center justify-center p-6">
    <div class="mt-5 bg-white dark:bg-[#182235] p-4 w-1/2">
      <form method="POST">
        <div class="space-y-12">
          <div class="border-b border-gray-900/10 pb-12">
            <h2 class="text-base font-semibold leading-7 text-gray-900">Bill Input</h2>
            <p class="mt-1 text-sm leading-6 text-gray-600">This information will be displayed publicly</p>
            @csrf

            <div class="mt-4">
              <x-input-label for="user_id" value="User" />
  
              <x-select-picker id="role" label="name" key="id" :options="$users" class="block mt-1 w-full"
                              name="user_id"
                              :value="old('user_id')??@$item->user_id"
                              required/>
  
              <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
            </div>
            <div class="mt-4" x-data='{types: @json($types->keyBy('id')), setAmount: (value)=>{ 
              $refs.amount.value=value
            }}' x-init="setAmount(types[$refs.type_id.value]?.amount)">
              <x-input-label for="type_id" value="Type" />
  
              <x-select-picker x-ref="type_id" x-on:change="setAmount(types[event.target.value]?.amount)" id="role" label="name" key="id" :options="$types" class="block mt-1 w-full"
                              name="type_id"
                              :value="old('type_id')??@$item->type_id"
                              required/>
  
              <x-input-error :messages="$errors->get('type_id')" class="mt-2" />
            </div>

            <div class="mt-4">
              <x-input-label for="admin_note" value="Amount" />
  
              <x-text-input x-ref="amount" disabled class="block mt-1 w-full" style="background: ghostwhite"/>
  
              <x-input-error :messages="$errors->get('admin_note')" class="mt-2" />
            </div>
    
            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="admin_note" value="Note" />
    
                <x-textarea-input :value="old('admin_note')??@$item->admin_note" id="admin_note" class="block mt-1 w-full"
                                name="admin_note" autocomplete="email" />
    
                <x-input-error :messages="$errors->get('admin_note')" class="mt-2" />
            </div>
        </div>
      
        <div class="mt-6 flex items-center justify-end gap-x-6">
          <a href="{{ route('bill.index') }}" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
          <x-primary-button>Save</x-button-primary>
        </div>
      </form>
    </div>
  </div>
</x-auth-layout>