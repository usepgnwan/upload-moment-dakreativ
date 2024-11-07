<section class="max-h-screen h-screen flex items-center justify-center flex-col   text-slate-400   bg-gray-700  ">
    <div class="flex gap-3 items-center justify-center mb-3">
        <img src="{{ asset('assets/2.png') }}" alt="" class="w-72 max-lg:w-52">
    </div>
    <div class="  my-4 w-11/12 sm:w-2/5 mx-auto rounded-2xl sm:py-6   shadow-md p-12 border-t-4  border-slate-800 mb-5  ">
        <h3 class="text-2xl font-semibold mb-3">Login</h3>
        <form wire:submit="login" class="w-full mt-2">
            <div class="mb-4">
                <x-input.errors for="Password" :error="$errors->first('email')">
                    <x-input.text-line leadingAddOn='<span class="icon-[solar--user-line-duotone]"></span> ' wire:model="email" :id="__('email')" placeholder="username / email" type="input" wire:model="email" />
                </x-input.errors>
            </div>
            <div class="mb-4">
                <x-input.errors for="Password" :error="$errors->first('password')">
                    <x-input.text-line leadingAddOn='<span class="icon-[carbon--password]"></span> ' wire:model="password" :id="__('email')" placeholder="password" type="password" wire:model="password" />
                </x-input.errors>
            </div>
            <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login</button>
        </form>
    </div>
</section>
