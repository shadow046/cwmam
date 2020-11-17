<script type="text/javascript">
    $(document).ready(function()
    {
        var reqno = $('#reqno').val();
        var table =
        $('table.itemDetails').DataTable({ //user datatables
            "drawCallback": function( settings ) {
                $("#printBtn").click();
            },
            "dom": 't',
            "language": {
                "emptyTable": " "
            },
            'iDisplayLength': 100,
            processing: true,
            serverSide: true,
            async: false,
            ajax: { 
                url: "/getprint/"+reqno,
                error: function(data, error, errorThrown) {
                    if(data.status == 401) {
                        // session timed out | not authenticated
                        window.location.href = '/login';
                    }
                }
            },
            columns: [
                { data: 'items_id', name:'items_id'},
                { data: 'item', name:'item'},
                { data: 'serial', name:'serial'}
            ]
        });

        
    });
</script>