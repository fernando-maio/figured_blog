$(function() {
    $('#box-search').keyup(function(e){
        if(e.keyCode == 13){
            $('#btn-search').trigger( "click" );
        }
    });

    $('#btn-search').click(function(e){
        if($('#box-search').val() == ''){
            return false;
        }
        $(location).attr("href", window.location.origin + '?title=' + $('#box-search').val());
    });
});