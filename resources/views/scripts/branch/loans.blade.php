<script type="text/javascript">

    $(document).ready(function()
    {
        var table =
        $('table.loanTable').DataTable({ //user datatables
            "dom": 'lrtip',
            processing: true,
            serverSide: true,
            ajax: '{{route("loans.table")}}',
            columnDefs: [
                    {"className": "dt-center", "targets": "_all"}
                ],
            columns: [
                { data: 'date', name:'date'},
                { data: 'branch', name:'branch'},
                { data: 'description', name:'description'},
                { data: 'status', name:'status'}
            ]
        });

    });
    
</script>
