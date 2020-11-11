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
                    <li class="breadcrumb-item"><a href="#" style="color: #0072C6">Users</a><i
                            class="fas fa-caret-right mx-2" aria-hidden="true"></i></li>
                    <li class="breadcrumb-item active"> All Users</li>
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
                    <table width="100%" class="table table-striped table-bordered table-hover dt-responsive datatable" id="dataTables-example">
                        <thead>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </thead>
                        @foreach($users as $key => $user) 
                            <tr>
                                <td>
                                    {{ $user->name }}
                                </td>
                                <td>
                                    {{ $user->email }}
                                </td>
                                <td>
                                    @if(!empty($user->getRoleNames()))
                                        @foreach($user->getRoleNames() as $role)
                                            <label class="badge badge-light">{{ $role }}</label>
                                        @endforeach
                                    @endif
                                </td>  
                                <td>
                                    <a href="{{ url('/user/edit/' . $user->id) }}" type="button" class="btn btn-outline-dark waves-effect btn-sm" style="text-transform: capitalize;"><i class="fas fa-pen text-dark pr-1" aria-hidden="true"></i>Edit</a>
                                </td>   
                                <td>
                                    <a href="{{ url('/user/delete/' . $user->id) }}" type="button" class="btn btn-outline-dark waves-effect btn-sm" style="text-transform: capitalize;"><i class="fas fa-trash text-dark pr-1" aria-hidden="true"></i>Delete</a>
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