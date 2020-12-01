var table;
var interval = null;
$(document).ready(function()
{
    table =
    $('table.unrepairTable').DataTable({ 
        "dom": 'lrtip',
        "language": {
            "emptyTable": " "
        },
        "order": [[ 0, "desc", ]],
        processing: true,
        serverSide: true,
        ajax: {
            url: 'unrepairable',
        error: function(data) {
                if(data.status == 401) {
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

    $('#search-ic').on("click", function () { 
        for ( var i=0 ; i<=5 ; i++ ) {
            
            $('.fl-'+i).val('').change();
            table
            .columns(i).search( '' )
            .draw();
        }
        $('.tbsearch').toggle();
        
    });

    $('.filter-input').keyup(function() { 
        table.column( $(this).data('column'))
            .search( $(this).val())
            .draw();
    });
});