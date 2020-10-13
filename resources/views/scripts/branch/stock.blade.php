<script type="text/javascript">
    var y = 1;
    var r = 1;
    var b =1;
    $(document).ready(function()
    {
        var branchid = $('#branchid').attr('branchid');
        var table =
        $('table.stockTable').DataTable({ //user datatables
            "dom": 'lrtip',
            processing: true,
            serverSide: true,
            ajax: '{{route("stocks.view")}}',
            columnDefs: [
                    {"className": "dt-center", "targets": "_all"}
                ],
            columns: [
                { data: 'category', name:'category'},
                { data: 'items_id', name:'items_id'},
                { data: 'description', name:'description'},
                { data: 'quantity', name:'quantity'}
            ]
        });

        $('.tbsearch').delay().fadeOut('slow'); //hide search

        $('#search-ic').on("click", function (event) { //clear search box on hide
            for ( var i=0 ; i<=6 ; i++ ) {
                
                $('.fl-'+i).val('').change();
                table
                .columns(i).search( '' )
                .draw();
            }
            $('.tbsearch').toggle();
            
        });

        $('.filter-input').keyup(function() { //search columns
            table.column( $(this).data('column'))
                .search( $(this).val())
                .draw();
        });

    });
    
    $(document).on('click', '#addStockBtn', function(){
        $('#addModal').modal({backdrop: 'static', keyboard: false});

    });

    $(document).on('change', '.item', function(){
        var count = $(this).attr('row_count');
        var id = $(this).val();        
        $('#desc' + count).val(id);
    });

    $(document).on('change', '.outitem', function(){
        var count = $(this).attr('row_count');
        var id = $(this).val();        
        $('#outdesc' + count).val(id);
    });

    $(document).on('change', '.desc', function(){
        var count = $(this).attr('row_count');
        var id = $(this).val();
        $('#item' + count).val(id);
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
        selectItem(outstock1);
        for(var i=1;i<=y;i++){
            if ($('#outdesc'+i).val() == $(this).val()) {
                rmserial = $('#outserial'+i).val();
                $("#outserial"+count+" option[value=\'"+rmserial+"\']").remove();
            }
        }

        function selectItem(outstock1) {
            $.ajax({
                type:'get',
                url:'{{route("stock.get")}}',
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
                url:'{{route("stock.serials")}}',
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

    $(document).on('change', '.category', function(){
        var codeOp = " ";
        var descOp = " ";
        var count = $(this).attr('row_count');
        var id = $(this).val();
        selectItem(item1);
        $('#item' + count).val('select itemcode');
        $('#desc' + count).val('select description');
        function selectItem(item1) {
            $.ajax({
                type:'get',
                url:'{{route("stock.get.itemcode")}}',
                data:{'id':id},
                success:function(data)
                {
                    codeOp+='<option selected value="select" disabled>select item code</option>';
                    descOp+='<option selected value="select" disabled>select description</option>';
                    for(var i=0;i<data.length;i++){
                        codeOp+='<option value="'+data[i].id+'">'+data[i].id+'</option>';
                        descOp+='<option value="'+data[i].id+'">'+data[i].item.toUpperCase()+'</option>';
                    }
                    $("#item" + count).find('option').remove().end().append(codeOp);
                    $("#desc" + count).find('option').remove().end().append(descOp);
                },
            });
        }
    });

    $(document).on('change', '.outcategory', function(){
        //var codeOp = " ";
        var descOp = " ";
        var count = $(this).attr('row_count');
        var id = $(this).val();
        selectItem(outdesc1);
        $('#outdesc' + count).val('select description');
        function selectItem(outdesc1) {
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
                    $("#outdesc" + count).find('option').remove().end().append(descOp);
                },
            });
        }
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

    $(document).on('click', '.add_item', function(){
        var rowcount = $(this).attr('btn_id');
        if ($(this).val() == 'Add Item') {
            if($('#category'+ rowcount).val() && $('#item'+ rowcount).val() && $('#desc'+ rowcount).val() && $('#serial'+ rowcount).val()) {
                y++;
                var additem = '<div class="row no-margin" id="row'+y+'"><div class="col-md-2 form-group"><select id="category'+y+'" class="form-control category" row_count="'+y+'"></select></div><div class="col-md-2 form-group"><select id="item'+y+'" class="form-control item" row_count="'+y+'"><option selected disabled>select item code</option></select></div><div class="col-md-3 form-group"><select id="desc'+y+'" class="form-control desc" row_count="'+y+'"><option selected disabled>select description</option></select></div><div class="col-md-2 form-group"><input type="text" id="serial'+y+'" class="form-control serial" row_count="'+y+'" value="N/A"></div><div class="col-md-1 form-group"><input type="button" class="add_item btn btn-xs btn-primary" btn_id="'+y+'" value="Add Item"></div></div>'
                $(this).val('Remove');
                $('#category'+ rowcount).prop('disabled', true);
                $('#item'+ rowcount).prop('disabled', true);
                $('#desc'+ rowcount).prop('disabled', true);
                $('#serial'+ rowcount).prop('disabled', true);
                if (r < 20 ) {
                    $('#reqfield').append(additem);
                    $('#category'+ rowcount).find('option').clone().appendTo('#category'+y);
                    r++;
                }
            }
        }else{
            if (r == 20) {
                y++;
                var additem = '<div class="row no-margin" id="row'+y+'"><div class="col-md-2 form-group"><select id="category'+y+'" class="form-control category" row_count="'+y+'"></select></div><div class="col-md-2 form-group"><select id="item'+y+'" class="form-control item" row_count="'+y+'"><option selected disabled>select item code</option></select></div><div class="col-md-3 form-group"><select id="desc'+y+'" class="form-control desc" row_count="'+y+'"><option selected disabled>select description</option></select></div><div class="col-md-2 form-group"><input type="text" id="serial'+y+'" class="form-control serial" row_count="'+y+'" value="N/A"></div><div class="col-md-1 form-group"><input type="button" class="add_item btn btn-xs btn-primary" btn_id="'+y+'" value="Add Item"></div></div>'
                $('#reqfield').append(additem);
                $('#category'+ rowcount).find('option').clone().appendTo('#category'+y);
                r++;
            }
            $('#category'+rowcount).val('select category');
            $('#item'+rowcount).val('select item code');
            $('#desc'+rowcount).val('select description');
            $('#serial'+rowcount).val('select serial');
            $('#category'+rowcount).prop('disabled', false);
            $('#item'+rowcount).prop('disabled', false);
            $('#desc'+rowcount).prop('disabled', false);
            $('#serial'+rowcount).prop('disabled', false);
            $('#row'+rowcount).hide();
            $(this).val('Add Item');
            r--;
        }
    });

    $(document).on('click', '.out_add_item', function(){
        var rowcount = $(this).attr('btn_id');
        if ($(this).val() == 'Add Item') {
            if($('#outcategory'+ rowcount).val() && $('#outdesc'+ rowcount).val() && $('#outserial'+ rowcount).val()) {
                y++;
                var additem = '<div class="row no-margin" id="outrow'+y+'"><div class="col-md-2 form-group"><select style="color:black" id="outcategory'+y+'" class="form-control outcategory" row_count="'+y+'"></select></div><div class="col-md-3 form-group"><select style="color:black" id="outdesc'+y+'" class="form-control outdesc" row_count="'+y+'"><option selected disabled>select description</option></select></div><div class="col-md-2 form-group"><select id="outserial'+y+'" class="form-control outserial" row_count="'+y+'" style="color: black;"><option selected disabled>select serial</option></select></div><div class="col-md-1 form-group"><input type="number" class="form-control" min="0" name="outstock'+y+'" id="outstock'+y+'" placeholder="0" style="color:black; width: 6em" disabled></div><div class="col-md-1 form-group"><input type="button" class="out_add_item btn btn-xs btn-primary" btn_id="'+y+'" value="Add Item"></div></div>'
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
                var additem = '<div class="row no-margin" id="outrow'+y+'"><div class="col-md-2 form-group"><select id="outcategory'+y+'" class="form-control outcategory" row_count="'+y+'"></select></div><div class="col-md-3 form-group"><select id="outdesc'+y+'" class="form-control outdesc" row_count="'+y+'"><option selected disabled>select description</option></select></div><div class="col-md-2 form-group"><select id="outserial'+y+'" class="form-control outserial" row_count="'+y+'" style="color: black;"><option selected disabled>select serial</option></select></div><div class="col-md-1 form-group"><input type="number" class="form-control" min="0" name="outstock'+y+'" id="outstock'+y+'" placeholder="0" style="color:black; width: 6em" disabled></div><div class="col-md-1 form-group"><input type="button" class="out_add_item btn btn-xs btn-primary" btn_id="'+y+'" value="Add Item"></div></div>'
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

    $(document).on('click', '.sub_Btn', function(){
        var cat = "";
        var item = "";
        var desc = "";
        var qty = "";
        var check = 1;
        for(var q=1;q<=y;q++){
            if ($('#row'+q).is(":visible")) {
                if ($('.add_item[btn_id=\''+q+'\']').val() == 'Remove') {
                    check++;
                    $('.sub_Btn').prop('disabled', true)
                    cat = $('#category'+q).val();
                    item = $('#item'+q).val();
                    serial = $('#serial'+q).val();
                    $.ajax({
                        url: '{{route("stocks.store")}}',
                        dataType: 'json',
                        type: 'POST',
                        data: {
                            item: item,
                            serial: serial,
                            cat : cat
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
                            url: '{{route("stocks.out")}}',
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
            console.log(3);
            alert("Inventory updated!!!");
            window.location.href = '{{route('stocks.index')}}';
        }
    });

    $(document).on('click', '#addCatBtn', function(){
        $("#addModal .close").click();
        $('#categoryModal').modal({backdrop: 'static', keyboard: false});
    });

    $(document).on('click', '#addCodeBtn', function(){
        $("#addModal .close").click();
        $('#itemModal').modal({backdrop: 'static', keyboard: false});
    });

    $(document).on('click', '.add_cat', function(){
        var rowcount = $(this).attr('btn_id');
        console.log('1');
        if ($(this).val() == 'Add') {
            console.log('2');
            if($('#cat'+ rowcount).val()){
                y++;
                var additem = '<div class="row no-margin" id="catrow'+y+'"><div class="col-md-8 form-group"><input type="text" id="cat'+y+'" class="form-control serial" row_count="'+y+'" placeholder="Category"></div><div class="col-md-1 form-group"><input type="button" class="add_cat btn btn-xs btn-primary" btn_id="'+y+'" value="Add"></div></div>'
                $(this).val('Remove');
                $('#cat'+ rowcount).prop('disabled', true);
                console.log('3');
                console.log('test'+y);
            }
            if (c < 10 ) {
                $('#catfield').append(additem);
                $('#cat'+ rowcount).find('option').clone().appendTo('#cat'+y);
                c++;
                console.log('4');
            }
        }else{
            console.log('5');
            if (c == 10) {
                y++;
                var additem = '<div class="row no-margin" id="catrow'+y+'"><div class="col-md-8 form-group"><input type="text" id="cat'+y+'" class="form-control serial" row_count="'+y+'" placeholder="Category"></div><div class="col-md-1 form-group"><input type="button" class="add_cat btn btn-xs btn-primary" btn_id="'+y+'" value="Add"></div></div>'
                $('#catfield').append(additem);
                $('#cat'+ rowcount).find('option').clone().appendTo('#cat'+y);
                console.log('6');
                c++;
            }
            $('#cat'+rowcount).val('');
            $('#catrow'+rowcount).hide();
            $(this).val('Add');
            c--;
        }
    });

    $(document).on('click', '.add_item-desc', function(){
        var rowcount = $(this).attr('btn_id');
        console.log('1');
        if ($(this).val() == 'Add') {
            console.log('2');
            if($('#item-desc'+ rowcount).val() && $('#itemcat'+ rowcount).val()){
                y++;
                var additem = '<div class="row no-margin" id="itemrow'+y+'"><div class="col-md-4 form-group"><select id="itemcat'+y+'" class="form-control item-category" row_count="'+y+'"></select></div><div class="col-md-4"><input type="text" id="item-desc'+y+'" class="form-control" row_count="'+y+'" placeholder="Item Description"></div><div class="col-md-1 form-group"><input type="button" class="add_item-desc btn btn-xs btn-primary" btn_id="'+y+'" value="Add"></div></div>'
                $(this).val('Remove');
                $('#item-desc'+ rowcount).prop('disabled', true);
                $('#itemcat'+ rowcount).prop('disabled', true);
                console.log('3');
            }
            if (b < 10 ) {
                $('#itemfield').append(additem);
                $('#itemcat'+ rowcount).find('option').clone().appendTo('#itemcat'+y);
                b++;
                console.log('4');
            }
        }else{
            console.log('5');
            if (b == 10) {
                y++;
                var additem = '<div class="row no-margin" id="itemrow'+y+'"><div class="col-md-4 form-group"><select id="itemcat'+y+'" class="form-control item-category" row_count="'+y+'"></select></div><div class="col-md-4"><input type="text" id="item-desc'+y+'" class="form-control" row_count="'+y+'" placeholder="Item Description"></div><div class="col-md-1 form-group"><input type="button" class="add_item-desc btn btn-xs btn-primary" btn_id="'+y+'" value="Add"></div></div>'
                $('#itemfield').append(additem);
                $('#itemcat'+ rowcount).find('option').clone().appendTo('#itemcat'+y);
                console.log('6');
                b++;
            }
            $('#itemcat'+rowcount).val('');
            $('#itemrow'+rowcount).hide();
            $(this).val('Add');
            b--;
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

    $(document).on('click', '#sub_cat_Btn', function(){
        var cat = "";
        var check = 1;
        for(var q=1;q<=y;q++){
            if ($('#catrow'+q).is(":visible")) {
                if ($('.add_cat[btn_id=\''+q+'\']').val() == 'Remove') {
                    check++;
                    $('#sub_cat_Btn').prop('disabled', true)
                    cat = $('#cat'+q).val();
                    $.ajax({
                        url: '{{route("add.category")}}',
                        dataType: 'json',
                        type: 'POST',
                        data: {
                            cat : cat
                        },
                    });
                }
            }
        }
        if (check > 1) {
            alert("Category added!!!");
            window.location.href = '{{route('stocks.index')}}';
        }
    });

    $(document).on('click', '#sub_item_Btn', function(){
        var cat = "";
        var check = 1;
        console.log(y);
        for(var q=1;q<=y;q++){
            if ($('#itemrow'+q).is(":visible")) {
                console.log(y);
                if ($('.add_item-desc[btn_id=\''+q+'\']').val() == 'Remove') {
                    check++;
                    $('#sub_item_Btn').prop('disabled', true);
                    cat = $('#itemcat'+q).val();
                    item = $('#item-desc'+q).val();
                    $.ajax({
                        url: '{{route("add.item")}}',
                        dataType: 'json',
                        type: 'POST',
                        data: {
                            cat : cat,
                            item : item
                        },
                    });
                }
            }
        }
        if (check > 1) {
            alert("Item added!!!");
            window.location.href = '{{route('stocks.index')}}';
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

    $(document).on('click', '.cancel', function(){
        window.location.href = '{{route('stocks.index')}}';
    });

    $(document).on('click', '#importBtn', function(){
        $('#importModal').modal({backdrop: 'static', keyboard: false});
    });

    $(document).on('click', '#out_Btn', function(){
        $('#outOptionModal').modal({backdrop: 'static', keyboard: false});
    });

    $(document).on('click', '.service-unit', function(){
        $("#outOptionModal .close").click();
        $('#service-unitModal').modal({backdrop: 'static', keyboard: false});
    });

    $(document).on('click', '.replacement', function(){
        $("#outOptionModal .close").click();
        $('#replacementModal').modal({backdrop: 'static', keyboard: false});
    });

    $(document).on('click', '#in_Btn', function(){
        $('#inOptionModal').modal({backdrop: 'static', keyboard: false});
    });

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

    $(document).on('keyup', '#client', function(){
        var id = $(this).val();
        var op = " ";
        $('#customer').val('');
        $("#customer-name").find('option').remove();
        selectClient(client);
        function selectClient(client) {
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
                    $("#client-name").find('option').remove().end().append(op);
                    
                    $('#client-id').val($('#client-name [value="'+$('#client').val()+'"]').data('value'));
                },
            });
        }
    });

    $(document).on('keyup', '#customer', function(){
        var id = $(this).val();
        var op = " ";
        if ($('#client-id').val()) {
            var client = $('#client-id').val();
        }else{
            alert("Incomplete Client Name!!!!");
            return false;
        }
        selectCustomer(customer);
        function selectCustomer(customer) {
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
                    $("#customer-name").find('option').remove().end().append(op);
                    $('#customer-id').val($('#customer-name [value="'+$('#customer').val()+'"]').data('value'));
                },
            });
        }
    });



</script>
