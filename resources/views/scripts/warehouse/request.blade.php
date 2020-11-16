
<script type="text/javascript">
    var r = 1;
    var y = 1;
    var interval = null;
    $(document).ready(function()
    {
        
        var d = new Date();
        var hour = String(d.getHours()).padStart(2, '0') % 12 || 12
        var ampm = (String(d.getHours()).padStart(2, '0') < 12 || String(d.getHours()).padStart(2, '0') === 24) ? "AM" : "PM";
        var months = ["January","February","March","April","May","June","July","August","September","October","November","December"];
        $('#date').val(months[d.getMonth()]+' '+d.getDate()+', ' +d.getFullYear()+' '+hour+':'+String(d.getMinutes()).padStart(2, '0')+ampm);
        $('#sdate').val(months[d.getMonth()]+' '+d.getDate()+', ' +d.getFullYear()+' '+hour+':'+String(d.getMinutes()).padStart(2, '0')+ampm);

        var table =
        $('table.requestTable').DataTable({ 
            "dom": 'lrtip',
            "language": {
                "emptyTable": " "
            },
            processing: true,
            serverSide: true,
            ajax: 'requests',
            columns: [
                { data: 'created_at', name:'date', "width": "14%" },
                { data: 'request_no', name:'request_no', "width": "14%"},
                { data: 'reqBy', name:'reqBy', "width": "14%"},
                { data: 'branch', name:'branch',"width": "14%"},
                { data: 'area', name:'area',"width": "14%"},
                { data: 'status', name:'status', "width": "14%"}
            ]
        });

        interval = setInterval(function(){
            table.draw();
        }, 30000);

        $('#requestTable tbody').on('click', 'tr', function () { 
            clearInterval(interval);
            var trdata = table.row(this).data();
            var dtdata = $('#requestTable tbody tr:eq(0)').data();
            if (trdata.status == 'SCHEDULED') {
                $('#prcBtn').hide();
                $('.sched').show();
                $('#printBtn').show();
                var trsched = new Date(trdata.sched);
                $('#sched').val(months[trsched.getMonth()]+' '+trsched.getDate()+', ' +trsched.getFullYear());
            }else if(trdata.status == 'PENDING'){
                $('#prcBtn').show();
                $('.sched').hide();
                $('#sched').val('');
                $('#printBtn').hide();
            }
            $('#date').val(trdata.created_at);
            $('#reqno').val(trdata.request_no);
            $('#branch').val(trdata.branch);
            $('#name').val(trdata.reqBy);
            $('#area').val(trdata.area);
            $('#reqbranch').val(trdata.branch_id);
            $('table.requestDetails').dataTable().fnDestroy();
            $('table.schedDetails').dataTable().fnDestroy();

            if (trdata.status == 'PENDING') {
                $('#printBtn').hide();
                $('table.schedDetails').hide();
                $('table.requestDetails').show();
                $('table.requestDetails').DataTable({ 
                    "dom": 'rt',
                    "language": {
                        "emptyTable": " "
                    },
                    processing: true,
                    serverSide: true,
                    ajax: "/requests/"+trdata.request_no,
                    columnDefs: [
                        {"className": "dt-body-center", "targets": "_all"}
                    ],
                    columns: [
                        { data: 'items_id', name:'items_id'},
                        { data: 'item_name', name:'item_name'},
                        { data: 'quantity', name:'quantity'},
                        { data: 'purpose', name:'purpose'}
                    ]
                });
            }else if(trdata.status == 'SCHEDULED'){
                $('#printBtn').show();
                $('table.requestDetails').hide();
                $('table.schedDetails').show();
                $('table.schedDetails').DataTable({ 
                    "dom": 'rt',
                    "language": {
                        "emptyTable": " "
                    },
                    processing: true,
                    serverSide: true,
                    ajax: "/send/"+trdata.request_no,
                    columnDefs: [
                        {"className": "dt-center", "targets": "_all"}
                    ],
                    columns: [
                        { data: 'items_id', name:'items_id'},
                        { data: 'item_name', name:'item_name'},
                        { data: 'serial', name:'serial'}
                    ]
                });
            }
            
            $('#requestModal').modal('show');
        });
    });

    $(document).on('click', '#prcBtn', function(){
        var id = $('#myid').val();
        $("#requestModal .closes").click();
        $('#sdate').val($('#date').val());
        $('#sreqno').val($('#reqno').val());
        $('#sbranch').val($('#branch').val());
        $('#sname').val($('#name').val());
        $('#sendModal').modal('show');
        var reqno = $('#sreqno').val();
        var x = 1;
        var catop = " ";
        for(var i=1;i<=y;i++){
            if (i != 1) {
                $('#row'+i).hide();
            }
            $('#stock'+i).css("border", "");
            $('#qty'+i).css('border', '');
            $('#category'+i).val('select category');
            $('#item'+i).val('select item code');
            $('#desc'+i).val('select description');
            $('#qty'+i).val('Qty');
            $('#stock'+i).val('');
        }
        $('table.sendDetails').dataTable().fnDestroy();
        $('table.sendDetails').DataTable({ 
            "dom": 'rt',
            "language": {
                "emptyTable": " "
            },
            processing: true,
            serverSide: true,
            ajax: "/requests/"+$('#sreqno').val(),
            columnDefs: [
                {"className": "dt-body-center", "targets": "_all"}
            ],
            columns: [
                { data: 'items_id', name:'items_id'},
                { data: 'item_name', name:'item_name'},
                { data: 'quantity', name:'quantity'},
                { data: 'purpose', name:'purpose'}
            ]
        });

        $.ajax({
            url: 'getcatreq',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            type: 'get',
            async:false,
            data: {
                reqno: reqno,
            },
            success:function(data)
            {
                catop+='<option selected value="select" disabled>select category</option>';
                for(var i=0;i<data.length;i++){
                    catop+='<option value="'+data[i].id+'">'+data[i].category+'</option>';
                }
                $("#category1").find('option').remove().end().append(catop);
            },
            error: function (data,error, errorThrown) {
                alert(data.responseText);
            }
        });
    });
    
    $(document).on('click', '.add_item', function(){
        var rowcount = $(this).attr('btn_id');
        if ($(this).val() == 'Add Item') {
            var x = 0;
            if($('#category'+ rowcount).val() && $('#item'+ rowcount).val() && $('#desc'+ rowcount).val() && $('#serial'+ rowcount).val()) {
                var id = $('#item'+ rowcount).val();
                var stockCount = 0;
                selectBranch(stock1);
                function selectBranch(stock1) {
                    $.ajax({
                        type:'get',
                        url:'getstock',
                        async: false,
                        data:{'id':id},
                        success:function(data)
                        {
                            if (data != "") {
                                var curstock = data[0].stock;
                                for(var i=1;i<=y;i++){
                                    if (i != rowcount) {
                                        if ($('#item'+i).val() == $('#item'+ rowcount).val()) {
                                            if ($('#serial'+i).val() == $('#serial'+ rowcount).val()) {
                                                $('#serial' + rowcount).css('color', 'red');
                                                $('#serial' + rowcount).css("border", "5px solid red");
                                                x++;
                                            }else{
                                                $('#serial' + rowcount).css('color', 'black');
                                                $('#serial' + rowcount).css("border", "");
                                            }
                                            if ($('#item'+i).prop('disabled')) {
                                                $('#stock'+i).val(curstock);
                                                curstock--;
                                            }
                                            
                                        }
                                    }
                                }
                                if (i == y) {
                                    $('#stock'+rowcount).val(curstock);
                                    if (curstock <= 0) {
                                        $('#stock' + rowcount).css('color', 'red');
                                        $('#stock' + rowcount).css("border", "5px solid red");
                                        x++;
                                    }
                                    $('#stock' + rowcount).css('color', 'black');
                                    $('#stock' + rowcount).css("border", "");
                                }
                            }
                        },
                    });
                }
            }else{
                x++;
                return false; 
            }
            if (x == 0) {
                y++;
                var additem = '<div class="row no-margin" id="row'+y+'"><div class="col-md-2 form-group"><select id="category'+y+'" class="form-control category" row_count="'+y+'"></select></div><div class="col-md-2 form-group"><select id="item'+y+'" class="form-control item" row_count="'+y+'"><option selected disabled>select item code</option></select></div><div class="col-md-3 form-group"><select id="desc'+y+'" class="form-control desc" row_count="'+y+'"><option selected disabled>select description</option></select></div><div class="col-md-2 form-group"><input type="text" class="form-control serial" row_count="'+y+'" name="serial1" id="serial'+y+'" placeholder="input serial"></div><div class="col-md-2 form-group"><input type="number" class="form-control" name="stock'+y+'" id="stock'+y+'" placeholder="0" style="width: 6em" disabled></div><div class="col-md-1 form-group"><input type="button" class="add_item btn btn-xs btn-primary" btn_id="'+y+'" value="Add Item"></div></div>'
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
            }else{
                return false;
            }
        }else{
            if (r == 20) {
                y++;
                var additem = '<div class="row no-margin" id="row'+y+'"><div class="col-md-2 form-group"><select id="category'+y+'" class="form-control category" row_count="'+y+'"></select></div><div class="col-md-2 form-group"><select id="item'+y+'" class="form-control item" row_count="'+y+'"><option selected disabled>select item code</option></select></div><div class="col-md-3 form-group"><select id="desc'+y+'" class="form-control desc" row_count="'+y+'"><option selected disabled>select description</option></select></div><div class="col-md-2 form-group"><input type="text" class="form-control serial" row_count="'+y+'" name="serial1" id="serial'+y+'" placeholder="input serial"></div><div class="col-md-2 form-group"><input type="number" class="form-control" name="stock'+y+'" id="stock'+y+'" placeholder="0" style="width: 6em" disabled></div><div class="col-md-1 form-group"><input type="button" class="add_item btn btn-xs btn-primary" btn_id="'+y+'" value="Add Item"></div></div>'
                $('#reqfield').append(additem);
                $('#category'+ rowcount).find('option').clone().appendTo('#category'+y);
                r++;
            }
            var id = $('#item'+rowcount).val();
            var istock = 0;
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
            selectItem(stock1);
            r--;
            function selectItem(stock1) {
                $.ajax({
                    type:'get',
                    url:'getstock',
                    data:{'id':id},
                    async: false,
                    success:function(data)
                    {
                        if (data != "") {
                            for(var i=1;i<=y;i++){
                                if (i != rowcount) {
                                    if ($('#item'+i).val() == id) {
                                        $('#stock'+i).val(data[0].stock - istock);
                                        istock++;
                                    }
                                }
                            }
                        }
                        
                    },
                });
            }
        }
    });

    $(document).on('click', '.sub_Btn', function(e){
        e.preventDefault();
        var cat = "";
        var item = "";
        var desc = "";
        var qty = "";
        var stat = "notok";
        var reqno = $('#sreqno').val();
        var check = 1;
        if ($('#datesched').val()) {
            for(var q=1;q<=y;q++){
                if ($('#row'+q).is(":visible")) {
                    if ($('.add_item[btn_id=\''+q+'\']').val() == 'Remove') {
                        check++;
                        cat = $('#category'+q).val();
                        item = $('#item'+q).val();
                        desc = $('#desc'+q).val();
                        serial = $('#serial'+q).val();
                        datesched = $('#datesched').val();
                        branchid = $('#reqbranch').val();
                        $.ajax({
                            url: 'update',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            dataType: 'json',
                            type: 'PUT',
                            data: {
                                item: item,
                                serial: serial,
                                reqno: reqno,
                                branchid: branchid
                            },
                        });
                    }
                }
                if (q == y) {
                    if (check > 1) {
                        var stat = "ok";
                        var status = "1";
                        $.ajax({
                            url: 'update',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type: 'PUT',
                            data: { 
                                reqno: reqno,
                                datesched: datesched,
                                stat: stat,
                                status: status
                            },
                            dataType: 'json',
                        });
                        window.location.href = '/print/'+reqno;
                    }
                }
            }
        }else{
            alert("Please select schedule date!!!");
        }
    });

    $(document).on('change', '.desc', function(){
        var count = $(this).attr('row_count');
        var id = $(this).val();
        var stockCount = 0;
        var serialOp = " ";
        $('#item' + count).val(id);
        for(var i=1;i<=y;i++){
            if (i != count ) {
                if ($('#desc'+i).val() == $(this).val()) {
                    stockCount++;
                }
            }
        }
        selectItem(stock1);
        for(var i=1;i<=y;i++){
            if ($('#desc'+i).val() == $(this).val()) {
                rmserial = $('#serial'+i).val();
                $("#serial"+count+" option[value=\'"+rmserial+"\']").remove();
            }
        }

        function selectItem(stock1) {
            $.ajax({
                type:'get',
                url:'getstock',
                data:{'id':id},
                async: false,
                success:function(data)
                {
                    if (data != "") {
                        $('#stock' + count).val(data[0].stock - stockCount);
                        $('#stock' + count).css('color', 'black');
                        $('#stock' + count).css("border", "");
                        if ($('#stock' + count).val() <= 0) {
                            $('#stock' + count).css('color', 'red');
                            $('#stock' + count).css("border", "5px solid red");
                        }
                    }else{
                        $('#stock' + count).val('0');
                        $('#stock' + count).css('color', 'red');
                        $('#stock' + count).css("border", "5px solid red");
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
                    $("#serial" + count).find('option').remove().end().append(serialOp);
                },
            });
        }
    });

    $(document).on('change', '.item', function(){
        var count = $(this).attr('row_count');
        var id = $(this).val();
        var stockCount = 0;
        var serialOp = " ";
        var rmserial = "";
        var istock = 0;
        $('#desc' + count).val(id);
        for(var i=1;i<=y;i++){
            if (i != count ) {
                if ($('#item'+i).val() == $(this).val()) {
                    stockCount++;
                }
            }
        }
        selectItem(stock1);
        for(var i=1;i<=y;i++){
            if ($('#item'+i).val() == $(this).val()) {
                rmserial = $('#serial'+i).val();
                $("#serial"+count+" option[value=\'"+rmserial+"\']").remove();
            }
        }

        function selectItem(stock1) {
            $.ajax({
                type:'get',
                url:'getstock',
                data:{'id':id},
                async: false,
                success:function(data)
                {
                    if (data != "") {
                        $('#stock' + count).val(data[0].stock - stockCount);
                        $('#stock' + count).css('color', 'black');
                        $('#stock' + count).css("border", "");
                        if (($('#stock' + count).val() < 0) || ($('#stock' + count).val() == 0)) {
                            $('#stock' + count).css('color', 'red');
                            $('#stock' + count).css("border", "5px solid red");
                        }
                    }else{
                        $('#stock' + count).val('0');
                        $('#stock' + count).css('color', 'red');
                        $('#stock' + count).css("border", "5px solid red");
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
                    $("#serial" + count).find('option').remove().end().append(serialOp);
                },
            });
        }
    });

    $(document).on('change', '.category', function(){
        var codeOp = " ";
        var descOp = " ";
        var count = $(this).attr('row_count');
        var id = $(this).val();
        $('#stock' + count).val('0');
        selectItem(item1);
        $('#item' + count).val('select itemcode');
        $('#desc' + count).val('select description');
        $('#stock' + count).css("border", "");
        $('#item' + count).css("border", "");
        function selectItem(item1) {
            $.ajax({
                type:'get',
                url:'itemcode',
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

    $(document).on('click', '.cancel', function(){
        window.location.href = 'request';
    });

    $(document).on('click', '#printBtn', function(){
        window.location.href = '/print/'+$('#reqno').val();
    });
</script>
