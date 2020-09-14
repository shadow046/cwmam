@extends('layouts.app')

@section('content')
  <div>
    <div class="container">
      <div style="display: flex; justify-content: flex-end" class="pt-3">
        <a href="#" id="search-ic"><i class="fa fa-lg fa-search" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="#" id="filter" data-placement="bottom" data-toggle="popover" data-content='@include("inc.cfilter")'><i class="fa fa-lg fa-filter" aria-hidden="true"></i></a>
      </div>
    </div>
    <table class="table" id="userTable">
      <thead class="thead-dark">
        <tr class="tbsearch">
          <td>
              <input type="text" class="form-control filter-input fl-0" placeholder="Search for name...." data-column="0" />
          </td>
          <td>
            <input type="text" class="form-control filter-input fl-1" placeholder="Search for email...." data-column="1" />
          </td>
          <td>
            <input type="text" class="form-control filter-input fl-2" placeholder="Search for area...." data-column="2" />
          </td>
          <td>
            <input type="text" class="form-control filter-input fl-3" placeholder="Search for branch...." data-column="3" />
          </td>
          <td>
            <input type="text" class="form-control filter-input fl-4" placeholder="Search for level...." data-column="4" />
          </td>
          <td>
            <input type="text" class="form-control filter-input fl-5" placeholder="Search for status...." data-column="5" />
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
  @role('Super-admin|Admin')
    <input type="button" id="addBtn" class="button" value="New User"> 
  @endrole
    @include('modal.user')
@endsection