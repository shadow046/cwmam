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
            ajax: '{{route('customer.list')}}',
            columns: [
                { data: 'code', name:'code'},
                { data: 'customer', name:'customer',}
            ]
        });
    });

    $(document).on("click", "#customerTable tr", function () {
    
        var trdata = customertable.row(this).data();
        var id = trdata.id;
        var url = '{{ route('home.index') }}';
        window.location.href = url+'/customer/'+trdata.id;
    
    });

</script>

