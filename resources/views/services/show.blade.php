<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $service->name }}</h2>
            @if(auth()->user()->hasRole('professional') && auth()->id() === $service->professional_id)
                <div class="flex space-x-4">
                    <x-button href="{{ route('services.edit', $service) }}">Edit</x-button>
                    <form action="{{ route('services.destroy', $service) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <x-button type="submit" class="bg-red-600 hover:bg-red-700">Delete</x-button>
                    </form>
                </div>
            @endif
        </div>
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-lg font-semibold mb-4">Service Details</h3>
                    <p class="text-gray-600 mb-4">{{ $service->description }}</p>
                    <div class="flex justify-between items-center">
                        <span class="text-indigo-600 font-semibold">${{ number_format($service->price, 2) }}</span>
                        <span class="text-gray-500">{{ $service->duration }} minutes</span>
                    </div>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-4">Professional</h3>
                    <p class="text-gray-600">{{ $service->professional->name }}</p>
                    
                    @if(auth()->user()->hasRole('user'))
                        <div class="mt-6">
                            <x-button href="{{ route('services.book', $service) }}">Book Now</x-button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>