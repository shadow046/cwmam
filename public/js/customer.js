var customertable;$(document).ready(function(){customertable=$("table.customerTable").DataTable({dom:"lrtip",language:{emptyTable:" "},processing:!0,serverSide:!1,ajax:"customer-list",columns:[{data:"code",name:"code"},{data:"customer",name:"customer"}]})});$(document).on("click","#customerTable tr",function(){var a=customertable.row(this).data();window.location.href="customer/"+a.id});