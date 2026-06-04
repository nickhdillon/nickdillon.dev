@props(['size' => null, 'color' => null])

@php
    $backgroundColor = match ($color) {
        'red' => 'bg-red-600',
        'blue' => 'bg-blue-600',
        'green' => 'bg-emerald-600',
        default => 'bg-zinc-200',
    };

    $borderColor = match ($color) {
        'red' => 'border border-red-600',
        'blue' => 'border border-blue-600',
        'green' => 'border border-emerald-600',
        default => 'border border-zinc-300',
    };

    $buttonColor = match ($color) {
        'red' => 'bg-red-500',
        'blue' => 'bg-blue-500',
        'green' => 'bg-emerald-500',
        default => 'bg-white',
    };
@endphp

<button {{ $attributes->merge(['class' => 'group relative inline-flex']) }}>
    <span class="absolute inset-0 top-1 rounded-lg {{ $backgroundColor }}"></span>

    <span
        @class([
            'py-1.5' => $size === 'sm',
            'py-3.5' => $size === 'lg',
            'py-2.5' => ! $size,
            'relative -translate-y-[3px] rounded-lg px-4 shadow-sm text-sm font-medium text-white transition-transform duration-150 ease-out group-hover:-translate-y-[4px] active:translate-y-[0.4px]',
            $borderColor,
            $buttonColor,
        ])
    >
        {{ $slot }}
    </span>
</button>