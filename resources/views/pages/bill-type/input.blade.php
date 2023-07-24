<x-auth-layout>
  <div class="flex items-center justify-center p-6">
    <div class="mx-auto mt-4 bg-white dark:bg-[#182235] p-4 w-1/2">
      <form method="POST">
        <div class="space-y-12">
          <div class="border-b border-gray-900/10 pb-12">
            <h2 class="text-base font-semibold leading-7 text-gray-900">Bill Type</h2>
            <p class="mt-1 text-sm leading-6 text-gray-600">This information will be displayed publicly</p>
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')??@$item->name"  autofocus required autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div>
              <x-input-label for="amount" value="Amount" />
              <x-text-input type="number" id="amount" class="block mt-1 w-full" name="amount" :value="old('amount')??@$item->amount"  autofocus required autocomplete="name" />
              <x-input-error :messages="$errors->get('amount')" class="mt-2" />
          </div>
    
            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="descripton" value="Description" />
    
                <x-textarea-input :value="old('description')??@$item->description" id="descripton" class="block mt-1 w-full"
                                name="description" autocomplete="email" />
    
                <x-input-error :messages="$errors->get('descripton')" class="mt-2" />
            </div>
        </div>
      
        <div class="mt-6 flex items-center justify-end gap-x-6">
          <a href="{{ route('type.index') }}" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
          <x-primary-button>Save</x-button-primary>
        </div>
      </form>
    </div>
  </div>
</x-auth-layout>