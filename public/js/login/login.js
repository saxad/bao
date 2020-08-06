$(document).ready(function(){
    console.log('document ready')
    $(".txtb input").on('focus', function(){
       
        $(this).addClass('focus');
        console.log('hello')
    
    });
    
    $(".txtb input").on('blur', function(){
    if( $(this).val() == "" )
    $(this).removeClass('focus');
    
    });
});



