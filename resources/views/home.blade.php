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

    <body class="min-h-screen bg-zinc-900 text-zinc-100 relative">
        <div class="absolute top-0 left-0 w-full h-80 bg-gradient-to-b from-zinc-950/50 blur-3xl to-zinc-900 pointer-events-none z-[-1]"></div>

        <div class="bg-grid bg-repeat">
            <x-header />

            <x-intro />

            <x-work />

            <x-technologies />

            <x-projects />

            <x-footer />

            <flux:toast />
        </div>

        <div class="absolute bottom-0 left-0 w-full h-60 bg-gradient-to-t from-zinc-950/75 to-zinc-900 pointer-events-none z-[-1]"></div>
        
        @fluxScripts
        @livewireScriptConfig
    </body>
</html>