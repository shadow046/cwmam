<div id="stockModal" class="modal fade" >
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title w-100 text-center">STOCK REQUEST</h6>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row no-margin">
                    <div class="col-md-6 form-group row">
                        <label for="bname" class="col-md-5 col-form-label text-md-right">Date requested:</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control form-control-sm " name="date" id="date" disabled>
                        </div>
                    </div>
                </div>
                <div class="row no-margin">
                    <div class="col-md-6 form-group row">
                        <label for="name" class="col-md-5 col-form-label text-md-right">Requested by:</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control form-control-sm " name="name" id="name" value="{{Auth::user()->name}}" disabled>
                        </div>
                    </div>
                    <div class="col-md-6 form-group row">
                        <label for="reqno" class="col-md-4 col-form-label text-md-right">Request no.:</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control form-control-sm " name="reqno" id="reqno" placeholder="1-001" disabled>
                        </div>
                    </div>
                </div>
                <div class="row no-margin">
                    <div class="col-md-6 form-group row">
                        <label for="branch" class="col-md-5 col-form-label text-md-right">Branch name:</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control form-control-sm " name="branch" id="branch" value="{{$user->branch->name}}" disabled>
                        </div>
                    </div>
                    <div class="col-md-6 form-group row">
                        <label for="area" class="col-md-4 col-form-label text-md-right">Area:</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control form-control-sm " name="area" id="area" value="{{$user->area->name}}" disabled>
                        </div>
                    </div>
                </div>
                <div class="row no-margin">
                    <div class="col-md-6 form-group row">
                        <label for="phone" class="col-md-5 col-form-label text-md-right">Contact number:</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control form-control-sm " name="phone" id="phone"  value="{{$user->branch->phone}}" disabled>
                        </div>
                    </div>
                    <div class="col-md-6 form-group row">
                        <label for="address" class="col-md-4 col-form-label text-md-right">Address:</label>
                        <div class="col-md-8">
                            <textarea class="form-control form-control-sm " name="address" id="address" disabled>{{$user->branch->address}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-header">
                <h6 class="modal-title w-100 text-center">REQUEST DETAILS</h6>
            </div>
            <div class="modal-body">
                <table class="table" style="height: 300px;">
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
                <div class="items">
                    
                </div>
                <input type="button" id="addBtn" class="button" value="Proceed"> 
                <input type="button" id="addBtn" class="button" value="Cancel"> 
            </div>
        </div>
    </div>
</div>