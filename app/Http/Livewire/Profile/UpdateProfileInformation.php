<?php

namespace App\Http\Livewire\Profile;

use App\Actions\User\UpdateUserProfileInformation;
use App\Http\Livewire\UserDropdown;
use App\Models\User;
use Exception;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class UpdateProfileInformation extends Component
{
    public string $name;

    public string $email;

    public string $timezone;

    public function mount(): void
    {
        $this->name = auth()->user()->name;
        $this->email = auth()->user()->email;
        $this->timezone = auth()->user()->timezone;
    }

    /**
     * @throws Exception
     */
    public function submit(): void
    {
        app(UpdateUserProfileInformation::class)->update(auth()->user(), $this->all());

        session()->flash('status', 'profile-updated');

        $this->dispatch('$refresh')->to(UserDropdown::class);
    }

    public function sendVerificationEmail(): void
    {
        /** @var User $user */
        $user = auth()->user();
        if (! $user->hasVerifiedEmail()) {
            $user->sendEmailVerificationNotification();

            session()->flash('status', 'verification-link-sent');
        }
    }

    public function render(): View
    {
        return view('livewire.profile.update-profile-information');
    }
}
