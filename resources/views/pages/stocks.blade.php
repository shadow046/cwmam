@extends('layouts.app')

@section('content')

  <div class="table-responsive">
    <div class="container">
      <div style="display: flex; justify-content: flex-end" class="pt-3">
      <input type="hidden" id="check" value="{{ $customers }}" />
        <a href="#" id="search-ic"><i class="fa fa-lg fa-search" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </div>
    </div>
    <table class="table stockTable" id="stockTable">
      <thead class="thead-dark">
        <tr class="tbsearch">
          <td>
              <input type="text" class="form-control filter-input fl-0" data-column="0" />
          </td>
          <td>
            <input type="text" class="form-control filter-input fl-1" data-column="1" />
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
            Category
          </th>
          <th>
            Item Code
          </th>
          <th>
            Item Description
          </th>
          <th>
            Quantity
          </th>
        </tr>
      </thead>
    </table>
  </div>
  <div class="d-flex">
    @if(!auth()->user()->hasrole('Administrator'))
      <input type="button" id="in_Btn" class="btn btn-xs btn-primary" value="SERVICE IN">&nbsp;
      <input type="button" id="out_Btn" class="btn btn-xs btn-primary" value="SERVICE OUT">&nbsp;
      <input type="button" id="loan_Btn" class="btn btn-xs btn-primary" value="LOAN UNIT">
    @endif
      <input type="button" id="importBtn" class="btn btn-xs btn-primary ml-auto" value="IMPORT">&nbsp;
      <input type="button" id="addStockBtn" class="btn btn-xs btn-primary" value="ADD STOCK">
  </div>
@endsection