@if((new \Jenssegers\Agent\Agent())->isDesktop()) 
    <!doctype html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
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
                @include('modal.branch')
            @endif

            @if(Request::is('request'))
                @include('modal.request')
                @include('modal.send')
                @include('modal.add')
            @endif

            @if(Request::is('user'))
                @include('modal.user')
            @endif
            
            <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
            <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
            
            @if(Request::is('user'))
                @include('scripts.user')
            @endif

            @if(Request::is('branch'))
                @include('scripts.branch')
            @endif

            @if(Request::is('request'))
                @include('scripts.stock')
            @endif
           
        </body>
    </html>
@else
    @include('errors.404')
@endif
