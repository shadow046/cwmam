<script type="text/javascript">
    var replaceTable;
    var repdata;

    $(document).on('click', '.replacement', function(){
        $("#outOptionModal .close").click();
        $('#replacementModal').modal({backdrop: 'static', keyboard: false});
    });

    $(document).on('change', '.replacementdesc', function(){
        var count = $(this).attr('row_count');
        var id = $(this).val();
        var serialOp = " ";
        $('#replacementserial'+count).val('select serial');
        $.ajax({
            type:'get',
            url:'getserials',
            data:{'id':id},
            async: false,
            success:function(data)
            {
                serialOp+='<option selected value="select" disabled>select serial</option>';
                for(var i=0;i<data.length;i++){
                    serialOp+='<option value="'+data[i].serial+'">'+data[i].serial+'</option>';
                }
                $("#replacementserial" + count).find('option').remove().end().append(serialOp);
            },
        });
    });

    $(document).on('click', '.service-unit', function(){
        $("#outOptionModal .close").click();
        $('#service-unitModal').modal({backdrop: 'static', keyboard: false});
    });

    $(document).on('click', '.out_sub_Btn', function(){
        var cat = "";
        var item = "";
        var desc = "";
        var qty = "";
        var check = 1;
        if ($('#customer-id').val() != "") {
            console.log(1);
            for(var q=1;q<=y;q++){
                if ($('#outrow'+q).is(":visible")) {
                    if ($('.out_add_item[btn_id=\''+q+'\']').val() == 'Remove') {
                        check++;
                        console.log(2);
                        $('.out_sub_Btn').prop('disabled', true)
                        cat = $('#outcategory'+q).val();
                        item = $('#outdesc'+q).val();
                        serial = $('#outserial'+q).val();
                        purpose = 'service unit';
                        client = $('#client-id').val();
                        customer = $('#customer-id').val();
                        $.ajax({
                            url: 'service-out',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            dataType: 'json',
                            type: 'PUT',
                            data: {
                                item: item,
                                serial: serial,
                                cat : cat,
                                purpose: purpose,
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
            window.location.href = 'stocks';
        }
    });

    $(document).on('change', '.outdesc', function(){
        var count = $(this).attr('row_count');
        var id = $(this).val();
        var stockCount = 0;
        var serialOp = " ";
        for(var i=1;i<=y;i++){
            if (i != count ) {
                if ($('#outdesc'+i).val() == $(this).val()) {
                    stockCount++;
                }
            }
        }
        selectStock(outstock1);
        for(var i=1;i<=y;i++){
            if ($('#outdesc'+i).val() == $(this).val()) {
                rmserial = $('#outserial'+i).val();
                $("#outserial"+count+" option[value=\'"+rmserial+"\']").remove();
            }
        }

        function selectStock(outstock1) {
            $.ajax({
                type:'get',
                url:'getstock',
                data:{'id':id},
                async: false,
                success:function(data)
                {
                    if (data != "") {
                        $('#outstock' + count).val(data[0].stock - stockCount);
                        $('#outstock' + count).css('color', 'black');
                        $('#outstock' + count).css("border", "");
                        if ($('#outstock' + count).val() <= 0) {
                            $('#outstock' + count).css('color', 'red');
                            $('#outstock' + count).css("border", "5px solid red");
                        }
                    }else{
                        $('#outstock' + count).val('0');
                        $('#outstock' + count).css('color', 'red');
                        $('#outstock' + count).css("border", "5px solid red");
                    }
                },
            });

            $.ajax({
                type:'get',
                url:'getserials',
                data:{'id':id},
                async: false,
                success:function(data)
                {
                    serialOp+='<option selected value="select" disabled>select serial</option>';
                    for(var i=0;i<data.length;i++){
                        serialOp+='<option value="'+data[i].serial+'">'+data[i].serial+'</option>';
                    }
                    $("#outserial" + count).find('option').remove().end().append(serialOp);
                },
            });
        }

    });

    $(document).on('change', '.outcategory', function(){
        var descOp = " ";
        var count = $(this).attr('row_count');
        var id = $(this).val();
        selectDesc(outdesc1);
        $('#outdesc' + count).val('select description');
        function selectDesc(outdesc1) {
            $.ajax({
                type:'get',
                url:'itemcode',
                data:{'id':id},
                success:function(data)
                {
                    descOp+='<option selected value="select" disabled>select description</option>';
                    for(var i=0;i<data.length;i++){
                        descOp+='<option value="'+data[i].id+'">'+data[i].item.toUpperCase()+'</option>';
                    }
                    $("#outdesc" + count).find('option').remove().end().append(descOp);
                },
            });
        }
    });

    $(document).on('change', '.outitem', function(){
        var count = $(this).attr('row_count');
        var id = $(this).val();        
        $('#outdesc' + count).val(id);
    });

    $(document).on('click', '.out_add_item', function(){
        var rowcount = $(this).attr('btn_id');
        if ($(this).val() == 'Add Item') {
            if($('#outcategory'+ rowcount).val() && $('#outdesc'+ rowcount).val() && $('#outserial'+ rowcount).val()) {
                y++;
                var additem = '<div class="row no-margin" id="outrow'+y+'"><div class="col-md-2 form-group"><select style="color:black" id="outcategory'+y+'" class="form-control outcategory" row_count="'+y+'"></select></div><div class="col-md-3 form-group"><select style="color:black" id="outdesc'+y+'" class="form-control outdesc" row_count="'+y+'"><option selected disabled>select description</option></select></div><div class="col-md-2 form-group"><select id="outserial'+y+'" class="form-control outserial" row_count="'+y+'" style="color: black;"><option selected disabled>select serial</option></select></div><div class="col-md-1 form-group"><input type="number" class="form-control" min="0" name="outstock'+y+'" id="outstock'+y+'" placeholder="0" style="color:black; width: 6em" disabled></div><div class="col-md-1 form-group"><input type="button" class="out_add_item btn btn-xs btn-primary" btn_id="'+y+'" value="Add Item"></div></div>';
                $(this).val('Remove');
                $('#outcategory'+ rowcount).prop('disabled', true);
                $('#outdesc'+ rowcount).prop('disabled', true);
                $('#outserial'+ rowcount).prop('disabled', true);
                if (r < 20 ) {
                    $('#outfield').append(additem);
                    $('#outcategory'+ rowcount).find('option').clone().appendTo('#outcategory'+y);
                    r++;
                }
            }
        }else{
            if (r == 20) {
                y++;
                var additem = '<div class="row no-margin" id="outrow'+y+'"><div class="col-md-2 form-group"><select id="outcategory'+y+'" class="form-control outcategory" row_count="'+y+'"></select></div><div class="col-md-3 form-group"><select id="outdesc'+y+'" class="form-control outdesc" row_count="'+y+'"><option selected disabled>select description</option></select></div><div class="col-md-2 form-group"><select id="outserial'+y+'" class="form-control outserial" row_count="'+y+'" style="color: black;"><option selected disabled>select serial</option></select></div><div class="col-md-1 form-group"><input type="number" class="form-control" min="0" name="outstock'+y+'" id="outstock'+y+'" placeholder="0" style="color:black; width: 6em" disabled></div><div class="col-md-1 form-group"><input type="button" class="out_add_item btn btn-xs btn-primary" btn_id="'+y+'" value="Add Item"></div></div>';
                $('#outfield').append(additem);
                $('#outcategory'+ rowcount).find('option').clone().appendTo('#outcategory'+y);
                r++;
            }
            $('#outcategory'+rowcount).val('select category');
            $('#outdesc'+rowcount).val('select description');
            $('#outserial'+rowcount).val('select serial');
            $('#outcategory'+rowcount).prop('disabled', false);
            $('#outdesc'+rowcount).prop('disabled', false);
            $('#outserial'+rowcount).prop('disabled', false);
            $('#outrow'+rowcount).hide();
            $(this).val('Add Item');
            r--;
        }
    });

    $(document).on('click', '.replacement', function(){
        $("#outOptionModal .close").click();
        $('#replacementModal').modal({backdrop: 'static', keyboard: false});
    });

    $(document).on('click', '.replacement_next_Btn', function(){
        if ($('#replacementcustomer-id').val()) {
            var id = $('#replacementcustomer-id').val();
            $("#replacementModal .closes").click();
            $('table.replacementDetails').dataTable().fnDestroy();
            replaceTable =
            $('table.replacementDetails').DataTable({ 
                "dom": 'lrtip',
                "language": {
                    "emptyTable": " "
                },
                processing: true,
                serverSide: true,
                ajax: "/pull-details/"+id,
                
                columns: [
                    { data: 'date', name:'date'},
                    { data: 'category', name:'category'},
                    { data: 'items_id', name:'items_id'},
                    { data: 'item', name:'item'},
                    { data: 'serial', name:'serial'}
                ]
            });
            $('#replacementTableModal').modal({backdrop: 'static', keyboard: false});
            $('#replacecustomer').val($('#replacementcustomer').val());
            $('#replaceclient').val($('#replacementclient').val());
        }

    });

    $(document).on("click", "#replacementDetails tr", function () {
        var dtdata = $('#replacementDetails tbody tr:eq(0)').data();
        var trdata = replaceTable.row(this).data();
        var catid = trdata.category_id;
        var id = trdata.id;
        repdata = trdata.id;
        var repOp = " ";
        console.log(trdata.id);
        $("#replacementTableModal .closes").click();
        $('#replaceselectcustomer').val($('#replacementcustomer').val());
        $('#replaceselectclient').val($('#replacementclient').val());
        var replace1Table =
        $('table.replacement1Details').DataTable({ //user datatables
            "dom": 'rt',
            "language": {
                "emptyTable": " "
            },
            processing: true,
            serverSide: true,
            ajax: "/pull-details1/"+id,
            columnDefs: [
                {"className": "dt-center", "targets": "_all"}
            ],
            columns: [
                { data: 'date', name:'date'},
                { data: 'category', name:'category'},
                { data: 'items_id', name:'items_id'},
                { data: 'item', name:'item'},
                { data: 'serial', name:'serial'}
            ]
        });
        $('#replacementSelectModal').modal({backdrop: 'static', keyboard: false});

        $.ajax({
            type:'get',
            url:'itemcode',
            data:{'id':catid},
            success:function(data)
            {
                repOp+='<option selected value="select" disabled>select description</option>';
                for(var i=0;i<data.length;i++){
                    repOp+='<option value="'+data[i].id+'">'+data[i].item.toUpperCase()+'</option>';
                }
                $("#repdesc1").find('option').remove().end().append(repOp);
            },
        });
    });

    $(document).on('change', '#repdesc1', function(){
        //var codeOp = " ";
        var id = $(this).val();
        var serialOp = " ";
        $.ajax({
            type:'get',
            url:'getserials',
            data:{'id':id},
            async: false,
            success:function(data)
            {
                serialOp+='<option selected value="select" disabled>select serial</option>';
                for(var i=0;i<data.length;i++){
                    serialOp+='<option value="'+data[i].id+'">'+data[i].serial+'</option>';
                }
                $("#repserial1").find('option').remove().end().append(serialOp);
            },
        });
    });

    $(document).on('click', '.rep_sub_Btn', function(){

        if ($('#repserial1').val()) {
            var item = $('#repserial1').val();
            var custid = $('#replacementcustomer-id').val();
            $.ajax({
                url: 'rep-update',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                type: 'PUT',
                async: false,
                data: {
                    item: item,
                    repdata: repdata,
                    custid : custid
                },
                success:function(data)
                {
                    window.location.href = 'stocks';
                },
                error: function (data,error, errorThrown) {
                    alert(data.responseText);
                }
            });

            

        }
    });

    $(document).on('keyup', '#replacementclient', function(){
        var id = $(this).val();
        var op = " ";
        $('#replacementcustomer').val('');
        $("#replacementcustomer-name").find('option').remove();
        selectClient(replacementclient);
        function selectClient(replacementclient) {
            $.ajax({
                type:'get',
                url:'pclient-autocomplete',
                data:{
                    'id':id
                },
                success:function(data)
                {
                    //console.log(data);
                    op+=' ';
                    for(var i=0;i<data.length;i++){
                        op+='<option data-value="'+data[i].customer_id+'" value="'+data[i].customer.toUpperCase()+'"></option>'; 
                    }
                    $("#replacementclient-name").find('option').remove().end().append(op);
                    
                    $('#replacementclient-id').val($('#replacementclient-name [value="'+$('#replacementclient').val()+'"]').data('value'));
                },
            });
        }
    });

    $(document).on('keyup', '#replacementcustomer', function(){
        var id = $(this).val();
        var op = " ";
        //$('#replacementcustomer-id').val('');
        if ($('#replacementclient-id').val()) {
            var client = $('#replacementclient-id').val();
        }else{
            alert("Incomplete Client Name!!!!");
            return false;
        }
        selectCustomer(replacementcustomer);
        function selectCustomer(replacementcustomer) {
            $.ajax({
                type:'get',
                url:'pcustomer-autocomplete',
                async: false,
                data:{
                    'id':id,
                    'client':client
                },
                success:function(data)
                {
                    //console.log(data);
                    op+=' ';
                    for(var i=0;i<data.length;i++){
                        op+='<option data-value="'+data[i].customer_branch_id+'" value="'+data[i].customer_branch.toUpperCase()+'"></option>';
                    }
                    $("#replacementcustomer-name").find('option').remove().end().append(op);
                    $('#replacementcustomer-id').val($('#replacementcustomer-name [value="'+$('#replacementcustomer').val()+'"]').data('value'));
                },
            });
        }
        
    });



</script>