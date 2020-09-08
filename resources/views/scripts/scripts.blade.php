
<script type="text/javascript">
    $(document).ready(function()
    {
        $(document).on('change','.area',function()
        {
            var id=$(this).val();
            var sel=$(this).parent();
            var op=" ";
            //console.log(id);
            $.ajax({
                type:'get',
                url:'{!!URL::to('getBranchName')!!}',
                data:{'id':id},
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
                },
                
            });
        });

        $('#addBtn').on('click', function(e){
            e.preventDefault();
            $('#subBtn').val('Save');
            $('#branchModal').modal('show');
            $('#branch_name').val('');
            $('#address').val('');
            $('#area').val('');
            $('#contact_person').val('');
            $('#mobile').val('');
            $('#email').val('');
            $('#status').val('');
 
        });


        $('.edittr').on('click', function(){
            $('#subBtn').val('Update');
            $('#branchModal').modal('show');
            
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
        });

        $('#editForm').on('submit', function(e){
            e.preventDefault();
            subBtn = $('#subBtn').val();
            if(subBtn == 'Update'){
                var myid = $('#myid').val();
                $.ajax({
                    type: "PUT",
                    url: "/service_center_update/"+myid,
                    data: $('#editForm').serialize(),
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
                    data: $('#editForm').serialize(),
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
    });
</script>
