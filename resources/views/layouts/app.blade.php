@if((new \Jenssegers\Agent\Agent())->isDesktop()) 
    <!doctype html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
        
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            @auth
            <meta name="csrf-token" content="{{ csrf_token() }}">
            @endauth
            
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
            <link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}" />
            <link rel="stylesheet" type="text/css" href="{{ url('/css/styles.css') }}" />
            <link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            @if(Request::is('login'))
                <title>Login</title>
            @else
                <title>{{$title}}</title>
            @endif
            <link rel="icon" href="{{asset('favicon.ico')}}" type="image/x-icon" />
            <link rel="shortcut icon" href="{{asset('favicon.ico')}}" type="image/x-icon" />
        </head>
        
        <body>
            @include('inc.header')
            @include('inc.navbar')
            @if(!Auth::guest())
                <input type="text" hidden id="level" value={{ auth()->user()->roles->first()->name }}>
            @endif
            <div class="py-2">
            @yield('content')
            </div>

            @if(Request::is('branch'))
                @include('modal.warehouse.branch')
                @if(auth()->user()->hasrole('Administrator'))
                    @include('modal.warehouse.initial')
                @endif
            @endif

            @if(Request::is('request'))
                @if(auth()->user()->hasAnyrole('Administrator', 'Encoder'))
                    @include('modal.warehouse.request')
                    @include('modal.warehouse.send')
                    @include('modal.warehouse.add')
                @else
                    @include('modal.branch.request')
                    @include('modal.branch.send')
                @endif
            @endif

            @if(Request::is('customer'))
                @if(auth()->user()->hasrole('Viewer'))
                    @include('modal.customer')
                @endif
            @endif

            @if(Request::is('customer/*'))
                @if(auth()->user()->hasrole('Viewer'))
                    @include('modal.customerbranch')
                @endif
            @endif

            @if(Request::is('stocks'))
                @if(auth()->user()->hasAnyrole('Administrator', 'Encoder'))
                    @include('modal.warehouse.add')
                    @include('modal.warehouse.category')
                    @include('modal.warehouse.item')
                    @include('modal.warehouse.import')
                @else
                    @include('modal.branch.import')
                    @include('modal.branch.add')
                    @include('modal.branch.out')
                    @include('modal.branch.pull-out')
                    @include('modal.branch.out-option')
                    @include('modal.branch.in-option')
                    @include('modal.branch.good')
                    @include('modal.branch.replacement')
                    @include('modal.branch.replace-details')
                    @include('modal.branch.replace-details-select')
                    @include('modal.branch.stock')
                @endif
            @endif

            @if(Request::is('user'))
                    @include('modal.warehouse.user')
            @endif

            @if(Request::is('loans'))
                @include('modal.branch.loans')
                @include('modal.branch.loan')
            @endif

            @if(Request::is('return'))
                @include('modal.branch.return')
            @endif

            @if (Request::is('/') && auth()->user()->hasrole('Repair'))
                @include('modal.branch.return')
            @endif
            
            <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.js"></script>
            <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
            <script src="{{asset('js/session.js')}}"></script>
            
            @if(Request::is('user'))
                <script src="{{asset('js/warehouse/user.js')}}"></script>
            @endif

            @if(Request::is('branch'))
                @if(auth()->user()->hasAnyrole('Administrator', 'Encoder'))
                    <script src="{{asset('js/warehouse/branch.js')}}"></script>
                @else
                    <script src="{{asset('js/branch/branch.js')}}"></script>
                @endif
            @endif

            @if(Request::is('request'))
                @if(auth()->user()->hasAnyrole('Administrator', 'Encoder'))
                    <script src="{{asset('js/warehouse/request.js')}}"></script>
                @endif
                @if(auth()->user()->hasrole('Viewer'))
                    @include('scripts.request')
                @endif
                @if(!auth()->user()->hasAnyrole('Administrator', 'Encoder', 'Viewer'))
                    <script src="{{asset('js/branch/request.js')}}"></script>
                @endif
            @endif

            @if(Request::is('stocks'))
                @if(auth()->user()->hasAnyrole('Administrator', 'Encoder'))
                    <script src="{{asset('js/warehouse/stock.js')}}"></script>
                @else
                    <script src="{{asset('js/branch/stocks.js')}}"></script>
                    <script src="{{asset('js/branch/service-in.js')}}"></script>
                    <script src="{{asset('js/branch/service-out.js')}}"></script>
                @endif
                @if(auth()->user()->hasrole('Head'))
                    <script src="{{asset('js/branch/addstock.js')}}"></script>
                @endif

            @endif

            @if(Request::is('service-unit'))
                <script src="{{asset('js/branch/service-unit.js')}}"></script>
            @endif

            @if(Request::is('print/*'))
                <script src="{{asset('js/warehouse/print.js')}}"></script>
            @endif

            @if(Request::is('loans'))
                <script src="{{asset('js/branch/loans.js')}}"></script>
            @endif

            @if(Request::is('return'))
                @if(auth()->user()->hasAnyrole('Administrator', 'Encoder'))
                    <script src="{{asset('js/warehouse/defective.js')}}"></script>
                @endif
                @if(auth()->user()->hasrole('Viewer'))
                    <script src="{{asset('js/defective.js')}}"></script>
                @endif
                @if (!auth()->user()->hasAnyrole('Administrator', 'Encoder', 'Viewer'))
                    <script src="{{asset('js/branch/defective.js')}}"></script>
                @endif
            @endif
            
            @if(Request::is('customer'))
                <!--script src="{{asset('js/customer.js')}}"></script-->
                @include('scripts.customer')
            @endif
            @if(Request::is('customer/*'))
                @include('scripts.customerbranch')
                <!--script src="{{asset('js/customerbranch.js')}}"></script-->
            @endif

            @if(Request::is('/') && !auth()->user()->hasrole('Repair'))
                <script src="{{asset('js/home.js')}}"></script>
            @endif
            @if (Request::is('/') && auth()->user()->hasrole('Repair'))
                <script src="{{asset('js/warehouse/defective.js')}}"></script>
            @endif
            @if(Request::is('log') && auth()->user()->hasrole('Repair'))
                <script src="{{asset('js/home.js')}}"></script>
            @endif
            @if(Request::is('unrepair') && auth()->user()->hasrole('Repair'))
                <script src="{{asset('js/unrepair.js')}}"></script>
            @endif

        </body>
    </html>
@else
    @include('errors.404')
@endif
