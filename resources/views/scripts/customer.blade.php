<script type="text/javascript">
    var customertable;
    $(document).ready(function()
    {
        customertable =
        $('table.customerTable').DataTable({ //user datatables
            "dom": 'lrtip',
            "language": {
                    "emptyTable": " "
                },
            processing: true,
            serverSide: false,
            ajax: 'customer-list',
            columns: [
                { data: 'code', name:'code'},
                { data: 'customer', name:'customer',}
            ]
        });

        $('.tbsearch').delay().fadeOut('slow'); //hide search
            

        $('#search-ic').on("click", function (event) { //clear search box on hide
            for ( var i=0 ; i<=6 ; i++ ) {
                
                $('.fl-'+i).val('').change();
                customertable
                .columns(i).search( '' )
                .draw();
            }
            $('.tbsearch').toggle();
            
        });

        $('.filter-input').keyup(function() { //search columns
            customertable.column( $(this).data('column'))
                .search( $(this).val())
                .draw();
        });


    });

    $(document).on("click", "#customerTable tr", function () {
    
        var trdata = customertable.row(this).data();
        var id = trdata.id;
        window.location.href = 'customer/'+trdata.id;
    
    });

    $('#customerBtn').on("click", function(){

        $('#customer_code').val('');
        $('#customer_name').val('');
        $('#subBtn').val('Save');
        $('#customerModal').modal('show');
    });

    $('#customerForm').on('submit', function(e){ //user modal update/save button
        e.preventDefault();
        subBtn = $('#subBtn').val();
        if(subBtn == 'Update'){
            var myid = $('#myid').val();
            $.ajax({
                type: "PUT",
                url: "/user_update/"+myid,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: $('#userForm').serialize(),
                success: function(datca){
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
                url: "customer_add",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: $('#customerForm').serialize(),
                success: function(data){
                    if(data > '0'){
                        window.location.reload();
                    }else{
                        alert("Customer already registered");
                    }
                },
                error: function (data,error, errorThrown) {
                    alert(data.responseText);
                }
            });
        }
    });

</script>

