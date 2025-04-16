<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>nickdillon.dev</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @fluxAppearance
        @livewireStyles
    </head>

    <body x-init="() => document.documentElement.classList.add('dark')" class="min-h-screen bg-zinc-900 bg-grid bg-repeat text-zinc-100">
        <x-header />

        <x-intro />

        <x-work />

        <x-technologies />

        <x-projects />

        <x-footer />

        <flux:toast />
        
        @fluxScripts
        @livewireScriptConfig
    </body>
</html>