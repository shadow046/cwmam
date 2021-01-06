@extends('layouts.app')

@section('content')
<div class="container pt-5">
    <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3">
                    <a href="#">
                        <div class="card bg-card" style="min-height: 120px">
                            <div class="card-header" style="min-height: 60px; background-color: #0d1a80; color: white;font-family:arial;font-size:80%;font-weight: bold">
                                CUSTOMERS<i class="far fa-file-alt" style="font-size:30px;float:right;line-height:20px;"></i>
                                
                            </div>
                            <div class="card-body text-center">
                                <p class="card-text" style="font-family:arial;font-size:130%;font-weight: bold">12314</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-3">
                    <a href="#">
                        <div class="card bg-card" style="min-height: 120px">
                            <div class="card-header" style="min-height: 60px; background-color: #0d1a80; color: white;font-family:arial;font-size:80%;font-weight: bold">
                                USERS<i class="fa fa-users" style="font-size:30px;float:right;line-height:20px;"></i>
                            </div>
                            <div class="card-body text-center">
                                <p class="card-text" style="font-family:arial;font-size:130%;font-weight: bold">12314</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-3">
                    <a href="#">
                        <div class="card bg-card" style="min-height: 120px">
                            <div class="card-header" style="min-height: 60px; background-color: #0d1a80; color: white;font-family:arial;font-size:80%;font-weight: bold">
                                EXPIRING<i class="fas fa-hourglass-half" style="font-size:30px;float:right;line-height:px;"></i>
                                WARRANTY/MA
                            </div>
                            <div class="card-body text-center">
                                <p class="card-text" style="font-family:arial;font-size:130%;font-weight: bold">12314</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-3">
                    <a href="#">
                        <div class="card bg-card" style="min-height: 120px">
                            <div class="card-header" style="min-height: 60px; background-color: #0d1a80; color: white;font-family:arial;font-size:80%;font-weight: bold">
                                EXPIRED<i class="fas fa-hourglass-end" style="font-size:30px;float:right;line-height:px;"></i>
                                WARRANTY/MA
                            </div>
                            <div class="card-body text-center">
                                <p class="card-text" style="font-family:arial;font-size:130%;font-weight: bold">12314</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
    </div>
</div>
<ul class="nav nav-tabs">
    <li class="nav-item">
        <p>USER ACTIVITIES</p>
    </li>
</ul>

<div class="table-responsive">
    <div style="float: right;" class="pt-3">
        <b>SEARCH&nbsp;&nbsp;</b><a href="#" id="search-ic"><i class="fa fa-lg fa-search" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </div>
    <table class="table activityTable" id="activityTable">
        <thead class="thead-dark">
            <tr class="tbsearch" style="display:none">
                <td>
                    <input type="text" class="form-control filter-input fl-0" data-column="0" />
                </td>
                <td>
                    <input type="text" class="form-control filter-input fl-1" data-column="1" />
                </td>
                <td>
                    <input type="text" class="form-control filter-input fl-2" data-column="2" />
                </td>
                <td>
                    <input type="text" class="form-control filter-input fl-3" data-column="3" />
                </td>
                <td>
                    <input type="text" class="form-control filter-input fl-3" data-column="4" />
                </td>
            </tr>
            <tr>
                <th>
                    ID
                </th>
                <th>
                    DATE & TIME
                </th>
                <th>
                    EMAIL
                </th>
                <th>
                    FULLNAME &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </th>
                <th>
                    ACTIVITY
                </th>
            </tr>
        </thead>
    </table>
</div>
@endsection