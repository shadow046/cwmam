<div id="goodModal" class="modal fade" >
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title w-100 text-center">SERVICE-UNIT FORM</h6>
                <button class="close cancel" aria-label="Close" hidden>
                </button>
            </div>
            <div class="modal-body" id="service-unitfield">
                <div class="row no-margin" id="goodrow1">
                    <div class="col-md-2 form-group">
                        <select id="goodcategory1" class="form-control goodcategory" row_count="1">
                            <option selected disabled>select category</option>
                            @foreach ($customers as $customer)
                                <option value="{{ $service_unit->category_id }}">{{ strtoupper($service_unit->name) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 form-group">
                        <select id="gooditem1" class="form-control gooditem" row_count="1">
                            <option selected disabled>select item code</option>
                        </select>
                    </div>
                    <div class="col-md-3 form-group">
                        <select id="gooddesc1" class="form-control gooddesc" row_count="1">
                            <option selected disabled>select description</option>
                        </select>
                    </div>
                    <div class="col-md-2 form-group">
                        <input type="text" id="goodserial1" class="form-control goodserial" row_count="1" value="N/A">
                    </div>
                    <div class="col-md-1 form-group">
                        <input type="button" class="good_add_item btn btn-xs btn-primary" btn_id="1" value="Add Item">
                    </div>
                </div>
            </div><hr>
            <div class="modal-footer">
            <input type="button" class="btn btn-primary cancel" value="Cancel">
            <input type="button" class="btn btn-primary good_sub_Btn" id="good_sub_Btn" class="button" value="Submit">
            
            </form>
                
            </div>
        </div>
    </div>
</div>