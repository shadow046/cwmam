<script type="text/javascript">
    var customertable;
    $(document).ready(function()
    {
        customertable =
        $('table.customerTable').DataTable({ //user datatables
            "dom": 'lrtip',
            "language": {
                    "emptyTable": " "
                },
            processing: true,
            serverSide: false,
            ajax: 'customer-list',
            columns: [
                { data: 'code', name:'code'},
                { data: 'customer', name:'customer',}
            ]
        });
    });

    $(document).on("click", "#customerTable tr", function () {
    
        var trdata = customertable.row(this).data();
        var id = trdata.id;
        window.location.href = 'customer/'+trdata.id;
    
    });

</script>

