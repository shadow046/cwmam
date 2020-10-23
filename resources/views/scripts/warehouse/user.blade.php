
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
        $('#userTable').DataTable({ //user datatables
            "dom": 'lrtip',
            processing: true,
            serverSide: true,
            ajax: '{{route('get.users')}}',
            columns: [
                { data: 'fname', name:'fname' },
                { data: 'email', name:'email' },
                { data: 'area', name:'area' },
                { data: 'branch', name:'branch' },
                { data: 'role', name:'role' },
                { data: 'status', name:'status' }
            ]
        });

        $('#userTable tbody').on('click', 'tr', function () { //show user details in modal
            var dtdata = $('#userTable tbody tr:eq(0)').data();
            var trdata = table.row(this).data();
            var area = trdata.area_id;
            var op=" ";
            $('#myid').val(trdata.id);
            $('#first_name').prop('disabled', false);
            $('#last_name').prop('disabled', false);
            $('#email').prop('disabled', false);
            $('#password').prop('disabled', true);
            $('#password_confirmation').prop('disabled', true);
            $("#divpass1").hide();
            $("#divpass2").hide();
            $('#role').prop('disabled', false);
            $('#area').prop('disabled', false);
            $('#branch').prop('disabled', false);
            $('#status').prop('disabled', false);
            $('#userModal').modal('show');
            selectBranch(branch, function() {
                $('#first_name').val(trdata.name);
                $('#last_name').val(trdata.lastname);
                $('#email').val(trdata.email);
                $('#area').val(area);
                $('#branch').val(trdata.branch_id);

            });
            $('#role').val(trdata.role);
            $('#status').val(dtdata.dataStatus);
            $('#subBtn').val('Update');

            function selectBranch(branch, callback) {
                $.ajax({
                    type:'get',
                    url:'{{route("user.getBranch")}}',
                    data:{'id':area},
                    async: false,
                    success:function(data)
                    {
                        //console.log('success');
                        console.log(data);
                        //console.log(data.length);
                        op+='<option selected disabled>select branch</option>';
                        for(var i=0;i<data.length;i++){
                            op+='<option value="'+data[i].id+'">'+data[i].branch+'</option>';
                        }
                        $('#branch').find('option').remove().end().append(op);
                        callback();
                    },
                });
            }
        });
        
        $('#addBtn').on('click', function(e){ //show user/branch modal
            e.preventDefault();
            $('#subBtn').val('Save');
            
                $("#divpass1").show();
                $("#divpass2").show();
                $('#userModal').modal('show');
                $('#first_name').val('');
                $('#last_name').val('');
                $('#email').val('');
                $('#password').val('');
                $('#password_confirmation').val('');
                if ($('#myrole').val() == 2) {
                    $('#role').val('Tech');   
                }
                $('#area').val('select area');
                $('#branch').val('select branch');
                $('#status').val('1');
                $('#first_name').prop('disabled', false);
                $('#last_name').prop('disabled', false);
                $('#email').prop('disabled', false);
                $('#password').prop('disabled', false);
                $('#password_confirmation').prop('disabled', false);
                $('#role').prop('disabled', false);
                $('#area').prop('disabled', false);
                $('#branch').prop('disabled', false);
                $('#status').prop('disabled', false);
        });

        $('.area').change(function(){ //get branches of this area
            var area = $(this).val();
            var op=" ";
            selectBranch(branch, function() {
                $('#branch').val('select branch');
            });

            function selectBranch(branch, callback) {
                $.ajax({
                    type:'get',
                    url:'{{route("user.getBranch")}}',
                    data:{'id':area},
                    success:function(data)
                    {
                        //console.log('success');
                        //console.log(data);
                        //console.log(data.length);
                        op+='<option selected disabled>select branch</option>';
                        for(var i=0;i<data.length;i++){
                            op+='<option value="'+data[i].id+'">'+data[i].branch+'</option>';
                        }
                        $('#branch').find('option').remove().end().append(op);
                        callback();
                    },
                });
            }
        });

        $('#userForm').on('submit', function(e){ //user modal update/save button
            e.preventDefault();
            subBtn = $('#subBtn').val();
            if(subBtn == 'Update'){
                var myid = $('#myid').val();
                $.ajax({
                    type: "PUT",
                    url: "/user_update/"+myid,
                    data: $('#userForm').serialize(),
                    success: function(data){
                        if($.isEmptyObject(data.error)){
                            $('#userModal').modal('hide');
                            alert("User data updated");
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
                    url: "{{route("user.add")}}",
                    data: $('#userForm').serialize(),
                    success: function(data){
                        if($.isEmptyObject(data.error)){
                            $('#userModal').modal('hide');
                            alert("User data saved");
                            window.location.reload();
                        }else{
                            alert(data.error);
                        }
                    }
                });
            }
        });

        $('.tbsearch').delay().fadeOut('slow'); //hide search
            
        $('#filter').popover({ //filter columns popover
            html: true,
            sanitize: false,
            title: 'Filter Columns &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',
        });

        $('#filter').on("click", function (event) { //check for visible columns
            for ( var i=1 ; i<=5 ; i++ ) {
                if (table.column( i ).visible()){
                    $('#filter-'+i).prop('checked', true);
                }
                else {
                    $('#filter-'+i).prop('checked', false);
                }
            }
        });

        $('body').on('click', '.userColumnCb', function(){ //show/hide columns
            // Get the column API object
            var column = table.column( $(this).attr('data-column') );
            var colnum = $(this).attr('data-column');
            // Toggle the visibility
            column.visible( ! column.visible() );
            $('.fl-'+colnum).val('');//clear columns on hide
            table
                .columns(colnum).search( '' )
                .draw();
        });

        $('#search-ic').on("click", function (event) { //clear search box on hide
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
</script>
