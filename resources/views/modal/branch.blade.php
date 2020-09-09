<div id="branchModal" class="modal fade" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Branch details</h4>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                <form id="branchForm">
                    {{ csrf_field() }}
                    
                    <input type="hidden" name="myid" id="myid">
                        <div class="form-group row">
                            <label for="bname" class="col-md-4 col-form-label text-md-right">Branch Name:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control form-control-sm " name="branch_name" id="branch_name" placeholder="Enter Branch Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">Address:</label>
                            <div class="col-md-6">
                                <textarea class="form-control form-control-sm" name="address" id="address" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="area" class="col-md-4 col-form-label text-md-right">Area:</label>
                            <div class="col-md-6">
                                <select name="area" id="area" class="form-control form-control-sm area @error('area') is-invalid @enderror">
                                    <option selected disabled>select area</option>
                                    @foreach ($areas as $area)
                                        <option value="{{ $area->id }}">{{ $area->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="contact_person" class="col-md-4 col-form-label text-md-right">Contact Person:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control form-control-sm" name="contact_person" id="contact_person" placeholder="Enter Contact person">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="mobile" class="col-md-4 col-form-label text-md-right">Mobile:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control form-control-sm" name="mobile" id="mobile" placeholder="Enter mobile number">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Email:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control form-control-sm" name="email" id="email" placeholder="Enter email address">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="status" class="col-md-4 col-form-label text-md-right">Status:</label>
                            <div class="col-md-6">
                                <select name="status" id="status" class="form-control form-control-sm status @error('status') is-invalid @enderror">
                                    <option selected disabled>select status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>

                    <div class="modal-footer">
                        <input type="button" class="btn btn-primary" data-dismiss="modal" value="Close">
                        <input type="submit" id="subBtn" class="btn btn-primary" value="Update">
                    </div>
                </form>
            </div>  
        </div>
    </div>
</div>