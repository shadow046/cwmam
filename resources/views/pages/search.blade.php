@extends('layouts.app')

@section('content')
    <br>
    <div class="container">
        <div class="row justify-content-center">
            <center>
                <p style="color: gray">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Please enter valid serial number to start search</p>
                <div>
                    SERIAL NUMBER :  <input type="text" id="search" size="50" value="">
                    <button type="button" id="searchBtn"><i class="fa fa-search" style="color:white;font-size:15px"></i></button>
                </div>
            </center>
        </div>
    </div>
    <div class="container pt-5">
        <div class="row">
            <div class="col-md-5" id="warranty" style="display:none">
                <div class="card bg-light">
                    <div class="card-header" style="background-color: #0d1a80; color: white;font-family:arial;font-size:130%;font-weight: bold">
                        WARRANTY INFORMATION
                    </div>
                    <div class="card-body">
                        <form id="mspg-warranty" style="display:none">
                            <div class="form-group row">
                                <label for="mspg-Status" class="col-md-3 col-form-label text-md-right">{{ __('Status') }}</label>
                                <div class="col-md-8">
                                    <input id="mspg-Status" type="text" name="mspg-Status" size="35" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="mspg-Start" class="col-md-3 col-form-label text-md-right">{{ __('Start') }}</label>
                                <div class="col-md-8">
                                    <input id="mspg-Start" type="text" name="mspg-Start" size="35" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="mspg-End" class="col-md-3 col-form-label text-md-right">{{ __('End') }}</label>
                                <div class="col-md-8">
                                    <input id="mspg-End" type="text" name="mspg-End" size="35" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="mspg-Serial_no" class="col-md-3 col-form-label text-md-right">{{ __('Serial No.') }}</label>
                                <div class="col-md-8">
                                    <input id="mspg-Serial_no" type="text" name="mspg-Serial_no" size="35" readonly>
                                </div>
                            </div>
                        </form>
                    </div> 
                </div>
            </div>
            <div class="col-md-7" id="info" style="display:none">
                <div class="card bg-light">
                    <div class="card-header" style="background-color: #0d1a80; color: white;font-family:arial;font-size:130%;font-weight: bold">
                        CUSTOMER INFORMATION
                    </div>
                    <div class="card-body">
                        <form id="mspg-customer" style="display:none">
                            <div class="form-group row">
                                <label for="mspg-Company_Name" class="col-md-4 col-form-label text-md-right">{{ __('Company Name') }}</label>
                                <div class="col-md-8">
                                    <input id="mspg-Company_Name" type="text" name="mspg-Company_Name" size="50" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="mspg-Branch_Name" class="col-md-4 col-form-label text-md-right">{{ __('Branch Name') }}</label>
                                <div class="col-md-8">
                                    <input id="mspg-Branch_Name" type="text" name="mspg-Branch_Name" size="50" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="mspg-Store_name" class="col-md-4 col-form-label text-md-right">{{ __('Store Name') }}</label>
                                <div class="col-md-8">
                                    <input id="mspg-Store_name" type="text" name="mspg-Store_name" size="50" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="mspg-Handling_Branch" class="col-md-4 col-form-label text-md-right">{{ __('Handling Branch') }}</label>
                                <div class="col-md-8">
                                    <input id="mspg-Handling_Branch" type="text" name="mspg-Handling_Branch" size="50" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="mspg-Brand" class="col-md-4 col-form-label text-md-right">{{ __('Brand') }}</label>
                                <div class="col-md-8">
                                    <input id="mspg-Brand" type="text" name="mspg-Brand" size="50" readonly>
                                </div>
                            </div>
                        </form>
                            <!--Puregold-->
                        <form id="pg-customer" style="display:none">
                            <div class="form-group row">
                                <label for="pg-Customer_Name" class="col-md-4 col-form-label text-md-right">{{ __('Customer Name') }}</label>
                                <div class="col-md-8">
                                    <input id="pg-Customer_Name" type="text" name="pg-Customer_Name" size="50" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="pg-Item_Description" class="col-md-4 col-form-label text-md-right">{{ __('Item Description') }}</label>
                                <div class="col-md-8">
                                    <input id="pg-Item_Description" type="text" name="pg-Item_Description" size="50" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="pg-Specifications" class="col-md-4 col-form-label text-md-right">{{ __('Specifications') }}</label>
                                <div class="col-md-8">
                                    <input id="pg-Specifications" type="text" name="pg-Specifications" size="50" readonly>
                                </div>
                            </div>
                        </form>
                        <!--sm-->
                        <form id="sm-customer" style="display:none">
                            <div class="form-group row">
                                <label for="sm-Customer_Name" class="col-md-4 col-form-label text-md-right">{{ __('Customer Name') }}</label>
                                <div class="col-md-8">
                                    <input id="sm-Customer_Name" type="text" name="sm-Customer_Name" size="50" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="sm-Item_Description" class="col-md-4 col-form-label text-md-right">{{ __('Item Description') }}</label>
                                <div class="col-md-8">
                                    <input id="sm-Item_Description" type="text" name="sm-Item_Description" size="50" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="sm-Keyboard_touchscreen" class="col-md-4 col-form-label text-md-right">{{ __('Keyboard/Touchscreen') }}</label>
                                <div class="col-md-8">
                                    <input id="sm-Keyboard_touchscreen" type="text" name="sm-Keyboard_touchscreen" size="50" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="sm-Specifications" class="col-md-4 col-form-label text-md-right">{{ __('Specifications') }}</label>
                                <div class="col-md-8">
                                    <input id="sm-Specifications" type="text" name="sm-Specifications" size="50" readonly>
                                </div>
                            </div>
                        </form>
                        <!--smma-->
                        <form id="smma-customer" style="display:none">
                            <div class="form-group row">
                                <label for="smma-Company_Name" class="col-md-4 col-form-label text-md-right">{{ __('Company Name') }}</label>
                                <div class="col-md-8">
                                    <input id="smma-Company_Name" type="text" name="smma-Company_Name" size="50" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="smma-Location" class="col-md-4 col-form-label text-md-right">{{ __('Location') }}</label>
                                <div class="col-md-8">
                                    <input id="smma-Location" type="text" name="smma-Location" size="50" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="smma-Handling_Branch" class="col-md-4 col-form-label text-md-right">{{ __('Handling Branch') }}</label>
                                <div class="col-md-8">
                                    <input id="smma-Handling_Branch" type="text" name="smma-Handling_Branch" size="50" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="smma-Model" class="col-md-4 col-form-label text-md-right">{{ __('Model') }}</label>
                                <div class="col-md-8">
                                    <input id="smma-Model" type="text" name="smma-Model" size="50" readonly>
                                </div>
                            </div>
                        </form>
                    </div> 
                </div>
            </div>
        </div>
    </div>
@endsection
