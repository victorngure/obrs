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
                        <li class="breadcrumb-item"><a href="#" style="color: #0072C6">Route</a><i
                                class="fas fa-caret-right mx-2" aria-hidden="true"></i></li>
                        <li class="breadcrumb-item active">Create</li>
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
                {{ csrf_field() }}
                <div class="card shadow mb-4">            
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-muted">Route details</h6>
                    </div>
                    <div class="card-body request">
                        <div class="row">
                            <div class="col-lg-6 form-group">
                                <label><b>Departure</b></label>
                                <input class="form-control" placeholder="Departure" type="text" id="departure" autofocus>
                            </div>

                            <div class="col-lg-6 form-group">
                                <label><b>Arrival</b></label>
                                <input class="form-control" placeholder="Arrival" type="text" id="arrival" autofocus>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 form-group">
                                <label><b>Trip Duration</b></label>
                                <input class="form-control" placeholder="Trip Duration" type="number" id="trip_duration" autofocus>
                            </div>
                        </div>
                    </div>   
                </div> 
                <button class="btn btn-md btn-primary" style="text-transform: capitalize; float: right;" @click="createRoute()">Submit</button><br />
            </form>
        </div>
    </div>
</div>
@endsection