<div>
    @if($showModal)
    <form wire:submit.prevent="submit">
        <x-modal.dialog wire:model.defer="showModal">
            <x-slot name="title"><span class="icon-[tdesign--user-password] text-2xl flex flex-item-center"></span> Ubah Password</x-slot>
            <x-slot name="content">
                <div class="mb-2">
                    <x-input.group for="Password" :inline="'true'" label="Password " :error="$errors->first('form.password')">
                        <x-input.text leadingAddOn='<span class="icon-[lucide--key-round]"></span>' :id="__('password')" wire:model="form.password" placeholder="Password" type="password" />
                    </x-input.group>
                </div>
                <div class="mb-2">
                    <x-input.group for="Password" :inline="'true'" label="Ulangi Password " :error="$errors->first('form.repeat_password')">
                        <x-input.text leadingAddOn='<span class="icon-[lucide--key-round]"></span>' :id="__('repeat_password')" wire:model="form.repeat_password" placeholder="Ulangi Password" type="password" />
                    </x-input.group>
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-button.secondary wire:click="$set('showModal', false)">Cancel</x-button.secondary>
                <x-button.primary type="submit">Save</x-button.primary>
            </x-slot>
        </x-modal.dialog>
    </form>
    @endif

</div>
