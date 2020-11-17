<div id="customerModal" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Customer details</h4>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mod">
                <form id="customerForm">
                    {{ csrf_field() }}
                    <input type="hidden" name="myid" id="myid">
                    <input type="text" hidden id="myrole" value="{{ auth()->user()->roles->first()->id }}">
                    <div class="form-group row">
                        <label for="customer_code" class="col-md-4 col-form-label text-md-right">{{ __('Customer Code') }}</label>
                        <div class="col-md-6">
                            <input id="customer_code" type="text" class="form-control" name="customer_code" style="color: black;">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Customer_name" class="col-md-4 col-form-label text-md-right">{{ __('Customer Name') }}</label>
                        <div class="col-md-6">
                            <input id="customer_name" type="text" class="form-control" name="customer_name" style="color: black;">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" id="subBtn" class="btn btn-primary" value="Save">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>