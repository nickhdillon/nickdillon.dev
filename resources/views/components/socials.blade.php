@php
    $socials = [
        'x' => [
            'link' => 'https://x.com/nickhdillon',
            'icon' => 'fab-x-twitter',
        ],
        'github' => [
            'link' => 'https://github.com/nickhdillon',
            'icon' => 'fab-github',
        ],
        'linkedIn' => [
            'link' => 'https://www.linkedin.com/in/nickhdillon',
            'icon' => 'fab-linkedin',
        ],
    ];
@endphp

<div class="flex space-x-3">
    @foreach ($socials as $social)
        <div class="ml-0 duration-300 ease-in-out hover:scale-125">
            <a href="{{ $social['link'] }}" target="_blank">
                <x-dynamic-component :component="$social['icon']"
                    class="w-6 h-6 text-white duration-300 ease-in-out hover:text-accent" />
            </a>
        </div>
    @endforeach
</div>