<div id="customerbranchModal" class="modal fade" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Branch details</h4>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mod">
                <form id="customerbranchForm">
                    {{ csrf_field() }}
                    <input type="hidden" name="myid" id="myid">
                    <input type="text" hidden id="myrole" value="{{ auth()->user()->roles->first()->id }}">
                    <div class="form-group row">
                        <label for="branch_code" class="col-md-4 col-form-label text-md-right">{{ __('Branch Code:') }}</label>
                        <div class="col-md-6">
                            <input id="branch_code" type="text" class="form-control" name="branch_code" style="color: black;" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="branch_name" class="col-md-4 col-form-label text-md-right">{{ __('Branch Name:') }}</label>
                        <div class="col-md-6">
                            <input id="branch_name" type="text" class="form-control" name="branch_name" style="color: black;" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="number" class="col-md-4 col-form-label text-md-right">{{ __('Phone:') }}</label>
                        <div class="col-md-6">
                            <input id="number" type="text" class="form-control" name="number" style="color: black;">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address:') }}</label>
                        <div class="col-md-6">
                            <input id="address" type="text" class="form-control" name="address" style="color: black;">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" id="saveBtn" class="btn btn-primary" value="Save">
                    </div>
                </form>
            </div>  
        </div>
    </div>
</div>