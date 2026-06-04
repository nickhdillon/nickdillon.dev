<div class="pb-10 text-slate-50">
    <div class="border-t border-white/15 w-10/12 max-w-[450px] mx-auto"></div>

    <footer class="flex flex-col items-center justify-center p-6 pb-4 mt-2 space-y-4 text-center">
        <div class="max-w-lg">
            <div
                class="flex flex-col items-center justify-between max-w-sm space-y-5 sm:space-x-5 sm:space-y-0 sm:flex-row">
                <livewire:contact-me />

                <flux:separator vertical class="my-3" />

                <x-socials />
            </div>
        </div>

        <h1 class="flex items-center space-x-2">
            <flux:icon name="copyright" class="size-4" />
            
            <span>{{ now()->format('Y') }} Nick Dillon</span>
        </h1>
    </footer>
</div>
