@extends('layouts.master')
@section('content')
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">

        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            <div class="container-fluid justify-content-center">
                <h2 class="text-muted">Bus booking system</h2>
            </div> 

            <span class="text-muted">{{ Auth::user()->name }}</span>&nbsp;&nbsp;
            <i class="fas fa-user"></i>

        </nav>

        <div class="container-fluid">
            <div class="bc-icons-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb" style="padding-bottom: 9px; padding-top: 9px;">
                        <li class="breadcrumb-item"><a href="#" style="color: #0072C6">Home</a><i
                                class="fas fa-caret-right mx-2" aria-hidden="true"></i></li>
                        <li class="breadcrumb-item"><a href="#" style="color: #0072C6">Buses</a><i
                                class="fas fa-caret-right mx-2" aria-hidden="true"></i></li>
                        <li class="breadcrumb-item active"> All Buses</li>
                    </ol>
                </nav>
            </div>
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table width="100%" class="table table-striped table-bordered table-hover dt-responsive datatable" id="dataTables-example">
                            <thead>
                                <th>Bus Type</th>
                                <th>Registration Number</th>
                                <th>Total Seats</th>
                                <th>Bus Schedule</th>
                                <th>Edit</th>
                            </thead>
                            @foreach($buses as $key => $bus) 
                                <tr>
                                    <td>
                                        {{ $bus->bus_type }}
                                    </td>
                                    <td>
                                        {{ $bus->registration_number }}
                                    </td>
                                    <td>
                                        {{ $bus->total_seats }}
                                    </td>
                                    <td>
                                        <button class="btn btn-outline-dark btn-sm" @click="showBusScheduleModal({{ $bus }})"><i class="fas fa-list text-dark pr-1" aria-hidden="true"></i>Schedule</button>
                                    </td>  
                                    <td>
                                        <a class="btn btn-outline-dark btn-sm mt-2" href="{{ url('/bus/' . $bus->id . '/edit') }}" type="button" style="text-transform: capitalize;"><i class="fas fa-pen text-dark pr-1" aria-hidden="true"></i>Edit</a>
                                    </td>                       
                                </tr>
                            @endforeach    
                        </table>     
                    </div>
                </div>
            </div>                           
            <br />
        </div>

        <div class="modal fade right" id="details_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-full-height modal-right modal-lg" role="document" style="max-width: 45%; !important;">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="card shadow mb-4">            
                            <div class="card-header">
                                 Bus Schedule (All trips)
                            </div>
                            <div class="card-body">
                                <table width="100%" class="table table-striped table-bordered table-hover dt-responsive modal_datatable" id="dataTables-example">
                                    <thead>
                                        <th>Departure</th>
                                        <th>Arrival</th>
                                        <th>Departure Date-Time</th>
                                        <th>Trip Duration</th>
                                        <th>Available Seats</th>
                                    </thead> 
                                    <tr v-for="trip in trips">
                                        <td>
                                            @{{ trip.departure_location }}
                                        </td> 
                                        <td>
                                            @{{ trip.arrival_location }}
                                        </td>
                                        <td>
                                            <span style="float: left">
                                                <i class="fas fa-calendar-alt mr-2 text-info"></i>
                                                @{{ trip.departure_date }}
                                            </span>
                                            <span style="float: right">
                                                <i class="fas fa-clock mr-2 text-info"></i>
                                                @{{ trip.departure_time }}
                                            </span>                                            
                                        </td>
                                        <td>
                                            @{{ trip.trip_duration }}
                                        </td>   
                                        <td>
                                            @{{ trip.available_seats }}
                                        </td>                       
                                    </tr>
                                </table>    
                            </div>
                        </div>                                                              
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>
@endsection