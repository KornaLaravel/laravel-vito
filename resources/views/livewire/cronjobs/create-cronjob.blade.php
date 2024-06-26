<div>
    <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-cronjob')">
        {{ __('Create Cronjob') }}
    </x-primary-button>

    <x-modal name="create-cronjob">
        <form wire:submit="create" class="p-6">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Create Cronjob') }}
            </h2>

            <div class="mt-6">
                <x-input-label for="command" :value="__('Command')" />
                <x-text-input wire:model="command" id="command" name="command" type="text" class="mt-1 w-full" />
                @error('command')
                <x-input-error class="mt-2" :messages="$message" />
                @enderror
            </div>

            <div class="mt-6">
                <x-input-label for="user" :value="__('User')" />
                <x-select-input wire:model="user" id="user" name="user" class="mt-1 w-full">
                    <option value="" selected disabled>{{ __("Select") }}</option>
                    <option value="root" @if($user === 'root') selected @endif>root</option>
                    <option value="{{ $server->ssh_user }}" @if($user === $server->ssh_user) selected @endif>{{ $server->ssh_user }}</option>
                </x-select-input>
                @error('user')
                <x-input-error class="mt-2" :messages="$message" />
                @enderror
            </div>

            <div class="mt-6">
                <x-input-label for="frequency" :value="__('Frequency')" />
                <x-select-input wire:model.live="frequency" id="frequency" name="frequency" class="mt-1 w-full">
                    <option value="" selected disabled>{{ __("Select") }}</option>
                    <option value="* * * * *" @if($frequency === '* * * * *') selected @endif>{{ __("Every minute") }}</option>
                    <option value="0 * * * *" @if($frequency === '0 * * * *') selected @endif>{{ __("Hourly") }}</option>
                    <option value="0 0 * * *" @if($frequency === '0 0 * * *') selected @endif>{{ __("Daily") }}</option>
                    <option value="0 0 * * 0" @if($frequency === '0 0 * * 0') selected @endif>{{ __("Weekly") }}</option>
                    <option value="0 0 1 * *" @if($frequency === '0 0 1 * *') selected @endif>{{ __("Monthly") }}</option>
                    <option value="custom">{{ __("Custom") }}</option>
                </x-select-input>
                @error('frequency')
                <x-input-error class="mt-2" :messages="$message" />
                @enderror
            </div>

            @if($frequency === 'custom')
                <div class="mt-6">
                    <x-input-label for="custom" :value="__('Custom Frequency')" />
                    <x-text-input wire:model="custom" id="custom" name="custom" type="text" class="mt-1 w-full" placeholder="* * * * *" />
                    @error('custom')
                    <x-input-error class="mt-2" :messages="$message" />
                    @enderror
                </div>
            @endif

            <div class="mt-6 flex justify-end">
                <x-secondary-button type="button" x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-primary-button class="ml-3" @created.window="$dispatch('close')">
                    {{ __('Create') }}
                </x-primary-button>
            </div>
        </form>
    </x-modal>
</div>
