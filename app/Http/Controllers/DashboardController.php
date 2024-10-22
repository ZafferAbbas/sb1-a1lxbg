<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();
        
        return match ($user->role) {
            User::ROLE_ADMIN => $this->adminDashboard(),
            User::ROLE_PROFESSIONAL => $this->professionalDashboard(),
            default => $this->userDashboard(),
        };
    }

    private function adminDashboard(): View
    {
        $totalUsers = User::count();
        $totalServices = Service::count();
        $totalBookings = Booking::count();
        $recentBookings = Booking::with(['user', 'service'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.admin', compact(
            'totalUsers',
            'totalServices',
            'totalBookings',
            'recentBookings'
        ));
    }

    private function professionalDashboard(): View
    {
        $user = auth()->user();
        $upcomingBookings = Booking::whereHas('service', function ($query) use ($user) {
            $query->where('professional_id', $user->id);
        })
        ->with(['user', 'service'])
        ->where('booking_time', '>=', now())
        ->where('status', '!=', 'cancelled')
        ->latest()
        ->take(5)
        ->get();

        $services = $user->services()
            ->withCount('bookings')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.professional', compact('upcomingBookings', 'services'));
    }

    private function userDashboard(): View
    {
        $user = auth()->user();
        $upcomingBookings = $user->bookings()
            ->with(['service', 'service.professional'])
            ->where('booking_time', '>=', now())
            ->where('status', '!=', 'cancelled')
            ->latest()
            ->take(5)
            ->get();

        $recentServices = Service::latest()
            ->take(5)
            ->get();

        return view('dashboard.user', compact('upcomingBookings', 'recentServices'));
    }
}