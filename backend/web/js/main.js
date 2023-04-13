$(function(){
    //get the click the of create button
    $('#modalButton').click(function (){
        $('#modal').modal('show')
            .find('#modalContent')
            .load($(this).attr('value'));
    });
});