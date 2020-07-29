$(document).ready(function(){



	$(".buton-md").click(function(){



	$(".kutlama").toggleClass("none");



});



});



  jQuery(document).ready(function() {



    jQuery('.content, .sidebar').theiaStickySidebar({



      // Settings



      additionalMarginTop: 30



    });



  });



    jQuery(document).ready(function() {



    jQuery('.uyg-left, .uyg-right').theiaStickySidebar({



      // Settings



      additionalMarginTop: 30



    });



  });



 $(document).ready(function(){



	$(".comment-box").click(function(){



		$(".commentbox").slideToggle("fast");



	  });



	});		



	   



/* ------------------------------------ */	



/*  Slick



/* ------------------------------------ */	



$(document).ready(function(){



$('.center').slick({



  centerMode: true,



  slidesToShow: 4,



  responsive: [



    {



      breakpoint: 768,



      settings: {



        arrows: false,



        centerMode: true,



        slidesToShow: 4



      }



    },



    {



      breakpoint: 480,



      settings: {



        arrows: false,



        centerMode: true,



        slidesToShow: 1



      }



    }



  ]



});



    });



$(document).ready(function(){



$('.autoplay').slick({



  slidesToShow: 1,



  slidesToScroll: 1,



  autoplay: true,



  dots: false,



  arrows: true,



  autoplaySpeed: 4000,



});



	



});



$(document).ready(function(){	



$('.multiple-items').slick({



  infinite: true,



  slidesToShow: 4,



  slidesToScroll: 4



});



});



/* ------------------------------------ */	



/*  Search Bar



/* ------------------------------------ */	



$(function() {



  



  $("input").keyup(function() {



    checkValue($(this));



  });



  



  var checkValue = function () {



    ( $("input").val() == '' ) ? $("input").removeClass("typing") : $("input").addClass("typing");



  };



  



});







/* ------------------------------------ */	



/*  Menüye Dalgalanma efekti



/* ------------------------------------ */



$('.secondary-navbar li').addClass('waves-effect');



$('.secondary-navbar .menu-item-has-children').removeClass('waves-effect waves-blue');



/* ------------------------------------ */	



/*  Tab Menü



/* ------------------------------------ */	



	$(function(){



		 



			 var tab = $('.tabMenu li'),



				  content = $('.tabContent');



			 tab.filter(':first').addClass('active');



			 content.filter(':not(:first)').hide();



			 tab.click(function(){



				  var indis = $(this).index();



				  tab.removeClass('active').eq(indis).addClass('active');



				  content.hide().eq(indis).fadeIn(500);



				  return false;



			 });



		 



		});



/* ------------------------------------ */	



/*  Header Menu



/* ------------------------------------ */	



$(document).ready(function(){



	$(".sec-menu-icon button").click(function(){



		$(".secondaryheader").slideToggle("slow");



	  });



	});		



// kutu kapama



$(".alert .close").click(function() {



  $(this).parent()



  .animate({ opacity: 0 }, 250, function() {



    $(this)



    .slideUp(250, function() {



      $(this).closest("#alert").remove();



    });



  });



});







/* ------------------------------------ */	



/*  MTD Menu açma, kapama



/* ------------------------------------ */	



$(document).ready(function(){



	$("#hamburger-icon, #navbar-top .close-button").click(function(){



	$("body").toggleClass("noscroll");



	$(".navbar").toggleClass("slides");



	



});







//  Menu Close		



$('.mdl-layout__obfuscator').click(function(){



    $('body').removeClass('noscroll');



    $(".navbar").removeClass("slides");



});



});















// PROFILE 1 MENU







	$('.apps-type.1>li').on('click', function() {



		$('.apps-type.1>li>ul').toggleClass('active');



	});







	$(document).on("click", function(e) {



		if (($(".apps-type.1>li>ul").hasClass("active")) && (!$(".apps-type.1>li>ul, .apps-type.1>li>ul *, .apps-type.1>li").is(e.target))) {



			$(".apps-type.1>li>ul").toggleClass("active");



		}



	});







	$(window).scroll(function() {



		$('.apps-type.1>li>ul').removeClass('active');



	});



// PROFILE 2 MENU







	$('.apps-type.2>li').on('click', function() {



		$('.apps-type.2>li>ul').toggleClass('active');



	});







	$(document).on("click", function(e) {



		if (($(".apps-type.2>li>ul").hasClass("active")) && (!$(".apps-type.2>li>ul, .apps-type.2>li>ul *, .apps-type.2>li").is(e.target))) {



			$(".apps-type.2>li>ul").toggleClass("active");



		}



	});







	$(window).scroll(function() {



		$('.apps-type.2>li>ul').removeClass('active');



	});



/* ------------------------------------ */	



/*  Header Logo Fixed



/* ------------------------------------ */



jQuery("document").ready(function($){



	var nav = $('.entry-top-fixed');



		$(window).scroll(function () {



			if ($(this).scrollTop() > 275) {



				nav.addClass("fixed-top");



			} else {



				nav.removeClass("fixed-top");



			}



		});



});