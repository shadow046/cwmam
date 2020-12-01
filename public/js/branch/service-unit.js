$(document).ready(function()
{
    $('table.sUnitTable').DataTable({ 
        "dom": 'lrtip',
        "language": {
            "emptyTable": " "
        },
        processing: true,
        serverSide: true,
        ajax: 'sUnit',
        
        columns: [
            { data: 'date', name:'date'},
            { data: 'client', name:'client'},
            { data: 'category', name:'category'},
            { data: 'description', name:'description'},
            { data: 'serial', name:'serial'}
        ]
    });

});