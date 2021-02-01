$(document).on('click', '#searchBtn', function(){
    $.ajax({
        url: 'api/search',
        dataType: 'json',
        type: 'GET',
        data: {
            serial: $('#search').val()
        },
        success: function(data){
            console.log(data);
            if (data != 0){
                $('#warranty').show();
                $('#info').show();
                $('#mspg-Serial_no').val(data.data.Serial);
                if (data.type == 'mspg') {
                    $('#mspg-Company_Name').val(data.data.Company);
                    $('#mspg-Branch_Name').val(data.data.Branch);
                    $('#mspg-Store_name').val(data.data.Store_name);
                    $('#mspg-Handling_Branch').val(data.data.Handling_branch);
                    $('#mspg-Brand').val(data.data.Brand);
                    $('#mspg-warranty').show();
                    $('#mspg-customer').show();
                    $('#sm-customer').hide();
                    $('#smma-customer').hide();
                    $('#pg-customer').hide();
                }else if(data.type == 'pg'){
                    $('#pg-Customer_Name').val(data.data.Customer_name);
                    $('#pg-Item_Description').val(data.data.Item_description);
                    $('#pg-Specifications').val(data.data.Specifications);
                    $('#mspg-warranty').show();
                    $('#mspg-customer').hide();
                    $('#sm-customer').hide();
                    $('#smma-customer').hide();
                    $('#pg-customer').show();
                }else if(data.type == 'sm'){
                    $('#sm-Customer_Name').val(data.data.Customer_name);
                    $('#sm-Item_Description').val(data.data.Item_description);
                    $('#sm-Keyboard_touchscreen').val(data.data.Keyboard_touchscreen);
                    $('#sm-Specifications').val(data.data.Specifications);
                    $('#mspg-warranty').show();
                    $('#mspg-customer').hide();
                    $('#pg-customer').hide();
                    $('#smma-customer').hide();
                    $('#sm-customer').show();
                }else if(data.type == 'lcc'){
                    $('#pg-Customer_Name').val(data.data.Customer_name);
                    $('#pg-Item_Description').val(data.data.Item_description);
                    $('#pg-Specifications').val(data.data.Specifications);
                    $('#mspg-warranty').show();
                    $('#mspg-customer').hide();
                    $('#sm-customer').hide();
                    $('#smma-customer').hide();
                    $('#pg-customer').show();
                }else if(data.type == 'smma'){
                    $('#smma-Company_Name').val(data.data.Company);
                    $('#smma-Location').val(data.data.Location);
                    $('#smma-Handling_Branch').val(data.data.Handling_branch);
                    $('#smma-Model').val(data.data.Model);
                    $('#mspg-warranty').show();
                    $('#mspg-customer').hide();
                    $('#pg-customer').hide();
                    $('#sm-customer').hide();
                    $('#smma-customer').show();
                }
            }
        },
        error: function (data) {
            alert(data.responseText);
        }
    });
});

$(document).on('keyup', '#search', function(e){
    if (e.keyCode == 13) {
        $.ajax({
            url: 'api/search',
            dataType: 'json',
            type: 'GET',
            data: {
                serial: $('#search').val()
            },
            success: function(data){
                console.log(data);
                if (data != 0){
                    $('#warranty').show();
                    $('#info').show();
                    if (data.type == 'mspg') {
                        $('#mspg-Serial_no').val(data.data.Serial);
                        $('#mspg-Company_Name').val(data.data.Company);
                        $('#mspg-Branch_Name').val(data.data.Branch);
                        $('#mspg-Store_name').val(data.data.Store_name);
                        $('#mspg-Handling_Branch').val(data.data.Handling_branch);
                        $('#mspg-Brand').val(data.data.Brand);
                        $('#mspg-warranty').show();
                        $('#mspg-customer').show();
                        $('#sm-customer').hide();
                        $('#smma-customer').hide();
                        $('#pg-customer').hide();
                    }else if(data.type == 'pg'){
                        $('#mspg-Serial_no').val(data.data.Serial);
                        $('#pg-Customer_Name').val(data.data.Customer_name);
                        $('#pg-Item_Description').val(data.data.Item_description);
                        $('#pg-Specifications').val(data.data.Specifications);
                        $('#mspg-warranty').show();
                        $('#mspg-customer').hide();
                        $('#sm-customer').hide();
                        $('#smma-customer').hide();
                        $('#pg-customer').show();
                    }else if(data.type == 'sm'){
                        $('#mspg-Serial_no').val(data.data.Serial);
                        $('#sm-Customer_Name').val(data.data.Customer_name);
                        $('#sm-Item_Description').val(data.data.Item_description);
                        $('#sm-Keyboard_touchscreen').val(data.data.Keyboard_touchscreen);
                        $('#sm-Specifications').val(data.data.Specifications);
                        $('#mspg-warranty').show();
                        $('#mspg-customer').hide();
                        $('#pg-customer').hide();
                        $('#smma-customer').hide();
                        $('#sm-customer').show();
                    }else if(data.type == 'lcc'){
                        $('#mspg-Serial_no').val(data.data.Serial);
                        $('#pg-Customer_Name').val(data.data.Customer_name);
                        $('#pg-Item_Description').val(data.data.Item_description);
                        $('#pg-Specifications').val(data.data.Specifications);
                        $('#mspg-warranty').show();
                        $('#mspg-customer').hide();
                        $('#sm-customer').hide();
                        $('#smma-customer').hide();
                        $('#pg-customer').show();
                    }else if(data.type == 'smma'){
                        $('#mspg-Serial_no').val(data.data.Serial);
                        $('#smma-Company_Name').val(data.data.Company);
                        $('#smma-Location').val(data.data.Location);
                        $('#smma-Handling_Branch').val(data.data.Handling_branch);
                        $('#smma-Model').val(data.data.Model);
                        $('#mspg-warranty').show();
                        $('#mspg-customer').hide();
                        $('#pg-customer').hide();
                        $('#sm-customer').hide();
                        $('#smma-customer').show();
                    }
                }
            },
            error: function (data) {
                alert(data.responseText);
            }
        });
    }
});