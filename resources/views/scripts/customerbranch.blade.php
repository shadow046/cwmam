<script type="text/javascript">

    var table;
    var bID;
    $(document).ready(function()
    {
        var url = window.location.pathname;
        var id = url.substring(url.lastIndexOf('/') + 1);
        bID = id;
        table =
        $('table.customerbranchTable').DataTable({ //user datatables
            "dom": 'lrtip',
            "language": {
                    "emptyTable": " "
                },
            processing: true,
            serverSide: false,
            ajax: "/customerbranch-list/"+id,
            columns: [
                { data: 'code', name:'code'},
                { data: 'customer_branch', name:'customer_branch',},
                { data: 'contact', name:'contact'},
                { data: 'status', name:'status',}
            ]
        });

        $('.tbsearch').delay().fadeOut('slow'); //hide search
            

        $('#search-ic').on("click", function (event) { //clear search box on hide
            for ( var i=0 ; i<=3 ; i++ ) {
                
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
        $('#branchBtn').val('ADD \"'+$('#name').val()+'\" BRANCH')
    });

    $('#branchBtn').on("click", function(){

        $('#customer_code').val('');
        $('#customer_name').val('');
        $('#subBtn').val('Save');
        $('#myid').val(bID);
        $('#customerbranchModal').modal('show');
    });

    $(document).on('click', '#saveBtn', function(e){ 
        e.preventDefault();
        subBtn = $('#saveBtn').val();
        bcode = $('#branch_code').val();
        bname = $('#branch_name').val();
        number = $('#number').val();
        address = $('#address').val();
        bid = bID;
        if(subBtn == 'Save'){
            $.ajax({
                type: "POST",
                url: "../cbranch_add",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    bcode: bcode,
                    bname: bname,
                    number: number,
                    address: address,
                    bid: bid
                },
                success: function(data){
                    if(data > '0'){
                        window.location.reload();
                    }else{
                        alert("Branch already registered");
                    }
                },
                error: function (data,error, errorThrown) {
                    alert(data.responseText);
                }
            });
        }
    });
</script>
