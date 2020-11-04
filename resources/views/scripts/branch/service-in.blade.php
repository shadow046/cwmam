<script type="text/javascript">

    $(document).on('click', '.good', function(){
        $("#inOptionModal .close").click();
        $('#status').val('in');
        $('#goodModal').modal({backdrop: 'static', keyboard: false});
    });

    $(document).on('click', '.defective', function(){
        $("#inOptionModal .close").click();
        $('#status').val('defective');
        $('#goodModal').modal({backdrop: 'static', keyboard: false});
    });

    $(document).on('click', '.pull-out', function(){
        $("#inOptionModal .close").click();
        $('#pulloutModal').modal({backdrop: 'static', keyboard: false});
    });

    $(document).on('change', '.goodcategory', function(){
        //var codeOp = " ";
        var catOp = " ";
        var count = $(this).attr('row_count');
        var customerid = $('#goodcustomer'+ count).val();
        var categoryid = $(this).val();
        selectCategory(goodcategory1);
        $('#gooddesc' + count).val('select description');
        function selectCategory(goodcategory1) {
            $.ajax({
                type:'get',
                url:'{{route("stock.description")}}',
                data:{
                    'customerid':customerid,
                    'categoryid':categoryid,
                },
                success:function(data)
                {
                    console.log(data);
                    //codeOp+='<option selected value="select" disabled>select item code</option>';
                    catOp+='<option selected value="select" disabled>select description</option>';
                    for(var i=0;i<data.length;i++){
                        //codeOp+='<option value="'+data[i].id+'">'+data[i].id+'</option>';
                        catOp+='<option value="'+data[i].items_id+'">'+data[i].item.toUpperCase()+'</option>';
                    }
                    //$("#outitem" + count).find('option').remove().end().append(codeOp);
                    $("#gooddesc" + count).find('option').remove().end().append(catOp);
                },
            });
        }
    });

    $(document).on('change', '.goodcustomer', function(){
        //var codeOp = " ";
        var custOp = " ";
        var count = $(this).attr('row_count');
        var id = $(this).val();
        selectCustomer(goodcustomer1);
        $('#goodcategory' + count).val('select category');
        function selectCustomer(goodcustomer1) {
            $.ajax({
                type:'get',
                url:'{{route("stock.category")}}',
                data:{'id':id},
                success:function(data)
                {
                    console.log(data);
                    //codeOp+='<option selected value="select" disabled>select item code</option>';
                    custOp+='<option selected value="select" disabled>select description</option>';
                    for(var i=0;i<data.length;i++){
                        //codeOp+='<option value="'+data[i].id+'">'+data[i].id+'</option>';
                        custOp+='<option value="'+data[i].category_id+'">'+data[i].category.toUpperCase()+'</option>';
                    }
                    //$("#outitem" + count).find('option').remove().end().append(codeOp);
                    $("#goodcategory" + count).find('option').remove().end().append(custOp);
                },
            });
        }
    });

    $(document).on('change', '.gooddesc', function(){
        //var codeOp = " ";
        var serialOp = " ";
        var count = $(this).attr('row_count');
        var customerid = $('#goodcustomer'+ count).val();
        var categoryid = $('#goodcategory'+ count).val();
        var descid = $(this).val();
        selectdesc(gooddesc1);
        $('#goodserial' + count).val('select serial');
        function selectdesc(gooddesc1) {
            $.ajax({
                type:'get',
                url:'{{route("stock.serial")}}',
                data:{
                    'customerid':customerid,
                    'categoryid':categoryid,
                    'descid':descid
                },
                success:function(data)
                {
                    console.log(data);
                    //codeOp+='<option selected value="select" disabled>select item code</option>';
                    serialOp+='<option selected value="select" disabled>select description</option>';
                    for(var i=0;i<data.length;i++){
                        //codeOp+='<option value="'+data[i].id+'">'+data[i].id+'</option>';
                        serialOp+='<option value="'+data[i].id+'">'+data[i].serial.toUpperCase()+'</option>';
                    }
                    //$("#outitem" + count).find('option').remove().end().append(codeOp);
                    $("#goodserial" + count).find('option').remove().end().append(serialOp);
                },
            });
        }
    });

    $(document).on('click', '.pout_add_item', function(){
        var rowcount = $(this).attr('btn_id');
        if ($(this).val() == 'Add Item') {
            if($('#poutcategory'+ rowcount).val() && $('#poutdesc'+ rowcount).val() && $('#poutserial'+ rowcount).val()) {
                y++;
                var additem = '<div class="row no-margin" id="poutrow'+y+'"><div class="col-md-2 form-group"><select id="poutcategory'+y+'" class="form-control poutcategory" row_count="'+y+'" style="color: black;"><option selected disabled>select category</option></select></div><div class="col-md-3 form-group"><select id="poutdesc'+y+'" class="form-control poutdesc" row_count="'+y+'" style="color: black;"><option selected disabled>select description</option></select></div><div class="col-md-2 form-group"><input type="text" id="poutserial'+y+'" class="form-control poutserial" row_count="'+y+'" style="color: black;" value="N/A"></div><div class="col-md-1 form-group"><input type="button" class="pout_add_item btn btn-xs btn-primary" btn_id="'+y+'" value="Add Item"></div></div>';
                $(this).val('Remove');
                $('#poutcategory'+ rowcount).prop('disabled', true);
                $('#poutdesc'+ rowcount).prop('disabled', true);
                $('#poutserial'+ rowcount).prop('disabled', true);
                if (r < 20 ) {
                    $('#poutfield').append(additem);
                    $('#poutcategory'+ rowcount).find('option').clone().appendTo('#poutcategory'+y);
                    r++;
                }
            }
        }else{
            if (r == 20) {
                y++;
                var additem = '<div class="row no-margin" id="poutrow'+y+'"><div class="col-md-2 form-group"><select id="poutcategory'+y+'" class="form-control poutcategory" row_count="'+y+'" style="color: black;"><option selected disabled>select category</option></select></div><div class="col-md-3 form-group"><select id="poutdesc'+y+'" class="form-control poutdesc" row_count="'+y+'" style="color: black;"><option selected disabled>select description</option></select></div><div class="col-md-2 form-group"><input type="text" id="poutserial'+y+'" class="form-control poutserial" row_count="'+y+'" style="color: black;" value="N/A"></div><div class="col-md-1 form-group"><input type="button" class="pout_add_item btn btn-xs btn-primary" btn_id="'+y+'" value="Add Item"></div></div>';
                $('#poutfield').append(additem);
                $('#poutcategory'+ rowcount).find('option').clone().appendTo('#poutcategory'+y);
                r++;
            }
            $('#poutcategory'+rowcount).val('select category');
            $('#poutdesc'+rowcount).val('select description');
            $('#poutserial'+rowcount).val('input serial');
            $('#poutcategory'+rowcount).prop('disabled', false);
            $('#poutdesc'+rowcount).prop('disabled', false);
            $('#poutserial'+rowcount).prop('disabled', false);
            $('#poutrow'+rowcount).hide();
            $(this).val('Add Item');
            r--;
        }
    });

    $(document).on('click', '.pout_sub_Btn', function(){
        var cat = "";
        var serial = "";
        var item = "";
        var check = 1;
        if ($('#pcustomer-id').val() != "") {
            console.log(1);
            for(var q=1;q<=y;q++){
                if ($('#poutrow'+q).is(":visible")) {
                    if ($('.pout_add_item[btn_id=\''+q+'\']').val() == 'Remove') {
                        check++;
                        console.log(2);
                        $('.pout_sub_Btn').prop('disabled', true)
                        cat = $('#poutcategory'+q).val();
                        item = $('#poutdesc'+q).val();
                        serial = $('#poutserial'+q).val();
                        client = $('#pclient-id').val();
                        customer = $('#pcustomer-id').val();
                        $.ajax({
                            url: '{{route("stocks.pullout")}}',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            dataType: 'json',
                            type: 'POST',
                            data: {
                                item: item,
                                serial: serial,
                                cat : cat,
                                customer: customer,
                                client: client
                            },
                        });
                    }
                }
            }
        }else{
            alert("Invalid Customer Name!!!!");
            return false;
        }
        if (check > 1) {
            console.log(3);
            alert("Inventory updated!!!");
            window.location.href = '{{route('stocks.index')}}';
        }
    });

    $(document).on('click', '.good_add_item', function(){
        var rowcount = $(this).attr('btn_id');
        console.log('1');
        if ($(this).val() == 'Add Item') {
            console.log('2');
            if($('#goodserial'+ rowcount).val()){
                y++;
                var additem = '<div class="row no-margin" id="goodrow'+y+'"><div class="col-md-3 form-group"><select id="goodcustomer'+y+'" class="form-control goodcustomer" row_count="'+y+'"><option selected disabled>select customer</option></select></div><div class="col-md-2 form-group"><select id="goodcategory'+y+'" class="form-control goodcategory" row_count="'+y+'"><option selected disabled>select category</option></select></div><div class="col-md-3 form-group"><select id="gooddesc'+y+'" class="form-control gooddesc" row_count="'+y+'"><option selected disabled>select description</option></select></div><div class="col-md-2 form-group"><select id="goodserial'+y+'" class="form-control goodserial" row_count="'+y+'"><option selected disabled>select serial</option></select></div><div class="col-md-1 form-group"><input type="button" class="good_add_item btn btn-xs btn-primary" btn_id="'+y+'" value="Add Item"></div></div>'
                $(this).val('Remove');
                $('#goodcustomer'+ rowcount).prop('disabled', true);
                $('#goodcategory'+ rowcount).prop('disabled', true);
                $('#gooddesc'+ rowcount).prop('disabled', true);
                $('#goodserial'+ rowcount).prop('disabled', true);
                console.log('3');
            }
            if (b < 10 ) {
                $('#service-unitfield').append(additem);
                $('#goodcustomer'+ rowcount).find('option').clone().appendTo('#goodcustomer'+y);
                b++;
                console.log('4');
            }
        }else{
            console.log('5');
            if (b == 10) {
                y++;
                var additem = '<div class="row no-margin" id="goodrow'+y+'"><div class="col-md-3 form-group"><select id="goodcustomer'+y+'" class="form-control goodcustomer" row_count="'+y+'"><option selected disabled>select customer</option></select></div><div class="col-md-2 form-group"><select id="goodcategory'+y+'" class="form-control goodcategory" row_count="'+y+'"><option selected disabled>select category</option></select></div><div class="col-md-3 form-group"><select id="gooddesc'+y+'" class="form-control gooddesc" row_count="'+y+'"><option selected disabled>select description</option></select></div><div class="col-md-2 form-group"><select id="goodserial'+y+'" class="form-control goodserial" row_count="'+y+'"><option selected disabled>select serial</option></select></div><div class="col-md-1 form-group"><input type="button" class="good_add_item btn btn-xs btn-primary" btn_id="'+y+'" value="Add Item"></div></div>'
                $('#service-unitfield').append(additem);
                $('#goodcustomer'+ rowcount).find('option').clone().appendTo('#goodcustomer'+y);
                console.log('6');
                b++;
            }
            $('#goodrow'+rowcount).hide();
            $(this).val('Add');
            b--;
        }
    });

    $(document).on('click', '#good_sub_Btn', function(){
        var serial = "";
        var check = 1;
        console.log(y);
        for(var q=1;q<=y;q++){
            if ($('#goodrow'+q).is(":visible")) {
                console.log(y);
                if ($('.good_add_item[btn_id=\''+q+'\']').val() == 'Remove') {
                    check++;
                    $('#good_sub_Btn').prop('disabled', true);
                    serial = $('#goodserial'+q).val();
                    status = $('#status').val();
                    $.ajax({
                        url: '{{route("stock.service-in")}}',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'json',
                        type: 'PUT',
                        data: {
                            serial : serial,
                            status : status
                        },
                    });
                }
            }
        }
        if (check > 1) {
            alert("Inventory updated!!!");
            window.location.href = '{{route('stocks.index')}}';
        }
    });

    $(document).on('keyup', '#pclient', function(){
        var id = $(this).val();
        var op = " ";
        $('#pcustomer').val('');
        $("#pcustomer-name").find('option').remove();
        selectClient(pclient);
        function selectClient(pclient) {
            $.ajax({
                type:'get',
                url:'{{route("client.autocomplete")}}',
                data:{
                    'id':id
                },
                success:function(data)
                {
                    //console.log(data);
                    op+=' ';
                    for(var i=0;i<data.length;i++){
                        op+='<option data-value="'+data[i].id+'" value="'+data[i].customer.toUpperCase()+'"></option>';
                    }
                    $("#pclient-name").find('option').remove().end().append(op);
                    
                    $('#pclient-id').val($('#pclient-name [value="'+$('#pclient').val()+'"]').data('value'));
                },
            });
        }
    });

    $(document).on('keyup', '#pcustomer', function(){
        var id = $(this).val();
        var op = " ";
        if ($('#pclient-id').val()) {
            var client = $('#pclient-id').val();
        }else{
            alert("Incomplete Client Name!!!!");
            return false;
        }
        selectCustomer(pcustomer);
        function selectCustomer(pcustomer) {
            $.ajax({
                type:'get',
                url:'{{route("customer.autocomplete")}}',
                data:{
                    'id':id,
                    'client':client
                },
                success:function(data)
                {
                    //console.log(data);
                    op+=' ';
                    for(var i=0;i<data.length;i++){
                        op+='<option data-value="'+data[i].id+'" value="'+data[i].customer_branch.toUpperCase()+'"></option>';
                    }
                    $("#pcustomer-name").find('option').remove().end().append(op);
                    $('#pcustomer-id').val($('#pcustomer-name [value="'+$('#pcustomer').val()+'"]').data('value'));
                },
            });
        }
    });

    $(document).on('change', '.poutdesc', function(){
        var count = $(this).attr('row_count');
        $('#poutserial'+count).val('N/A');
    });

    $(document).on('change', '.poutcategory', function(){
        //var codeOp = " ";
        var descOp = " ";
        var count = $(this).attr('row_count');
        var id = $(this).val();
        selectDesc(poutdesc1);
        $('#poutdesc' + count).val('select description');
        function selectDesc(poutdesc1) {
            $.ajax({
                type:'get',
                url:'{{route("stock.get.itemcode")}}',
                data:{'id':id},
                success:function(data)
                {
                    //codeOp+='<option selected value="select" disabled>select item code</option>';
                    descOp+='<option selected value="select" disabled>select description</option>';
                    for(var i=0;i<data.length;i++){
                        //codeOp+='<option value="'+data[i].id+'">'+data[i].id+'</option>';
                        descOp+='<option value="'+data[i].id+'">'+data[i].item.toUpperCase()+'</option>';
                    }
                    //$("#outitem" + count).find('option').remove().end().append(codeOp);
                    $("#poutdesc" + count).find('option').remove().end().append(descOp);
                },
            });
        }
    });

</script>