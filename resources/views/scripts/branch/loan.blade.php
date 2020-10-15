<script type="text/javascript">
    
    $(document).on('change', '#loanbranch', function(){
        var id = $(this).val();
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
            },
        });

    });

    $(document).on('change', '#loancategory1', function(){
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
            },
        });

    });

    $(document).on('click', '#serial_sub_Btn', function(){

        if ($('#loandesc1').val()) {
            
            var branchid = $('#loanbranch').val();
            var itemid = $('#loandesc1').val();
            $.ajax({
                url: '{{route("stocks.loan")}}',
                async: false,
                dataType: 'json',
                type: 'POST',
                data: {
                    branchid: branchid,
                    itemid: itemid
                },
            });
            window.location.href = '{{route('stocks.index')}}';
        }

    });

</script>