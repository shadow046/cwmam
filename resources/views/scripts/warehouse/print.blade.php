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
            ajax: "/getprint/"+reqno,
            columns: [
                { data: 'items_id', name:'items_id'},
                { data: 'item', name:'item'},
                { data: 'serial', name:'serial'}
            ]
        });

        
    });
</script>