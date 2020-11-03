<?php

namespace App\Http\Controllers\OBRS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Trip;
use App\Booking;
use Carbon\Carbon;

class TripController extends Controller
{
    public function store(Request $request)
    {
        $trip = new Trip();

        $trip->departure_location = $request->departure_location;
        $trip->arrival_location = $request->arrival_location;
        $trip->departure_date = $request->departure_date;
        $trip->departure_time = $request->departure_time;
        $trip->departure_datetime = $request->departure_datetime;
        $trip->trip_duration = $request->trip_duration;
        $trip->arrival_timestamp = $request->arrival_timestamp;
        $trip->total_seats = $request->total_seats;
        $trip->available_seats = $request->total_seats;
        $trip->class_fare = $request->class_fare;

        $trip->save();

        return redirect()->back()->with('message', 'success');
    }

    public function create()
    {
        return view('obrs.trips.create');
    }

    public function edit($id)
    {
        $trip = Trip::find($id);

        return view('obrs.trips.edit', compact('trip'));
    }

    public function update(Request $request, $id)
    {
        $trip = Trip::find($id);

        $trip->departure_location = $request->departure_location;
        $trip->arrival_location = $request->arrival_location;
        $trip->departure_date = $request->departure_date;
        $trip->departure_time = $request->departure_time;
        $trip->departure_datetime = $request->departure_datetime;
        $trip->trip_duration = $request->trip_duration;
        $trip->arrival_timestamp = $request->arrival_timestamp;
        $trip->total_seats = $request->total_seats;
        $trip->class_fare = $request->class_fare;
        $trip->status = $request->status;
        $trip->cancellation_reason = $request->cancellation_reason;

        $trip->save();

        return response()->json('success', 200);
    }

    public function show()
    {
        return view('obrs.trips.edit');
    }

    public function index()
    {
        $currentTimestamp = Carbon::now()->timestamp; 
        $pendingTrips = Trip::where('departure_datetime', '>', $currentTimestamp)->where('status', 'active')->get();

        $enRoute = Trip::where('departure_datetime', '<', $currentTimestamp)->where('arrival_timestamp', '>', $currentTimestamp)->where('status', 'active')->get();

        $completed = Trip::where('arrival_timestamp', '<', $currentTimestamp)->where('status', 'active')->get();

        $cancelled = Trip::where('status', 'cancelled')->get();
        
        return view('obrs.trips.index', compact('pendingTrips', 'enRoute', 'completed', 'cancelled'));
    }

    public function getBookings($id) {
        $bookings = Booking::where('trip_id', $id)->get();

        return $bookings;
    }
}
