
<script type="text/javascript">

    $(document).on('click', function (e) //hide popover on click outside
    {
        $('[data-toggle="popover"]').each(function () {
            //the 'is' for buttons that trigger popups
            //the 'has' for icons within a button that triggers a popup
            if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
                if ($(this).data('bs.popover')) {
                    (($(this).popover('hide').data('bs.popover') || {}).inState || {}).click = false  // fix for BS 3.3.6
                }
            }
        });
    });

    $(document).ready(function()
    {
        //var selected = [];
        var table = 
        $('#branchTable').DataTable({ //user datatables
            "dom": 'lrtip',
            processing: true,
            serverSide: true,
            ajax: '{{route('get.branches')}}',
            columns: [
                { data: 'name', name:'name', "width": "14%" },
                { data: 'area', name:'area', "width": "14%"},
                { data: 'head', name:'head', "width": "14%"},
                { data: 'phone', name:'phone',"width": "14%"},
                { data: 'email', name:'email',"width": "14%"},
                { data: 'status', name:'status', "width": "14%"},
                { data: 'address', name:'address', "width": "14%"}
            ]
        });

        $('#branchTable tbody').on('click', 'tr', function () { //show branch details in modal

            var dtdata = $('#branchTable tbody tr:eq(0)').data();
            var trdata = table.row(this).data();
            $('#branch_name').prop('disabled', true);
            $('#address').prop('disabled', true);
            $('#area').prop('disabled', true);
            $('#contact_person').prop('disabled', true);
            $('#mobile').prop('disabled', true);
            $('#email').prop('disabled', true);
            $('#status').prop('disabled', true);
            $('#subBtn').val('Edit');
            $('#myid').val(trdata.id);
            $('#branch_name').val(trdata.name);
            $('#address').val(trdata.address);
            $('#area').val(trdata.area_id);
            $('#contact_person').val(trdata.head);
            $('#mobile').val(trdata.phone);
            $('#email').val(trdata.email);
            $('#status').val(dtdata.dataStatus);
            $('#myid').val(trdata.id);
            $('#branchModal').modal('show');
        });

        $('#addBtn').on('click', function(e){ //show user/branch modal
            e.preventDefault();
            $('#subBtn').val('Save');
            $('#branchModal').modal('show');
            $('#branch_name').val('');
            $('#address').val('');
            $('#area').val('select area');
            $('#contact_person').val('');
            $('#mobile').val('');
            $('#email').val('');
            $('#status').val('select status');
            $('#branch_name').prop('disabled', false);
            $('#address').prop('disabled', false);
            $('#area').prop('disabled', false);
            $('#contact_person').prop('disabled', false);
            $('#mobile').prop('disabled', false);
            $('#email').prop('disabled', false);
            $('#status').prop('disabled', false);
        });

        $('#branchForm').on('submit', function(e){ //branch modal update/save button
            e.preventDefault();
            subBtn = $('#subBtn').val();
            if(subBtn == 'Update'){
                var myid = $('#myid').val();
                $.ajax({
                    type: "PUT",
                    url: "/branch_update/"+myid,
                    data: $('#branchForm').serialize(),
                    success: function(data){
                        if($.isEmptyObject(data.error)){
                            $('#branchModal').modal('hide');
                            alert("Branch data updated");
                            window.location.reload();
                        }else{
                            alert(data.error);
                        }
                    } 
                });
            }
            if(subBtn == 'Save'){
                $.ajax({
                    type: "POST",
                    url: "{{route("branch.add")}}",
                    data: $('#branchForm').serialize(),
                    success: function(data){
                        if($.isEmptyObject(data.error)){
                            $('#branchModal').modal('hide');
                            alert("Branch data saved");
                            window.location.reload();
                        }else{
                            alert(data.error);
                        }
                    }
                });
            }
            if(subBtn == 'Edit'){
                $('#branch_name').prop('disabled', false);
                $('#address').prop('disabled', false);
                $('#area').prop('disabled', false);
                $('#contact_person').prop('disabled', false);
                $('#mobile').prop('disabled', false);
                $('#email').prop('disabled', false);
                $('#status').prop('disabled', false);
                $('#subBtn').val('Update');
            }
        });

        $('.tbsearch').delay().fadeOut('slow'); //hide search
            
        $('#filter').popover({ //filter columns popover
            html: true,
            sanitize: false,
            title: 'Filter Columns &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',
        });

        $('#filter').on("click", function (event) { //check for visible columns
            for ( var i=1 ; i<=6 ; i++ ) {
                if (table.column( i ).visible()){
                    $('#filter-'+i).prop('checked', true);
                }
                else {
                    $('#filter-'+i).prop('checked', false);
                }
            }
        });

        $('body').on('click', '.branchColumnCb', function(){ //show/hide columns
            // Get the column API object
            var column = table.column( $(this).attr('data-column') );
            var colnum = $(this).attr('data-column');
            $('.fl-'+colnum).val('');//clear columns on hide
            table
                .columns(colnum).search( '' )
                .draw();
            // Toggle the visibility
            column.visible( ! column.visible() );
            
        });

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
