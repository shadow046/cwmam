
<script type="text/javascript">
    $(document).ready(function()
    {
        var selected = [];
        var table = $('#userTable').DataTable({
            "dom": 'lrtip',
            processing: true,
            serverSide: true,
            ajax: '{!! route('get.users')!!}',
            columns: [
                { data: 'name', name:'name' },
                { data: 'email', name:'email' },
                { data: 'area', name:'area' },
                { data: 'branch', name:'branch' },
                { data: 'role', name:'role' },
                { data: 'status', name:'status' }
            ]

        });
        
        $('.toggle-vis').on( 'click', function (e) {
            e.preventDefault();
    
            // Get the column API object
            var column = table.column( $(this).attr('data-column') );
    
            // Toggle the visibility
            column.visible( ! column.visible() );
        });


        $('.filter-input').keyup(function() {
            table.column( $(this).data('column'))
                .search( $(this).val())
                .draw();
        });

        $('#userTable tbody').on('click', 'tr', function () {
            var dtdata = $('#userTable tbody tr:eq(0)').data();
            //console.log( $('#example tbody tr:eq(0)').data() );
            var mydata = table.row(this).data();
            var op=" ";
                $('#full_name').prop('disabled', false);
                $('#email').prop('disabled', false);
                $('#password').prop('disabled', false);
                $('#password_confirmation').prop('disabled', false);
                $('#role').prop('disabled', false);
                $('#area').prop('disabled', false);
                $('#branch').prop('disabled', false);
                $('#status').prop('disabled', false);
                $('#userModal').modal('show');
                selectBranch(branch, function() {
                    $('#full_name').val(mydata.name);
                    $('#email').val(mydata.email);
                    $('#area').val(mydata.area_id);   
                });
                
                $('#role').val(mydata.role);
                $('#status').val(dtdata.dataStatus);
                $('#subBtn').val('Update');
                    //console.log(mydata.DT_RowData[data-status]);
                    console.log(dtdata);
                function selectBranch(branch, callback) {
                $.ajax({
                    type:'get',
                    url:'{!!URL::to('getBranchName')!!}',
                    data:{'id':mydata.area_id},
                    success:function(data)
                    {
                        //console.log('success');
                        //console.log(data);
                        //console.log(data.length);
                        op+='<option selected disabled>select branch</option>';
                        for(var i=0;i<data.length;i++){
                            op+='<option value="'+data[i].id+'">'+data[i].name+'</option>';
                        }
                        $('#branch').find('option').remove().end().append(op);
                        $('#branch').val(mydata.branch_id);
                        callback();
                    },
                });
            }
        });
        
        $('#addBtn').on('click', function(e){
            e.preventDefault();
            $('#subBtn').val('Save');
            addBtn = $('#addBtn').val();
            if(addBtn == 'Add Branch'){
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
            }
            if(addBtn == 'New User'){
                $("#divpass1").show();
                $("#divpass2").show();
                $('#userModal').modal('show');
                $('#full_name').val('');
                $('#email').val('');
                $('#password').val('');
                $('#password_confirmation').val('');
                $('role').val('select role');
                $('#area').val('select area');
                $('#branch').val('select branch');
                $('#status').val('select status');
                $('#full_name').prop('disabled', false);
                $('#email').prop('disabled', false);
                $('#password').prop('disabled', false);
                $('#password_confirmation').prop('disabled', false);
                $('#role').prop('disabled', false);
                $('#area').prop('disabled', false);
                $('#branch').prop('disabled', false);
                $('#status').prop('disabled', false);
            }
        });

        $('.edittr').on('click', function(){
            $('#subBtn').val('Update');
            addBtn = $('#addBtn').val();
            if(addBtn == 'Add Branch'){
                $('#branch_name').prop('disabled', false);
                $('#address').prop('disabled', false);
                $('#area').prop('disabled', false);
                $('#contact_person').prop('disabled', false);
                $('#mobile').prop('disabled', false);
                $('#email').prop('disabled', false);
                $('#status').prop('disabled', false);
                $('#myid').val(id);

                $tr = $(this).closest('tr');
                var id = $(this).attr('data-id');
                var area = $(this).attr('data-area');
                var status = $(this).attr('data-status');
                var data = $tr.children("td").map(function(){
                    return $(this).text();
                }).get();

                $('#branch_name').val($.trim(data[0]));
                $('#address').val($.trim(data[1]));
                $('#area').val(area);
                $('#contact_person').val($.trim(data[3]));
                $('#mobile').val($.trim(data[4]));
                $('#email').val($.trim(data[5]));
                $('#status').val(status);
                $('#myid').val(id);  
            }
            if(addBtn == 'New User'){

                $('#full_name').prop('disabled', false);
                $('#email').prop('disabled', false);
                $('#password').prop('disabled', false);
                $('#password_confirmation').prop('disabled', false);
                $('#role').prop('disabled', false);
                $('#area').prop('disabled', false);
                $('#branch').prop('disabled', false);
                $('#status').prop('disabled', false);

                $tr = $(this).closest('tr');
                var id = $(this).attr('data-id');
                var area = $(this).attr('data-area');
                var branch = $(this).attr('data-branch');
                var role = $(this).attr('data-role');
                var status = $(this).attr('data-status');
                var op=" ";
                var info = $tr.children("td").map(function(){
                    return $(this).text();
                }).get();
                $("#divpass1").hide();
                $("#divpass2").hide();
                selectBranch(branch, function() {  
                    $('#full_name').val($.trim(info[0]));
                    $('#email').val($.trim(info[1]));
                    $('#area').val(area);
                    $('#branch').val(branch);
                    $('#role').val(role);
                    $('#status').val(status);
                    $('#myid').val(id);
                });
            }

            function selectBranch(branch, callback) {
                $.ajax({
                    type:'get',
                    url:'{!!URL::to('getBranchName')!!}',
                    data:{'id':area},
                    success:function(data)
                    {
                        //console.log('success');
                        //console.log(data);
                        //console.log(data.length);
                        op+='<option selected disabled>select branch</option>';
                        for(var i=0;i<data.length;i++){
                            op+='<option value="'+data[i].id+'">'+data[i].name+'</option>';
                        }
                        $('#branch').find('option').remove().end().append(op);
                        callback();
                    },
                });
            }
            
        });

        $('#branchForm').on('submit', function(e){
            e.preventDefault();
            subBtn = $('#subBtn').val();
            if(subBtn == 'Update'){
                var myid = $('#myid').val();
                $.ajax({
                    type: "PUT",
                    url: "/service_center_update/"+myid,
                    data: $('#branchForm').serialize(),
                    success: function(data){
                        if($.isEmptyObject(data.error)){
                            $('#branchModal').modal('hide');
                            alert("Data Updated");
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
                    url: "/service_center_add/",
                    data: $('#branchForm').serialize(),
                    success: function(data){
                        if($.isEmptyObject(data.error)){
                            $('#branchModal').modal('hide');
                            alert("Data Saved");
                            window.location.reload();
                        }else{
                            alert(data.error);
                        }
                    }
                });
            }
        });

        $('#userForm').on('submit', function(e){
            e.preventDefault();
            subBtn = $('#subBtn').val();
            if(subBtn == 'Update'){
                var myid = $('#myid').val();
                $.ajax({
                    type: "PUT",
                    url: "/user_up/"+myid,
                    data: $('#userForm').serialize(),
                    success: function(data){
                        if($.isEmptyObject(data.error)){
                            $('#userModal').modal('hide');
                            alert("Data Updated");
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
                    url: "/user_add/",
                    data: $('#userForm').serialize(),
                    success: function(data){
                        if($.isEmptyObject(data.error)){
                            $('#userModal').modal('hide');
                            alert("Data Saved");
                            window.location.reload();
                        }else{
                            alert(data.error);
                        }
                    }
                });
            }
        });
    });
</script>
