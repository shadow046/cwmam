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
                    <div class="col-lg-7 form-group row">
                        <label class="col-md-4 col-form-label text-md-right">Date schedule:</label>
                        <div class="col-md-6">
                            <input type="date" class="form-control form-control-sm" name="sched" id="sched">
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <h5 class="modal-title w-100 text-center">REQUEST DETAILS</h5>
            </div>
            <div class="modal-body" style="max-height:200px;overflow-y: auto;">
                <table class="table" style="height: 150px;">
                    <thead class="thead-dark">
                        <th>Item Code</th>
                        <th>Description</th>
                        <th>Qty</th>
                        <th>Purpose</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>test</td>
                            <td>test</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-header">
                <h6 class="modal-title w-100 text-center">ENTER ITEM HERE</h6>
            </div>
            <div class="modal-body" style="max-height:200px;overflow-y: auto;">
                <table class="table">
                    <thead class="thead-dark">
                        <th>Item Code</th>
                        <th>Description</th>
                        <th>Qty</th>
                        <th></th>
                    </thead>
                </table>
            </div><hr>
            <div class="modal-footer">
            <input type="button" class="add_item btn btn-primary mr-auto" value="Add Item">
            <input type="button" class="btn btn-primary" data-dismiss="modal" value="Cancel">
            <input type="submit" class="btn btn-primary" id="ssubBtn" class="button" value="Submit">
            </form>
                
            </div>
        </div>
    </div>
</div>