@props(['name'])

<a
    x-on:click="active = '{{ $name }}'"
    class="duration-150 ease-in-out cursor-pointer hover:text-zinc-300"
    :class="active === '{{ $name }}' ? 'text-red-500 font-semibold' : 'text-white hover:text-zinc-200'"
    href="#{{ $name }}"
>
    <h1 class="text-sm -space-x-1 font-medium">
        <span>//</span> <span>{{ $name }}</span>
    </h1>
</a>
