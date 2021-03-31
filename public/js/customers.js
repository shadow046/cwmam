var lcc;
var mspg;
var puregold;
var shoemart;
var tables;
var select = 'lcc';
var search;
$(document).ready(function(){

    lcc =
        $('table.lccTable').DataTable({ 
            "dom": 'lrtip',
            "language": {
                "emptyTable": " ",
                "processing": "Searching"
            },
            processing: true,
            serverSide: true,
            ajax: {
                url: 'api/lcc',
                error: function(data) {
                    console.log(data);
                },
                beforeSend: function(xhrObj){
                    xhrObj.setRequestHeader("Authorization","Bearer "+$('meta[name="tok"]').attr('content'));
                },
            },
            columns: [
                { data: 'Customer_name', name:'Customer_name'},
                { data: 'Item_description', name:'Item_description', "width": "14%"},
                { data: 'Serial', name:'Serial', "width": "14%"},
                { data: 'Receiving_date', name:'Receiving_date', "width": "14%"},
                { data: 'End_warranty', name:'End_warranty', "width": "14%"},
                { data: 'Specifications', name:'Specifications', "width": "14%"},
                { data: 'Status', name:'Status', "width": "14%"}
            ]
        });
    $("#LCC").toggleClass('bg-dark');
    $("#lccTable").toggle();
});

$('.import').on('click', function(){
    $('#importModal').modal({backdrop: 'static', keyboard: false});
    if (select != '') {
        $('#lccForm').attr('action', select);
        $('#h6').text('Import '+select+' data');
    }
});

$('.submit').on('click', function(e){
    if (!$('#upload').val()) {
        e.preventDefault();
        alert('Please Upload File');
    }
});

$('.cancel').on('click', function(){
    window.location.href = 'Customers';
});

$('#searchBtn').on('click', function(){
    $.ajax({
        url: 'api/global',
        dataType: 'json',
        type: 'GET',
        data: {
            serial: $('#search').val()
        },
        error: function (data) {
            alert(data.responseText);
        },
        beforeSend: function(xhrObj){
            xhrObj.setRequestHeader("Authorization","Bearer "+$('meta[name="tok"]').attr('content'));
        },
        success: function(data){
            console.log(data)
            console.log(data.type)
            search = $('#search').val();
            if (data.type == 'lcc') {
                if (select != data.type) {
                    $('#LCC').click();
                }
                $('#search').val(search);
                lcc.column(2)
                    .search($('#search').val())
                    .draw();
                mspg
                    .columns(4).search( '' )
                    .draw();
                puregold
                    .columns(2).search( '' )
                    .draw();
                shoemart
                    .columns(2).search( '' )
                    .draw();
                smma
                    .columns(2).search( '' )
                    .draw();
            }else if (data.type == 'mspg') {
                if (select != data.type) {
                    $('#MSPG').click();
                }
                $('#search').val(search);
                mspg.column(4)
                    .search($('#search').val())
                    .draw();
                lcc
                    .columns(2).search( '' )
                    .draw();
                puregold
                    .columns(2).search( '' )
                    .draw();
                shoemart
                    .columns(2).search( '' )
                    .draw();
                smma
                    .columns(2).search( '' )
                    .draw();
            }else if( data.type == 'pg') {
                if (select != data.type) {
                    $('#PUREGOLD').click();
                }
                $('#search').val(search);
                puregold.column(2)
                    .search($('#search').val())
                    .draw();
                mspg
                    .columns(4).search( '' )
                    .draw();
                lcc
                    .columns(2).search( '' )
                    .draw();
                shoemart
                    .columns(2).search( '' )
                    .draw();
                smma
                    .columns(2).search( '' )
                    .draw();
            }else if (data.type == 'sm') {
                if (select != data.type) {
                    $('#SHOEMART').click();
                }
                $('#search').val(search);
                shoemart.column(2)
                    .search($('#search').val())
                    .draw();
                mspg
                    .columns(4).search( '' )
                    .draw();
                puregold
                    .columns(2).search( '' )
                    .draw();
                lcc
                    .columns(2).search( '' )
                    .draw();
                smma
                    .columns(2).search( '' )
                    .draw();
            }else if (data.type =='smma') {
                if (select != data.type) {
                    $('#SMMA').click();
                }
                $('#search').val(search);
                smma.column(3)
                    .search($('#search').val())
                    .draw();
                mspg
                    .columns(4).search( '' )
                    .draw();
                puregold
                    .columns(2).search( '' )
                    .draw();
                shoemart
                    .columns(2).search( '' )
                    .draw();
                lcc
                    .columns(2).search( '' )
                    .draw();
            }else if (data.type =='none') {
                alert('Serial not found!');
            }
        }
    });
});

$('#clearBtn').on('click', function() {
    if (select == 'lcc') {
        $('#LCC').click();
        $('#LCC').click();
    }else if (select == 'mspg') {
        $('#MSPG').click();
        $('#MSPG').click();
    }else if (select == 'pg') {
        $('#PUREGOLD').click();
        $('#PUREGOLD').click();
    }else if (select == 'sm') {
        $('#SHOEMART').click();
        $('#SHOEMART').click();
    }else if (select == 'smma') {
        $('#SMMA').click();
        $('#SMMA').click();
    }
    $('#search').val('');
});

$('#LCC').on('click', function () {
    $('table.lccTable').dataTable().fnDestroy();
    $("#LCC").toggleClass('bg-dark');
    $("#MSPG").removeClass('bg-dark');
    $("#PUREGOLD").removeClass('bg-dark');
    $("#SHOEMART").removeClass('bg-dark');
    $("#SMMA").removeClass('bg-dark');
    $("#lccTable").toggle();
    $("#mspgTable").hide();
    $("#shoemartTable").hide();
    $("#puregoldTable").hide();
    $("#smmaTable").hide();
    $('#search').val('');
    $('table.lccTable').dataTable().fnDestroy();
    select = 'lcc';
    lcc =
        $('table.lccTable').DataTable({ 
            "dom": 'lrtip',
            "language": {
                "emptyTable": " ",
                "processing": "Searching"
            },
            processing: true,
            serverSide: true,
            ajax: {
                url: 'api/lcc',
                error: function(data) {
                    alert(data.responseText);
                },
                beforeSend: function(xhrObj){
                    xhrObj.setRequestHeader("Authorization","Bearer "+$('meta[name="tok"]').attr('content'));
                },
            },
            columns: [
                { data: 'Customer_name', name:'Customer_name'},
                { data: 'Item_description', name:'Item_description', "width": "14%"},
                { data: 'Serial', name:'Serial', "width": "14%"},
                { data: 'Receiving_date', name:'Receiving_date', "width": "14%"},
                { data: 'End_warranty', name:'End_warranty', "width": "14%"},
                { data: 'Specifications', name:'Specifications', "width": "14%"},
                { data: 'Status', name:'Status', "width": "14%"}
            ]
        });
});

$('#MSPG').on('click', function () {
    $("#LCC").removeClass('bg-dark');
    $("#MSPG").toggleClass('bg-dark');
    $("#PUREGOLD").removeClass('bg-dark');
    $("#SHOEMART").removeClass('bg-dark');
    $("#SMMA").removeClass('bg-dark');
    $("#lccTable").hide();
    $("#puregoldTable").hide();
    $("#shoemartTable").hide();
    $("#smmaTable").hide();
    $("#mspgTable").toggle();
    $('#search').val('');
    $('table.mspgTable').dataTable().fnDestroy();
    select = 'mspg';
    mspg =
        $('table.mspgTable').DataTable({ 
            "dom": 'lrtip',
            "language": {
                "emptyTable": " ",
                "processing": "Searching"
            },
            processing: true,
            serverSide: true,
            ajax: {
                url: 'api/mspg',
                error: function(data) {
                    alert(data.responseText);
                },
                beforeSend: function(xhrObj){
                    xhrObj.setRequestHeader("Authorization","Bearer "+$('meta[name="tok"]').attr('content'));
                },
            },
            columns: [
                { data: 'Company'},
                { data: 'Branch'},
                { data: 'Store_name'},
                { data: 'Brand'},
                { data: 'Serial'},
                { data: 'Start'},
                { data: 'End'},
                { data: 'Status'}
            ]
        });
});

$('#PUREGOLD').on('click', function () {
    $("#LCC").removeClass('bg-dark');
    $("#MSPG").removeClass('bg-dark');
    $("#PUREGOLD").toggleClass('bg-dark');
    $("#SHOEMART").removeClass('bg-dark');
    $("#SMMA").removeClass('bg-dark');
    $("#puregoldTable").toggle();
    $("#lccTable").hide();
    $("#shoemartTable").hide();
    $("#smmaTable").hide();
    select = 'pg';
    $("#mspgTable").hide();
    $('#search').val('');
    $('table.puregoldTable').dataTable().fnDestroy();
    puregold =
        $('table.puregoldTable').DataTable({ 
            "dom": 'lrtip',
            "language": {
                "emptyTable": " ",
                "processing": "Searching"
            },
            processing: true,
            serverSide: true,
            ajax: {
                url: 'api/puregold',
                error: function(data) {
                    alert(data.responseText);
                },
                beforeSend: function(xhrObj){
                    xhrObj.setRequestHeader("Authorization","Bearer "+$('meta[name="tok"]').attr('content'));
                },
            },
            columns: [
                { data: 'Customer_name', name:'Customer_name'},
                { data: 'Item_description', name:'Item_description', "width": "14%"},
                { data: 'Serial', name:'Serial', "width": "14%"},
                { data: 'Receiving_date', name:'Receiving_date', "width": "14%"},
                { data: 'End_warranty', name:'End_warranty', "width": "14%"},
                { data: 'Specifications', name:'Specifications', "width": "14%"},
                { data: 'Status', name:'Status', "width": "14%"}
            ]
        });
});

$('#SHOEMART').on('click', function () {
    $("#LCC").removeClass('bg-dark');
    $("#MSPG").removeClass('bg-dark');
    $("#PUREGOLD").removeClass('bg-dark');
    $("#SHOEMART").toggleClass('bg-dark');
    $("#SMMA").removeClass('bg-dark');
    $("#lccTable").hide();
    $("#puregoldTable").hide();
    $("#shoemartTable").toggle();
    $("#mspgTable").hide();
    select = 'sm';
    $('#search').val('');
    $('table.shoemartTable').dataTable().fnDestroy();
    $("#smmaTable").hide();
    shoemart =
        $('table.shoemartTable').DataTable({ 
            "dom": 'lrtip',
            "language": {
                "emptyTable": " ",
                "processing": "Searching"
            },
            processing: true,
            serverSide: true,
            ajax: {
                url: 'api/shoemart',
                error: function(data) {
                    alert(data.responseText);
                },
                beforeSend: function(xhrObj){
                    xhrObj.setRequestHeader("Authorization","Bearer "+$('meta[name="tok"]').attr('content'));
                },
            },
            columns: [
                { data: 'Customer_name', name:'Customer_name'},
                { data: 'Item_description', name:'Item_description', "width": "14%"},
                { data: 'Serial', name:'Serial', "width": "14%"},
                { data: 'Receiving_date', name:'Receiving_date', "width": "10%"},
                { data: 'End_warranty', name:'End_warranty', "width": "10%"},
                { data: 'Keyboard_touchscreen', name:'KB/touchscreen'},
                { data: 'Specifications', name:'Specifications'},
                { data: 'Status', name:'Status', "width": "10%"}
            ]
        });
});

$('#SMMA').on('click', function () {
    $("#LCC").removeClass('bg-dark');
    $("#MSPG").removeClass('bg-dark');
    $("#PUREGOLD").removeClass('bg-dark');
    $("#SHOEMART").removeClass('bg-dark');
    $("#SMMA").toggleClass('bg-dark');
    $("#lccTable").hide();
    $("#puregoldTable").hide();
    $("#shoemartTable").hide();
    $("#mspgTable").hide();
    $('table.smmaTable').dataTable().fnDestroy();
    select = 'smma';
    $("#smmaTable").toggle();
    smma =
        $('table.smmaTable').DataTable({ 
            "dom": 'lrtip',
            "language": {
                "emptyTable": " ",
                "processing": "Searching"
            },
            processing: true,
            serverSide: true,
            ajax: {
                url: 'api/smma',
                error: function(data) {
                    alert(data.responseText);
                },
                beforeSend: function(xhrObj){
                    xhrObj.setRequestHeader("Authorization","Bearer "+$('meta[name="tok"]').attr('content'));
                },
            },
            columns: [
                { data: 'Company', name:'Company'},
                { data: 'Location', name:'Location', "width": "14%"},
                { data: 'Model', name:'Model', "width": "14%"},
                { data: 'Serial', name:'Serial', "width": "14%"},
                { data: 'Start', name:'Start', "width": "14%"},
                { data: 'End', name:'End', "width": "14%"},
                { data: 'Status', name:'Status', "width": "14%"}
            ]
        });
});

$("#search").keypress(function(e){
    var key = e.which;
    if (key == 13) {
        $('#searchBtn').click();
    }
});