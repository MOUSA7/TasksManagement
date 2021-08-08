jQuery(document).ready(function () {
    //show and hide search
$(".search").click(function(){
    $(".full-search").show("slow");
});
$(".close-search").click(function(){
    $(".full-search").hide("slow");
})
//show this color of navlink


$(".fa-globe").click(function(){
        $('.change-bg').toggleClass("togg-position");
    });

    $(".change-black").click(function(){
        var x = $(this).css('backgroundColor');
        $('body').css("background-color",x);
        $('.chose-bg').css("background-color",x);
        $('.change-bg').toggleClass("togg-position");
    });

    
    // setInterval( document.querySelector(".time").innerHTML=time, 1000);
    setInterval(function(){ 
        var time1=new Date();
    var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    time=time1.toLocaleTimeString('ar-EG', options);
        document.querySelector(".time").innerHTML=time; }, 100);

    
    
/* slider*/

$('.autoplay').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2000,
  });
  
});



