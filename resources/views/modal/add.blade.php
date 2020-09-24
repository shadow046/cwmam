<div id="addModal" class="modal fade" >
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title w-100 text-center">Service center inventory</h4>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addForm">
                    {{ csrf_field() }}
                    
                    <input type="hidden" name="myid" id="myid">
                    <div class="row no-margin">
                        <div class="col-md-6 form-group row">
                            <label class="col-md-5 col-form-label text-md-right">Category:</label>
                            <div class="col-md-7">
                                <select name="dategory" id="dategory">

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row no-margin">
                        <div class="col-md-6 form-group row">
                            <label class="col-md-5 col-form-label text-md-right">Description:</label>
                            <div class="col-md-7">
                                <select name="description" id="description">
                                    
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row no-margin">
                        <div class="col-md-6 form-group row">
                            <label class="col-md-5 col-form-label text-md-right">Stock:</label>
                            <div class="col-md-7">
                                <input type="number" name="stock" id="stock" value="" disabled>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <input type="submit" id="addBtn" class="btn btn-primary" value="add">
                        <input type="button" class="btn btn-primary mr-auto" data-dismiss="modal" value="Cancel">                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>