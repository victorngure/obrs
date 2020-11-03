<?php


namespace App\Http\Controllers\OBRS;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Booking;
use App\Payment;
use App\Trip;
use Carbon\Carbon;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $currentTimestamp = Carbon::now()->timestamp; 
        $pendingTrips = Trip::where('departure_datetime', '>', $currentTimestamp)->where('status', 'active')->get();

        return view('obrs.booking.create', compact('pendingTrips'));
    }
    
    public function initiateTransaction(Request $request) {
        $mpesa= new \Safaricom\Mpesa\Mpesa();

        $amount = $request->amount;
        $billingNumber = $request->billing_number;
        $email = $request->email;

        $request= $mpesa->STKPushSimulation(
            174379,
            env("MPESA_PASSKEY"), 
            "CustomerPayBillOnline", 
            $amount, 
            $billingNumber, 
            174379,
            $billingNumber, 
            "https://fmovies.io",
            $billingNumber, 
            "OBRS", 
            "Bus booking request");
        $response = json_decode($request);

        if(array_key_exists('ResponseCode', $response))
        {
            if($response->ResponseCode == 0)
            {
                return $this->savePayment($response, $billingNumber, $amount, $email);
            }
            else
            {
                return response()->json("Error with payment request");
            }
        }
        else
        {
            return response()->json($response);
        }
    }

    public function savePayment($resp, $phoneNumber, $amount, $email)
    {
        $payment = new Payment();

        $payment->merchant_request_id = $resp->MerchantRequestID;
        $payment->checkout_request_id = $resp->CheckoutRequestID;
        $payment->phone_number = $phoneNumber;
        $payment->amount = $amount;
        $payment->email = $email;
        $payment->save();

        return $payment;
    }

    public function store(Request $request)
    {
        $booking = new Booking();
        $userId = Auth::id();

        $booking->trip_id = $request->trip_id;
        $booking->payment_id = $request->payment_id; 
        $booking->user_id = $userId;
        $booking->full_name = $request->full_name;
        $booking->id_number = $request->id_number;
        $booking->phone_number= $request->phone_number;
        $booking->email = $request->email; 
        $booking->ticket_number = "#".mt_rand(100000, 999999);        

        if($booking->save()) {
            return $this->updateSeats($request->trip_id, $request->total_tickets);
        }      

        
    }

    public function updateSeats($tripId, $totalTickets) {
        $trip = Trip::find($tripId);
        $availableSeats = $trip->available_seats;
        $updatedSeats = $availableSeats - $totalTickets;

        $trip->available_seats = $updatedSeats;

        $trip->save();

        return response()->json('success', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
