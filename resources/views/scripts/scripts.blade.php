<script type="text/javascript">
    $(document).ready(function()
    {
        $(document).on('change','.area',function()
        {
            var id=$(this).val();
            var sel=$(this).parent();
            var op=" ";
            //console.log(id);
            $.ajax(
            {
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
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){

        $('.edittr').on('click', function(){
            $('#branchModal').modal('show');
            
            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function(){
                return $(this).text();
            }).get();

            console.log(data);

            $('#bname').val($.trim(data[0]));
            $('#address').val($.trim(data[1]));
            $('#area').val($.trim(data[2]));
            $('#cname').val($.trim(data[3]));
            $('#mobile').val($.trim(data[4]));
            $('#email').val($.trim(data[5]));
            $('#status').val($.trim(data[6]));
        });
    });
        
</script>