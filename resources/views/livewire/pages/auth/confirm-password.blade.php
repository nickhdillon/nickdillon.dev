<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    public string $password = '';

    /**
     * Confirm the current user's password.
     */
    public function confirmPassword(): void
    {
        $this->validate([
            'password' => ['required', 'string'],
        ]);

        if (
            !Auth::guard('web')->validate([
                'email' => Auth::user()->email,
                'password' => $this->password,
            ])
        ) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        session(['auth.password_confirmed_at' => time()]);

        $this->redirectIntended(default: route('apps', absolute: false), navigate: true);
    }
}; ?>

<div>
    <x-auth-card submit="confirmPassword">
        <x-slot:header>
            <div class="mb-4 text-sm text-slate-600 dark:text-slate-400">
                {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
            </div>
        </x-slot:header>

        <x-slot:content>
            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input wire:model="password" id="password" class="block w-full mt-2" type="password" name="password"
                    required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
        </x-slot:content>

        <x-slot:button target="confirmPassword">
            Confirm
        </x-slot:button>
    </x-auth-card>
</div>