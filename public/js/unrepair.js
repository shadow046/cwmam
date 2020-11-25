var table;
    var interval = null;
    $(document).ready(function()
    {
        table =
        $('table.unrepairTable').DataTable({ //user datatables
            "dom": 'lrtip',
            "language": {
                "emptyTable": " "
            },
            processing: true,
            serverSide: true,
            ajax: {
                url: 'unrepairable',
            error: function(data, error, errorThrown) {
                    if(data.status == 401) {
                        // session timed out | not authenticated
                        window.location.href = '/login';
                    }
                }
            },
            columns: [
                { data: 'date', name:'date'},
                { data: 'branch', name:'branch'},
                { data: 'category', name:'category'},
                { data: 'item', name:'item'},
                { data: 'serial', name:'serial'},
                { data: 'status', name:'status'}
            ]
        });
        interval = setInterval(function() {
            table.draw();
        }, 30000);

         //hide search

        $('#search-ic').on("click", function () { //clear search box on hide
            for ( var i=0 ; i<=5 ; i++ ) {
                
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