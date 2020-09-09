<script type="text/javascript">
    $(document).ready(function()
    {
        $('.edittr').on('click', function(){
            if(window.location.href.includes('service_center')) {
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
            if(window.location.href.includes('user')) {
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
    });
</script>