<nav class="nav nav-tabs navbar-expand-md">
    <div class="navbar-collapse collapse justify-content-between align-items-center w-100">
        <ul class="nav mr-auto">
            @auth
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('branch') ? 'active' : '' }}" href="{{ route('branch.index') }}">Service Center</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('customer') ? 'active' : '' }}" href="{{ url('customer') }}">Customer</a>
                </li>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('request') ? 'active' : '' }}" href="{{ route('stock.index') }}">Stock Request</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('service_units') ? 'active' : '' }}" href="{{ url('service_units') }}">Service Units</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('return') ? 'active' : '' }}" href="{{ url('return') }}">Return</a>
                </li>
                
            @else
                <br><br>
            @endauth
            </ul>
        </ul>

        <ul class="nav">
            @role('Admin|Super-admin')
            <li class="nav-item mr-1">
                <a class="nav-link {{ Request::is('user') ? 'active' : '' }}" href="{{ url('user') }}">Users</a>
            </li>
            @endrole
            <li class="nav-item">
                <a href="{{route('logout')}}" class="nav-link">logout</a>
            </li>
        </ul>
    </div>
</nav>
