<x-card>
    <x-slot name="title">{{ __("Edit Server") }}</x-slot>

    <x-slot name="description">{{ __("You can edit your server's some of fields") }}</x-slot>

    <form id="update-server" wire:submit="update" class="mt-6 space-y-6">
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input wire:model="name" id="name" name="name" type="text" class="mt-1 block w-full" required autocomplete="name" />
            @error('name')
            <x-input-error class="mt-2" :messages="$message" />
            @enderror
        </div>

        <div>
            <x-input-label for="ip" :value="__('IP Address')" />
            <x-text-input wire:model="ip" id="ip" name="ip" type="text" class="mt-1 block w-full" required autocomplete="ip" />
            @error('ip')
            <x-input-error class="mt-2" :messages="$message" />
            @enderror
        </div>

        <div>
            <x-input-label for="port" :value="__('SSH Port')" />
            <x-text-input wire:model="port" id="port" name="port" type="text" class="mt-1 block w-full" required autocomplete="port" />
            @error('port')
            <x-input-error class="mt-2" :messages="$message" />
            @enderror
        </div>
    </form>

    <x-slot name="actions">
        @if (session('status') === 'server-updated')
            <p class="mr-2">{{ __('Saved') }}</p>
        @endif
        <x-primary-button form="update-server" wire:loading.attr="disabled">{{ __('Save') }}</x-primary-button>
    </x-slot>
</x-card>
