
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
        /*var op = " "
        var max_fields      = 10; //maximum input boxes allowed
        var x = 1; //initlal text box count
        op+='<input text="text">';
        for(var i=0;i<4;i++){
            op+='<input text="text">';
        }
        //$('.item').append(op);*/

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

        $('#sendTable').on('click', '.removeBtn[delete_btn]', function(e){
            e.preventDefault();
            var id = $(this).attr('delete_btn');
            console.log(id);
            $.ajax(
                {
                    url: "/delete/"+id,
                    type: 'DELETE', // replaced from put
                    cache: false,
                    data: {
                        _token:'{{ csrf_token() }}'// method and token not needed in data
                    },
                    success: function (response)
                    {
                        console.log(response); // see the reponse sent
                    },
                    error: function(xhr) {
                    console.log(xhr.responseText); // this line will save you tons of hours while debugging
                    // do something here because of error
                    }
                }
            );
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
                    { data: 'purpose', name:'purpose'},
                    { data: 'action', name:'action'}
                ]
            });

            $('table.sendDetailsItem').dataTable().fnDestroy();
            $('table.sendDetailsItem').DataTable({ //user datatables
                "dom": 'lrtip',
                processing: true,
                serverSide: true,
                ajax: "/send/"+$('#sreqno').val(),
                columnDefs: [
                    {"className": "dt-body-center", "targets": "_all"}
                ],
                columns: [
                    { data: 'items_id', name:'items_id'},
                    { data: 'item_name', name:'item_name'},
                    { data: 'quantity', name:'quantity'},
                    { data: 'action', name:'action'}
                ]
            });
            
        });

        $('#sendForm').on('submit', function(){ //user modal update/save button
            var d = $('#sched').val();
            var sched = new Date(d);
            alert(months[sched.getMonth()]+' '+sched.getDate()+', ' +sched.getFullYear());
        });
    
        $('.add_item').click(function(e){ //on add input button click
            e.preventDefault();
            $("#sendModal .close").click();
            $('#addModal').modal('show');
            /*if(x < max_fields){ //max input box allowed
                x++; //text box increment
                $('.items').append('<div class="row no-margin "><div class="col-lg-12 form-group row"><div class="col-lg-3"><input type="text" list="itemcat" class="form-control form-control-sm" name="itemcat[]" id="itemcat[]" placeholder="item category"><datalist id="itemlist"></datalist></div><div class="col-lg-2"><input type="text" list="itemlist" class="form-control form-control-sm" name="itemcode[]" id="itemcode[]" placeholder="item code"><datalist id="itemlist"></datalist></div><div class="col-lg-4"><input type="text" class="form-control form-control-sm" name="itemdesc[]" id="itemdesc[]" placeholder="Description"></div><div class="col-lg-1"><input type="number" class="form-control form-control-sm" name="itemqty[]" id="itemqty[]" placeholder="Qty."></div><div class="col-lg-2"><button type="button" class="remove_field btn btn-primary">remove</button></div></div></div>'); //add input box
            }*/
        });

        /*$('.items').on("click",".add_field", function(e){ //user click on remove text
            e.preventDefault();
            if($(this).val() == 'add'){
                $(this).val('remove');
            }else{
                $(this).val('add');
            }
           $(this).parent().parent('input').remove(); x--;
        });

        $('.items').on("click",".remove_field", function(e){ //user click on remove text
            e.preventDefault(); $(this).parent().parent('div').remove(); x--;
        });*/

    });
</script>
