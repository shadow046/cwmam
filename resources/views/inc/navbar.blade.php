<nav class="nav nav-tabs navbar-expand-md">
    <div class="navbar-collapse collapse justify-content-between align-items-center w-100">
        @auth
            <ul class="nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('branch') ? 'active' : '' }}" href="{{ route('branch.index') }}">Service Center</a>
                </li>
                @role('Administrator')
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('customer') ? 'active' : '' }}" href="{{ url('customer') }}">Customer</a>
                </li>
                @endrole
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('request') ? 'active' : '' }}" href="{{ route('stock.index') }}">Stock Request</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('stocks') ? 'active' : '' }}" href="{{ route('stocks.index') }}">Stock</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('return') ? 'active' : '' }}" href="{{ url('return') }}">Return</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('service-unit') ? 'active' : '' }}" href="{{ route('stock.service-unit') }}">Service unit</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('loans') ? 'active' : '' }}" href="{{ route('stock.loans') }}">Loans</a>
                </li>
            </ul>
            <ul class="nav">
                @role('Administrator')
                <li class="nav-item mr-1">
                    <a class="nav-link {{ Request::is('user') ? 'active' : '' }}" href="{{ url('user') }}">Users</a>
                </li>
                @endrole
                <li class="nav-item">
                    <a href="{{route('logout')}}" class="nav-link">logout</a>
                </li>
            </ul>
        @endauth
    </div>
</nav>
