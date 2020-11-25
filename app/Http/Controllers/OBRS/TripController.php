<?php

namespace App\Http\Controllers\OBRS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\ConfirmationEmail;
use Illuminate\Support\Facades\Mail;
use App\Trip;
use App\Booking;
use App\Bus;
use App\route;
use Carbon\Carbon;

class TripController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:trips');
    }

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
        $trip->total_seats = $bus->total_seats;
        $trip->available_seats = $bus->total_seats;
        $trip->class_fare = $request->class_fare;
        $trip->bus_id = $request->bus_id;
        $trip->route_id = $request->route_id;

        $trip->save();

        return redirect()->back()->with('message', 'success');
    }

    public function create()
    {
        $buses = Bus::all();
        $routes = route::all();

        return view('obrs.trips.create', compact('buses', 'routes'));
    }

    public function edit($id)
    {
        $buses = Bus::all();
        $trip = Trip::find($id)->with('bus')->first();

        return view('obrs.trips.edit', compact('trip', 'buses'));
    }

    public function update(Request $request, $id)
    {
        $trip = Trip::find($id);
        
        $trip->departure_date = $request->departure_date;
        $trip->departure_time = $request->departure_time;
        $trip->departure_datetime = $request->departure_datetime;        
        $trip->arrival_timestamp = $request->arrival_timestamp;
        $trip->class_fare = $request->class_fare;
        $trip->status = $request->status;
        $trip->cancellation_reason = $request->cancellation_reason;
        $trip->bus_id = $request->bus_id;

        $trip->save();

        return response()->json('success', 200);
    }

    public function show()
    {
        //
    }

    public function index()
    {
        $currentTimestamp = Carbon::now()->timestamp; 
        $pendingTrips = Trip::where('departure_datetime', '>', $currentTimestamp)->where('status', 'active')->with('bus')->get();

        $enRoute = Trip::where('departure_datetime', '<', $currentTimestamp)->where('arrival_timestamp', '>', $currentTimestamp)->where('status', 'active')->with('bus')->get();

        $completed = Trip::where('arrival_timestamp', '<', $currentTimestamp)->where('status', 'active')->with('bus')->get();

        $cancelled = Trip::where('status', 'cancelled')->with('bus')->get();
        
        return view('obrs.trips.index', compact('pendingTrips', 'enRoute', 'completed', 'cancelled'));
    }

    public function getBookings($id) {
        $bookings = Booking::where('trip_id', $id)->get();

        return $bookings;
    }
}
