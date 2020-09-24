@extends('layouts.app')

@section('content')

  <div class="table-responsive" style="height: 450px;">
    <div class="container">
      <div style="display: flex; justify-content: flex-end" class="pt-3">
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
@endsection