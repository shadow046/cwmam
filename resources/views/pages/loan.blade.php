@extends('layouts.app')

@section('content')
<br><br>
  <div class="table-responsive">
    <table class="table loanTable" id="loanTable">
      <thead class="thead-dark">
        <tr>
          <th>
            Date
          </th>
          <th>
            Branch
          </th>
          <th>
            Item Description
          </th>
          <th>
            Type
          </th>
          <th>
            Status
          </th>
        </tr>
      </thead>
    </table>
  </div>
  
@endsection