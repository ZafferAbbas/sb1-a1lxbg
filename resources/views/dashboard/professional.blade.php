<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Professional Dashboard</h2>
    </x-slot>

    <div class="grid gap-6 mb-8 md:grid-cols-2">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Upcoming Bookings</h3>
                    <x-button href="{{ route('professional.bookings') }}">View All</x-button>
                </div>
                <div class="space-y-4">
                    @forelse($upcomingBookings as $booking)
                        <div class="border rounded-lg p-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h4 class="font-medium">{{ $booking->service->name }}</h4>
                                    <p class="text-sm text-gray-600">
                                        Client: {{ $booking->user->name }}<br>
                                        Date: {{ $booking->booking_time->format('F j, Y g:i A') }}
                                    </p>
                                </div>
                                <span class="px-2 py-1 text-xs rounded-full {{ $booking->status === 'confirmed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-600">No upcoming bookings</p>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">My Services</h3>
                    <x-button href="{{ route('services.create') }}">Add New</x-button>
                </div>
                <div class="space-y-4">
                    @forelse($services as $service)
                        <div class="border rounded-lg p-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h4 class="font-medium">{{ $service->name }}</h4>
                                    <p class="text-sm text-gray-600">
                                        Price: ${{ number_format($service->price, 2) }}<br>
                                        Duration: {{ $service->duration }} minutes
                                    </p>
                                </div>
                                <span class="px-2 py-1 text-xs bg-indigo-100 text-indigo-800 rounded-full">
                                    {{ $service->bookings_count }} bookings
                                </span>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-600">No services created</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>