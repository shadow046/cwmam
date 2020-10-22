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
            "language": {
                "emptyTable": " "
            },
            processing: true,
            serverSide: true,
            ajax: '{{route("stocks.view")}}',
            
            columns: [
                { data: 'category', name:'category'},
                { data: 'items_id', name:'items_id'},
                { data: 'description', name:'description'},
                { data: 'quantity', name:'quantity'}
            ]
        });

        $('.tbsearch').delay().fadeOut('slow'); //hide search

        $('#search-ic').on("click", function () { //clear search box on hide
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

    $(document).on('click', '#importBtn', function(){
        $('#importModal').modal({backdrop: 'static', keyboard: false});
    });
    
    $(document).on('click', '#loan_Btn', function(){
        $('#loanModal').modal({backdrop: 'static', keyboard: false});
    });

    $(document).on('click', '#in_Btn', function(){
        if ($('#check').val() == '[]') {
            $('.defective').prop('disabled', true)
            $('.good').prop('disabled', true)
        }else{
            $('.defective').prop('disabled', false)
            $('.good').prop('disabled', false)
        }
        $('#inOptionModal').modal({backdrop: 'static', keyboard: false});
    });

    $(document).on('click', '#out_Btn', function(){
        $('#outOptionModal').modal({backdrop: 'static', keyboard: false});
    });

    $(document).on('click', '.add_item', function(){
        var rowcount = $(this).attr('btn_id');
        if ($(this).val() == 'Add Item') {
            if($('#category'+ rowcount).val() && $('#item'+ rowcount).val() && $('#desc'+ rowcount).val() && $('#serial'+ rowcount).val()) {
                y++;
                var additem = '<div class="row no-margin" id="row'+y+'"><div class="col-md-2 form-group"><select id="category'+y+'" class="form-control category" row_count="'+y+'"></select></div><div class="col-md-2 form-group"><select id="item'+y+'" class="form-control item" row_count="'+y+'"><option selected disabled>select item code</option></select></div><div class="col-md-3 form-group"><select id="desc'+y+'" class="form-control desc" row_count="'+y+'"><option selected disabled>select description</option></select></div><div class="col-md-2 form-group"><input type="text" id="serial'+y+'" class="form-control serial" row_count="'+y+'" value="N/A"></div><div class="col-md-1 form-group"><input type="button" class="add_item btn btn-xs btn-primary" btn_id="'+y+'" value="Add Item"></div></div>';
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
                var additem = '<div class="row no-margin" id="row'+y+'"><div class="col-md-2 form-group"><select id="category'+y+'" class="form-control category" row_count="'+y+'"></select></div><div class="col-md-2 form-group"><select id="item'+y+'" class="form-control item" row_count="'+y+'"><option selected disabled>select item code</option></select></div><div class="col-md-3 form-group"><select id="desc'+y+'" class="form-control desc" row_count="'+y+'"><option selected disabled>select description</option></select></div><div class="col-md-2 form-group"><input type="text" id="serial'+y+'" class="form-control serial" row_count="'+y+'" value="N/A"></div><div class="col-md-1 form-group"><input type="button" class="add_item btn btn-xs btn-primary" btn_id="'+y+'" value="Add Item"></div></div>';
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

    $(document).on('click', '.cancel', function(){
        window.location.href = '{{route('stocks.index')}}';
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
