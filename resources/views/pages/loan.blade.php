@extends('layouts.app')

@section('content')
<div class="container">Loan Request From Branch</div>
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
            Status
          </th>
        </tr>
      </thead>
    </table>
  </div>
  <hr>
  <hr>
  <div class="container">Loan Request to Branch</div>
  <div class="table-responsive">
    <table class="table loanrequestTable" id="loanrequestTable">
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
            Status
          </th>
        </tr>
      </thead>
    </table>
  </div>
@endsection