<script type="text/javascript">
    $(document).ready(function()
    {
        var table =
        $('table.customerTable').DataTable({ //user datatables
            "dom": 'lrtip',
            processing: true,
            serverSide: false,
            ajax: '{{route('customer.list')}}',
            columns: [
                { data: 'code', name:'code'},
                { data: 'customer_branch', name:'customer_branch',},
                { data: 'contact', name:'contact'},
                { data: 'status', name:'status',}
            ]
        });
    });
</script>