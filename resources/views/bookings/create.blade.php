<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Book {{ $service->name }}</h2>
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6">
            <form action="{{ route('bookings.store') }}" method="POST">
                @csrf
                <input type="hidden" name="service_id" value="{{ $service->id }}">
                
                <x-form.input
                    type="datetime-local"
                    name="booking_time"
                    label="Select Date and Time"
                    :value="old('booking_time')"
                    required
                />

                <x-form.textarea
                    name="notes"
                    label="Additional Notes"
                >{{ old('notes') }}</x-form.textarea>

                <div class="mt-6">
                    <x-button type="submit">Confirm Booking</x-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>