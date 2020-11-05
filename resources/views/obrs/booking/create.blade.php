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
                        <li class="breadcrumb-item active">Buy Ticket</li>
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
                    <h6 class="m-0 font-weight-bold text-muted">Available trips</h6>
                </div>
                <div class="card-body request">
                    <table width="100%" class="table table-striped table-bordered table-hover dt-responsive datatable" id="dataTables-example">
                        <thead>
                            <th>Departure</th>
                            <th>Arrival</th>
                            <th>Departure Date-Time</th>
                            <th>Trip duration</th>
                            <th>Available seats</th>
                            <th>Price</th>        
                            <th>Status</th>                                                     
                            <th>Action</th>
                        </thead>
                        @foreach($pendingTrips as $key => $trip) 
                            <tr>
                                <td>
                                    {{ $trip->departure_location }}
                                </td>
                                <td>
                                    {{ $trip->arrival_location }}
                                </td>
                                <td>
                                    <span style="float: left">
                                        <i class="fas fa-calendar-alt mr-2 text-info"></i>
                                        {{ $trip->departure_date }}
                                    </span>
                                    <span style="float: right">
                                        <i class="fas fa-clock mr-2 text-info"></i>
                                        {{ $trip->departure_time }}
                                    </span>                                    
                                </td>   
                                <td>
                                    {{ $trip->trip_duration }} hours
                                </td>   
                                <td>
                                    {{ $trip->available_seats }}
                                </td>  
                                <td>
                                    KSh. {{ $trip->class_fare }}
                                </td>  
                                <td>
                                    <span v-if="{{ $trip->available_seats }} > 0" class="badge badge-info rotate-n-15">Available</span>
                                    <span v-else class="badge badge-danger rotate-n-15">Sold out</span>
                                </td>  
                                <td>
                                    <button v-if="{{ $trip->available_seats }} > 0" class="btn btn-sm btn-outline-dark" @click="showModal({{ $trip }})"><i class="fas fa-shopping-cart text-dark pr-1" aria-hidden="true"></i>Book</button>
                                    <button v-else class="btn btn-sm btn-outline-dark" disabled><i class="fas fa-shopping-cart text-dark pr-1" aria-hidden="true"></i>Book</button>
                                </td>                       
                            </tr>
                        @endforeach    
                    </table>  
                </div>   
            </div> 
            <div class="modal fade right" id="details_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-full-height modal-right modal-lg" role="document" style="max-width: 45%; !important;">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="card shadow mb-4">            
                                <div class="card-header">
                                    <div class="row">            
                                        <div class="col-lg-12">  
                                            <ul class="stepper stepper-horizontal m-0 p-2">                        
                                                <li class="stp">
                                                    <a class="p-0" href="#!" disabled>
                                                        <span class="circle trip_details_number">
                                                            <span>1</span>
                                                        </span>
                                                        <span class="circle trip_details_check" style="display: none">
                                                            <i class="fas fa-check"></i>
                                                        </span>
                                                        <span class="label">Trip Details</span>
                                                    </a>
                                                </li>
                                        
                                                <li class="stp">
                                                    <a class="p-0" href="#!" disabled>
                                                        <span class="circle personal_details_number">
                                                            <span>2</span>
                                                        </span>
                                                        <span class="circle personal_details_check" style="display: none">
                                                            <i class="fas fa-check"></i>
                                                        </span>
                                                        <span class="label">Passenger Details</span>
                                                    </a>
                                                </li>
                                        
                                                <li class="stp">
                                                    <a class="p-0" href="#!" disabled>
                                                        <span class="circle payment_details_number">
                                                            <span>3</span>
                                                        </span>
                                                        <span class="circle payment_details_check" style="display: none">
                                                            <i class="fas fa-check"></i>
                                                        </span>
                                                        <span class="label">Payment Details</span>
                                                    </a>
                                                </li>                                      
                                            </ul>                        
                                        </div>
                                    </div>  
                                </div>
                                <div class="card-body">
                                    <div class="tab card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-6 form-group">
                                                    <label><b>Departure</b></label>
                                                    <input class="form-control readonly" name="name" v-model="trip.departure_location" placeholder="Departure location" type="text" id="departure_location" readonly>
                                                </div>
                    
                                                <div class="col-lg-6 form-group">
                                                    <label><b>Arrival</b></label>
                                                    <input class="form-control readonly" name="phone_number" v-model="trip.arrival_location" placeholder="Arrival location" type="text" id="arrival_location" readonly>
                                                </div>
                                            </div>
                    
                                             <div class="row">
                                                <div class="col-lg-6 form-group">
                                                    <label><b>Departure Date</b></label>
                                                    <input class="form-control readonly" name="name" v-model="trip.departure_date" placeholder="Departure date" type="date" id="departure_date" readonly>
                                                </div>
                    
                                                <div class="col-lg-3 form-group">
                                                    <label><b>Departure Time</b></label>
                                                    <input class="form-control readonly" name="phone_number" v-model="trip.departure_time" placeholder="Departure time" type="time" id="departure_time" readonly>
                                                </div>
                    
                                                <div class="col-lg-3 form-group">
                                                    <label><b>Trip duration (Hours)</b></label>
                                                    <input class="form-control readonly" name="phone_number" v-model="trip.trip_duration" placeholder="Trip duration in hours" type="number" id="trip_duration" readonly>
                                                </div>
                                            </div>
                    
                                            <div class="row">
                                                <div class="col-lg-6 form-group">
                                                    <label><b>Available seats</b></label>
                                                    <input class="form-control readonly" name="phone_number" v-model="trip.total_seats" placeholder="Total number of seats" type="number" id="total_seats" readonly>
                                                </div>
                    
                                                <div class="col-lg-6 form-group">
                                                    <label><b>KSh.</b></label>
                                                    <input class="form-control readonly " name="phone_number" v-model="trip.class_fare" placeholder="Price in kenya shillings" type="number" id="class_fare" readonly>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 form-group">
                                                    <label><b>Tickets</b></label>
                                                    <select class="form-control" id="tickets" @change="generatePersonalDetails({{ $trip ?? '' }})">
                                                        <option value="0">0</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>                                        
                                    </div>
            
                                    <div class="tab" style="display: none;"> 
                                        <div class="passenger_details">
                                            <div class="card passenger_details_one mb-2">
                                                <div class="card-body ">
                                                    <div class="row">
                                                        <div class="col-lg-6 form-group">
                                                            <label><b>Full Name - Passenger</b></label>
                                                            <input class="form-control readonly" name="full_name[]" placeholder="Full Names" type="text" id="full_name">
                                                        </div>
                            
                                                        <div class="col-lg-6 form-group">
                                                            <label><b>ID Number</b></label>
                                                            <input class="form-control readonly" name="id_number[]" placeholder="National ID Number" type="number" id="id_number">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6 form-group">
                                                            <label><b>Phone Number</b></label>
                                                            <input class="form-control readonly" name="phone_number[]" placeholder="Phone Number" type="number" id="phone_number">
                                                        </div>
                            
                                                        <div class="col-lg-6 form-group">
                                                            <label><b>Email</b></label>
                                                            <input class="form-control readonly" name="email[]" placeholder="Email" type="email" id="email">
                                                        </div>
                                                    </div>
                                                </div>          
                                            </div>    
                                        </div>    
                                    </div>
            
                                    <div class="tab" style="display: none;">
                                        <div class="alert alert-primary" role="alert">
                                            Provide payment details and wait for STK push pop up on your mobile device to complete payment
                                        </div>
                                        <div class="card mb-2">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="d-flex align-items-center justify-content-center">
                                                            <img src="{{ asset('/public/img/logo-mpesa.png')}} " width="20%" height="auto"><br />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-2">
                                                    <div class="col-lg-12">
                                                        <div class="d-flex align-items-center justify-content-center">
                                                            <h4 class="text-primary">@{{ trip.departure_location }} to @{{ trip.arrival_location }}</h4>
                                                        </div>
                                                    </div>
                                                </div><hr class="m-2" />   
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="d-flex align-items-center justify-content-center">
                                                            <label>Date</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="d-flex align-items-center justify-content-center">
                                                            <label>@{{ trip.departure_date }}</label>
                                                        </div>
                                                    </div>
                                                </div><hr class="m-2" />
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="d-flex align-items-center justify-content-center">
                                                            <label>Time</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="d-flex align-items-center justify-content-center">
                                                            <label>@{{ trip.departure_time }}</label>
                                                        </div>
                                                    </div>
                                                </div><hr class="m-2" />  
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="d-flex align-items-center justify-content-center">
                                                            <label>Passangers</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="d-flex align-items-center justify-content-center">
                                                            <label>@{{ passengers }}</label>
                                                        </div>
                                                    </div>
                                                </div><hr class="m-2" />    
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="d-flex align-items-center justify-content-center">
                                                            <label>Payment status</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="d-flex align-items-center justify-content-center">
                                                            <span class="badge badge-light" id="pending_payment_status">pending</span>
                                                            <span class="badge badge-success" id="paid_payment_status" style="display: none">paid</span>
                                                        </div>
                                                    </div>
                                                </div><hr class="m-2" /> 
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="d-flex align-items-center justify-content-center">
                                                            <label>Total Fare</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="d-flex align-items-center justify-content-center">
                                                            <h4 class="text-success">KSh. @{{ totalFare }}</h4>
                                                        </div>
                                                    </div>
                                                </div><hr class="m-2" />                                         
                                            </div>   
                                        </div>  
                                          <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-6 form-group">
                                                        <label><b>Billing Number</b></label>
                                                        <input class="form-control readonly" name="name" placeholder="Billing number" type="number" id="billing_number">
                                                    </div>
                        
                                                    <div class="col-lg-6 form-group">
                                                        <label><b>Billing Email</b></label>
                                                        <input class="form-control readonly" name="phone_number" placeholder="Billing email" type="billing_email" id="billing_email">
                                                    </div>
                                                </div>
                                                <button class="btn btn-light btn-sm" type="button" style="text-transform: capitalize;" @click="initiateTransaction">
                                                    <span id="pay_now_spinner" class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true" style="display: none"></span>
                                                    <span id="pay_now_text">Pay Now</span>
                                                </button>
                                            </div>   
                                        </div>              
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-lg-12">
                                            <div class="btn-group" role="group" aria-label="Basic example" style="float: right;">                                    
                                                <button type="button" class="btn btn-light btn-sm" style="text-transform: capitalize;" id="prevBtn" @click="previous">Previous</button>
                                                <button type="button" class="btn btn-primary btn-sm" style="text-transform: capitalize;" id="nextBtn" @click="next">Next</button>                                                                       
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mt-4 pl-4 text-center">
                                                <span class="step"></span>
                                                <span class="step"></span>
                                                <span class="step"></span>
                                            </div>
                                        </div>                            
                                    </div>      
                                </div>
                            </div>                                                              
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection