<ul class="nav nav-tabs">
    
        <li class="nav-item">
            <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::is('service_center') ? 'active' : '' }}" href="{{ url('service_center') }}">Service Center</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::is('customer') ? 'active' : '' }}" href="{{ url('customer') }}">Customer</a>
        </li>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::is('stock_request') ? 'active' : '' }}" href="{{ url('stock_request') }}">Stock Request</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::is('service_units') ? 'active' : '' }}" href="{{ url('service_units') }}">Service Units</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::is('return') ? 'active' : '' }}" href="{{ url('return') }}">Return</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::is('users') ? 'active' : '' }}" href="{{ url('users') }}">Users</a>
        </li>
        @role('super-admin'|'admin')
            <li class="nav-item">
                <a href="{{route('register')}}" class="nav-link">Add user</a>
            </li>
        @endrole
        <li class="nav-item">
            <a href="{{route('logout')}}" class="nav-link">logout</a>
        </li>
    
        <li class="nav-item">
            <a href="{{route('login')}}" class="nav-link">Login</a>
        </li>
    
    </ul>
</ul>
