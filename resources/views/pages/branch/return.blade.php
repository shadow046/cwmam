@extends('layouts.app')

@section('content')
<div class="table-responsive">
    <div class="container">
        <div style="display: flex; justify-content: flex-end" class="pt-3">
            <a href="#" id="search-ic"><i class="fa fa-lg fa-search" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </div>
    </div>
    <table class="table defectiveTable" id="defectiveTable">
        <thead class="thead-dark">
            <tr class="tbsearch" style="display:none">
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
                <td>
                    <input type="text" class="form-control filter-input fl-4" data-column="4" />
                </td>
            </tr>
            <tr>
                <th>
                    Date
                </th>
                <th>
                    Category
                </th>
                <th>
                    Item Description
                </th>
                <th>
                    Serial
                </th>
                <th>
                    Status
                </th>
            </tr>
        </thead>
    </table>
</div>
@endsection