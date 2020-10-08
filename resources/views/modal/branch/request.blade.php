<div id="requestModal" class="modal fade" >
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title w-100 text-center">STOCK REQUEST</h6>
                <button class="close cancel" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row no-margin">
                    <div class="col-md-6 form-group row">
                        <label class="col-md-5 col-form-label text-md-right">Date requested:</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control form-control-sm " id="date" disabled>
                        </div>
                    </div>
                    <div class="col-md-6 form-group row">
                        <label class="col-md-4 col-form-label text-md-right">Request no.:</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control form-control-sm " id="reqno" placeholder="1-001" disabled>
                        </div>
                    </div>
                </div>
                <div class="row no-margin">
                    <div class="col-md-6 form-group row">
                        <label class="col-md-5 col-form-label text-md-right">Branch name:</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control form-control-sm " id="branch" value="{{ Auth::user()->branch->name }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-6 form-group row">
                        <label class="col-md-4 col-form-label text-md-right">Requested by:</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control form-control-sm " id="name" value="{{ Auth::user()->name }}" disabled>
                        </div>
                    </div>
                </div>
                <div class="row no-margin">
                    <div class="col-md-6 form-group row">
                        <label class="col-md-5 col-form-label text-md-right">Area:</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control form-control-sm " id="area" value="{{ Auth::user()->area->name }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-6 form-group row sched">
                        <label class="col-md-4 col-form-label text-md-right">Schedule on:</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control form-control-sm " id="sched" value="" disabled>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <h5 class="modal-title w-100 text-center">REQUEST DETAILS</h5>
            </div>
            <div class="modal-body">
                <table class="table requestDetails">
                    <thead class="thead-dark">
                        <th>Item Code</th>
                        <th>Description</th>
                        <th>Qty</th>
                        <th>Purpose</th>
                    </thead>
                </table>
                <table class="table schedDetails">
                    <thead class="thead-dark">
                        <th>Item Code</th>
                        <th>Description</th>
                        <th>Serial</th>
                    </thead>
                </table>
            </div>
            <div class="modal-footer">
                <input type="button" class="btn btn-primary del_Btn" id="del_Btn" reqno="0" class="button" value="Delete">
            </div>
        </div>
    </div>
</div>