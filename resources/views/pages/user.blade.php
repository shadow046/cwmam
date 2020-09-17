@extends('layouts.app')

@section('content')
  <div>
    <div class="container">
      <div style="display: flex; justify-content: flex-end" class="pt-3">
        <a href="#" id="search-ic"><i class="fa fa-lg fa-search" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="#" id="filter" data-placement="bottom" data-toggle="popover" data-content='@include("inc.userfilter")'><i class="fa fa-lg fa-filter" aria-hidden="true"></i></a>
      </div>
    </div>
    <table class="table" id="userTable">
      <thead class="thead-dark">
        <tr class="tbsearch">
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
            <input type="text" class="form-control filter-input fl-4" data-column="4" />
          </td>
          <td>
            <input type="text" class="form-control filter-input fl-5" data-column="5" />
          </td>
        </tr>
        <tr>
          <th>FULL NAME</th>
          <th>EMAIL</th>
          <th>AREA</th>
          <th>BRANCH</th>
          <th>LEVEL</th>
          <th>STATUS</th>
        </tr>
      </thead>
    </table>
  </div>
  @role('Administrator')
    <input type="button" id="addBtn" class="btn btn-primary" value="New User"> 
  @endrole
    @include('modal.user')
@endsection