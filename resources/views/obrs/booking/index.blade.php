@extends('layouts.master')
@section('content')
<div class="page_name" id="CreateBooking"></div>
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
                        <li class="breadcrumb-item"><a href="#" style="color: #0072C6">Booking</a><i
                                class="fas fa-caret-right mx-2" aria-hidden="true"></i></li>
                        <li class="breadcrumb-item active">My Tickets</li>
                    </ol>
                </nav>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card shadow mb-4">            
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-muted">My Tickets</h6>
                </div>
                <div class="card-body request">
                    <table width="100%" class="table table-striped table-bordered table-hover dt-responsive datatable" id="dataTables-example">
                        <thead>
                            <th>Ticket Number</th>
                            <th>Departure</th>
                            <th>Arrival</th>
                            <th>Departure Date-Time</th>
                            <th>Trip duration</th>
                            <th>Price</th>    
                        </thead>
                        @foreach($bookings as $key => $booking) 
                            <tr>
                                <td>
                                    {{ $booking->ticket_number }}
                                </td>
                                <td>
                                    {{ $booking->trip->departure_location }}
                                </td>
                                <td>
                                    {{ $booking->trip->arrival_location }}
                                </td>
                                <td>
                                    <span style="float: left">
                                        <i class="fas fa-calendar-alt mr-2 text-info"></i>
                                        {{ $booking->trip->departure_date }}
                                    </span>
                                    <span style="float: right">
                                        <i class="fas fa-clock mr-2 text-info"></i>
                                        {{ $booking->trip->departure_time }}
                                    </span>                                    
                                </td>   
                                <td>
                                    {{ $booking->trip->trip_duration }} hours
                                </td>   
                                <td>
                                    KSh. {{ $booking->trip->class_fare }}
                                </td>                       
                            </tr>
                        @endforeach    
                    </table>  
                </div>   
            </div> 
        </div>
    </div>
</div>
@endsection