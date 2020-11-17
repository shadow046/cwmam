<div id="sendModal" class="modal fade">
    <div class="modal-dialog modal-dialog-centered modal-full modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title w-100 text-center">STOCK REQUEST FORM</h6>
                <button class="close cancel" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mod" style="max-height:400px;overflow-y: auto;">
                <form id="sendForm">
                    {{ csrf_field() }}
                    <div class="row no-margin">
                        <input type="text" hidden id="reqbranch">
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
                                <input type="text" class="form-control form-control-sm " name="branch" id="sbranch" value="{{ auth()->user()->branch->branch }}" disabled>
                            </div>
                        </div>
                        <div class="col-md-6 form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Requested by:</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control form-control-sm " name="name" id="sname" value="{{ auth()->user()->name }}" disabled>
                            </div>
                        </div>

                    </div>
                    <div class="row no-margin">
                        <div class="col-md-6 form-group row">
                            <label class="col-md-5 col-form-label text-md-right">Date schedule:</label>
                            <div class="col-md-7">
                                <input type="date" class="form-control form-control-sm" name="datesched" id="datesched">
                            </div>
                        </div>
                    </div>
                    <div>
                        <h5 class="modal-title w-100 text-center">REQUEST DETAILS</h5>
                    </div>
                    <table class="table sendDetails" style="height: 150px;width:100%">
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
            <div class="modal-body" id="reqfield">
                <div class="row no-margin" id="row1">
                    <div class="col-md-2 form-group">
                        <select id="category1" class="form-control category" row_count="1">
                            <option selected disabled>select category</option>

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
                    <div class="col-md-2 form-group">
                        <input type="text" class="form-control serial" row_count="1" name="serial1" id="serial1" placeholder="input serial">
                    </div>
                    <div class="col-md-2 form-group">
                        <input type="number" class="form-control" row_count="1" name="stock1" id="stock1" placeholder="0" style="width: 6em" disabled>
                    </div>
                    <div class="col-md-1 form-group">
                        <input type="button" class="add_item btn btn-xs btn-primary" btn_id="1" value="Add Item">
                    </div>
                </div>
            </div>
            <hr>
            <div class="modal-footer">
                <input type="button" class="btn btn-primary cancel" value="Cancel">
                <input type="button" class="btn btn-primary sub_Btn" id="sub_Btn" class="button" value="Submit">
            </div>
        </div>
    </div>
</div>