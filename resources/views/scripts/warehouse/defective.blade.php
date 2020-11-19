<script type="text/javascript">
    var table;
    var interval = null;
    $(document).ready(function() {
        table =
            $('table.defectiveTable').DataTable({ //user datatables
                "dom": 'lrtip',
                "language": {
                    "emptyTable": " "
                },
                processing: true,
                serverSide: true,
                ajax: {
                    url: 'return-table',
                    error: function(data, error, errorThrown) {
                        if(data.status == 401) {
                            // session timed out | not authenticated
                            window.location.href = '/login';
                        }
                    }
                },
                columns: [{
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: 'branch',
                        name: 'branch'
                    },
                    {
                        data: 'category',
                        name: 'category'
                    },
                    {
                        data: 'item',
                        name: 'item'
                    },
                    {
                        data: 'serial',
                        name: 'serial'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    }
                ],
            });

        interval = setInterval(function() {
            table.draw();
        }, 30000);

         //hide search

        $('#search-ic').on("click", function() { //clear search box on hide
            for (var i = 0; i <= 5; i++) {

                $('.fl-' + i).val('').change();
                table
                    .columns(i).search('')
                    .draw();
            }
            $('.tbsearch').toggle();

        });

        $('.filter-input').keyup(function() { //search columns
            table.column($(this).data('column'))
                .search($(this).val())
                .draw();
        });

    });

    $(document).on("click", "#defectiveTable tr", function() {
        var trdata = table.row(this).data();
        var id = trdata.id;
        var descop = " ";
        console.log(trdata);
        clearInterval(interval);
        $('#branch_id').val(trdata.branchid);
        $('#date').val(trdata.date);
        $('#description').val(trdata.item);
        $('#status').val(trdata.status);
        $('#myid').val(trdata.id);
        $('#serial').val(trdata.serial);
        if (trdata.status == 'For receiving') {
            $('#submit_Btn').val('Received');
            $('#submit_Btn').show();
        } else if (trdata.status == 'For repair' && $('#level').val() == 'Repair') {
            $('#submit_Btn').val('Repaired');
            $('#submit_Btn').show();
        } else if (trdata.status == 'Repaired') {
            $('#submit_Btn').val('Add to stock');
            $('#submit_Btn').show();
        } else {
            $('#submit_Btn').hide();
        }

        $('#returnModal').modal({
            backdrop: 'static',
            keyboard: false
        });
    });

    $(document).on('click', '#submit_Btn', function() {
        var branch = $('#branch_id').val();
        var id = $('#myid').val();
        var status = $('#submit_Btn').val();
        if ($('#submit_Btn').val() == 'Received') {
            $.ajax({
                url: 'return-update',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                type: 'PUT',
                data: {
                    id: id,
                    branch: branch,
                    status: status
                },
                success: function(data) {
                    interval = setInterval(function() {
                        table.draw();
                    }, 30000);
                    table.draw();
                    $('#returnModal .close').click();
                },
                error: function(data, error, errorThrown) {
                    alert(data.responseText);
                }
            });
        }
        if ($('#submit_Btn').val() == 'Repaired') {
            $.ajax({
                url: 'return-update',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                type: 'PUT',
                data: {
                    id: id,
                    branch: branch,
                    status: status
                },
                success: function(data) {
                    interval = setInterval(function() {
                        table.draw();
                    }, 30000);
                    table.draw();
                    $('#returnModal .close').click();
                },
                error: function(data, error, errorThrown) {
                    alert(data.responseText);
                }
            });
        }
        if ($('#submit_Btn').val() == 'Add to stock') {
            status = 'warehouse';
            $.ajax({
                url: 'return-update',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                type: 'PUT',
                data: {
                    id: id,
                    branch: branch,
                    status: status
                },
                success: function(data) {
                    interval = setInterval(function() {
                        table.draw();
                    }, 30000);
                    table.draw();
                    $('#returnModal .close').click();
                },
                error: function(data, error, errorThrown) {
                    alert(data.responseText);
                }
            });
        }
    });

    $(document).on('click', '.close', function() {
        interval = setInterval(function() {
            table.draw();
        }, 30000);
        table.draw();
    });

    $(document).on('click', '#unrepair_Btn', function() {
        var branch = $('#branch_id').val();
        var id = $('#myid').val();
        var status = 'unrepairable';
        $.ajax({
            url: 'return-update',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            type: 'PUT',
            data: {
                id: id,
                branch: branch,
                status: status
            },
            success: function(data) {
                interval = setInterval(function() {
                    table.draw();
                }, 30000);
                table.draw();
                $('#returnModal .close').click();
            },
            error: function(data, error, errorThrown) {
                alert(data.responseText);
            }
        });
    });

</script>