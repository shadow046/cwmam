
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
            //$('#requestModal').modal('show');
            console.log(trdata);
            var dtdata = $('#requestTable tbody tr:eq(0)').data();
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

        $('.add_item').on('click', function(e){ //show user/branch modal
            e.preventDefault();
            var x = 0;
            var a = 0;
            for(var y=2;y<=10;y++){
                if (x == 0) {
                    if ($('#row'+y).is(":hidden")) {
                        x++;
                        $('#row'+y).show();
                    }
                }
            }
            for(var q=2;q<=10;q++){
                if ($('#row'+q).is(":visible")) {
                    a++;
                }
                if(a == 9){
                    $('.add_item').hide();
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
            var branch = $('#sreqno').val();
            var check = 'ok';            
            for(var q=1;q<=10;q++){
                if ($('#row'+q).is(":visible")) {
                    if(!$('#category'+q).val() || !$('#item'+q).val() || !$('#desc'+q).val() || !$('#qty'+q).val()) {
                        alert("Incomplete details!!!\nFailed!!!!");
                        check = 'failed';
                        return false;
                    }
                    if ($('#qty'+q).val() > $('#stock'+q).val()) {
                        
                    }
                }
            }
            
            if (check == 'ok') {
                for(var q=1;q<=10;q++){
                    if ($('#row'+q).is(":visible")) {
                        if($('#category'+q).val() && $('#item'+q).val() && $('#desc'+q).val() && $('#qty'+q).val()) {
                            cat = $('#category'+q).val();
                            item = $('#item'+q).val();
                            desc = $('#desc'+q).val();
                            qty = $('#qty'+q).val();
                            console.log('ok');
                            $.ajax({
                                url: '/update/'+branch,
                                type: 'PUT',
                                data: { 
                                    cat: cat,
                                    item: item,
                                    desc: desc,
                                    qty: qty
                                },
                                dataType: 'json',
                                headers: {
                                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                        }
                    }
                }
                alert("Branch data updated!!!!");
                window.location.href = '{{route('stock.index')}}';
            }
        });

        $('.remove_btn').on('click', function(e){ //show user/branch modal
            e.preventDefault();
            var btnCount = $(this).attr('btn_id');
            $('#row'+btnCount).hide();
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
                $('#category'+i).val('Select Category');
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
            $('#stock' + count).val('stock');
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
                        //console.log('success');
                        console.log(data);
                        console.log(data.length);
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
            $('#desc' + count).val(id);
            selectItem(stock1);
            function selectItem(stock1) {
                $.ajax({
                    type:'get',
                    url:'{{route("stock.get")}}',
                    data:{'id':id},
                    success:function(data)
                    {
                        if (data != "") {
                            $('#stock' + count).val(data[0].stock);
                        }else{
                            $('#stock' + count).val('0');
                        }
                    },
                });
            }
        });

        $('.desc').change(function(){
            var count = $(this).attr('row_count');
            var id = $(this).val();
            $('#item' + count).val(id);
            selectItem(stock1);
            function selectItem(stock1) {
                $.ajax({
                    type:'get',
                    url:'{{route("stock.get")}}',
                    data:{'id':id},
                    success:function(data)
                    {
                        if (data != "") {
                            $('#stock' + count).val(data[0].stock);
                        }else{
                            $('#stock' + count).val('0');
                        }
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
