@extends('layouts.app')

@section('content')
@if(!auth()->user()->hasrole('Repair'))
  <div class="container pt-5">  
  @if (!auth()->user()->hasrole('Viewer'))
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-2">
        <a href="{{ route('stock.index')}}">
          <div class="card bg-card">
            <div class="card-body text-center">
              <p class="card-text">STOCK REQUEST</p>
              <p class="card-text">{{ $stockreq }}</p>
            </div>
          </div>
        </a>
      </div>
      <div class="col-sm-2">
        <a href="{{ route('stocks.index')}}">
          <div class="card bg-card">
            <div class="card-body text-center">
              <p class="card-text">STOCKS</p>
              <p class="card-text">{{ $units }}</p>
            </div>
          </div>
        </a>
      </div>
      <div class="col-sm-2">
        <a href="{{ route('return.index')}}">
          <div class="card bg-card">
            <div class="card-body text-center">
              <p class="card-text">RETURNS</p>
              <p class="card-text">{{ $returns }}</p>
            </div>
          </div>
        </a>
      </div>
      @if(auth()->user()->branch->branch != 'Warehouse');
      <div class="col-sm-2">
        <a href="{{ route('stock.service-unit')}}">
          <div class="card bg-card">
            <div class="card-body text-center">
              <p class="card-text">SERVICE UNIT</p>
              <p class="card-text">{{ $sunits }}</p>
            </div>
          </div>
        </a>
      </div>
      @endif
    </div>  
  </div>
  @endif
</div>
  <ul class="nav nav-tabs">
    <li class="nav-item">
      <a>USER ACTIVITIES</a>
    </li>
  </ul>
@endif
  
  <div class="table-responsive">
    <div style="display: flex; justify-content: flex-end" class="pt-3">
      <a href="#" id="search-ic"><i class="fa fa-lg fa-search" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </div>
    <table class="table activityTable" id="activityTable">
      <thead class="thead-dark">
        <tr class="tbsearch">
          <td>
            <input hidden type="text" class="form-control filter-input fl-0" data-column="0" />
          </td>
          <td>
            <input hidden type="text" class="form-control filter-input fl-1" data-column="1" />
          </td>
          <td>
            <input type="text" class="form-control filter-input fl-2" data-column="2" />
          </td>
          <td>
            <input type="text" class="form-control filter-input fl-3" data-column="3" />
          </td>
        </tr>
        <tr>
          <th>
            DATE & TIME
          </th>
          <th>
            EMAIL
          </th>
          <th>
            FULLNAME &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          </th>
          <th>
            ACTIVITY  
          </th>
        </tr>
      </thead>
    </table>
  </div>
@endsection