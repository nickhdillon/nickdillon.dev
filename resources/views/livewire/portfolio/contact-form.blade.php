<?php

declare(strict_types=1);

use App\Mail\ContactForm;
use Livewire\Volt\Component;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Mail;
use Filament\Notifications\Notification;

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

        $this->dispatch('close-modal');

        Notification::make()
            ->title("Your message has been sent!")
            ->info()
            ->send();
    }
}; ?>

<div x-init="() => document.documentElement.classList.add('dark')">
    <flux:modal.trigger name="contact-form">
        <div class="relative inline-flex w-full group/button">
            <div
                class="absolute transition-all duration-1000 bg-[#ff9b3e] -inset-px rounded-xl blur-lg group-hover/button:opacity-100 group-hover/button:-inset-1 group-hover/button:duration-200 animate-pulse">
            </div>

            <button class="relative inline-flex items-center justify-center w-full px-4 py-2 text-lg font-semibold text-white transition-all duration-300 ease-in-out bg-[#ff9b3e] sm:w-auto hover:scale-110 rounded-xl focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#ff9b3e]"
                role="button">
                Send me a message!
            </button>
        </div>
    </flux:modal.trigger>

    <flux:modal name="contact-form" class="md:w-96">
        <form wire:submit='sendEmail' class="space-y-6">
            <flux:heading size="lg">Contact Me</flux:heading>

            <flux:input label="Name" />

            <flux:input label="Email" type="email" />

            <flux:textarea label="Message" rows="5" />

            <div class="flex">
                <flux:spacer />

                <flux:button type="submit" variant="primary">Save changes</flux:button>
            </div>
        </form>
    </flux:modal>


</div>