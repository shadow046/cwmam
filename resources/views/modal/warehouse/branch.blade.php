<div id="branchModal" class="modal fade" >
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title w-100 text-center">Service center inventory</h4>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="branchForm">
                    {{ csrf_field() }}
                    
                    <input type="hidden" name="myid" id="myid">
                    <div class="row no-margin">
                        <div class="col-md-3 form-group">
                            <input type="text" class="form-control form-control-sm " name="branch_name" id="branch_name" placeholder="Enter Branch Name" disabled>
                        </div>
                        <div class="col-md-3 form-group">
                            <select name="area" id="area" class="form-control form-control-sm area @error('area') is-invalid @enderror" disabled>
                                <option selected disabled>select area</option>
                                @foreach ($areas as $area)
                                    <option value="{{ $area->id }}">{{ $area->area}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <input type="text" class="form-control form-control-sm" name="address" id="address" placeholder="Enter address" disabled>
                        </div>
                    </div>
                    <div class="row no-margin">
                        <div class="col-md-3 form-group">
                            <input type="text" class="form-control form-control-sm" name="contact_person" id="contact_person" placeholder="Enter Contact person" disabled>
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control form-control-sm" name="mobile" id="mobile" placeholder="Enter mobile number" disabled>
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control form-control-sm" name="email" id="email" placeholder="Enter email address" disabled>
                        </div>
                        <div class="col-md-3">
                            <select name="status" id="status" class="form-control form-control-sm status @error('status') is-invalid @enderror" disabled>
                                <option selected disabled>select status</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div id="table">
                        <table class="table branchDetails" id="branchDetails" style="width: 100%">
                            <thead class="thead-dark">
                                <tr>
                                    <th>ITEM CODE</th>
                                    <th>DESCRIPTION</th>
                                    <th>STOCK</th>
                                    <th>AVAILABLE</th>
                                    <th>OUT</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    @role('Administrator')
                    <div class="modal-footer">
                        <input type="button" id="editBtn" class="btn btn-primary" value="Edit">
                        <input type="submit" id="saveBtn" class="btn btn-primary" value="Save">
                        <input type="button" class="btn btn-primary mr-auto" data-dismiss="modal" value="Cancel">                        
                    </div>
                    @endrole
                </form>
            </div>
        </div>
    </div>
</div>