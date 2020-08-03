$('document').ready(function(){
    $(".txtb input").on('focus', function(){
       
        $(this).addClass('focus');
     //alert('hello')
    
    });
    
    $(".txtb input").on('blur', function(){
    if( $(this).val() == "" )
    $(this).removeClass('focus');
    
    });
});