@extends('layouts.app')

@section('content')
  <div class="table-responsive">
    <table class="table customerTable" id="customerTable">
      <thead class="thead-dark">
        <tr>
          <th>
            BRANCH CODE
          </th>
          <th>
            BRANCH NAME
          </th>
          <th>
            PHONE 
          </th>
          <th>
            STATUS 
          </th>
        </tr>
      </thead>
    </table>
  </div>
  <input type="button" value="Add">
  <input type="button" value="Edit">
  <input type="button" value="Save">
  <input type="button" value="Cancel">
@endsection