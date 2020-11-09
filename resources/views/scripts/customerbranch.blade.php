<script type="text/javascript">

    var table;
    $(document).ready(function()
    {
        var url = window.location.pathname;
        var id = url.substring(url.lastIndexOf('/') + 1);
        console.log(id);
        table =
        $('table.customerbranchTable').DataTable({ //user datatables
            "dom": 'lrtip',
            "language": {
                    "emptyTable": " "
                },
            processing: true,
            serverSide: false,
            ajax: "/customerbranch-list/"+id,
            columns: [
                { data: 'code', name:'code'},
                { data: 'customer_branch', name:'customer_branch',},
                { data: 'contact', name:'contact'},
                { data: 'status', name:'status',}
            ]
        });
    });
</script>
