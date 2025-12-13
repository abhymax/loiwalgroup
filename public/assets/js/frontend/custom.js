 
// owl slider script
  jQuery( function() {					   
		    var owl = jQuery('.banner-slider .owl-carousel');
	        owl.owlCarousel({
	        loop: true,
	        autoplay: true,
	        autoplay: 1000,
	        autoplayHoverPause: false,
	        dots: true,
	        nav: false,
	        items:1,
	        mouseDrag: false,
	        animateIn: 'fadeIn',
            animateOut: 'fadeOut',
	  })
	  var owl = jQuery('.industry-box .owl-carousel');
		    owl.owlCarousel({
		      margin: 0,
		      items: 5,
		      loop: false,
		      autoplay: false,
		      autoplayTimeout: 4000,
		      autoplayHoverPause: true,
		      nav: true,
		      dots: false,
		      responsive: {
		        0: {
		          items: 1,
		          loop: true,
		        },
		        600: {
		          items: 3,
		          loop: false,
		        },
		        1000: {
		          items: 5,
		          autoplay: true,
		          loop: false,
		        }
		      }
      })
});



// Aos animation script
 AOS.init({
       // once: true,
        duration: 1500,
});



// sticky header script
jQuery(document).on("scroll", function () {
    if (jQuery(document).scrollTop() > 160) {
        jQuery(".header-box").addClass("sticky");
    } else {
        jQuery(".header-box").removeClass("sticky");
    };
});

// mobile menu
jQuery(".menuTrigger").click(function(){
  jQuery("body").toggleClass("menu_active");
});
jQuery(".overly").click(function(){
  jQuery("body").removeClass("menu_active");
});


// form label

jQuery(document).ready(function() {

$("form input").on("blur input focus", function() {
	var $field = $(this).closest(".form-item");
	if (this.value) {
		$field.addClass("filled");
	} else {
		$field.removeClass("filled");
	}
});

$("form input").on("focus", function() {
	var $field = $(this).closest(".form-item");
	if (this) {
		$field.addClass("filled");
	} else {
		$field.removeClass("filled");
	}
});

$("form textarea").on("blur textarea focus", function() {
	var $field = $(this).closest(".form-item");
	if (this.value) {
		$field.addClass("filled");
	} else {
		$field.removeClass("filled");
	}
});

$("form textarea").on("focus", function() {
	var $field = $(this).closest(".form-item");
	if (this) {
		$field.addClass("filled");
	} else {
		$field.removeClass("filled");
	}
});
});

// scroll script
jQuery(document).on('click', 'a[href^="#"]', function (event) {
	var id = this.id;
	if(id=="#about" || id=="#quote-area")
	{
	}
	else
	{
	event.preventDefault();
    jQuery('html, body').animate({
        scrollTop: $($.attr(this, 'href')).offset().top
    }, 500);
	}  
});


// accordion

$(document).ready(function(){
  
    
  $('.accordion-list > li').click(function() {
    if ($(this).hasClass("active")) {
      $(this).removeClass("active").find(".answer").slideUp();
    } else {
      $(".accordion-list > li.active .answer").slideUp();
      $(".accordion-list > li.active").removeClass("active");
      $(this).addClass("active").find(".answer").slideDown();
    }
    return false;
  });
  
});



// Cache our vars for the fixed sidebar on scroll
    var $sidebar = $('#sidebar');
    // Get & Store the original top of our #sidebar-nav so we can test against it
    var sidebarTop = 400;
    // Edit the `- 10` to control when it should disappear when the footer is hit.
    var blogHeight = $('#content').outerHeight() + 1400;

    // Add the function below to the scroll event
    $(window).scroll(fixSidebarOnScroll);

    // On window scroll, this fn is called (binded above)
    function fixSidebarOnScroll() {
        // Cache our scroll top position (our current scroll position)
        var windowScrollTop = $(window).scrollTop();

        // Add or remove our sticky class on these conditions
        if (windowScrollTop >= blogHeight || windowScrollTop <= sidebarTop) {
            // Remove when the scroll is greater than our #content.OuterHeight()
            // or when our sticky scroll is above the original position of the sidebar
            $sidebar.removeClass('sticky-left');
        }
        // Scroll is past the original position of sidebar
        else if (windowScrollTop >= sidebarTop) {
            // Otherwise add the sticky if $sidebar doesnt have it already!
            if (!$sidebar.hasClass('sticky-left')) {
                $sidebar.addClass('sticky-left');
            }
        }
    }


// menu active
jQuery(document).ready(function() {
    jQuery('.menu-item li').click(function() {
        jQuery('.menu-item li.active').removeClass("active");
       jQuery(this).addClass("active");
    });
});

jQuery(document).ready(function(){
	jQuery(".first-list").click(function(){
	  jQuery(".service-item-one").addClass("active");
	});
});

jQuery(window).scroll(function() {    
    var scroll = jQuery(window).scrollTop();
    if (scroll <= 0) {
        jQuery(".service-item-one").removeClass("active").animate({ scrollTop: 0 }, 500);
    }
});
function closemenu()
{
	 jQuery("body").removeClass("menu_active");
}