@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-semibold text-lg text-black dark:text-gray-300']) }}>
    {{ $value ?? $slot }}
</label>
