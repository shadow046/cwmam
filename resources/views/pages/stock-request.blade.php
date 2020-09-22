@extends('layouts.app')

@section('content')
  <div class="table-responsive" style="height: 450px;">
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th>
            DATE
          </th>
          <th>
            REQUEST NO.
          </th>
          <th>
            REQUESTED BY
          </th>
          <th>
            BRANCH NAME
          </th>
          <th>
            AREA
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
          <td>
            ----
          </td>
        </tr>
        @endfor
      </tbody>
    </table>
  </div>
@endsection