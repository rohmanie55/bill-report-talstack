<x-auth-layout>
  <div class="flex items-center justify-center p-6">
    <div class="mx-auto mt-4 bg-white dark:bg-[#182235] p-4 w-1/2">
      <form method="POST">
        <div class="space-y-12">
          <div class="border-b border-gray-900/10 pb-12">
            <h2 class="text-base font-semibold leading-7 text-gray-900">Users</h2>
            <p class="mt-1 text-sm leading-6 text-gray-600">This information will be displayed publicly so be careful what you share.</p>
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')??@$item->name"  autofocus required autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
    
            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')??@$item->email" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
    
            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
    
                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                :required="is_null(@$item)" autocomplete="email" />
    
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="mt-4">
              @php
                  $options = [["value"=>"user", "label"=>"User"],["value"=>"admin", "label"=>"Admin"]];
              @endphp
              <x-input-label for="role" value="Role" />
  
              <x-select-picker id="role" label="label" key="value" :options="$options" class="block mt-1 w-full"
                              name="role"
                              :value="old('role')??@$item->role"
                              required autocomplete="new-password" />
  
              <x-input-error :messages="$errors->get('role')" class="mt-2" />
            </div>
            <div class="mt-4 flex">
              <input type="checkbox" {{old('is_active')??@$item->is_active ? 'checked' : ''}} name="is_active" id="active" class="toggle-checkbox block w-6 h-6 mr-2 bg-white border-2 rounded-full appearance-none cursor-pointer"/>
              <label for="active">Active</label>
            </div>
        </div>
      
        <div class="mt-6 flex items-center justify-end gap-x-6">
          <a href="{{ route('users.index') }}" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
          <x-primary-button>Save</x-button-primary>
        </div>
      </form>
    </div>
  </div>
</x-auth-layout>