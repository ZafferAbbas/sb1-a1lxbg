<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">My Bookings</h2>
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6">
            <div class="space-y-6">
                @forelse($bookings as $booking)
                    <div class="border rounded-lg p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-lg font-semibold">{{ $booking->service->name }}</h3>
                                <p class="text-gray-600">{{ $booking->booking_time->format('F j, Y g:i A') }}</p>
                                <p class="text-sm text-gray-500 mt-2">{{ $booking->notes }}</p>
                            </div>
                            <span class="px-3 py-1 rounded-full text-sm 
                                @if($booking->status === 'confirmed') bg-green-100 text-green-800
                                @elseif($booking->status === 'cancelled') bg-red-100 text-red-800
                                @else bg-yellow-100 text-yellow-800
                                @endif"
                            >
                                {{ ucfirst($booking->status) }}
                            </span>
                        </div>
                        
                        @if($booking->status === 'pending')
                            <div class="mt-4 flex justify-end space-x-4">
                                <form action="{{ route('bookings.update', $booking) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="cancelled">
                                    <x-button type="submit" class="bg-red-600 hover:bg-red-700">Cancel Booking</x-button>
                                </form>
                            </div>
                        @endif
                    </div>
                @empty
                    <p class="text-gray-600">No bookings found.</p>
                @endforelse
            </div>

            <div class="mt-6">
                {{ $bookings->links() }}
            </div>
        </div>
    </div>
</x-app-layout>