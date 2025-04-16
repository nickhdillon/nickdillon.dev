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

<div>
    <flux:modal.trigger name="contact-form">
        <div class="relative inline-flex w-full group/button">
            <div
                class="absolute transition-all duration-1000 bg-accent -inset-px rounded-xl blur-lg group-hover/button:opacity-100 group-hover/button:-inset-1 group-hover/button:duration-200 animate-pulse">
            </div>

            <button class="relative text-[17px]! inline-flex items-center justify-center w-full px-4 py-2 text-lg font-medium text-white transition-all duration-300 ease-in-out bg-accent sm:w-auto hover:scale-110 rounded-xl focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-accent"
                role="button">
                Send me a message!
            </button>
        </div>
    </flux:modal.trigger>

    <flux:modal name="contact-form" class="w-86 sm:w-full text-left">
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

                <flux:button type="submit" variant="primary" class="text-zinc-100! h-9!">
                    Send
                </flux:button>
            </div>
        </form>
    </flux:modal>
</div>