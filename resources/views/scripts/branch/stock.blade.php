<script type="text/javascript">
    $(document).ready(function()
    {
        var branchid = $('#branchid').attr('branchid');
        var table =
        $('table.stockTable').DataTable({ //user datatables
            "dom": 'lrtip',
            processing: true,
            serverSide: true,
            ajax: "/view/"+branchid,
            columnDefs: [
                    {"className": "dt-center", "targets": "_all"}
                ],
            columns: [
                { data: 'category', name:'category'},
                { data: 'items_id', name:'items_id'},
                { data: 'description', name:'description'},
                { data: 'quantity', name:'quantity'}
            ]
        });

        $('.tbsearch').delay().fadeOut('slow'); //hide search

        $('#search-ic').on("click", function (event) { //clear search box on hide
            for ( var i=0 ; i<=6 ; i++ ) {
                
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
