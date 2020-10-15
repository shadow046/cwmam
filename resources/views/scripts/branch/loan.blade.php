<script type="text/javascript">
    
    $(document).on('change', '#loanbranch', function(){
        var id = $(this).val();
        var serialOp ='<option selected value="select" disabled>select serial</option>';
        var itemOp ='<option selected value="select" disabled>select description</option>';
        var catOp = " ";
        $.ajax({
            type:'get',
            url:'{{route("stock.bcategory")}}',
            data:{'id':id},
            success:function(data)
            {
                console.log(data);
                //codeOp+='<option selected value="select" disabled>select item code</option>';
                catOp+='<option selected value="select" disabled>select category</option>';
                for(var i=0;i<data.length;i++){
                    //codeOp+='<option value="'+data[i].id+'">'+data[i].id+'</option>';
                    catOp+='<option value="'+data[i].category_id+'">'+data[i].category.toUpperCase()+'</option>';
                }
                //$("#outitem" + count).find('option').remove().end().append(codeOp);
                $("#loancategory1").find('option').remove().end().append(catOp);
                $("#loandesc1").find('option').remove().end().append(itemOp);
                $("#loanserial1").find('option').remove().end().append(serialOp);
            },
        });

    });

    $(document).on('change', '#loancategory1', function(){
        var serialOp ='<option selected value="select" disabled>select serial</option>';
        var catid = $(this).val();
        var branchid = $('#loanbranch').val();
        var itemOp = " ";
        $.ajax({
            type:'get',
            url:'{{route("stock.bitem")}}',
            data:{
                'catid':catid,
                'branchid':branchid
            },
            success:function(data)
            {
                console.log(data);
                //codeOp+='<option selected value="select" disabled>select item code</option>';
                itemOp+='<option selected value="select" disabled>select description</option>';
                for(var i=0;i<data.length;i++){
                    //codeOp+='<option value="'+data[i].id+'">'+data[i].id+'</option>';
                    itemOp+='<option value="'+data[i].items_id+'">'+data[i].item.toUpperCase()+'</option>';
                }
                //$("#outitem" + count).find('option').remove().end().append(codeOp);
                $("#loandesc1").find('option').remove().end().append(itemOp);
                $("#loanserial1").find('option').remove().end().append(serialOp);
            },
        });

    });

    $(document).on('change', '#loandesc1', function(){
        var branchid = $('#loanbranch').val();
        var itemid = $(this).val();
        var serialOp = " ";
        $.ajax({
            type:'get',
            url:'{{route("stock.bserial")}}',
            data:{
                'itemid':itemid,
                'branchid':branchid
            },
            success:function(data)
            {
                console.log(data);
                //codeOp+='<option selected value="select" disabled>select item code</option>';
                serialOp+='<option selected value="select" disabled>select serial</option>';
                for(var i=0;i<data.length;i++){
                    //codeOp+='<option value="'+data[i].id+'">'+data[i].id+'</option>';
                    serialOp+='<option value="'+data[i].id+'">'+data[i].serial.toUpperCase()+'</option>';
                }
                //$("#outitem" + count).find('option').remove().end().append(codeOp);
                $("#loanserial1").find('option').remove().end().append(serialOp);
            },
        });

    });

    $(document).on('click', '#serial_sub_Btn', function(){

        if ($('#serial').val()) {
            
            var branchid = $('#loanbranch').val();
            var serial = $('#loanserial1').val();
            $.ajax({
                url: '{{route("stocks.pullout")}}',
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

    });

</script>