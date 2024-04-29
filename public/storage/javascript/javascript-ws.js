
function boxsSize(){
    var windowheight = $(window).height();
    var menuBoxHeight = windowheight - 50;

    var trackingBoxHeight = $("#section-tracking").height();
    $("#section-service").css("padding-top",trackingBoxHeight+"px");
}

$(document).ready(function(){


    $('header .header-links li a,.home-scroll-link a').click(function() { 
            var page = $(this).attr('href'); 
            var speed = 750; 
            $('html , body').animate( { scrollTop: (($("#section-"+page).offset().top)-80) }, speed ); 
            
            var windowWidth = $(window).width();

            if( windowWidth < 769){
                hideResMenu();
            }
            

            return false;
        });


  setInterval(function(){
    var pos = $("#work-section .infos-screen .screenshot .web-screenshot").scrollTop();
    $("#work-section .infos-screen .screenshot .web-screenshot").scrollTop(pos + 2);
    if(pos > 392){
        $("#work-section .infos-screen .screenshot .web-screenshot").scrollTop(0);
    }

    $(".ul-auto-scroll").each(function() {
        var posUl = $(this).scrollTop();
        $(this).scrollTop(posUl + 2);
    })


    
}, 200);

        


    boxsSize();


var homeSec = $("#section-home").height()+20;
var serviceSec = $("#section-service").height()+homeSec+40;
var workSec = $("#section-work").height()+serviceSec+60;
var pricesSec = $("#section-prices").height()+workSec+80;
var contactSec = $("#section-contact").height()+pricesSec+100;




var sections = {
  'home': { start: 0,   end: homeSec },
  'service': { start: homeSec,   end: serviceSec },
  'work': { start: serviceSec,   end: workSec },
  'prices': { start: workSec,   end: pricesSec },

  // ...
  'contact':  { start: pricesSec },
};

$(window).on("scroll", function() {
  var $window   = $(this);
  var scrollTop = $window.scrollTop();

  var section;
  Object.keys(sections).forEach(function(name) {
    var bounds = sections[name];

    if(bounds.start < scrollTop && (bounds.end > scrollTop || !bounds.end)) {

      //$("header .header-links li a").removeClass("header-links-hover");
      //$("header .header-links li a[href="+name+"]").addClass("header-links-hover");
    }
  });

  
});




    $(window).resize(function() {
        boxsSize();
        var windowWidth = $(window).width();

        if( windowWidth > 769){
                $(".header-links").css('display','table-cell');
                $(".responsive-menu").attr("href","javascript:hideResMenu()");
            }
            
    });


});

function closeIframeBox(){
   $('#ajaxResultModal').modal('toggle');
    
}

function showIframeBox(htmlContent){

        $("#ajaxResultModal .modal-title").html("");
        $("#ajaxResultModal .modal-body").html(htmlContent);
        $('#ajaxResultModal').modal('show');

}

function ajaxIframeBox(link){
    
    $.ajax({

        url: link,
        beforeSend: function(){
          $("#loading").show();
        },
        success: function(data){
        showIframeBox(data);
          $("#loading").fadeOut();
          hideProgressBar();

        }
    });
}
function hideResult(){

    $("#result").fadeOut(function(){
        $(this).html('');
        $("#bg-res").fadeOut();

    });
}
function ajaxResult(resultText){
    var resultGetHtml = '<div id="result-in"><span id="result-text">'+resultText+'</span><span id="result-remove"><i onclick="hideResult()" class="fa fa-eye-slash"></i></span></div>';
    $("#result").html(resultGetHtml);

    $("#bg-res").show();
    $("#result").fadeIn();
    $("#result").css("bottom","25px");

    setTimeout(function(){ 
    $("#bg-res").fadeOut();
    }, 1000);
    setTimeout(function(){ 
    $("#result").css("bottom","-10%");
    }, 2000);

}


function showResMenu(){

    $(".header-links").slideDown();
    $(".responsive-menu").attr("href","javascript:hideResMenu()");

}



function hideResMenu(){

    $(".header-links").slideUp();
    $(".responsive-menu").attr("href","javascript:showResMenu()");

}


$(document).scroll(function(){

    if($(this).scrollTop() > (5))
    {   
       $("header").addClass("header-logo-scroll");
    }
    else {
       $("header").removeClass("header-logo-scroll");
    } 


});

var resultOption = {
    beforeSend : function()
    {
        $("#loading").show();
    },
    complete: function(response)
    {
        $("#loading").fadeOut();
        showIframeBox(response.responseText);

    },
    error: function()
    {
        $("#loading").fadeOut();
        alert('ERROR');
    }
};
$("#tracking-form").ajaxForm(resultOption);


var resultOption2 = {
    beforeSend : function()
    {
        $("#loading").show();
    },
    complete: function(response)
    {
        $("#loading").fadeOut();
        $("#result-ajax").html(response.responseText);

    },
    error: function()
    {
        $("#loading").fadeOut();
        alert('ERROR');
    }
};
$("#ajax-form").ajaxForm(resultOption2);
$("#contact-form").ajaxForm(resultOption2);








$( document ).on( 'keydown', function ( e ) {
    if ( e.keyCode === 27 ) {
        closeIframeBox();
        

    }
});