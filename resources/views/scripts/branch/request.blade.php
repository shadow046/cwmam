
<script type="text/javascript">
    var y = 1;
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
                $('.sched').show();
                $('#sched').val(trdata.sched);
            }else if(trdata.status == 'PENDING'){
                $('#prcBtn').show();
                $('.sched').hide();
                $('#sched').val('');
            }
            $('#date').val(trdate);
            $('#reqno').val(trdata.request_no);
            $('#branch').val(trdata.branch);
            $('#name').val(trdata.reqBy);
            $('#area').val(trdata.area);
            $('table.requestDetails').dataTable().fnDestroy();
            $('table.schedDetails').dataTable().fnDestroy();

            if (trdata.status == 'PENDING') {
                $('table.schedDetails').hide();
                $('table.requestDetails').show();
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
            }else if(trdata.status == 'SCHEDULED'){
                $('table.requestDetails').hide();
                $('table.schedDetails').show();
                $('table.schedDetails').DataTable({ //user datatables
                    "dom": 'lrtip',
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

    $(document).on('click', '#reqBtn', function(){
        $.ajax({
            type:'get',
            url:'{{route("stock.gen")}}',
            async: false,
            success:function(result)
            {
                $('#sreqno').val(result);
            },
        });
        $('#sendrequestModal').modal('show');

    });

    $(document).on('click', '.add_item', function(){

        //$('.add_item').on('click', function(){ //show user/branch modal
            var rowcount = $(this).attr('btn_id');
            if ($(this).val() == 'Add Item') {
                if($('#qty'+rowcount).val() != 0 && $('#purpose'+rowcount).val()){
                    var y = parseInt(rowcount) + 1;
                    var additem = '<div class="row no-margin" id="row'+y+'"><div class="col-md-2 form-group"><select id="category'+y+'" class="form-control category" row_count="'+y+'"></select></div><div class="col-md-2 form-group"><select id="item'+y+'" class="form-control item" row_count="'+y+'"><option selected disabled>select item code</option></select></div><div class="col-md-3 form-group"><select id="desc'+y+'" class="form-control desc" row_count="'+y+'"><option selected disabled>select description</option></select></div><div class="col-md-2 form-group"><select id="purpose'+y+'" class="form-control purpose" row_count="'+y+'"><option selected disabled>select purpose</option><option value="1">Service Unit</option><option value="2">Replacement</option><option value="3">Stock</option></select></div><div class="col-md-2 form-group"><input type="number" class="form-control" name="qty'+y+'" id="qty'+y+'" placeholder="0" style="width: 6em" disabled></div><div class="col-md-1 form-group"><input type="button" class="add_item btn btn-xs btn-primary" btn_id="'+y+'" value="Add Item"></div></div>'
                    $(this).val('Remove');
                    $('#category'+ rowcount).prop('disabled', true);
                    $('#item'+ rowcount).prop('disabled', true);
                    $('#desc'+ rowcount).prop('disabled', true);
                    $('#qty'+ rowcount).prop('disabled', true);
                    $('#purpose'+ rowcount).prop('disabled', true);
                    $('#reqfield').append(additem);
                    $('#category'+ rowcount).find('option').clone().appendTo('#category'+y);
                }else{
                    alert("Invalid Quantity value!!!");
                }
            }else{
                $('#category'+rowcount).val('select category');
                $('#item'+rowcount).val('select item code');
                $('#desc'+rowcount).val('select description');
                $('#serial'+rowcount).val('select serial');
                $('#purpose'+rowcount).val('select purpose');
                $('#category'+rowcount).prop('disabled', false);
                $('#item'+rowcount).prop('disabled', false);
                $('#desc'+rowcount).prop('disabled', false);
                $('#serial'+rowcount).prop('disabled', false);
                $('#purpose'+ rowcount).prop('disabled', false);
                $('#row'+rowcount).hide();
                $(this).val('Add Item');
            }
            
        //});

    });

    $(document).on('click', '.send_sub_Btn', function(e){

        //$('.sub_Btn').on('click', function(e){ //show user/branch modal
            e.preventDefault();
            var cat = "";
            var item = "";
            var desc = "";
            var qty = "";
            var stat = "notok";
            var reqno = $('#sreqno').val();
            for(var q=1;q<=y;q++){
                if ($('#row'+q).is(":visible")) {
                    if ($('.add_item[btn_id=\''+q+'\']').val() == 'Remove') {
                        cat = $('#category'+q).val();
                        item = $('#item'+q).val();
                        desc = $('#desc'+q).val();
                        qty = $('#qty'+q).val();
                        purpose = $('#purpose'+q).val();
                        $.ajax({
                            url: '{{route("stock.store.request")}}',
                            dataType: 'json',
                            type: 'POST',
                            data: {
                                reqno : reqno,
                                item: item,
                                purpose: purpose,
                                qty: qty,
                                stat: stat                           
                            },
                        });
                    }
                }
                if (q == y) {
                    stat = "ok";
                    $.ajax({
                        url: '{{route("stock.store.request")}}',
                        dataType: 'json',
                        type: 'POST',
                        data: {
                            reqno : reqno,  
                            stat: stat                     
                        },
                    });
                    alert("Request datails submitted!!!");
                    window.location.href = '{{route('stock.index')}}';
                }
            }
        //});

    });

    $(document).on('change', '.desc', function(){
        var count = $(this).attr('row_count');
        var id = $(this).val();
        $('#item' + count).val(id);
        $('#qty'+count).prop('disabled', false);
    });

    $(document).on('change', '.item', function(){
        var count = $(this).attr('row_count');
        var id = $(this).val();
        $('#desc' + count).val(id);
        $('#qty'+count).prop('disabled', false);
    });

    $(document).on('change', '.category', function(){
        var codeOp = " ";
        var descOp = " ";
        var count = $(this).attr('row_count');
        var id = $(this).val();
        $('#stock' + count).val('Stock');
        selectItem(item1);
        $('#item' + count).val('select itemcode');
        $('#desc' + count).val('select description');
        $('#item' + count).css("border", "");
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
                        descOp+='<option value="'+data[i].id+'">'+data[i].name+'</option>';
                    }
                    $("#item" + count).find('option').remove().end().append(codeOp);
                    $("#desc" + count).find('option').remove().end().append(descOp);
                },
            });
        }
    });
</script>
