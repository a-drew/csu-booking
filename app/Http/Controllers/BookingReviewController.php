<?php

namespace App\Http\Controllers;

use App\Models\BookingRequest;
use App\Models\User;
use Illuminate\Http\Request;

class BookingReviewController extends Controller
{
    public function index() {
        $bookings = BookingRequest::with('requester', 'reviewers', 'reservations', 'reservations.room')->pending()->get();

        return inertia('Admin/Reviews/Index', [
            'bookings' => $bookings
        ]);
    }

}
