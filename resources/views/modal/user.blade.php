<div id="userModal" class="modal fade" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">User details</h4>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                <form id="userForm">
                    {{ csrf_field() }}
                    <input type="hidden" name="myid" id="myid">
                    <div class="form-group row">
                        <label for="full_name" class="col-md-4 col-form-label text-md-right">{{ __('Full Name') }}</label>
                        <div class="col-md-6">
                            <input id="full_name" type="text" class="form-control" name="full_name" autofocus>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="area" class="col-md-4 col-form-label text-md-right">{{ __('Area') }}</label>

                        <div class="col-md-6">
                            <select name="area" id="area" class="form-control area">
                                <option selected disabled>select area</option>
                                @foreach ($areas as $area)
                                    <option value="{{ $area->id }}">{{ $area->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="branch" class="col-md-4 col-form-label text-md-right">{{ __('Branch') }}</label>

                        <div class="col-md-6">
                            <select name="branch" id="branch" class="form-control branch">
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Level') }}</label>
                        <div class="col-md-6">
                            <select name="role" id="role" class="form-control">
                                <option selected disabled>select roles</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>

                        <div class="col-md-6">
                            <select name="status" id="status" class="form-control status">
                                <option selected disabled>select status</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div id="divpass1" class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password">
                        </div>
                    </div>

                    <div id="divpass2" class="form-group row">
                        <label for="password_confirmation" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                        <div class="col-md-6">
                            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation">
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