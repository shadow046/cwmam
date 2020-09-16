
<script type="text/javascript">

    $(document).ready(function()
    {
        var d = new Date();
        var hour = String(d.getHours()).padStart(2, '0') % 12 || 12
        var ampm = (String(d.getHours()).padStart(2, '0') < 12 || String(d.getHours()).padStart(2, '0') === 24) ? "AM" : "PM";
        var months = ["January","February","March","April","May","June","July","August","September","October","November","December"];
        $('#requestModal').modal('show');
        $('#date').val(months[d.getMonth()]+' '+d.getDate()+', ' +d.getFullYear()+' '+hour+':'+String(d.getMinutes()).padStart(2, '0')+ampm);
        $('#sdate').val(months[d.getMonth()]+' '+d.getDate()+', ' +d.getFullYear()+' '+hour+':'+String(d.getMinutes()).padStart(2, '0')+ampm);
        var op = " "
        op+='<input text="text">';
        for(var i=0;i<4;i++){
            op+='<input text="text">';
        }
        $('.item').append(op);

        
        
        $('#prcBtn').on('click', function(e){ //show user/branch modal
            e.preventDefault();
            var id = $('#myid').val();
            $("#requestModal .close").click();
            $('#sendModal').modal('show');
        });

        $('#sendForm').on('submit', function(){ //user modal update/save button
            var d = $('#sched').val();
            var sched = new Date(d);
            alert(months[sched.getMonth()]+' '+sched.getDate()+', ' +sched.getFullYear());
        });

            var max_fields      = 10; //maximum input boxes allowed
            var wrapper         = $(".items"); //Fields wrapper
            var add_button      = $(".add_field_button"); //Add button ID

            var x = 1; //initlal text box count
            $(add_button).click(function(e){ //on add input button click
                e.preventDefault();
                if(x < max_fields){ //max input box allowed
                    x++; //text box increment
                    $(wrapper).append('<div class="row no-margin "><div class="col-lg-12 form-group row"><div class="col-lg-2"><input type="text" list="itemlist" class="form-control form-control-sm" name="itemcode[]" id="itemcode[]" placeholder="item code"></div><div class="col-lg-4"><input type="text" class="form-control form-control-sm" name="itemcode[]" id="itemcode[]" placeholder="Description"></div><div class="col-lg-2"><input type="number" class="form-control form-control-sm" name="itemcode[]" id="itemcode[]" placeholder="Qty."></div><div class="col-lg-2"><button type="button" class="add_field_button btn btn-primary">remove</button></div></div></div>'); //add input box
                }
            });
            $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                e.preventDefault(); $(this).parent('div').remove(); x--;
            });
        });
</script>
