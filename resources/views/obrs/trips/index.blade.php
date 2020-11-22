@extends('layouts.master')
@section('content')
<div class="page_name" id="AllTrips"></div>
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
                    <li class="breadcrumb-item"><a href="#" style="color: #0072C6">Trips</a><i
                            class="fas fa-caret-right mx-2" aria-hidden="true"></i></li>
                    <li class="breadcrumb-item active"> All Trips</li>
                </ol>
            </nav>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success col-lg-12" id="alert">
                <p>{{ $message }}</p>
            </div>
        @endif
        <div class="parent_view">
            <div class="accordion child_view" id="accordionExample">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pending-tab"
                            data-toggle="tab" href="#pending" role="tab" aria-controls="pending" aria-selected="true">Pending</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="active-trips-tab"
                            data-toggle="tab" href="#active-trips" role="tab" aria-controls="active-trips" aria-selected="false">En-Route
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="completed-trips-tab"
                            data-toggle="tab" href="#completed-trips" role="tab" aria-controls="completed-trips" aria-selected="false">Completed
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="canceled-trips-tab"
                            data-toggle="tab" href="#canceled-trips" role="tab" aria-controls="canceled-trips" aria-selected="false">Cancelled
                        </a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <br />
                    <div class="tab-pane fade pending show active" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table width="100%" class="table table-striped table-bordered table-hover dt-responsive datatable" id="dataTables-example">
                                        <thead>
                                            <th>Bus</th>
                                            <th>Departure</th>
                                            <th>Arrival</th>
                                            <th>Departure Date</th>
                                            <th>Departure Time</th>
                                            <th>Trip duration</th>
                                            <th>Total seats - Available seats</th>
                                            <th>Price</th>                                            
                                            <th>Action</th>
                                        </thead>
                                        @foreach($pendingTrips as $key => $trip) 
                                            <tr>
                                                <td>
                                                    {{ $trip->bus->registration_number }}
                                                </td>
                                                <td>
                                                    {{ $trip->departure_location }}
                                                </td>
                                                <td>
                                                    {{ $trip->arrival_location }}
                                                </td>
                                                <td>
                                                    {{ $trip->departure_date }}
                                                </td>  
                                                <td>
                                                    {{ $trip->departure_time }}
                                                </td>  
                                                <td>
                                                    {{ $trip->trip_duration }} hours
                                                </td>   
                                                <td>
                                                    {{ $trip->total_seats }} - {{ $trip->available_seats }}
                                                </td>   
                                                <td>
                                                    KSh. {{ $trip->class_fare }}
                                                </td>  
                                                <td>
                                                    <button class="btn btn-sm btn-outline-dark" @click="showPassengersModal({{ $trip }})"><i class="fas fa-list text-dark pr-1" aria-hidden="true"></i>Passenger list</button>
                                                    <a href="{{ url('/trip/' . $trip->id . '/edit') }}" type="button" class="btn btn-sm btn-outline-dark ml-1" style="text-transform: capitalize;"><i class="fas fa-pen text-dark pr-1" aria-hidden="true"></i>Edit</a>
                                                </td>                       
                                            </tr>
                                        @endforeach    
                                    </table>  
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade active-trips " id="active-trips" role="tabpanel" aria-labelledby="active-trips-tab">
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <div class="table-responsive"> 
                                    <table width="100%" class="table table-striped table-bordered table-hover dt-responsive datatable" id="dataTables-example">
                                        <thead>
                                            <th>Bus</th>
                                            <th>Departure</th>
                                            <th>Arrival</th>
                                            <th>Departure Date</th>
                                            <th>Departure Time</th>
                                            <th>Trip duration</th>
                                            <th>Total Seats - Booked Seats</th>
                                            <th>Price</th>                                            
                                            <th>Action</th>
                                        </thead>
                                        @foreach($enRoute as $key => $trip) 
                                            <tr>
                                                <td>
                                                    {{ $trip->bus->registration_number }}
                                                </td>
                                                <td>
                                                    {{ $trip->departure_location }}
                                                </td>
                                                <td>
                                                    {{ $trip->arrival_location }}
                                                </td>
                                                <td>
                                                    {{ $trip->departure_date }}
                                                </td>  
                                                <td>
                                                    {{ $trip->departure_time }}
                                                </td>  
                                                <td>
                                                    {{ $trip->trip_duration }} hours
                                                </td>    
                                                <td>
                                                    {{ $trip->total_seats }} - {{ $trip->available_seats }}
                                                </td>  
                                                <td>
                                                    KSh. {{ $trip->class_fare }}
                                                </td>  
                                                <td>
                                                    <button class="btn btn-sm btn-outline-dark" @click="showPassengersModal({{ $trip }})"><i class="fas fa-list text-dark pr-1" aria-hidden="true"></i>Passenger list</button>
                                                </td>                       
                                            </tr>
                                        @endforeach    
                                    </table>   
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade completed-trips " id="completed-trips" role="tabpanel" aria-labelledby="completed-trips-tab">
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <div class="table-responsive"> 
                                    <table width="100%" class="table table-striped table-bordered table-hover dt-responsive datatable" id="dataTables-example">
                                        <thead>
                                            <th>Bus</th>
                                            <th>Departure</th>
                                            <th>Arrival</th>
                                            <th>Departure Date</th>
                                            <th>Departure Time</th>
                                            <th>Trip duration</th>
                                            <th>Total Seats - Booked Seats</th>
                                            <th>Price</th>                                            
                                            <th>Action</th>
                                        </thead>
                                        @foreach($completed as $key => $trip) 
                                            <tr>
                                                <td>
                                                    {{ $trip->bus->registration_number }}
                                                </td>
                                                <td>
                                                    {{ $trip->departure_location }}
                                                </td>
                                                <td>
                                                    {{ $trip->arrival_location }}
                                                </td>
                                                <td>
                                                    {{ $trip->departure_date }}
                                                </td>  
                                                <td>
                                                    {{ $trip->departure_time }}
                                                </td>  
                                                <td>
                                                    {{ $trip->trip_duration }} hours
                                                </td>    
                                                <td>
                                                    {{ $trip->total_seats }} - {{ $trip->available_seats }}
                                                </td> 
                                                <td>
                                                    KSh. {{ $trip->class_fare }}
                                                </td>  
                                                <td>
                                                    <button class="btn btn-sm btn-outline-dark"><i class="fas fa-list text-dark pr-1" aria-hidden="true"  @click="showPassengersModal({{ $trip }})"></i>Passenger list</button>
                                                </td>                       
                                            </tr>
                                        @endforeach    
                                    </table>   
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade canceled-trips " id="canceled-trips" role="tabpanel" aria-labelledby="canceled-trips-tab">
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <div class="table-responsive"> 
                                    <table width="100%" class="table table-striped table-bordered table-hover dt-responsive datatable" id="dataTables-example">
                                        <thead>
                                            <th>Bus</th>
                                            <th>Departure</th>
                                            <th>Arrival</th>
                                            <th>Departure Date</th>
                                            <th>Departure Time</th>
                                            <th>Trip duration</th>
                                            <th>Total Seats - Booked Seats</th>
                                            <th>Price</th>        
                                            <th>Cancellation Reason</th>                                                     
                                            <th>Action</th>
                                        </thead>
                                        @foreach($cancelled as $key => $trip) 
                                            <tr>
                                                <td>
                                                    {{ $trip->bus->registration_number }}
                                                </td>
                                                <td>
                                                    {{ $trip->departure_location }}
                                                </td>
                                                <td>
                                                    {{ $trip->arrival_location }}
                                                </td>
                                                <td>
                                                    {{ $trip->departure_date }}
                                                </td>  
                                                <td>
                                                    {{ $trip->departure_time }}
                                                </td>  
                                                <td>
                                                    {{ $trip->trip_duration }} hours
                                                </td>   
                                                <td>
                                                    {{ $trip->total_seats }} - {{ $trip->available_seats }}
                                                </td> 
                                                <td>
                                                    KSh. {{ $trip->class_fare }}
                                                </td>  
                                                <td>
                                                    {{ $trip->cancellation_reason }}
                                                </td>  
                                                <td>
                                                    <button class="btn btn-sm btn-outline-dark"><i class="fas fa-list text-dark pr-1" aria-hidden="true" @click="showPassengersModal({{ $trip }})"></i>Passenger list</button>
                                                </td>                       
                                            </tr>
                                        @endforeach    
                                    </table>    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>   
        <div class="modal fade right" id="details_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-full-height modal-right modal-lg" role="document" style="max-width: 45%; !important;">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="card shadow mb-4">            
                            <div class="card-header">
                                 Passenger List 
                            </div>
                            <div class="card-body">
                                <table width="100%" class="table table-striped table-bordered table-hover dt-responsive modal_datatable" id="dataTables-example">
                                    <thead>
                                        <th>Ticket Number</th>
                                        <th>Name</th>
                                        <th>ID Number</th>
                                        <th>Phone Number</th>
                                        <th>Email</th>
                                    </thead> 
                                    <tr v-for="passenger in passengerList">
                                        <td>
                                            @{{ passenger.ticket_number }}
                                        </td> 
                                        <td>
                                            @{{ passenger.full_name }}
                                        </td>
                                        <td>
                                            @{{ passenger.id_number }}
                                        </td>
                                        <td>
                                            @{{ passenger.phone_number }}
                                        </td>  
                                        <td>
                                            @{{ passenger.email }}
                                        </td>                       
                                    </tr>
                                </table>    
                            </div>
                        </div>                                                              
                    </div>
                </div>
            </div>
        </div>                        
        <br />
    </div>
</div>
</div>
@endsection