var table;
$(document).ready(function(){table=$("table.defectiveTable").DataTable({dom:"lrtip",language:{emptyTable:" "},processing:!0,serverSide:!0,ajax:"return-table",columns:[{data:"date",name:"date"},{data:"branch",name:"branch"},{data:"category",name:"category"},{data:"item",name:"item"},{data:"serial",name:"serial"},{data:"status",name:"status"}]});$(".tbsearch").delay().fadeOut("slow");$("#search-ic").on("click",function(){for(var a=0;5>=a;a++)$(".fl-"+a).val("").change(),table.columns(a).search("").draw();$(".tbsearch").toggle()});
$(".filter-input").keyup(function(){table.column($(this).data("column")).search($(this).val()).draw()})});
$(document).on("click","#defectiveTable tr",function(){var a=table.row(this).data();console.log(a);$("#branch_id").val(a.branchid);$("#date").val(a.date);$("#description").val(a.item);$("#status").val(a.status);$("#myid").val(a.id);$("#serial").val(a.serial);"For receiving"==a.status?($("#submit_Btn").val("Received"),$("#submit_Btn").show()):"For repair"==a.status?($("#submit_Btn").val("Repaired"),$("#submit_Btn").show()):"pending"==a.status?($("#submit_Btn").val("pending"),$("#submit_Btn").show()):
$("#submit_Btn").hide();$("#returnModal").modal({backdrop:"static",keyboard:!1})});
$(document).on("click","#submit_Btn",function(){var a=$("#branch_id").val(),b=$("#myid").val(),c=$("#submit_Btn").val();"Received"==$("#submit_Btn").val()&&$.ajax({url:"return-update",headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")},dataType:"json",type:"PUT",data:{id:b,branch:a,status:c},success:function(d){window.location.href="return"}});"Repaired"==$("#submit_Btn").val()&&$.ajax({url:"return-update",headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")},dataType:"json",
type:"PUT",data:{id:b,branch:a,status:c},success:function(d){window.location.href="return"}});"pending"==$("#submit_Btn").val()&&$.ajax({url:"return-update",headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")},dataType:"json",type:"PUT",data:{id:b,branch:a,status:c},success:function(d){window.location.href="return"}})});$(document).on("click",".cancel",function(){window.location.href="return"});