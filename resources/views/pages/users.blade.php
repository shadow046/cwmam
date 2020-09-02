@extends('layouts.app')

@section('content')
  <div class="table-responsive" style="height: 400px;">
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th>
            USER NAME
          </th>
          <th>
            FULL NAME
          </th>
          <th>
            BRANCH
          </th>
          <th>
            LEVEL
          </th>
          <th>
            STATUS
          </th>
        </tr>
      </thead>
      <tbody>
        @for($i = 1; $i<=20; $i++)
        <tr>
          <td>
            ----
          </td>
          <td>
            ----
          </td>
          <td>
            ----
          </td>
          <td>
            ----
          </td>
          <td>
            ----
          </td>
        </tr>
        @endfor
      </tbody>
    </table>
  </div>
  <input type="button" value="Add">
  <input type="button" value="Edit">
  <input type="button" value="Save">
  <input type="button" value="Cancel">
@endsection