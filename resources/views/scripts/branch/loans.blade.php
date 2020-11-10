<script type="text/javascript">
    var table;
    var requesttable;
    var interval = null;
    $(document).ready(function()
    {
        table =
        $('table.loanTable').DataTable({ //user datatables
            "dom": 'rt',
            processing: true,
            serverSide: true,
            "language": {
                    "emptyTable": " "
                },
            ajax: 'loanstable',
            
            columns: [
                { data: 'date', name:'date'},
                { data: 'branch', name:'branch'},
                { data: 'item', name:'item'},
                { data: 'stat', name:'stat'},
                { data: 'status', name:'status'}
            ]
        });

        interval = setInterval(function(){
            table.draw();
        }, 30000);

    });

    $(document).on("click", "#loanTable tr", function () {
        clearInterval(interval);
        var trdata = table.row(this).data();
        var id = trdata.id;
        var branch = trdata.branchid;
        var descop = " ";
        $('#date').val(trdata.date);
        $('#description').val(trdata.item);
        $('#status').val(trdata.status);
        $('#myid').val(trdata.id);
        $('#branch_id').val(trdata.branchid);
        $('#branch').val(trdata.branch);
        if (trdata.stat == 'IN-BOUND') {
            $('#serials').hide();
            $('#received_Btn').hide();
            $('#del_Btn').hide();
            $.ajax({
                type:'get',
                url:'loanitemcode',
                data:{'id':trdata.items_id},
                success:function(data)
                {
                    //codeOp+='<option selected value="select" disabled>select item code</option>';
                    descop+='<option selected value="select" disabled>select description</option>';
                    for(var i=0;i<data.length;i++){
                        //codeOp+='<option value="'+data[i].id+'">'+data[i].id+'</option>';
                        descop+='<option value="'+data[i].id+'">'+data[i].item.toUpperCase()+'</option>';
                    }
                    //$("#outitem" + count).find('option').remove().end().append(codeOp);
                    $("#loandesc1").find('option').remove().end().append(descop);
                },
            });

            if (trdata.status != 'pending') {
                $('#submit_Btn').hide();
                $('#loanrow1').hide();
            }else{
                $('#submit_Btn').show();
                $('#loanrow1').show();

            }
        }else{
            $('#submit_Btn').hide();
            $('#loanrow1').hide();
            if (trdata.status == 'approved') {
                $('#received_Btn').show();
                $('#serials').show();
                $('#del_Btn').hide();
                $.ajax({
                    url: 'loanget',
                    dataType: 'json',
                    type: 'GET',
                    async: false,
                    data: {
                        id: id,
                        branch: branch
                    },
                    success:function(data)
                    {
                        $('#serial').val(data.serial);
                    }
                });
            }else{
                $('#received_Btn').hide();
                $('#serials').hide();
                $('#del_Btn').show();
            }
        }
        $('#loansModal').modal({backdrop: 'static', keyboard: false});
    });

    $(document).on("click", "#submit_Btn", function () {
        var id = $('#myid').val();
        var item = $('#loanserial1').val();
        var branch = $('#branch_id').val();
        var status = 'approved';
        if ($('#loanserial1').val() && $('#status').val() == 'pending') {
            $.ajax({
                url: 'loanstock',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                type: 'PUT',
                data: {
                    id: id,
                    item: item,
                    branch: branch
                },
                error: function (data,error, errorThrown) {
                    alert(data.responseText);
                }
            });

            $.ajax({
                url: 'loansapproved',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                type: 'PUT',
                data: {
                    id: id,
                    status: status

                },
                success:function(data)
                {
                    window.location.href = 'loans';
                },
                error: function (data,error, errorThrown) {
                    alert(data.responseText);
                }
            });
        }
        
    });

    $(document).on("click", "#received_Btn", function () {
        var id = $('#myid').val();
        var branch = $('#branch_id').val();
        var status = 'completed';
        if ($('#serial').val() && $('#status').val() == 'approved') {
            $.ajax({
                url: 'loanupdate',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                type: 'PUT',
                data: {
                    id: id,
                    branch: branch
                },
                error: function (data,error, errorThrown) {
                    alert(data.responseText);
                }
            });

            $.ajax({
                url: 'loansapproved',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                type: 'PUT',
                data: {
                    id: id,
                    status: status

                },
                success:function(data)
                {
                    window.location.href = 'loans';
                },
                error: function (data,error, errorThrown) {
                    alert(data.responseText);
                }
            });
        }
        
    });

    $(document).on("click", "#del_Btn", function () {
        var id = $('#myid').val();
        var branch = $('#branch_id').val();
        var status = 'deleted';
        $.ajax({
            url: 'loandelete',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            type: 'PUT',
            data: {
                id: id,
                status: status
            },
        });
        window.location.href = 'loans';
    });

    $(document).on('change', '#loandesc1', function(){
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
                    $("#loanserial1").find('option').remove().end().append(serialOp);
                },
            });
    });

    $(document).on('click', '.cancel', function(){
        window.location.href = 'loans';
    });
    
    $(document).on('change', '#loanbranch', function(){
        var id = $(this).val();
        var itemOp ='<option selected value="select" disabled>select description</option>';
        var catOp = " ";
        $.ajax({
            type:'get',
            url:'bcategory',
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
                $("#loanreqcategory1").find('option').remove().end().append(catOp);
                $("#loanreqdesc1").find('option').remove().end().append(itemOp);
            },
        });

    });

    $(document).on('change', '#loanreqcategory1', function(){
        var catid = $(this).val();
        var branchid = $('#loanbranch').val();
        var itemOp = " ";
        $.ajax({
            type:'get',
            url:'bitem',
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
                console.log(data[0].items_id);
                $("#loanreqdesc1").find('option').remove().end().append(itemOp);
            },
        });

    });

    $(document).on('click', '#serial_sub_Btn', function(){

        if ($('#loanreqdesc1').val()) {
            
            var branchid = $('#loanbranch').val();
            var itemid = $('#loanreqdesc1').val();
            $.ajax({
                url: 'loan',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                type: 'POST',
                data: {
                    branchid: branchid,
                    itemid: itemid
                },
            });
            window.location.href = 'loans';
        }

    });

    $(document).on('click', '#loan_Btn', function(){
        clearInterval(interval);
        $('#loanModal').modal({backdrop: 'static', keyboard: false});
    });

</script>
