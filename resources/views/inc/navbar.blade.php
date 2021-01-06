<nav class="nav nav-tabs navbar-expand-md">
    <div class="navbar-collapse collapse justify-content-between align-items-center w-100">
        <ul class="nav mr-auto">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ url('/') }}">HOME</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('Customers') ? 'active' : '' }}" href="{{ url('Customers') }}">CUSTOMERS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('Users') ? 'active' : '' }}" href="{{ url('Users') }}">USERS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('Settings') ? 'active' : '' }}" href="{{ url('Settings') }}">SETTINGS</a>
            </li>
        </ul>
        <ul class="nav">
             <li class="nav-item">
                <a href="{{route('logout')}}" class="nav-link"><b>Logout</b>&nbsp;&nbsp;<i class="fa fa-sign-out" aria-hidden="true"></i></a>
            </li>
        </ul>
    </div>
</nav>