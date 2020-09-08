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
                
                <form id="editForm">
                    {{ csrf_field() }}
                    
                    <input type="hidden" name="myid" id="myid">
                        <div class="form-inline input-group mb-2">
                            <label for="bname" class="mr-sm-2">Branch Name:</label>
                            <input type="text" class="form-control form-control-sm " name="branch_name" id="branch_name" placeholder="Enter Branch Name">
                        </div>
                        <div class="form-inline input-group mb-2">
                            <label for="address" class="mr-sm-2">Address:</label>
                            <input type="text" class="form-control form-control-sm" name="address" id="address" placeholder="Enter Branch Address">
                        </div>
                        <div class="form-inline input-group mb-2">
                            <label for="area" class="mr-sm-2">Area:</label>
                            <!-- <input type="text" class="form-control form-control-sm" name="area" id="area" placeholder=""> -->
                            <select name="area" id="area" class="form-control form-control-sm area @error('area') is-invalid @enderror">
                                <option selected disabled>select area</option>
                                @foreach ($areas as $area)
                                    <option value="{{ $area->id }}">{{ $area->name}}</option>
                                @endforeach
                            </select>
                        </div> 
                        <div class="form-inline input-group input-group mb-2">
                            <label for="cname" class="mr-sm-2">Contact Person:</label>
                            <input type="text" class="form-control form-control-sm" name="contact_person" id="contact_person" placeholder="Enter Contact person">
                        </div> 
                        <div class="form-inline input-group mb-2">
                            <label for="mobile" class="mr-sm-2">Mobile:</label>
                            <input type="text" class="form-control form-control-sm" name="mobile" id="mobile" placeholder="Enter mobile number">
                        </div> 
                        <div class="form-inline input-group mb-2">
                            <label for="email" class="mr-sm-2">Email:</label>
                            <input type="text" class="form-control form-control-sm" name="email" id="email" placeholder="Enter email address">
                        </div> 
                        <div class="form-inline input-group mb-2">
                            <label for="status" class="mr-sm-2">Status:</label>
                            <!-- <input type="text" class="form-control form-control-sm" name="status" id="status" placeholder="Enter Status"> -->
                            <select name="status" id="status" class="form-control form-control-sm status @error('status') is-invalid @enderror">
                                <option selected disabled>select status</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>

                    <div class="modal-footer">
                        <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button> -->
                        <input type="button" class="btn btn-primary" data-dismiss="modal" value="Close">
                        <input type="submit" id="subBtn" class="btn btn-primary" value="Update">
                    </div>
                </form>
            </div>  
        </div>
    </div>
</div>