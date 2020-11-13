<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Trip;
use App\Payment;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $tripsTakenArray = array();
        $pendingTripsArray = array();

        $currentTimestamp = Carbon::now()->timestamp; 
        $availableTrips = Trip::where('departure_datetime', '>', $currentTimestamp)->where('status', 'active')->get();

        $bookings = Booking::where('user_id', Auth::id())->with('trip')->get();
        $payments = Payment::where('user_id', Auth::id())->sum('amount');

        foreach ($bookings as $booking){ 
           if($booking->trip->arrival_timestamp < $currentTimestamp) {
                array_push($tripsTakenArray, $booking);
           }
        }

        $tripsTakenCount = count($tripsTakenArray);

        foreach ($bookings as $booking){ 
            if($booking->trip->departure_datetime > $currentTimestamp) {
                 array_push($pendingTripsArray, $booking);
            }
         }
        
        $pendingTripsCount = count($pendingTripsArray);

        return view('home', compact('availableTrips', 'tripsTakenCount', 'payments', 'pendingTripsCount'));
    }
}
