@extends('layouts.app')

@section('content')
  <div class="container">
    <div style="display: flex; justify-content: flex-end">
      Toggle column: <a class="toggle-vis" data-column="0">Name</a> - <a class="toggle-vis" data-column="1">Position</a> - <a class="toggle-vis" data-column=
      "2">Office</a> - <a class="toggle-vis" data-column="3">Age</a> - <a class="toggle-vis" data-column="4">Start date</a> - <a class="toggle-vis" data-column=
      "5">Salary</a>
    </div>
    <table class="table" id="userTable">
      <thead class="thead-dark">
        <tr>
          <td>
              <input type="text" class="form-control filter-input" placeholder="Search for name...." data-column="0" />
          </td>
          <td>
            <input type="text" class="form-control filter-input" placeholder="Search for email...." data-column="1" />
          </td>
          <td>
            <input type="text" class="form-control filter-input" placeholder="Search for area...." data-column="2" />
          </td>
          <td>
            <input type="text" class="form-control filter-input" placeholder="Search for branch...." data-column="3" />
          </td>
          <td>
            <input type="text" class="form-control filter-input" placeholder="Search for level...." data-column="4" />
          </td>
          <td>
            <input type="text" class="form-control filter-input" placeholder="Search for status...." data-column="5" />
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