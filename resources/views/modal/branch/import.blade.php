<div id="importModal" class="modal fade" >
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title w-100 text-center">IMPORT STOCK FORM</h6>
                <button class="close cancel" aria-label="Close" hidden>
                    
                </button>
            </div>
            <div class="modal-body" id="catfield">
                <div class="row no-margin" id="catrow1">
                    <form action="{{ route('stocks.upload') }}" method="post" enctype="multipart/form-data">
                        <div class="col-md-11 form-group">
                            <input type="file" name="upload-file" class="form-control">
                        </div>
                        <div class="col-md-1 form-group">
                            <input type="submit" class="btn btn-xs btn-primary" value="Upload" name="submit">
                        </div>
                    </form>
                </div>
            </div><hr>
            <div class="modal-footer">
                <input type="button" class="btn btn-primary cancel" value="Cancel">            
            </form>
                
            </div>
        </div>
    </div>
</div>