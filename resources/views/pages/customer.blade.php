@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
    <center>
        <p style="color: gray">Please enter valid serial number to start search</p>
        <div>
           SEARCH :  <input type="text" id="search" size="50" value="">
            <button type="button" id="searchBtn"><i class="fa fa-search" style="color:white;font-size:15px"></i></button>
            <button type="button" id="clearBtn" style="color:white;font-size:13px"><b>Clear</b></button>
        </div>
    </center>
    </div>
</div>
<div class="container pt-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2">
                <a href="#lccTable">
                    <div class="card bg-card text-center" style="min-height: 30px">
                        <div id="LCC" class="card-header" style="color: white;font-family:arial;font-size:80%;font-weight: bold;">
                            LCC
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-2">
                <a href="#mspgTable">
                    <div class="card bg-card text-center" style="min-height: 30px">
                        <div id="MSPG" class="card-header" style="color: white;font-family:arial;font-size:80%;font-weight: bold">
                            MSPG
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-2">
                <a href="#puregoldTable">
                    <div class="card bg-card text-center" style="min-height: 30px">
                        <div id="PUREGOLD" class="card-header" style="color: white;font-family:arial;font-size:80%;font-weight: bold">
                            PUREGOLD
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-2">
                <a href="#shoemartTable">
                    <div class="card bg-card text-center" style="min-height: 30px">
                        <div id="SHOEMART" class="card-header" style="color: white;font-family:arial;font-size:80%;font-weight: bold">
                            SHOEMART
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-2">
                <a href="#smmaTable">
                    <div class="card bg-card text-center" style="min-height: 30px">
                        <div id="SMMA" class="card-header" style="color: white;font-family:arial;font-size:80%;font-weight: bold">
                            SM MA
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

@include('pages.lcc')
@include('pages.mspg')
@include('pages.puregold')
@include('pages.shoemart')
@include('pages.smma')


@role('Viewer')
<input type="button" id="customerBtn" class="btn btn-primary" value="New Customer">
<input type="button" id="editBtn" class="btn btn-primary" value="Edit Customer Details">
@endrole
@endsection