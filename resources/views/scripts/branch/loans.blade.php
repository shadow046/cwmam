<script type="text/javascript">
    var table;
    var requesttable;
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
            ajax: '{{route("loans.table")}}',
            columnDefs: [
                    {"className": "dt-center", "targets": "_all"}
                ],
            columns: [
                { data: 'date', name:'date'},
                { data: 'branch', name:'branch'},
                { data: 'item', name:'item'},
                { data: 'status', name:'status'}
            ]
        });

        requesttable =
        $('table.loanrequestTable').DataTable({ //user datatables
            "dom": 'rt',
            processing: true,
            serverSide: true,
            "language": {
                    "emptyTable": " "
                },
            ajax: '{{route("loansrequest.table")}}',
            columnDefs: [
                    {"className": "dt-center", "targets": "_all"}
                ],
            columns: [
                { data: 'date', name:'date'},
                { data: 'branch', name:'branch'},
                { data: 'item', name:'item'},
                { data: 'status', name:'status'}
            ]
        });

    });

    $(document).on("click", "#loanTable tr", function () {
        var trdata = table.row(this).data();
        var id = trdata.id;
        var descop = " ";
        console.log(trdata);
        $('#date').val(trdata.date);
        $('#branch').val(trdata.branch);
        $('#description').val(trdata.item);
        $('#status').val(trdata.status);
        $('#myid').val(trdata.id);
        $('#branch_id').val(trdata.branchid);
        $.ajax({
            type:'get',
            url:'{{route("loan.get.itemcode")}}',
            data:{'id':id},
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
        $('#loansModal').modal({backdrop: 'static', keyboard: false});
    });

    $(document).on("click", "#submit_Btn", function () {
        var id = $('#myid').val();
        var item = $('#loanserial1').val();
        var branch = $('#branch_id').val();
        if ($('#loanserial1').val()) {
            $.ajax({
                url: '{{route("loans.stock")}}',
                dataType: 'json',
                type: 'PUT',
                data: {
                    item: item,
                    branch: branch
                },
            });

            $.ajax({
                url: '{{route("loans.approved")}}',
                dataType: 'json',
                type: 'PUT',
                data: {
                    id: id
                },
                success:function(data)
                {
                    window.location.href = '{{route('loans')}}';
                }
            });
        }
        
    });

    $(document).on('change', '#loandesc1', function(){
        var id = $(this).val();
        var serialOp = " ";
        $.ajax({
                type:'get',
                url:'{{route("stock.serials")}}',
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
    
</script>
