$(document).on("click",".sub_Btn",function(){for(var a,b,d=1,c=1;c<=y;c++)$("#row"+c).is(":visible")&&"Remove"==$(".add_item[btn_id='"+c+"']").val()&&(d++,$(".sub_Btn").prop("disabled",!0),a=$("#category"+c).val(),b=$("#item"+c).val(),serial=$("#serial"+c).val(),$.ajax({url:"store",headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")},dataType:"json",type:"POST",data:{item:b,serial:serial,cat:a}}));1<d&&(alert("Inventory updated!!!"),window.location.href="stocks")});
$(document).on("change",".category",function(){var a=" ",b=" ",d=$(this).attr("row_count"),c=$(this).val();(function(g){$.ajax({type:"get",url:"itemcode",data:{id:c},success:function(f){a+='<option selected value="select" disabled>select item code</option>';b+='<option selected value="select" disabled>select description</option>';for(var e=0;e<f.length;e++)a+='<option value="'+f[e].id+'">'+f[e].id+"</option>",b+='<option value="'+f[e].id+'">'+f[e].item.toUpperCase()+"</option>";$("#item"+d).find("option").remove().end().append(a);
$("#desc"+d).find("option").remove().end().append(b)}})})(item1);$("#item"+d).val("select itemcode");$("#desc"+d).val("select description")});$(document).on("change",".item",function(){var a=$(this).attr("row_count"),b=$(this).val();$("#desc"+a).val(b)});$(document).on("change",".desc",function(){var a=$(this).attr("row_count"),b=$(this).val();$("#item"+a).val(b)});