@extends('layouts.app')

@section('content')

  <div class="table-responsive" style="height: 450px;">
    <table class="table requestTable" id="requestTable">
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
    </table>
  </div>
@endsection