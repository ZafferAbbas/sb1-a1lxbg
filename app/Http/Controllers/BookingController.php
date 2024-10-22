<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingRequest;
use App\Models\Booking;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BookingController extends Controller
{
    public function index(): View
    {
        $bookings = $this->getBookingsForUser();
        return view('bookings.index', compact('bookings'));
    }

    public function create(Service $service): View
    {
        return view('bookings.create', compact('service'));
    }

    public function store(BookingRequest $request): RedirectResponse
    {
        $booking = $request->user()->bookings()->create($request->validated());
        return redirect()->route('bookings.show', $booking)
            ->with('success', 'Booking created successfully.');
    }

    public function show(Booking $booking): View
    {
        $this->authorize('view', $booking);
        return view('bookings.show', compact('booking'));
    }

    public function update(BookingRequest $request, Booking $booking): RedirectResponse
    {
        $this->authorize('update', $booking);
        $booking->update($request->validated());
        return redirect()->route('bookings.show', $booking)
            ->with('success', 'Booking updated successfully.');
    }

    private function getBookingsForUser()
    {
        $user = auth()->user();
        $query = Booking::with(['service', 'service.professional']);

        if ($user->hasRole(User::ROLE_USER)) {
            return $query->where('user_id', $user->id);
        }

        if ($user->hasRole(User::ROLE_PROFESSIONAL)) {
            return $query->whereHas('service', function ($query) use ($user) {
                $query->where('professional_id', $user->id);
            });
        }

        return $query->latest();
    }
}