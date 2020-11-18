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
            serverSide: true,
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
        if($('#editBtn').val() == 'Cancel'){
            $('#myid').val(id);
            $('#subBtn').val('Update');
            $('#customer_code').val(trdata.code);
            $('#customer_name').val(trdata.customer);
            $('#customerModal').modal('show');
        }else{
        window.location.href = 'customer/'+id;
        }
    });

    $('#customerBtn').on("click", function(){

        $('#customer_code').val('');
        $('#customer_name').val('');
        $('#subBtn').val('Save');
        $('#customerModal').modal('show');
        $('#editBtn').val('Edit Customer Details');
    });

    $('#editBtn').on("click", function(){
        if($(this).val() == 'Cancel'){
            $('#editBtn').val('Edit Customer Details');
        }else{
            $('#editBtn').val('Cancel');
        }
    });


    $('#customerForm').on('submit', function(e){ //user modal update/save button
        e.preventDefault();
        subBtn = $('#subBtn').val();
        if(subBtn == 'Update'){
            var myid = $('#myid').val();
            $.ajax({
                type: "PUT",
                url: "customer_add",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: $('#customerForm').serialize(),
                success: function(data){
                    if(data > '0'){
                        customertable.draw();
                        $('#customerModal .close').click();
                    }else{
                        alert("Customer already registered");
                    }
                },
                error: function (data,error, errorThrown) {
                    alert(data.responseText);
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
                        customertable.draw();
                        $('#customerModal .close').click();
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

