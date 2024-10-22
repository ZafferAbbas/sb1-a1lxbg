<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Services</h2>
            @if(auth()->user()->hasRole('professional'))
                <x-button href="{{ route('services.create') }}">Create Service</x-button>
            @endif
        </div>
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($services as $service)
                    <div class="border rounded-lg p-6">
                        <h3 class="text-lg font-semibold mb-2">{{ $service->name }}</h3>
                        <p class="text-gray-600 mb-4">{{ Str::limit($service->description, 100) }}</p>
                        <div class="flex justify-between items-center">
                            <span class="text-indigo-600 font-semibold">${{ number_format($service->price, 2) }}</span>
                            <span class="text-gray-500">{{ $service->duration }} minutes</span>
                        </div>
                        <div class="mt-4 flex justify-end">
                            <x-button href="{{ route('services.show', $service) }}">View Details</x-button>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $services->links() }}
            </div>
        </div>
    </div>
</x-app-layout>