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
            "pageLength": 50,
            "language": {
                "emptyTable": " "
            },
            "order": [[ 6, 'asc'], [ 0, 'desc']],
            "columnDefs": [
            {
                "targets": [ 0 ],
                "visible": false
            }],
            processing: true,
            serverSide: true,
            ajax: 'requests',
            columns: [
                { data: 'id', name:'id'},
                { data: 'created_at', name:'date', "width": "14%" },
                { data: 'request_no', name:'request_no', "width": "14%"},
                { data: 'reqBy', name:'reqBy', "width": "14%"},
                { data: 'branch', name:'branch',"width": "14%"},
                { data: 'area', name:'area',"width": "14%"},
                { data: 'status', name:'status', "width": "14%"}
            ]
        });

        $('#requestTable tbody').on('click', 'tr', function () {
            var trdata = table.row(this).data();
            var trsched = new Date(trdata.sched);
            $('#sched').val(months[trsched.getMonth()]+' '+trsched.getDate()+', ' +trsched.getFullYear());
            $('#date').val(trdata.created_at);
            $('#reqno').val(trdata.request_no);
            $('#branch').val(trdata.branch);
            $('#name').val(trdata.reqBy);
            $('#area').val(trdata.area);
            $('#reqbranch').val(trdata.branch_id);
            $('table.requestDetails').dataTable().fnDestroy();
            $('table.schedDetails').dataTable().fnDestroy();
            $('#printBtn').show();
            $('table.requestDetails').hide();
            $('#unresolveBtn').hide();
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
            $('#requestModal').modal('show');

        });
    });