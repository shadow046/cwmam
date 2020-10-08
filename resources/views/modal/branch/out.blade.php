<div id="outModal" class="modal fade" >
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title w-100 text-center">SERVICE OUT FORM</h6>
                <button class="close cancel" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row no-margin">
                    <div class="col-md-6 form-group row">
                        <label class="col-md-5 col-form-label text-md-right">Date:</label>
                        <div class="col-md-7">
                        <input type="text" class="form-control form-control-sm " id="date" value="{{ Carbon\Carbon::now()->toDayDateTimeString() }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-6 form-group row">
                        <label class="col-md-6 col-form-label text-md-right">Service Reference No.:</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control form-control-sm " id="serviceno" placeholder="1-001" disabled>
                        </div>
                    </div>
                </div>
                <div class="row no-margin">
                    <div class="col-md-6 form-group row">
                        <label class="col-md-5 col-form-label text-md-right">Customer name:</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control form-control-sm " id="Customer" value="">
                        </div>
                    </div>
                    <div class="col-md-6 form-group row">
                        <label class="col-md-6 col-form-label text-md-right">Service Engineer:</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control form-control-sm " id="engr" value="">
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <h5 class="modal-title w-100 text-center">ITEM DETAILS</h5>
            </div>
            <div class="modal-body">
                <table class="table requestDetails">
                    <thead class="thead-dark">
                        <th>Category</th>
                        <th>Item Code</th>
                        <th>Description</th>
                        <th>Serial</th>
                    </thead>
                </table>
            </div>
            <div class="modal-footer">
                <input type="button" class="btn btn-primary del_Btn" id="out_sub_Btn" reqno="0" class="button" value="Delete">
            </div>
        </div>
    </div>
</div>