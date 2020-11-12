<ul class="navbar-nav bg-gradient-secondary sidebar sidebar-dark accordion" id="accordionSidebar">

    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-bus"></i>
        </div>
        <div class="sidebar-brand-text mx-3">OBRS</div>
    </a>

    <hr class="sidebar-divider my-0">

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Management
    </div>

    @can('trips')
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-clipboard"></i>
                <span>Trips</span>
            </a>
            <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Trips</h6>
                    <a class="collapse-item" href="{{ url('/trip/create') }}">Create</a>
                    <a class="collapse-item" href="{{ url('/trip') }}">All Trips</a>
                </div>
            </div>
        </li>
    @endcan

    @can('bookings')
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBookings" aria-expanded="true" aria-controls="collapseBookings">
                <i class="fas fa-ticket-alt"></i>
                <span>Bookings</span>
            </a>
            <div id="collapseBookings" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Tickets</h6>
                    <a class="collapse-item" href="{{ url('/booking/create') }}">Buy ticket</a>
                    <a class="collapse-item" href="{{ url('/trip') }}">My Tickets</a>
                </div>
            </div>
        </li>
    @endcan

    @can('buses')
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBuses" aria-expanded="true" aria-controls="collapseBookings">
                <i class="fas fa-bus"></i>
                <span>Buses</span>
            </a>
            <div id="collapseBuses" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Buses</h6>
                    <a class="collapse-item" href="{{ url('/bus/create') }}">Create Bus</a>
                    <a class="collapse-item" href="{{ url('/bus') }}">All Buses</a>
                </div>
            </div>
        </li>
    @endcan   
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-user"></i>
            <span>Users</span>
        </a>
        <div id="collapseUsers" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">System Users</h6>
                @can('users')
                    <a class="collapse-item" href="{{ url('/users') }}">All Users</a>
                @endcan
                <a class="collapse-item" href="{{ url('/logout') }}">Logout</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>