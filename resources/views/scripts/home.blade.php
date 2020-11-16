<script type="text/javascript">
    $(document).ready(function()
    {
        var table =
        $('table.activityTable').DataTable({ //user datatables
            "dom": 'lrtip',
            "language": {
                    "emptyTable": " "
                },
            "order": [[ 0, 'desc' ], [ 1, 'desc' ]],
            processing: true,
            serverSide: false,
            ajax: 'activity',
            columns: [
                { data: 'date', name:'date'},
                { data: 'username', name:'username'},
                { data: 'fullname', name:'fullname'},
                { data: 'activity', name:'activity',}
            ]
        });

        $('.tbsearch').delay().fadeOut('slow'); //hide search

        $('#search-ic').on("click", function (event) { //clear search box on hide
            for ( var i=2 ; i<=5 ; i++ ) {
                
                $('.fl-'+i).val('').change();
                table
                .columns(i).search( '' )
                .draw();
            }
            $('.tbsearch').toggle();
            
        });

        $('.filter-input').keyup(function() { //search columns
            table.column( $(this).data('column'))
                .search( $(this).val())
                .draw();
        });
    });

    
</script>