

$('.portfolio-slider-for-all').owlCarousel({
    margin:0,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
})


$(document).ready(function(){
     
  var arr = ["skp","skp1","skp2","skp3","skp4"]; // List of users
 
 $('.msg_head').click(function(){  
  var chatbox = $(this).parents().attr("rel") ;
  $('[rel="'+chatbox+'"] .msg_wrap').slideToggle('slow');
  return false;
 });

 $('.minimise-chat').click(function(){  
  var chatbox = $(this).parents().parents().attr("rel") ;
  $('[rel="'+chatbox+'"] .msg_wrap').slideToggle('slow');
  return false;
 });
 
 $('.close-live-chat').click(function(){
  
  var chatbox = $(this).parents().parents().attr("rel") ;
  $('[rel="'+chatbox+'"]').hide();
  //update require
  arr.splice($.inArray(chatbox, arr),1);
  i = 50 ; // start position
  j = 260;  //next position
  $.each( arr, function( index, value ) {          
       $('[rel="'+value+'"]').css("right",i);
    i = i+j;
        });
  
  return false;
 }); 
 
 $('textarea').keypress(
    function(e){     
   
        if (e.keyCode == 13) {
            var msg = $(this).val();   
   $(this).val('');
   if(msg.trim().length != 0){    
   var chatbox = $(this).parents().parents().parents().attr("rel") ;
   $('<div class="msg-right">'+msg+'</div>').insertBefore('[rel="'+chatbox+'"] .msg_push');
   $('.msg_body').scrollTop($('.msg_body')[0].scrollHeight);
   }
        }
    });
 
});






// 9/18/2020 start
$('.destinations-city-s2-slider').slick({
  infinite: true,
  slidesToShow: 1,
  slidesToScroll: 1
});

// Sliders 
$('.slide').owlCarousel({
    loop:true,
    margin:10,
    nav:false,
    dots:false,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
})
$('.slider-home').slick({
  dots: true,
  infinite: false,
  speed: 300,
  slidesToShow: 3,
  slidesToScroll: 1,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});

$('.slider-home-two').slick({
  dots: true,
  infinite: false,
  speed: 300,
  slidesToShow: 2,
  slidesToScroll: 1,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});




// RESPONSIVE NAVIGATION
  $(document).ready(function () {

    $("#navbar").on("click", function() {
      $(".nveMenu").addClass("is-opened");
      $(".overlay").addClass("is-on");
    });

    $(".overlay").on("click", function() {
      $(this).removeClass("is-on");
      $(".nveMenu").removeClass("is-opened");
    });
  });
  
  $(".close-btn-nav").click(function() {
    $(".nveMenu").removeClass("is-opened");
    $(".overlay").removeClass("is-on");
});
  // RESPONSIVE NAVIGATION


  //inspired by instagram : webdev.tips

const tab = document.querySelectorAll("button");
const panel = document.querySelectorAll(".single__tab");

function tabClick(event) {
  // deactivate existing active tabs and panel
  for (let i = 0; i < tab.length; i++) {
    tab[i].classList.remove("active");
    // console.log(tab[i]);
  }
  for (let i = 0; i < panel.length; i++) {
    panel[i].classList.remove("active");
    // console.log(panel[i]);
  }
  // activate new tabs and panel
  event.target.classList.add('active');
  let classString = event.target.getAttribute('data-target');
  document.getElementById('tabs__content').getElementsByClassName(classString)[0].classList.add("active");
}
for (let i = 0; i < tab.length; i++) {
  tab[i].addEventListener('click', tabClick, false);
}

window.onload = function() {
    baguetteBox.run('.baguetteBoxOne');
    baguetteBox.run('.baguetteBoxTwo');
    baguetteBox.run('.baguetteBoxThree', {
        animation: 'fadeIn',
        noScrollbars: true
    });
    baguetteBox.run('.baguetteBoxFour', {
        buttons: false
    });
    baguetteBox.run('.baguetteBoxFive', {
        captions: function(element) {
            return element.getElementsByTagName('img')[0].alt;
        }
    });

    if (typeof oldIE === 'undefined' && Object.keys) {
        // hljs.initHighlighting();
    }

    var year = document.getElementById('year');
    // year.innerText = new Date().getFullYear();
};

// Slider Js
$('#myCarousel').carousel({
  interval: false
});
$('#carousel-thumbs').carousel({
  interval: false
});

// handles the carousel thumbnails
// https://stackoverflow.com/questions/25752187/bootstrap-carousel-with-thumbnails-multiple-carousel
$('[id^=carousel-selector-]').click(function() {
  var id_selector = $(this).attr('id');
  var id = parseInt( id_selector.substr(id_selector.lastIndexOf('-') + 1) );
  $('#myCarousel').carousel(id);
});
// Only display 3 items in nav on mobile.
if ($(window).width() < 575) {
  $('#carousel-thumbs .row div:nth-child(4)').each(function() {
    var rowBoundary = $(this);
    $('<div class="row mx-0">').insertAfter(rowBoundary.parent()).append(rowBoundary.nextAll().addBack());
  });
  $('#carousel-thumbs .carousel-item .row:nth-child(even)').each(function() {
    var boundary = $(this);
    $('<div class="carousel-item">').insertAfter(boundary.parent()).append(boundary.nextAll().addBack());
  });
}
// Hide slide arrows if too few items.
if ($('#carousel-thumbs .carousel-item').length < 2) {
  $('#carousel-thumbs [class^=carousel-control-]').remove();
  $('.machine-carousel-container #carousel-thumbs').css('padding','0 5px');
}
// when the carousel slides, auto update
$('#myCarousel').on('slide.bs.carousel', function(e) {
  var id = parseInt( $(e.relatedTarget).attr('data-slide-number') );
  $('[id^=carousel-selector-]').removeClass('selected');
  $('[id=carousel-selector-'+id+']').addClass('selected');
});

$(document).ready(function () {


// when user swipes, go next or previous
// $('#myCarousel').swipe({
//   fallbackToMouseEvents: true,
//   swipeLeft: function(e) {
//     $('#myCarousel').carousel('next');
//   },
//   swipeRight: function(e) {
//     $('#myCarousel').carousel('prev');
//   },
//   allowPageScroll: 'vertical',
//   preventDefaultEvents: false,
//   threshold: 75
// });
/*
$(document).on('click', '[data-toggle="lightbox"]', function(event) {
  event.preventDefault();
  $(this).ekkoLightbox();
});
*/

$('#myCarousel .carousel-item img').on('click', function(e) {
  var src = $(e.target).attr('data-remote');
  if (src) $(this).ekkoLightbox();
});

// external js: masonry.pkgd.js, imagesloaded.pkgd.js



  // init Masonry
  // var $grid = $('.grid').masonry({
  //   itemSelector: '.grid-item',
  //   percentPosition: true,
  //   columnWidth: '.grid-sizer'
  // });
// layout Masonry after each image loads
  // $grid.imagesLoaded().progress( function() {
  //   $grid.masonry();
  // }); 
  $('.slider-artist-new').owlCarousel({
    loop:false,
    margin:10,
    nav:false,
    dots:false,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        1000:{
            items:3
        }
    }
})
});

        $('.choose-photographer-box a.btn-portfolio-one').removeClass('w-100');
        $('.choose-photographer-box a.button-book-one').removeClass('w-100');
        $('.choose-photographer-box .d-md-flex').addClass('justify-content-center');
			     


// $('.choose-photographer-box .bottom a.btn-portfolio-one').removeClass('w-100');
// $('.choose-photographer-box .bottom a.button-book-one').removeClass('w-100');


