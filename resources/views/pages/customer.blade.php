@extends('layouts.app')

@section('content')
  <div class="container">
      <div style="display: flex; justify-content: flex-end" class="pt-3">
        <a href="#" id="search-ic"><i class="fa fa-lg fa-search" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </div>
  </div>
  <div class="table-responsive">
    <table class="table customerTable" id="customerTable">
      <thead class="thead-dark">
        <tr class="tbsearch">
          <td>
            <input type="text" class="form-control filter-input fl-0" data-column="0" />
          </td>
          <td>
            <input type="text" class="form-control filter-input fl-1" data-column="1" />
          </td>
        </tr>
        <tr>
          <th>
            CUSTOMER CODE
          </th>
          <th>
            CUSTOMER NAME
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