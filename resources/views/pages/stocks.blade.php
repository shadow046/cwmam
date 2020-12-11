@extends('layouts.app')

@section('content')
<div id="itemsearch">
    <input type="hidden" id="check" value="{{ $customers }}" />
    <div style="float: right;" class="pt-3">
        <b>SEARCH&nbsp;&nbsp;</b><a href="#" id="search-ic"><i class="fa fa-lg fa-search" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </div>
</div>
<div class="table-responsive">
<<<<<<< HEAD
    <div class="container" id="itemsearch">
        <div style="display: flex; justify-content: flex-end" class="pt-3">
            <input type="hidden" id="check" value="{{ $customers }}" />
            <a href="#" id="search-ic"><i class="fa fa-lg fa-search" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </div>
    </div>
    <div id="ctable">
        <table class="table catTable" id="catTable">
            <thead class="thead-dark">
                <tr>
                    <th>
                        Category
                    </th>
                    <th>
                        Quantity
                    </th>
                </tr>
            </thead>
        </table>
    </div>
    
    <div id="stable">
        <center><h5 id="catname"></h5></center>
        <table class="table stockTable" id="stockTable" style="display: none">
            <thead class="thead-dark">
                <tr class="tbsearch" style="display:none">
                    <td>
                        <input type="text" class="form-control filter-input fl-0" data-column="0" />
                    </td>
                    <td>
                        <input type="text" class="form-control filter-input fl-1" data-column="1" />
                    </td>
                </tr>
                <tr>
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
=======
    <div id="ctable">
        <table class="table catTable" id="catTable">
            <thead class="thead-dark">
                <tr>
                    <th>
                        Category
                    </th>
                    <th>
                        Quantity
                    </th>
                </tr>
            </thead>
        </table>
    </div>
    
    <div id="stable">
        <center><h5 id="catname"></h5></center>
        <table class="table stockTable" id="stockTable" style="display: none">
            <thead class="thead-dark">
                <tr class="tbsearch" style="display:none">
                    <td>
                        <input type="text" class="form-control filter-input fl-0" data-column="0" />
                    </td>
                    <td>
                        <input type="text" class="form-control filter-input fl-1" data-column="1" />
                    </td>
                </tr>
                <tr>
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
>>>>>>> 3cc1c39d6e65c936066604d8acf20ce6009fb473
</div>
<div class="d-flex">
    @if(auth()->user()->hasAnyRole('Head', 'Tech'))
    <input type="button" id="in_Btn" class="btn btn-xs btn-primary" value="SERVICE IN">&nbsp;
    <input type="button" id="out_Btn" class="btn btn-xs btn-primary" value="SERVICE OUT">&nbsp;
    @endif
    @if(auth()->user()->hasAnyrole('Administrator|Head'))
    <input type="button" id="importBtn" class="btn btn-xs btn-primary ml-auto" value="IMPORT">&nbsp;
    <input type="button" id="addStockBtn" class="btn btn-xs btn-primary" value="ADD STOCK">
    @endif
</div>
@endsection