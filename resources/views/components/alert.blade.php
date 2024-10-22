@props(['type' => 'info', 'message'])

@php
    $classes = match($type) {
        'success' => 'bg-green-100 text-green-800',
        'error' => 'bg-red-100 text-red-800',
        'warning' => 'bg-yellow-100 text-yellow-800',
        default => 'bg-blue-100 text-blue-800'
    };
@endphp

<div {{ $attributes->merge(['class' => "rounded-lg p-4 mb-4 {$classes}"]) }} role="alert">
    <p class="text-sm">{{ $message }}</p>
</div>