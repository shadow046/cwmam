<script type="text/javascript">
    $(document).ready(function()
    {
        var table =
        $('table.activityTable').DataTable({ //user datatables
            "dom": 'lrtip',
            "language": {
                    "emptyTable": " "
                },
            processing: true,
            serverSide: false,
            ajax: '{{route('get.activity')}}',
            columns: [
                { data: 'date', name:'date'},
                { data: 'time', name:'time',},
                { data: 'username', name:'username'},
                { data: 'fullname', name:'fullname'},
                { data: 'userlevel', name:'userlevel'},
                { data: 'activity', name:'activity',}
            ]
        });
    });
</script>