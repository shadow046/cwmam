$(document).ready(function()
{
    var interval = null;
    var table =
    $('table.activityTable').DataTable({ 
        "dom": 'lrtip',
        "language": {
                "emptyTable": " "
            },
        "order": [[ 0, 'desc' ], [ 1, 'desc' ]],
        processing: true,
        serverSide: true,
        ajax: {
            url: 'activity',
            error: function(data) {
                if(data.status == 401) {
                    window.location.href = '/login';
                }
            }
        },
        columns: [
            { data: 'date', name:'date'},
            { data: 'username', name:'username'},
            { data: 'fullname', name:'fullname'},
            { data: 'activity', name:'activity',}
        ]
    });

    interval = setInterval(function(){
        table.draw();
    }, 30000);

    $('#search-ic').on("click", function () { 
        for ( var i=2 ; i<=5 ; i++ ) {
            
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