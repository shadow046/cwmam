<div id="replacementModal" class="modal fade" >
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title w-100 text-center">REPLACEMENT FORM</h6>
                <button class="close cancel" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row no-margin">
                    <div class="col-md-6 form-group row">
                        <label class="col-md-5 col-form-label text-md-right">Date:</label>
                        <div class="col-md-7">
                        <input type="text" style="color: black" class="form-control form-control-sm " id="replacemente" value="{{ Carbon\Carbon::now()->toDayDateTimeString() }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-6 form-group row">
                        <label class="col-md-6 col-form-label text-md-right">Service Engineer:</label>
                        <div class="col-md-6">
                            <input type="text" style="color: black" class="form-control form-control-sm " id="replacementengr" value="{{ strtoupper(Auth::user()->name) }}" disabled>
                        </div>
                    </div>
                </div>
                <div class="row no-margin">
                    <div class="col-md-6 form-group row">
                        <label class="col-md-5 col-form-label text-md-right">Client Name:</label>
                        <div class="col-md-7">
                            <input type="text" list="replacementclient-name" style="color: black" class="form-control form-control-sm " id="replacementclient" placeholder="client name" autocomplete="off">
                            <datalist id="replacementclient-name">
                            </datalist>
                            <input type="text" id="replacementclient-id" value="" hidden>
                        </div>
                    </div>
                    <div class="col-md-6 form-group row">
                        <label class="col-md-6 col-form-label text-md-right">Client Branch Name:</label>
                        <div class="col-md-6">
                            <input type="text" list="replacementcustomer-name" style="color: black" class="form-control form-control-sm " id="replacementcustomer" placeholder="client branch name" autocomplete="off">
                            <datalist id="replacementcustomer-name">
                            </datalist>
                            <input type="text" id="replacementcustomer-id" value="" hidden>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="modal-header">
                <h6 class="modal-title w-100 text-center">ITEM DETAILS</h6>
            </div>
            <div class="modal-body" id="replacementfield">
                <table class="table requestDetails">
                    <thead class="thead-dark">
                        <th>Category</th>
                        <th>Description</th>
                        <th>Serial&nbsp;&nbsp;&nbsp;</th>
                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                    </thead>
                </table>
                <div class="row no-margin" id="replacementrow1">
                    <div class="col-md-2 form-group">
                        <select id="replacementcategory1" class="form-control replacementcategory" row_count="1" style="color: black;">
                            <option selected disabled>select category</option>
                        </select>
                    </div>
                    <div class="col-md-3 form-group">
                        <select id="replacementdesc1" class="form-control replacementdesc" row_count="1" style="color: black;">
                            <option selected disabled>select description</option>
                        </select>
                    </div>
                    <div class="col-md-2 form-group">
                        <select id="replacementserial1" class="form-control replacementserial" row_count="1" style="color: black;">
                            <option selected disabled>select description</option>
                        </select>
                    </div>
                    <div class="col-md-1 form-group">
                        <input type="button" class="replacement_add_item btn btn-xs btn-primary" btn_id="1" value="Add Item">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="button" class="btn btn-primary replacement_sub_Btn" id="replacement_sub_Btn" reqno="0" class="button" value="Submit">
            </div>
        </div>
    </div>
</div>