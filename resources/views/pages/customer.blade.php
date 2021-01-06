@extends('layouts.app')

@section('content')
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
                    <a href="#">
                        <div class="card bg-card text-center" style="min-height: 30px">
                            <div id="MSPG" class="card-header" style="color: white;font-family:arial;font-size:80%;font-weight: bold">
                                MSPG
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-2">
                    <a href="#">
                        <div class="card bg-card text-center" style="min-height: 30px">
                            <div id="PUREGOLD" class="card-header" style="color: white;font-family:arial;font-size:80%;font-weight: bold">
                                PUREGOLD
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-2">
                    <a href="#">
                        <div class="card bg-card text-center" style="min-height: 30px">
                            <div id="SHOEMART" class="card-header" style="color: white;font-family:arial;font-size:80%;font-weight: bold">
                                SHOEMART
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-2">
                    <a href="#">
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
<div style="float: right;" class="pt-3">
    <b>SEARCH&nbsp;&nbsp;</b><a href="#" id="search-ic"><i class="fa fa-lg fa-search" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</div>
<div class="table-responsive" id="lccTable" style="display: none">
    <table class="table table-sm">
        <caption>LCC Invertory Warranty</caption>
        <thead class="bg-info">
            <tr>
                <th>
                    COMPANY NAME
                </th>
                <th>
                    ITEM DESCRIPTION
                </th>
                <th>
                    SERIAL
                </th>
                <th>
                    START
                </th>
                <th>
                    END
                </th>
                <th>
                    SPECIFICATIONS
                </th>
                <th>
                    STATUS
                </th>
            </tr>
        </thead>
    </table>
</div>
@role('Viewer')
<input type="button" id="customerBtn" class="btn btn-primary" value="New Customer">
<input type="button" id="editBtn" class="btn btn-primary" value="Edit Customer Details">
@endrole
@endsection