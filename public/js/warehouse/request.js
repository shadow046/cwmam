var r=1,y=1,interval=null;
$(document).ready(function(){var a=new Date,f=String(a.getHours()).padStart(2,"0")%12||12,b=12>String(a.getHours()).padStart(2,"0")||24===String(a.getHours()).padStart(2,"0")?"AM":"PM",d="January February March April May June July August September October November December".split(" ");$("#date").val(d[a.getMonth()]+" "+a.getDate()+", "+a.getFullYear()+" "+f+":"+String(a.getMinutes()).padStart(2,"0")+b);$("#sdate").val(d[a.getMonth()]+" "+a.getDate()+", "+a.getFullYear()+" "+f+":"+String(a.getMinutes()).padStart(2,
"0")+b);var h=$("table.requestTable").DataTable({dom:"lrtip",language:{emptyTable:" "},processing:!0,serverSide:!0,ajax:{url:"requests",error:function(c,e,g){401==c.status&&(window.location.href="/login")}},columns:[{data:"created_at",name:"date",width:"14%"},{data:"request_no",name:"request_no",width:"14%"},{data:"reqBy",name:"reqBy",width:"14%"},{data:"branch",name:"branch",width:"14%"},{data:"area",name:"area",width:"14%"},{data:"status",name:"status",width:"14%"}]});$("#requestTable tbody").on("click",
"tr",function(){var c=h.row(this).data();$("#requestTable tbody tr:eq(0)").data();if("SCHEDULED"==c.status){$("#prcBtn").hide();$(".sched").show();$("#printBtn").show();var e=new Date(c.sched);$("#sched").val(d[e.getMonth()]+" "+e.getDate()+", "+e.getFullYear())}else"PENDING"==c.status&&($("#prcBtn").show(),$(".sched").hide(),$("#sched").val(""),$("#printBtn").hide());$("#date").val(c.created_at);$("#reqno").val(c.request_no);$("#branch").val(c.branch);$("#name").val(c.reqBy);$("#area").val(c.area);
$("#reqbranch").val(c.branch_id);$("table.requestDetails").dataTable().fnDestroy();$("table.schedDetails").dataTable().fnDestroy();"PENDING"==c.status?($("#printBtn").hide(),$("table.schedDetails").hide(),$("table.requestDetails").show(),$("table.requestDetails").DataTable({dom:"rt",language:{emptyTable:" "},processing:!0,serverSide:!0,ajax:"/requests/"+c.request_no,columnDefs:[{className:"dt-body-center",targets:"_all"}],columns:[{data:"items_id",name:"items_id"},{data:"item_name",name:"item_name"},
{data:"quantity",name:"quantity"},{data:"purpose",name:"purpose"}]})):"SCHEDULED"==c.status&&($("#printBtn").show(),$("table.requestDetails").hide(),$("table.schedDetails").show(),$("table.schedDetails").DataTable({dom:"rt",language:{emptyTable:" "},processing:!0,serverSide:!0,ajax:"/send/"+c.request_no,columnDefs:[{className:"dt-center",targets:"_all"}],columns:[{data:"items_id",name:"items_id"},{data:"item_name",name:"item_name"},{data:"serial",name:"serial"}]}));$("#requestModal").modal("show")})});
$(document).on("click","#prcBtn",function(){$("#myid").val();$("#requestModal .closes").click();$("#sdate").val($("#date").val());$("#sreqno").val($("#reqno").val());$("#sbranch").val($("#branch").val());$("#sname").val($("#name").val());$("#sendModal").modal("show");for(var a=$("#sreqno").val(),f=" ",b=1;b<=y;b++)1!=b&&$("#row"+b).hide(),$("#stock"+b).css("border",""),$("#qty"+b).css("border",""),$("#category"+b).val("select category"),$("#item"+b).val("select item code"),$("#desc"+b).val("select description"),
$("#qty"+b).val("Qty"),$("#stock"+b).val("");$("table.sendDetails").dataTable().fnDestroy();$("table.sendDetails").DataTable({dom:"rt",language:{emptyTable:" "},processing:!0,serverSide:!0,ajax:"/requests/"+$("#sreqno").val(),columnDefs:[{className:"dt-body-center",targets:"_all"}],columns:[{data:"items_id",name:"items_id"},{data:"item_name",name:"item_name"},{data:"quantity",name:"quantity"},{data:"purpose",name:"purpose"}]});$.ajax({url:"getcatreq",headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")},
dataType:"json",type:"get",async:!1,data:{reqno:a},success:function(d){f+='<option selected value="select" disabled>select category</option>';for(var h=0;h<d.length;h++)f+='<option value="'+d[h].id+'">'+d[h].category+"</option>";$("#category1").find("option").remove().end().append(f)},error:function(d,h,c){alert(d.responseText)}})});
$(document).on("click",".add_item",function(){var a=$(this).attr("btn_id");if("Add Item"==$(this).val()){var f=0;if($("#category"+a).val()&&$("#item"+a).val()&&$("#desc"+a).val()&&$("#serial"+a).val()){var b=$("#item"+a).val();(function(c){$.ajax({type:"get",url:"getstock",async:!1,data:{id:b},success:function(e){if(""!=e){e=e[0].stock;for(var g=1;g<=y;g++)g!=a&&$("#item"+g).val()==$("#item"+a).val()&&($("#serial"+g).val()==$("#serial"+a).val()?($("#serial"+a).css("color","red"),$("#serial"+a).css("border",
"5px solid red"),f++):($("#serial"+a).css("color","black"),$("#serial"+a).css("border","")),$("#item"+g).prop("disabled")&&($("#stock"+g).val(e),e--));g==y&&($("#stock"+a).val(e),0>=e&&($("#stock"+a).css("color","red"),$("#stock"+a).css("border","5px solid red"),f++),$("#stock"+a).css("color","black"),$("#stock"+a).css("border",""))}}})})(stock1)}else return f++,!1;if(0==f){y++;var d='<div class="row no-margin" id="row'+y+'"><div class="col-md-2 form-group"><select id="category'+y+'" class="form-control category" row_count="'+
y+'"></select></div><div class="col-md-2 form-group"><select id="item'+y+'" class="form-control item" row_count="'+y+'"><option selected disabled>select item code</option></select></div><div class="col-md-3 form-group"><select id="desc'+y+'" class="form-control desc" row_count="'+y+'"><option selected disabled>select description</option></select></div><div class="col-md-2 form-group"><input type="text" class="form-control serial" row_count="'+y+'" name="serial1" id="serial'+y+'" placeholder="input serial"></div><div class="col-md-2 form-group"><input type="number" class="form-control" name="stock'+
y+'" id="stock'+y+'" placeholder="0" style="width: 6em" disabled></div><div class="col-md-1 form-group"><input type="button" class="add_item btn btn-xs btn-primary" btn_id="'+y+'" value="Add Item"></div></div>';$(this).val("Remove");$("#category"+a).prop("disabled",!0);$("#item"+a).prop("disabled",!0);$("#desc"+a).prop("disabled",!0);$("#serial"+a).prop("disabled",!0);20>r&&($("#reqfield").append(d),$("#category"+a).find("option").clone().appendTo("#category"+y),r++)}else return!1}else{20==r&&(y++,
d='<div class="row no-margin" id="row'+y+'"><div class="col-md-2 form-group"><select id="category'+y+'" class="form-control category" row_count="'+y+'"></select></div><div class="col-md-2 form-group"><select id="item'+y+'" class="form-control item" row_count="'+y+'"><option selected disabled>select item code</option></select></div><div class="col-md-3 form-group"><select id="desc'+y+'" class="form-control desc" row_count="'+y+'"><option selected disabled>select description</option></select></div><div class="col-md-2 form-group"><input type="text" class="form-control serial" row_count="'+
y+'" name="serial1" id="serial'+y+'" placeholder="input serial"></div><div class="col-md-2 form-group"><input type="number" class="form-control" name="stock'+y+'" id="stock'+y+'" placeholder="0" style="width: 6em" disabled></div><div class="col-md-1 form-group"><input type="button" class="add_item btn btn-xs btn-primary" btn_id="'+y+'" value="Add Item"></div></div>',$("#reqfield").append(d),$("#category"+a).find("option").clone().appendTo("#category"+y),r++);b=$("#item"+a).val();var h=0;$("#category"+
a).val("select category");$("#item"+a).val("select item code");$("#desc"+a).val("select description");$("#serial"+a).val("select serial");$("#category"+a).prop("disabled",!1);$("#item"+a).prop("disabled",!1);$("#desc"+a).prop("disabled",!1);$("#serial"+a).prop("disabled",!1);$("#row"+a).hide();$(this).val("Add Item");(function(c){$.ajax({type:"get",url:"getstock",data:{id:b},async:!1,success:function(e){if(""!=e)for(var g=1;g<=y;g++)g!=a&&$("#item"+g).val()==b&&($("#stock"+g).val(e[0].stock-h),h++)}})})(stock1);
r--}});
$(document).on("click",".sub_Btn",function(a){a.preventDefault();var f=$("#sreqno").val(),b=1;if($("#datesched").val())for(var d=1;d<=y;d++)$("#row"+d).is(":visible")&&"Remove"==$(".add_item[btn_id='"+d+"']").val()&&(b++,$("#category"+d).val(),a=$("#item"+d).val(),$("#desc"+d).val(),serial=$("#serial"+d).val(),datesched=$("#datesched").val(),branchid=$("#reqbranch").val(),$.ajax({url:"update",headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")},dataType:"json",type:"PUT",data:{item:a,serial:serial,
reqno:f,branchid:branchid}})),d==y&&1<b&&($.ajax({url:"update",headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")},type:"PUT",data:{reqno:f,datesched:datesched,stat:"ok",status:"1"},dataType:"json"}),window.location.href="/print/"+f);else alert("Please select schedule date!!!")});
$(document).on("change",".desc",function(){var a=$(this).attr("row_count"),f=$(this).val(),b=0,d=" ";$("#item"+a).val(f);for(var h=1;h<=y;h++)h!=a&&$("#desc"+h).val()==$(this).val()&&b++;(function(c){$.ajax({type:"get",url:"getstock",data:{id:f},async:!1,success:function(e){""!=e?($("#stock"+a).val(e[0].stock-b),$("#stock"+a).css("color","black"),$("#stock"+a).css("border",""),0>=$("#stock"+a).val()&&($("#stock"+a).css("color","red"),$("#stock"+a).css("border","5px solid red"))):($("#stock"+a).val("0"),
$("#stock"+a).css("color","red"),$("#stock"+a).css("border","5px solid red"))}});$.ajax({type:"get",url:"getserials",data:{id:f},async:!1,success:function(e){d+='<option selected value="select" disabled>select serial</option>';for(var g=0;g<e.length;g++)d+='<option value="'+e[g].serial+'">'+e[g].serial+"</option>";$("#serial"+a).find("option").remove().end().append(d)}})})(stock1);for(h=1;h<=y;h++)$("#desc"+h).val()==$(this).val()&&(rmserial=$("#serial"+h).val(),$("#serial"+a+" option[value='"+rmserial+
"']").remove())});
$(document).on("change",".item",function(){var a=$(this).attr("row_count"),f=$(this).val(),b=0,d=" ",h="";$("#desc"+a).val(f);for(var c=1;c<=y;c++)c!=a&&$("#item"+c).val()==$(this).val()&&b++;(function(e){$.ajax({type:"get",url:"getstock",data:{id:f},async:!1,success:function(g){if(""!=g){if($("#stock"+a).val(g[0].stock-b),$("#stock"+a).css("color","black"),$("#stock"+a).css("border",""),0>$("#stock"+a).val()||0==$("#stock"+a).val())$("#stock"+a).css("color","red"),$("#stock"+a).css("border","5px solid red")}else $("#stock"+
a).val("0"),$("#stock"+a).css("color","red"),$("#stock"+a).css("border","5px solid red")}});$.ajax({type:"get",url:"getserials",data:{id:f},async:!1,success:function(g){d+='<option selected value="select" disabled>select serial</option>';for(var k=0;k<g.length;k++)d+='<option value="'+g[k].serial+'">'+g[k].serial+"</option>";$("#serial"+a).find("option").remove().end().append(d)}})})(stock1);for(c=1;c<=y;c++)$("#item"+c).val()==$(this).val()&&(h=$("#serial"+c).val(),$("#serial"+a+" option[value='"+
h+"']").remove())});
$(document).on("change",".category",function(){var a=" ",f=" ",b=$(this).attr("row_count"),d=$(this).val();$("#stock"+b).val("0");(function(h){$.ajax({type:"get",url:"itemcode",data:{id:d},success:function(c){a+='<option selected value="select" disabled>select item code</option>';f+='<option selected value="select" disabled>select description</option>';for(var e=0;e<c.length;e++)a+='<option value="'+c[e].id+'">'+c[e].id+"</option>",f+='<option value="'+c[e].id+'">'+c[e].item.toUpperCase()+"</option>";
$("#item"+b).find("option").remove().end().append(a);$("#desc"+b).find("option").remove().end().append(f)}})})(item1);$("#item"+b).val("select itemcode");$("#desc"+b).val("select description");$("#stock"+b).css("border","");$("#item"+b).css("border","")});$(document).on("click",".cancel",function(){window.location.href="request"});$(document).on("click","#printBtn",function(){window.location.href="/print/"+$("#reqno").val()});