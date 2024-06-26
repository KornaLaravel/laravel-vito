<div>
    <x-secondary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'add-existing-key')">
        {{ __('Add existing Key') }}
    </x-secondary-button>

    <x-modal name="add-existing-key">
        <form wire:submit="add" class="p-6">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Add existing Key') }}
            </h2>

            <div class="mt-6">
                <x-input-label for="key_id" :value="__('SSH Key')" />
                <x-select-input wire:model="key_id" id="key_id" name="key_id" class="mt-1 w-full">
                    <option value="" selected disabled>{{ __("Select") }}</option>
                    @foreach($keys as $key)
                        <option value="{{ $key->id }}" @if($key->id === $key_id) selected @endif>{{ $key->name }}</option>
                    @endforeach
                </x-select-input>
                @error('key_id')
                <x-input-error class="mt-2" :messages="$message" />
                @enderror
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button type="button" x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-primary-button class="ml-3" @added.window="$dispatch('close')">
                    {{ __('Add') }}
                </x-primary-button>
            </div>
        </form>
    </x-modal>
</div>
