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

//const _ = require('nouislider');

var slider = document.getElementById('slider');

console.log(slider);

noUiSlider.create(slider, {
    start: [20, 80],
    connect: true,
    range: {
        'min': 0,
        'max': 100
    }
});