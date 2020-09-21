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
            <style>
                body {
                    padding: 20px;   
                }
                .nav {
                    background: #0d1a80;
                }
                .nav.nav-tabs li a {
                    color: white;
                }
                .nav.nav-tabs .active{
                    color: white;
                    background: gray;
                }
                p {
                    color: white;
                    margin: 0;
                }
                .mybg{background:#0d1a80;}
                .table th, td {
                    text-align: left;
                } 
                .table-responsive{
                    height:350px;  
                    overflow:scroll;
                }
                
                thead tr:nth-child(2) th{
                    background: white;
                    position: sticky;
                    top: 0;
                    z-index: 10;
                }

                button[type=button].col-md-2{
                    height: 35px;
                    background-color: #0d1a80;
                    color: white;
                    cursor: pointer;
                    width: 60px;
                }

                button[type=button], button[type=submit], button[type=reset], input[type=button], input[type=submit], input[type=reset] {
                    background-color: #0d1a80;
                }
                .bg-card {
                    background-color: #0d1a80;
                }

                .modal-header {
                    padding:9px 15px;
                    border-bottom:1px solid #eee;
                    background-color: #0d1a80;
                    color: white;
                    -webkit-border-top-left-radius: 5px;
                    -webkit-border-top-right-radius: 5px;
                    -moz-border-radius-topleft: 5px;
                    -moz-border-radius-topright: 5px;
                    border-top-left-radius: 5px;
                    border-top-right-radius: 5px;
                }

                .row.no-margin {
                    margin-left: -1.5px;
                    margin-right: -1.5px;
                }

                .row.no-margin > .col-md-2, .row.no-margin > .col-lg-3, .row.no-margin > .col-md-3, .row.no-margin > .col-md-4, , .row.no-margin > .col-md-5 .row.no-margin > .col-md-6, .row.no-margin > .col-md-7, .row.no-margin > .col-md-8{
                    padding-left: 1.5px;
                    padding-right: 1.5px;
                }
                
                .modal-content{
                    background-color: #f2f2f2;
                }
            </style>
        </head>
        <body>
            <div class="d-flex">
                <img class="p-2 align-self-end" src="idsi.png" alt="idsi.png" style="width: auto; height: 120px;">
                <h2 class="p-2 align-self-end" style="color: #0d1a80; font-family: arial; font-weight: bold;">SERVICE CENTER STOCK INVENTORY MONITORING</h2>
                @auth
                <div class="p-2 ml-auto align-self-end d-flex">
                    <div class="p-2 ml-auto" style="text-align: right;">
                            <p style="color: #0d1a80">{{ Auth::user()->name}}</p>
                            <p style="color: #0d1a80">{{ Auth::user()->branch->name}}</p>
                            <p style="color: #0d1a80">{{Carbon\Carbon::now()->toDayDateTimeString()}}</p>
                    </div>
                    <i class="fa fa-user-circle fa-5x p-2"></i>
                </div>
                @endauth
            </div>
            @include('inc.navbar')
            <div class="py-2">
            @yield('content')
            </div>
            @if(Request::is('branch'))
                @include('modal.branch')
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
