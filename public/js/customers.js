$(document).ready(function(){
    $("#LCC").toggleClass('bg-dark');
    $("#MSPG").removeClass('bg-dark');
    $("#PUREGOLD").removeClass('bg-dark');
    $("#SHOEMART").removeClass('bg-dark');
    $("#SMMA").removeClass('bg-dark');
    $("#lccTable").toggle();
});

$('#LCC').on('click', function () {

    $("#LCC").toggleClass('bg-dark');
    $("#MSPG").removeClass('bg-dark');
    $("#PUREGOLD").removeClass('bg-dark');
    $("#SHOEMART").removeClass('bg-dark');
    $("#SMMA").removeClass('bg-dark');
    $("#lccTable").toggle();

});

$('#MSPG').on('click', function () {

    $("#LCC").removeClass('bg-dark');
    $("#MSPG").toggleClass('bg-dark');
    $("#PUREGOLD").removeClass('bg-dark');
    $("#SHOEMART").removeClass('bg-dark');
    $("#SMMA").removeClass('bg-dark');
    $("#lccTable").hide();

});

$('#PUREGOLD').on('click', function () {

    $("#LCC").removeClass('bg-dark');
    $("#MSPG").removeClass('bg-dark');
    $("#PUREGOLD").toggleClass('bg-dark');
    $("#SHOEMART").removeClass('bg-dark');
    $("#SMMA").removeClass('bg-dark');
    $("#lccTable").hide();
});

$('#SHOEMART').on('click', function () {

    $("#LCC").removeClass('bg-dark');
    $("#MSPG").removeClass('bg-dark');
    $("#PUREGOLD").removeClass('bg-dark');
    $("#SHOEMART").toggleClass('bg-dark');
    $("#SMMA").removeClass('bg-dark');
    $("#lccTable").hide();
});

$('#SMMA').on('click', function () {
    $("#LCC").removeClass('bg-dark');
    $("#MSPG").removeClass('bg-dark');
    $("#PUREGOLD").removeClass('bg-dark');
    $("#SHOEMART").removeClass('bg-dark');
    $("#SMMA").toggleClass('bg-dark');
    $("#lccTable").hide();
});