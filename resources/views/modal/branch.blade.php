<div id="branchModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Branch details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editFormID" class="form-horizontal">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                        <div class="form-group">
                            <label for="bname">Branch Name</label>
                            <input type="text" class="form-control" name="bname" id="bname" placeholder="Enter Branch Name">
                        </div> 
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" class="form-control" name="address" id="address" placeholder="Enter Branch Address">
                        </div>
                        <div class="form-group">
                            <label>Area</label>
                            <input type="text" class="form-control" name="area" id="area" placeholder="">
                        </div> 
                        <div class="form-group">
                            <label>Contact Person</label>
                            <input type="text" class="form-control" name="cname" id="cname" placeholder="Enter Contact person">
                        </div> 
                        <div class="form-group">
                            <label>Mobile</label>
                            <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Enter mobile number">
                        </div> 
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" name="email" id="email" placeholder="Enter email address">
                        </div> 
                        <div class="form-group">
                            <label>Status</label>
                            <input type="text" class="form-control" name="status" id="status" placeholder="Enter Status">
                        </div>    
                    <!-- <input type="text" id="branchName" value="" /> -->
                
                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                    </div>
                </form>
            </div>  
        </div>
    </div>
</div>