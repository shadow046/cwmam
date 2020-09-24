<div id="sendModal" class="modal fade" >
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title w-100 text-center">STOCK REQUEST FORM</h6>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mod">
                <form id="sendForm">
                    {{ csrf_field() }}
                <div class="row no-margin">
                    <div class="col-md-6 form-group row">
                        <label for="bname" class="col-md-5 col-form-label text-md-right">Date requested:</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control form-control-sm " name="date" id="sdate" disabled>
                        </div>
                    </div>
                    <div class="col-md-6 form-group row">
                        <label for="reqno" class="col-md-4 col-form-label text-md-right">Request no.:</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control form-control-sm " name="reqno" id="sreqno" placeholder="1-001" disabled>
                        </div>
                    </div>
                </div>
                <div class="row no-margin">
                    <div class="col-md-6 form-group row">
                        <label for="branch" class="col-md-5 col-form-label text-md-right">Branch name:</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control form-control-sm " name="branch" id="sbranch" value="{{ Auth::user()->branch->name }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-6 form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">Requested by:</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control form-control-sm " name="name" id="sname" value="{{ Auth::user()->name }}" disabled>
                        </div>
                    </div>
                    
                </div>
                <div class="row no-margin">
                    <div class="col-md-6 form-group row">
                        <label class="col-md-5 col-form-label text-md-right">Date schedule:</label>
                        <div class="col-md-7">
                            <input type="date" class="form-control form-control-sm" name="sched" id="sched">
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <h5 class="modal-title w-100 text-center">REQUEST DETAILS</h5>
            </div>
            <div class="modal-body" style="max-height:200px;overflow-y: auto;">
                <table class="table sendDetails" style="height: 150px;">
                    <thead class="thead-dark">
                        <th>Item Code</th>
                        <th>Description</th>
                        <th>Qty</th>
                        <th>Purpose</th>
                    </thead>
                </table>
            </div>
            <div class="modal-header">
                <h6 class="modal-title w-100 text-center">ENTER ITEM HERE</h6>
            </div>
            <div class="modal-body" style="max-height:200px;overflow-y: auto;">
                <div class="row no-margin" id="row1">
                    <div class="col-md-3 form-group">
                        <select id="category1" class="form-control category" row_count="1">
                            <option selected disabled>Select Category</option>
                            @foreach ($categories as $category )
                            <option value="{{ $category->id }}">{{ $category->id }}</option>
                            <option value="2">2</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 form-group">
                        <select id="item1" class="form-control item" row_count="1">
                            <option selected disabled>select item code</option>
                        </select>
                    </div>
                    <div class="col-md-3 form-group">
                        <select id="desc1" class="form-control desc" row_count="1">
                            <option selected disabled>select description</option>
                        </select>
                    </div>
                    <div class="col-md-1 form-group">
                        <input type="number" min="0" max="10" class="form-control" name="qty1" id="qty1" placeholder="Qty">
                    </div>
                    <div class="col-md-2 form-group">
                        <input type="number" class="form-control" name="stock1" id="stock1" placeholder="Stock" style="width: 6em" disabled>
                    </div>
                </div>
                <div class="row no-margin" id="row2">
                    <div class="col-md-3 form-group">
                        <select id="category2" class="form-control category" row_count="2">
                            <option selected disabled>Select Category</option>
                            @foreach ($categories as $category )
                            <option value="{{ $category->id }}">{{ $category->id }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 form-group">
                        <select id="item2" class="form-control item" row_count="2">
                            <option selected disabled>select item code</option>
                        </select>
                    </div>
                    <div class="col-md-3 form-group">
                        <select id="desc2" class="form-control desc" row_count="2">
                            <option selected disabled>select description</option>
                        </select>
                    </div>
                    <div class="col-md-1 form-group">
                        <input type="number" min="0" max="10" class="form-control" name="qty2" id="qty2" placeholder="Qty">
                    </div>
                    <div class="col-md-2 form-group">
                        <input type="number" class="form-control" name="stock2" id="stock2" placeholder="Stock" style="width: 6em" disabled>
                    </div>
                    <div class="col-md-1 form-group">
                        <input type="button" class="btn btn-xs remove_btn btn-primary" btn_id="2" value="Remove">
                    </div>
                </div>
                <div class="row no-margin" id="row3">
                    <div class="col-md-3 form-group">
                        <select id="category3" class="form-control category" row_count="3">
                            <option selected disabled>Select Category</option>
                            @foreach ($categories as $category )
                            <option value="{{ $category->id }}">{{ $category->id }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 form-group">
                        <select id="item3" class="form-control item" row_count="3">
                            <option selected disabled>select item code</option>
                        </select>
                    </div>
                    <div class="col-md-3 form-group">
                        <select id="desc3" class="form-control desc" row_count="3">
                            <option selected disabled>select description</option>
                        </select>
                    </div>
                    <div class="col-md-1 form-group">
                        <input type="number" min="0" max="10" class="form-control" name="qty3" id="qty3" placeholder="Qty">
                    </div>
                    <div class="col-md-2 form-group">
                        <input type="number" class="form-control" name="stock3" id="stock3" placeholder="Stock" style="width: 6em" disabled>
                    </div>
                    <div class="col-md-1 form-group">
                        <input type="button" class="btn btn-xs remove_btn btn-primary" btn_id="3" value="Remove">
                    </div>
                </div>
                <div class="row no-margin" id="row4">
                    <div class="col-md-3 form-group">
                        <select id="category4" class="form-control category" row_count="4">
                            <option selected disabled>Select Category</option>
                            @foreach ($categories as $category )
                            <option value="{{ $category->id }}">{{ $category->id }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 form-group">
                        <select id="item4" class="form-control item" row_count="4">
                            <option selected disabled>select item code</option>
                        </select>
                    </div>
                    <div class="col-md-3 form-group">
                        <select id="desc4" class="form-control desc" row_count="4">
                            <option selected disabled>select description</option>
                        </select>
                    </div>
                    <div class="col-md-1 form-group">
                        <input type="number" min="0" max="10" class="form-control" name="qty4" id="qty4" placeholder="Qty">
                    </div>
                    <div class="col-md-2 form-group">
                        <input type="number" class="form-control" name="stock4" id="stock4" placeholder="Stock" style="width: 6em" disabled>
                    </div>
                    <div class="col-md-1 form-group">
                        <input type="button" class="btn btn-xs remove_btn btn-primary" btn_id="4" value="Remove">
                    </div>
                </div>
                <div class="row no-margin" id="row5">
                    <div class="col-md-3 form-group">
                        <select id="category5" class="form-control category" row_count="5">
                            <option selected disabled>Select Category</option>
                            @foreach ($categories as $category )
                            <option value="{{ $category->id }}">{{ $category->id }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 form-group">
                        <select id="item5" class="form-control item" row_count="5">
                            <option selected disabled>select item code</option>
                        </select>
                    </div>
                    <div class="col-md-3 form-group">
                        <select id="desc5" class="form-control desc" row_count="5">
                            <option selected disabled>select description</option>
                        </select>
                    </div>
                    <div class="col-md-1 form-group">
                        <input type="number" min="0" max="10" class="form-control" name="qty5" id="qty5" placeholder="Qty">
                    </div>
                    <div class="col-md-2 form-group">
                        <input type="number" class="form-control" name="stock5" id="stock5" placeholder="Stock" style="width: 6em" disabled>
                    </div>
                    <div class="col-md-1 form-group">
                        <input type="button" class="btn btn-xs remove_btn btn-primary" btn_id="5" value="Remove">
                    </div>
                </div>
                <div class="row no-margin" id="row6">
                    <div class="col-md-3 form-group">
                        <select id="category6" class="form-control category" row_count="6">
                            <option selected disabled>Select Category</option>
                            @foreach ($categories as $category )
                            <option value="{{ $category->id }}">{{ $category->id }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 form-group">
                        <select id="item6" class="form-control item" row_count="6">
                            <option selected disabled>select item code</option>
                        </select>
                    </div>
                    <div class="col-md-3 form-group">
                        <select id="desc6" class="form-control desc" row_count="6">
                            <option selected disabled>select description</option>
                        </select>
                    </div>
                    <div class="col-md-1 form-group">
                        <input type="number" min="0" max="10" class="form-control" name="qty6" id="qty6" placeholder="Qty">
                    </div>
                    <div class="col-md-2 form-group">
                        <input type="number" class="form-control" name="stock6" id="stock6" placeholder="Stock" style="width: 6em" disabled>
                    </div>
                    <div class="col-md-1 form-group">
                        <input type="button" class="btn btn-xs remove_btn btn-primary" btn_id="6" value="Remove">
                    </div>
                </div>
                <div class="row no-margin" id="row7">
                    <div class="col-md-3 form-group">
                        <select id="category7" class="form-control category" row_count="7">
                            <option selected disabled>Select Category</option>
                            @foreach ($categories as $category )
                            <option value="{{ $category->id }}">{{ $category->id }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 form-group">
                        <select id="item7" class="form-control item" row_count="7">
                            <option selected disabled>select item code</option>
                        </select>
                    </div>
                    <div class="col-md-3 form-group">
                        <select id="desc7" class="form-control desc" row_count="7">
                            <option selected disabled>select description</option>
                        </select>
                    </div>
                    <div class="col-md-1 form-group">
                        <input type="number" min="0" max="10" class="form-control" name="qty7" id="qty7" placeholder="Qty">
                    </div>
                    <div class="col-md-2 form-group">
                        <input type="number" class="form-control" name="stock7" id="stock7" placeholder="Stock" style="width: 6em" disabled>
                    </div>
                    <div class="col-md-1 form-group">
                        <input type="button" class="btn btn-xs remove_btn btn-primary" btn_id="7" value="Remove">
                    </div>
                </div>
                <div class="row no-margin" id="row8">
                    <div class="col-md-3 form-group">
                        <select id="category8" class="form-control category" row_count="8">
                            <option selected disabled>Select Category</option>
                            @foreach ($categories as $category )
                            <option value="{{ $category->id }}">{{ $category->id }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 form-group">
                        <select id="item8" class="form-control item" row_count="8">
                            <option selected disabled>select item code</option>
                        </select>
                    </div>
                    <div class="col-md-3 form-group">
                        <select id="desc8" class="form-control desc" row_count="8">
                            <option selected disabled>select description</option>
                        </select>
                    </div>
                    <div class="col-md-1 form-group">
                        <input type="number" min="0" max="10" class="form-control" name="qty8" id="qty8" placeholder="Qty">
                    </div>
                    <div class="col-md-2 form-group">
                        <input type="number" class="form-control" name="stock8" id="stock8" placeholder="Stock" style="width: 6em" disabled>
                    </div>
                    <div class="col-md-1 form-group">
                        <input type="button" class="btn btn-xs remove_btn btn-primary" btn_id="8" value="Remove">
                    </div>
                </div>
                <div class="row no-margin" id="row9">
                    <div class="col-md-3 form-group">
                        <select id="category9" class="form-control category" row_count="9">
                            <option selected disabled>Select Category</option>
                            @foreach ($categories as $category )
                            <option value="{{ $category->id }}">{{ $category->id }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 form-group">
                        <select id="item9" class="form-control item" row_count="9">
                            <option selected disabled>select item code</option>
                        </select>
                    </div>
                    <div class="col-md-3 form-group">
                        <select id="desc9" class="form-control desc" row_count="9">
                            <option selected disabled>select description</option>
                        </select>
                    </div>
                    <div class="col-md-1 form-group">
                        <input type="number" min="0" max="10" class="form-control" name="qty9" id="qty9" placeholder="Qty">
                    </div>
                    <div class="col-md-2 form-group">
                        <input type="number" class="form-control" name="stock9" id="stock9" placeholder="Stock" style="width: 6em" disabled>
                    </div>
                    <div class="col-md-1 form-group">
                        <input type="button" class="btn btn-xs remove_btn btn-primary" btn_id="9" value="Remove">
                    </div>
                </div>
                <div class="row no-margin" id="row10">
                    <div class="col-md-3 form-group">
                        <select id="category10" class="form-control category" row_count="10">
                            <option selected disabled>Select Category</option>
                            @foreach ($categories as $category )
                            <option value="{{ $category->id }}">{{ $category->id }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 form-group">
                        <select id="item10" class="form-control item" row_count="10">
                            <option selected disabled>select item code</option>
                        </select>
                    </div>
                    <div class="col-md-3 form-group">
                        <select id="desc10" class="form-control desc" row_count="10">
                            <option selected disabled>select description</option>
                        </select>
                    </div>
                    <div class="col-md-1 form-group">
                        <input type="number" min="0" max="10" class="form-control" name="qty10" id="qty10" placeholder="Qty">
                    </div>
                    <div class="col-md-2 form-group">
                        <input type="number" class="form-control" name="stock10" id="stock10" placeholder="Stock" style="width: 6em" disabled>
                    </div>
                    <div class="col-md-1 form-group">
                        <input type="button" class="btn btn-xs remove_btn btn-primary" btn_id="10" value="Remove">
                    </div>
                </div>
            </div><hr>
            <div class="modal-footer">
            <input type="button" class="add_item btn btn-primary mr-auto" value="Add Item">
            <input type="button" class="btn btn-primary" data-dismiss="modal" value="Cancel">
            <input type="button" class="btn btn-primary sub_Btn" id="sub_Btn" class="button" value="Submit">
            </form>
                
            </div>
        </div>
    </div>
</div>