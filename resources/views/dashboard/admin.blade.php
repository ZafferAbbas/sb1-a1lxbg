<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Admin Dashboard</h2>
    </x-slot>

    <div class="grid gap-6 mb-8 md:grid-cols-3">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h3 class="text-lg font-semibold mb-2">Total Users</h3>
                <p class="text-3xl font-bold text-indigo-600">{{ $totalUsers }}</p>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h3 class="text-lg font-semibold mb-2">Total Services</h3>
                <p class="text-3xl font-bold text-indigo-600">{{ $totalServices }}</p>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h3 class="text-lg font-semibold mb-2">Total Bookings</h3>
                <p class="text-3xl font-bold text-indigo-600">{{ $totalBookings }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6">
            <h3 class="text-lg font-semibold mb-4">Recent Bookings</h3>
            <div class="space-y-4">
                @forelse($recentBookings as $booking)
                    <div class="border rounded-lg p-4">
                        <div class="flex justify-between items-start">
                            <div>
                                <h4 class="font-medium">{{ $booking->service->name }}</h4>
                                <p class="text-sm text-gray-600">
                                    Booked by: {{ $booking->user->name }}<br>
                                    Date: {{ $booking->booking_time->format('F j, Y g:i A') }}
                                </p>
                            </div>
                            <span class="px-2 py-1 text-xs rounded-full 
                                @if($booking->status === 'confirmed') bg-green-100 text-green-800
                                @elseif($booking->status === 'cancelled') bg-red-100 text-red-800
                                @else bg-yellow-100 text-yellow-800
                                @endif"
                            >
                                {{ ucfirst($booking->status) }}
                            </span>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-600">No recent bookings</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>