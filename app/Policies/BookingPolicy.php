<?php

namespace App\Policies;

use App\Models\Booking;
use App\Models\User;

class BookingPolicy
{
    public function view(User $user, Booking $booking): bool
    {
        if ($user->hasRole(User::ROLE_ADMIN)) {
            return true;
        }

        if ($user->id === $booking->user_id) {
            return true;
        }

        return $user->id === $booking->service->professional_id;
    }

    public function update(User $user, Booking $booking): bool
    {
        if ($user->hasRole(User::ROLE_ADMIN)) {
            return true;
        }

        if ($booking->status === Booking::STATUS_PENDING) {
            return $user->id === $booking->user_id;
        }

        return $user->id === $booking->service->professional_id;
    }
}