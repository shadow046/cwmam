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

        $('.tbsearch').delay().fadeOut('slow'); //hide search
            

        $('#search-ic').on("click", function (event) { //clear search box on hide
            for ( var i=0 ; i<=6 ; i++ ) {
                
                $('.fl-'+i).val('').change();
                customertable
                .columns(i).search( '' )
                .draw();
            }
            $('.tbsearch').toggle();
            
        });

        $('.filter-input').keyup(function() { //search columns
            customertable.column( $(this).data('column'))
                .search( $(this).val())
                .draw();
        });


    });

    $(document).on("click", "#customerTable tr", function () {
    
        var trdata = customertable.row(this).data();
        var id = trdata.id;
        window.location.href = 'customer/'+trdata.id;
    
    });

</script>

