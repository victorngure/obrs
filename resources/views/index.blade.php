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
                    <li class="breadcrumb-item"><a href="#" style="color: #0072C6">Students</a><i
                            class="fas fa-caret-right mx-2" aria-hidden="true"></i></li>
                    <li class="breadcrumb-item active"> All Students</li>
                </ol>
            </nav>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success col-lg-12" id="alert">
                <p>{{ $message }}</p>
            </div>
        @endif
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table width="100%" class="table table-striped table-bordered table-hover dt-responsive" id="dataTables-example">
                        <thead>
                            <th>Name</th>
                            <th>Phone Number</th>
                            <th>Class</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </thead>
                        @foreach($students as $key => $student) 
                            <tr>
                                <td>
                                    {{ $student->name }}
                                </td>
                                <td>
                                    {{ $student->phone_number }}
                                </td>
                                <td>
                                    {{ $student->class }}
                                </td>  
                                <td>
                                    <a href="{{ url('/student/edit/' . $student->id) }}" type="button" class="btn btn-outline-primary waves-effect btn-sm" style="text-transform: capitalize;">Edit</a>
                                </td>   
                                <td>
                                    <a href="{{ url('/student/delete/' . $student->id) }}" type="button" class="btn btn-outline-danger waves-effect btn-sm" style="text-transform: capitalize;">Delete</a>
                                </td>                     
                            </tr>
                        @endforeach    
                    </table>     
                </div>
            </div>
        </div>                           
        <br />
    </div>
</div>
</div>
@endsection