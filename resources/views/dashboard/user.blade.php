<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
    </x-slot>

    <div class="grid gap-6 mb-8 md:grid-cols-2">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h3 class="text-lg font-semibold mb-4">Upcoming Bookings</h3>
                @forelse($upcomingBookings as $booking)
                    <div class="mb-4 p-4 border rounded-lg">
                        <div class="flex justify-between items-start">
                            <div>
                                <h4 class="font-medium">{{ $booking->service->name }}</h4>
                                <p class="text-sm text-gray-600">{{ $booking->booking_time->format('F j, Y g:i A') }}</p>
                                <p class="text-sm text-gray-500">with {{ $booking->service->professional->name }}</p>
                            </div>
                            <span class="px-2 py-1 text-xs rounded-full {{ $booking->status === 'confirmed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-600">No upcoming bookings</p>
                @endforelse
                <div class="mt-4">
                    <x-button href="{{ route('bookings.index') }}">View All Bookings</x-button>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h3 class="text-lg font-semibold mb-4">Recent Services</h3>
                @forelse($recentServices as $service)
                    <div class="mb-4 p-4 border rounded-lg">
                        <h4 class="font-medium">{{ $service->name }}</h4>
                        <p class="text-sm text-gray-600">${{ number_format($service->price, 2) }} - {{ $service->duration }} minutes</p>
                        <div class="mt-2">
                            <x-button href="{{ route('services.show', $service) }}" class="text-xs">View Details</x-button>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-600">No recent services</p>