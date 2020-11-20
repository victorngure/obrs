<?php

namespace App\Http\Controllers\OBRS;

use App\Trip;
use App\route;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $routes = route::all();

        return view('obrs.route.index', compact('routes'));
    }

    public function schedule($id) {
        $trips = Trip::where('route_id', $id)->with('bus')->get();
        return $trips;
    }

    public function create()
    {
        return view('obrs.route.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $route = new route();

        $route->departure = $request->departure;
        $route->arrival = $request->arrival;   
        $route->trip_duration = $request->trip_duration;       

        $route->save();

        return response()->json('success', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\route  $route
     * @return \Illuminate\Http\Response
     */
    public function show(route $route)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\route  $route
     * @return \Illuminate\Http\Response
     */
    public function edit(route $route)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\route  $route
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, route $route)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\route  $route
     * @return \Illuminate\Http\Response
     */
    public function destroy(route $route)
    {
        //
    }
}
