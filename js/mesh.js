jQuery(document).ready(function($){

  //Are we loaded?
  console.log('New theme loaded!');
//$('.slick-slide').css({width:""});
  //Let's do something awesome!

  //Smooth page scroll + page scroll location control
$(function() {
  $('a[href*=#]:not([href=#])').click(function() {
  if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
    var target = $(this.hash);
    target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
    if (target.length) {
      //alert("BAMM!");
      $('html,body').animate({
        //'top-75' is custom.  limits the offset to top of window plus 75px
        scrollTop: (target.offset().top)
      }, 800);
      return false;
    }
  }
  });
});

//Setup variables to hold our sizes
var gi2, gi3, gi4, gi5, gi6, gi7, cp3, cp4, cp5, cp6, cp7, $wW;

  //Grab the width of each element
function gi_resize(){
  gi2 = $('.grid-item-width2 ').width();
  gi3 = $('.grid-item-width3 ').width();
  //console.log(gi3);
  gi4 = $('.grid-item-width4 ').width();
  gi5 = $('.grid-item-width5 ').width();
  gi6 = $('.grid-item-width6 ').width();
  gi7 = $('.grid-item-width7 ').width();
  cp3 = $('.grid-item.columns-3').width();
  cp4 = $('.grid-item.columns-4').width();

  //cpw4 = $('.grid-item.columns-4');
  cp5 = $('.grid-item.columns-5').width();
  cp6 =  $('.grid-item.columns-6').width();
  //console.log(cp6);
  //cp6_alt = $('.columns-6')
  cp7 = $('.grid-item.columns-7').width();

  $wW = $(window).width();


  //return gi2, gi3, gi4;
}
//Run the function above at document ready and on a window resize event
 $(document).ready(gi_resize(gi2, gi3, gi4, gi5, gi6, gi7, cp3,cp4, cp5, cp6, cp7, $wW));
 $(window).resize(gi_resize(gi2, gi3, gi4, gi5, gi6, gi7, cp3, cp4, cp5, cp6, cp7, $wW));

//Apply our widths to the height of selected elements either on load, or on resize
function _resize(){
  gi_resize(gi2, gi3, gi4, gi5, gi6, gi7, cp3, cp4, cp5, cp6, cp7, $wW);
   $(window).resize(gi_resize(gi2, gi3, gi4, gi5, gi6, gi7, cp3, cp4, cp5, cp6, cp7,$wW));

 //  console.log("Width 2: "+gi2);
	// console.log("Width 3: "+gi3);
	//  console.log("Width 4: "+gi4);
  //$('.grid-item-width2').css({height: (gi2)});
 // $('.grid-item-width2.nest').css({height: (gi2*2)});
 // $('.grid-item-width2.nest .nested').css({height: gi2});
  //$('.grid-item-width3').css({height: gi3});
  //$('.grid-item-width4').css({height: gi4});
  //$('.grid-item-width5').css({height: gi5})
  //$('.grid-item-width6').css({height: (gi6*.66)});
 // $('.width6-diamond').css({height: (gi6*0.4)});
 // $('.columns-4.child-links').css({height:cp4});
  //$('.columns-6.promo').css({height: (cp6*.5)});
 // $('.columns-6.cpromo').css({height: (cp6*.66)});
  //console.log(cp6*.66);
  //$('.columns-6 .width6-diamond').css({height: (cp6*0.4)});
  //$('.columns-5.event-feed').css({height: (cp5)});
 // $('.columns-7.trip').css({height: cp5});
  //$('.grid-item-width6.nest').css({height: gi2});
 // $('.grid-item-width6.nest .nested').css({height: gi2});
  //$('.grid-item-width7').css({height: (gi5)});
  $('.grid-item.columns-3').css({height:cp3});
  $('.grid-item.columns-4').css({height:cp4});
  //$('.grid-item.columns-5.promo-slide').css({width:cp5});
  $('.grid-item.columns-5').css({height:cp5});
  console.log(cp5);
  $('.grid-item.columns-6').css({height:cp6*0.66});
  //console.log($wW);
  if ($wW > 800){
  
}
}

//Run the function on load & on resize
_resize();
$(window).resize(_resize);

console.log('Width :'+ $wW);

var divs = $(".events > .event");
for(var i = 0; i < divs.length; i+=3) {
  divs.slice(i, i+3).wrapAll("<div class='instance'></div>");
}

// $('.promo').scrollable({
// 		circular: 	 false,
// 		next:		'#nextbtn',
// 		prev:		'#prevbtn',
// 		speed:		300,
// 		touch: 		false,
// 		onBeforeSeek: function() {
// 			var currSlide = api.getIndex();
// 			$('.items > div.item').each(function() {
// 				$(this).removeClass('active');
// 			});
// 		},
// 		onSeek: function() {
// 			var currSlide = api.getIndex();
// 			currSlide = currSlide + 1;
// 			$('.items > div.item:eq(' + currSlide + ')').addClass('active');
// 		}
// 	}).navigator();
// 	var api = $('#fader').data('scrollable');

// Comment this stuff out to test UI Tools

// $('.promo, .hz-shows').on('init', function(event){
//   $(this).addClass('init');
//   $panel = $('.slick-slide:not(.slick-cloned)');
//   var _count = $panel.length;
//   var _width = $panel.width();
//   //$('.slick-slide').css({'width':'600px'});
//   console.log(_count);
//   console.log(_width);

// });

  $('.promo').slick({
    accessibility: true,
    autoplay: false,
    //swipeToSlide: true,
    slidesToShow: 3,
    //slidesToScroll: 1,
    variableWidth: true,
    arrows: true,
    draggable: true,
    prevArrow: '<button type="button" class="slick-prev" title="See previous"><div class="content"><span>Previous</span></div></button>',
   nextArrow: '<button type="button" class="slick-next" title="See Next"><div class="content"><span>Next</span></div></button>'
  });

 //  $('.events').slick({
 //    accessibility: true,
 //    autoplay: false,
 //    //swipeToSlide: true,
 //    slidesToShow: 3,
 //  	//slidesToScroll: 1,
 //  	variableWidth: true,
 //    appendArrows: $('.events-nav'),
 // 	  arrows: true,
 //    draggable: true,
 // // prevArrow: '<button type="button" class="slick-prev"><span>Previous</span></button>',
 //  // nextArrow: '<button type="button" class="slick-next"><span>Next</span></button>'

 //  });

$('.hz-shows').slick({
    accessibility: true,
    autoplay: false,
    //swipeToSlide: true,
    slidesToShow: 3,
  	//slidesToScroll: 1,
  	variableWidth: true,
 	arrows: false,
  draggable: true
  });

////////////////////////////////////////////////////////////

//Sidr
$('.sidr-trigger').sidr({
      name: 'sidr-main',
      source: '.main-navigation',
      renaming: false,
      side: 'left',
      displace: false,     

 });//end sidr onOpen function


});
