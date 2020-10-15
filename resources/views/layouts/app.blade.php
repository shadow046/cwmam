@if((new \Jenssegers\Agent\Agent())->isDesktop()) 
    <!doctype html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
            <link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}" />
            <link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <title>SERVICE CENTER STOCK INVENTORY MONITORING</title>
            @include('inc.style')
        </head>
        <body>
            @include('inc.header')
            @include('inc.navbar')
            <div class="py-2">
            @yield('content')
            </div>

            @if(Request::is('branch'))
                @include('modal.warehouse.branch')
            @endif

            @if(Request::is('request'))
                @if(Auth::user()->hasrole('Administrator'))
                    @include('modal.warehouse.request')
                    @include('modal.warehouse.send')
                    @include('modal.warehouse.add')
                @else
                    @include('modal.branch.request')
                    @include('modal.branch.send')
                @endif
            @endif

            @if(Request::is('stocks'))
                @if(Auth::user()->hasrole('Administrator'))
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
                    @include('modal.branch.loan')
                @endif
            @endif

            @if(Request::is('user'))
                @include('modal.warehouse.user')
            @endif

            <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.js"></script>
            <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
            
            @if(Request::is('user'))
                @include('scripts.warehouse.user')
            @endif

            @if(Request::is('branch'))
                @include('scripts.warehouse.branch')
            @endif

            @if(Request::is('request'))
                @if(Auth::user()->hasrole('Administrator'))
                    @include('scripts.warehouse.request')
                @else
                    @include('scripts.branch.request')
                @endif
            @endif

            @if(Request::is('stocks'))
                @if(Auth::user()->hasrole('Administrator'))
                    @include('scripts.warehouse.stock')
                @else
                    @include('scripts.branch.stock')
                    @include('scripts.branch.addstock')
                    @include('scripts.branch.service-in')
                    @include('scripts.branch.service-out')
                    @include('scripts.branch.loan')

                @endif                
            @endif

            @if(Request::is('service-unit'))
                    @include('scripts.branch.service-unit')
            @endif
        </body>
    </html>
@else
    @include('errors.404')
@endif
