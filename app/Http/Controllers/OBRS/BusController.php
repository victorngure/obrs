<?php

namespace App\Http\Controllers\OBRS;

use App\Bus;
use App\Trip;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BusController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:buses');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buses = Bus::all();

        return view('obrs.bus.index', compact('buses'));
    }

    public function schedule($id) {
        $trips = Trip::where('bus_id', $id)->get();
        return $trips;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('obrs.bus.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bus = new Bus();

        $bus->bus_type = $request->bus_type;
        $bus->registration_number = $request->registration_number;   
        $bus->total_seats = $request->total_seats;       

        $bus->save();

        return response()->json('success', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function show(Bus $bus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bus = Bus::find($id);

        return view('obrs.bus.edit', compact('bus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $bus = Bus::find($id);

        $bus->bus_type = $request->bus_type;
        $bus->registration_number = $request->registration_number;   
        $bus->total_seats = $request->total_seats;       

        $bus->save();

        return response()->json('success', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bus $bus)
    {
        //
    }
}
