
<script type="text/javascript">

    $(document).ready(function()
    {
        var d = new Date();
        var hour = String(d.getHours()).padStart(2, '0') % 12 || 12
        var ampm = (String(d.getHours()).padStart(2, '0') < 12 || String(d.getHours()).padStart(2, '0') === 24) ? "AM" : "PM";
        var months = ["January","February","March","April","May","June","July","August","September","October","November","December"];
        //$('#requestModal').modal('show');
        $('#date').val(months[d.getMonth()]+' '+d.getDate()+', ' +d.getFullYear()+' '+hour+':'+String(d.getMinutes()).padStart(2, '0')+ampm);
        $('#sdate').val(months[d.getMonth()]+' '+d.getDate()+', ' +d.getFullYear()+' '+hour+':'+String(d.getMinutes()).padStart(2, '0')+ampm);

        var table =
        $('table.requestTable').DataTable({ //user datatables
            "dom": 'lrtip',
            processing: true,
            serverSide: true,
            ajax: '{{route('get.requests')}}',
            columns: [
                { data: 'created_at', name:'date', "width": "14%" },
                { data: 'request_no', name:'request_no', "width": "14%"},
                { data: 'reqBy', name:'reqBy', "width": "14%"},
                { data: 'branch', name:'branch',"width": "14%"},
                { data: 'area', name:'area',"width": "14%"},
                { data: 'status', name:'status', "width": "14%"}
            ]
        });

        $('#requestTable tbody').on('click', 'tr', function () { //show branch details in modal
            var trdata = table.row(this).data();
            var d = new Date(trdata.created_at);
            var hour = String(d.getHours()).padStart(2, '0') % 12 || 12
            var ampm = (String(d.getHours()).padStart(2, '0') < 12 || String(d.getHours()).padStart(2, '0') === 24) ? "AM" : "PM";
            var trdate = months[d.getMonth()]+' '+d.getDate()+', ' +d.getFullYear()+' '+hour+':'+String(d.getMinutes()).padStart(2, '0')+ampm
            var dtdata = $('#requestTable tbody tr:eq(0)').data();
            //$('#requestModal').modal('show');
            if (trdata.status == 'SCHEDULED') {
                $('#prcBtn').hide();
                $('#sched').show();
                $('#sched').val(trdata.sched);
            }else if(trdata.status == 'PENDING'){
                $('#prcBtn').show();
                $('#sched').hide();
                $('#sched').val('');
            }
            $('#date').val(trdate);
            $('#reqno').val(trdata.request_no);
            $('#branch').val(trdata.branch);
            $('#name').val(trdata.reqBy);
            $('#area').val(trdata.area);
            $('table.requestDetails').dataTable().fnDestroy();
            $('table.requestDetails').DataTable({ //user datatables
                "dom": 'lrtip',
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
            $('#requestModal').modal('show');
        });

        $('.add_item').on('click', function(){ //show user/branch modal
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
                            url:'{{route("stock.get")}}',
                            async: false,
                            data:{'id':id},
                            success:function(data)
                            {
                                if (data != "") {
                                    var curstock = data[0].stock;
                                    for(var i=1;i<=10;i++){
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
                                    if (i == 10) {
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
                    $(this).val('Remove');
                    $('#category'+ rowcount).prop('disabled', true);
                    $('#item'+ rowcount).prop('disabled', true);
                    $('#desc'+ rowcount).prop('disabled', true);
                    $('#serial'+ rowcount).prop('disabled', true);
                    for(var i=1;i<=10;i++){
                        if ($('#row'+i).is(":hidden")) {
                            $('#row'+i).show();
                            return false;
                        }
                    }
                }else{
                    return false;
                }
            }else{
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
                function selectItem(stock1) {
                    $.ajax({
                        type:'get',
                        url:'{{route("stock.get")}}',
                        data:{'id':id},
                        async: false,
                        success:function(data)
                        {
                            if (data != "") {
                                for(var i=1;i<=10;i++){
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

        $('.sub_Btn').on('click', function(e){ //show user/branch modal
            e.preventDefault();
            var s = 1;
            var cat = "";
            var item = "";
            var desc = "";
            var qty = "";
            var reqno = $('#sreqno').val();
            var check = 'ok';
            var visrow = [0];           
            for(var q=1;q<=10;q++){
                if ($('#row'+q).is(":visible")) {
                    if(!$('#datesched').val() || !$('#category'+q).val() || !$('#item'+q).val() || !$('#desc'+q).val() || !$('#serial'+q).val()) {
                        alert("Incomplete details!!!\nFailed!!!!");
                        check = 'failed';
                        return false;
                    }
                    if ($('#stock'+q).val() <= 0) {
                        $('#qty'+q).css('border', '5px solid red');
                        check = 'failed';
                        return false;
                    }
                    visrow.push(q);
                }
            }
            
            if (check == 'ok') {
                var stat = 'ok';
                for(var q=1;q<=10;q++){
                    if ($('#row'+q).is(":visible")) {
                        if($('#category'+q).val() && $('#item'+q).val() && $('#desc'+q).val() && $('#serial'+q).val()) {
                            cat = $('#category'+q).val();
                            item = $('#item'+q).val();
                            desc = $('#desc'+q).val();
                            serial = $('#serial'+q).val();
                            datesched = $('#datesched').val();
                            $.ajax({
                                url: '/update/'+reqno,
                                type: 'PUT',
                                data: { 
                                    cat: cat,
                                    item: item,
                                    desc: desc,
                                    datesched: datesched,
                                    qty: qty
                                },
                                dataType: 'json',
                                headers: {
                                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                        }
                    }
                    if (q == 10) {
                    $.ajax({
                        url: '/update/'+reqno,
                        type: 'PUT',
                        data: { 
                            reqno: reqno,
                            datesched: datesched,
                            stat: stat
                            
                        },
                        dataType: 'json',
                        headers: {
                            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    alert("Branch data updated!!!!");
                    window.location.href = '{{route('stock.index')}}';
                }
                }
            }
        });

        $('.remove_btn').on('click', function(e){ //show user/branch modal
            e.preventDefault();
            var btnCount = $(this).attr('btn_id');
            $('#row'+btnCount).hide();
            $('#category'+btnCount).val('select category');
            $('#item'+btnCount).val('select item code');
            $('#desc'+btnCount).val('select description');
            $('#serial'+btnCount).val('serial');
            $('#stock'+btnCount).val('Stock');
            $('.add_item').show();
        });

        $('#prcBtn').on('click', function(e){ //show user/branch modal
            e.preventDefault();
            var id = $('#myid').val();
            $("#requestModal .close").click();
            $('#sdate').val($('#date').val());
            $('#sreqno').val($('#reqno').val());
            $('#sbranch').val($('#branch').val());
            $('#sname').val($('#name').val());
            $('#sendModal').modal('show');
            var x = 1;
            for(var i=1;i<=10;i++){
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
            $('table.sendDetails').DataTable({ //user datatables
                "dom": 'lrtip',
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
        });

        $('.category').change(function() { //search columns
            var codeOp = " ";
            var descOp = " ";
            var count = $(this).attr('row_count');
            var id = $(this).val();
            $('#stock' + count).val('Stock');
            selectItem(item1);
            $('#item' + count).val('select itemcode');
            $('#desc' + count).val('select description');
            $('#stock' + count).css("border", "");
            $('#item' + count).css("border", "");
            function selectItem(item1) {
                $.ajax({
                    type:'get',
                    url:'{{route("stock.get.itemcode")}}',
                    data:{'id':id},
                    success:function(data)
                    {
                        //console.log('success');
                        //console.log(data);
                        //console.log(data.length);
                        codeOp+='<option selected value="select" disabled>select item code</option>';
                        descOp+='<option selected value="select" disabled>select description</option>';
                        for(var i=0;i<data.length;i++){
                            codeOp+='<option value="'+data[i].id+'">'+data[i].id+'</option>';
                            descOp+='<option value="'+data[i].id+'">'+data[i].name+'</option>';
                        }
                        $("#item" + count).find('option').remove().end().append(codeOp);
                        $("#desc" + count).find('option').remove().end().append(descOp);
                    },
                });
            }
        });

        $('.item').change(function(){
            var count = $(this).attr('row_count');
            var id = $(this).val();
            var stockCount = 0;
            var serialOp = " ";
            var rmserial = "";
            var istock = 0;
            $('#desc' + count).val(id);
            for(var i=1;i<=10;i++){
                if (i != count ) {
                    if ($('#item'+i).val() == $(this).val()) {
                        stockCount++;
                    }
                }
            }
            selectItem(stock1);
            for(var i=1;i<=10;i++){
                if ($('#item'+i).val() == $(this).val()) {
                    rmserial = $('#serial'+i).val();
                    $("#serial"+count+" option[value=\'"+rmserial+"\']").remove();
                }
            }

            function selectItem(stock1) {
                $.ajax({
                    type:'get',
                    url:'{{route("stock.get")}}',
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
                    url:'{{route("stock.serials")}}',
                    data:{'id':id},
                    async: false,
                    success:function(data)
                    {
                        //console.log('success');
                        //console.log(data);
                        //console.log(data.length);
                        serialOp+='<option selected value="select" disabled>select serial</option>';
                        for(var i=0;i<data.length;i++){
                            serialOp+='<option value="'+data[i].serial+'">'+data[i].serial+'</option>';
                        }
                        $("#serial" + count).find('option').remove().end().append(serialOp);
                    },
                });
            }
        });

        $('.desc').change(function(){
            var count = $(this).attr('row_count');
            var id = $(this).val();
            var stockCount = 0;
            $('#item' + count).val(id);
            for(var i=1;i<=10;i++){
                if (i != count ) {
                    if ($('#desc'+i).val() == $(this).val()) {
                        stockCount++;
                    }
                }
            }
            selectItem(stock1);
            for(var i=1;i<=10;i++){
                if ($('#desc'+i).val() == $(this).val()) {
                    rmserial = $('#serial'+i).val();
                    $("#serial"+count+" option[value=\'"+rmserial+"\']").remove();
                }
            }

            function selectItem(stock1) {
                $.ajax({
                    type:'get',
                    url:'{{route("stock.get")}}',
                    data:{'id':id},
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
                    url:'{{route("stock.serials")}}',
                    data:{'id':id},
                    success:function(data)
                    {
                        //console.log('success');
                        //console.log(data);
                        //console.log(data.length);
                        serialOp+='<option selected value="select" disabled>select serial</option>';
                        for(var i=0;i<data.length;i++){
                            serialOp+='<option value="'+data[i].serial+'">'+data[i].serial+'</option>';
                        }
                        $("#serial" + count).find('option').remove().end().append(serialOp);
                    },
                });
            }
        });

        $('#sendForm').on('submit', function(){ //user modal update/save button
            var d = $('#sched').val();
            var sched = new Date(d);
            alert(months[sched.getMonth()]+' '+sched.getDate()+', ' +sched.getFullYear());
        });
    });
</script>
