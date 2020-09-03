@if((new \Jenssegers\Agent\Agent())->isDesktop())
    <!doctype html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">

            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
            <link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}" />
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
                }
                .mybg{background:#0d1a80;}
                .table th, td {
                    text-align: center;
                } 
                .table-responsive{
                    height:350px;  
                    overflow:scroll;
                }
                thead tr:nth-child(1) th{
                    background: white;
                    position: sticky;
                    top: 0;
                    z-index: 10;
                }
                input[type=button], input[type=submit], input[type=reset] {
                    height: 40px;
                    background-color: #0d1a80;
                    color: white;
                    cursor: pointer;
                    width: 100px;
                }
                .bg-card {
                    background-color: #0d1a80;
                }
            </style>
        </head>
        <body>
            <div class="container"><table><tr><td><img class="container__image" src="idsi.png" alt="idsi.png" style="width: auto; height: 100px;"></td><td><h1 style="color: #0d1a80; font-family: arial; font-weight: bold;">SERVICE CENTER STOCK INVENTORY MONITORING</h1></td></tr></table></div>
                @include('inc.navbar')
                <div class="py-2">
                @yield('content')
                </div>            
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
        </body>
    </html>
@else
    @include('errors.404')
@endif
