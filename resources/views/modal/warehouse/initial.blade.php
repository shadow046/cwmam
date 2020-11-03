<div id="updateModal" class="modal fade" >
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title w-100 text-center" id="head4"></h6>
                <button class="close closes" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" hidden id="iniitemid">
                <input type="text" hidden id="inibranchid">
                <br><br>
                <div class="row no-margin">
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-4">
                        <input type="number" class="form-control" min="0" id="item-qty" placeholder="0" style="color:black; width: 6em; border: 2px solid black;">
                    </div>
                    <div class="col-md-4">
                    </div>
                </div>
                <br><br>
                <div class="modal-footer">
                    <input type="button" id="updateBtn" class="btn btn-primary" value="Save">
                </div>
            </div>
        </div>
    </div>
</div>