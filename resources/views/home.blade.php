@extends('layouts.master')
@section('content')
<div class="page_name" id="Home"></div>
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
            <div class="accordion acc_data" id="accordionExample">
                <div class="row">
                    
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                           Trips Taken</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <p id="aging">{{ $tripsTakenCount }}</p>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-clipboard-check fa-3x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                            Total Payments</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <p id="in_progress">KSh. {{ $paymentSum }}</p>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-money-bill-wave-alt fa-3x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Pending Trips</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <p id="completed_items">{{ $pendingTripsCount }}</p>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-clock fa-3x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="display-5" style="font-size: 25px">Data Visualization</h1>
                </div>
            </div>
            <hr />
            <div class="row">
                <div class="col-lg-6">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Booking requests</h6>
                        </div>
                       
                        <div class="card-body">
                            <input type="hidden" value="{{ $bookings }}" id="bookings">
                            <canvas id="lineChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Payments</h6>
                        </div>
                       
                        <div class="card-body">
                            <input type="hidden" value="{{ $payments }}" id="payments">
                            <canvas id="paymentsChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection