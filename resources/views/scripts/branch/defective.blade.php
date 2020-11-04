<script type="text/javascript">
    var table;
    $(document).ready(function()
    {
        table =
        $('table.defectiveTable').DataTable({ //user datatables
            "dom": 'lrtip',
            processing: true,
            serverSide: true,
            "language": {
                    "emptyTable": " "
                },
            ajax: '{{route("return.table")}}',
            
            columns: [
                { data: 'date', name:'date'},
                { data: 'category', name:'category'},
                { data: 'item', name:'item'},
                { data: 'serial', name:'serial'},
                { data: 'status', name:'status'}
            ]
        });

        $('.tbsearch').delay().fadeOut('slow'); //hide search

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

    $(document).on("click", "#defectiveTable tr", function () {
        var trdata = table.row(this).data();
        var id = trdata.id;
        var descop = " ";
        console.log(trdata);
        $('#branch_id').val(trdata.branchid);
        $('#date').val(trdata.date);
        $('#description').val(convert(trdata.item));
        $('#status').val(trdata.status);
        $('#myid').val(trdata.id);
        $('#serial').val(trdata.serial);
        if (trdata.status == 'For return') {
            $('#submit_Btn').show();
        }else{
            $('#submit_Btn').hide();
        }

        $('#returnModal').modal({backdrop: 'static', keyboard: false});

        function convert (string) {
            return string.replace(/&#(?:x([\da-f]+)|(\d+));/ig, function (_, hex, dec) {
                return String.fromCharCode(dec || +('0x' + hex))
            })
        }
    });

    $(document).on('click', '#submit_Btn', function(){
        var branch = $('#branch_id').val();
        var id = $('#myid').val();
        var status = 'For receiving';
        console.log(branch);
        console.log(id+'id');
        $.ajax({
            url: '{{route("return.update")}}',
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
            success:function(data)
            {
                window.location.href = '{{route('return.index')}}';
            },
            error: function (data,error, errorThrown) {
                alert(data.responseText);
            }
        });
    });

    $(document).on('click', '.cancel', function(){
        window.location.href = '{{route('return.index')}}';
    });


</script>