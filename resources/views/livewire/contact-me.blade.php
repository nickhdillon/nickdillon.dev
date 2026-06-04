<?php

declare(strict_types=1);

use Flux\Flux;
use App\Mail\ContactForm;
use Livewire\Volt\Component;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Mail;

new class extends Component {
    #[Validate(['required', 'string', 'max:50'])]
    public string $name;

    #[Validate(['required', 'email'])]
    public string $email;

    #[Validate(['required', 'string', 'max:255'])]
    public string $message;

    public function sendEmail(): void
    {
        $this->validate();

        Mail::to('nickhds@gmail.com')->send(new ContactForm($this->name, $this->email, $this->message));

        $this->reset();

        Flux::toast(
            variant: 'success',
            text: 'Your message has been sent!',
        );

        Flux::modals()->close();
    }
}; ?>

<div x-init="() => document.documentElement.classList.add('dark')">
    <flux:modal.trigger name="contact-form">
        <x-sentry-button color="red">Send me a message!</x-sentry-button>
    </flux:modal.trigger>

    <flux:modal name="contact-form" class="w-86 sm:w-full ring-zinc-600! text-left">
        <form wire:submit='sendEmail' class="space-y-6">
            <flux:heading size="lg" class="font-semibold -mt-1!">
                Contact Me
            </flux:heading>

            <flux:field>
                <flux:label>Name</flux:label>

                <flux:input type="text" wire:model='name' autocomplete="name" />

                <flux:error name="name" />
            </flux:field>

            <flux:field>
                <flux:label>Email</flux:label>

                <flux:input type="email" wire:model='email' autocomplete="email" />

                <flux:error name="email" />
            </flux:field>

            <flux:field>
                <flux:label>Message</flux:label>

                <flux:textarea rows="5" wire:model='message' />

                <flux:error name="message" />
            </flux:field>

            <div class="flex">
                <flux:spacer />

                <x-sentry-button size="sm" type="submit" color="red">Send</x-sentry-button>
            </div>
        </form>
    </flux:modal>
</div>