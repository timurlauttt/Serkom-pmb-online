//[Javascript]



$(function () {
    "use strict";   
		
	/* BOOTSTRAP SLIDER */
		$('.slider').slider()
	
	
	/* flexslider SLIDER */
		// Default: keep simple behavior for generic sliders
		$('.flexslider').each(function(){
			var $el = $(this);
			// If the element has id 'hero' or is the hero-slider, use autoplay settings
			var isHero = $el.closest('#hero').length || $el.hasClass('hero-slider');
			$el.flexslider({
				animation: "slide",
				slideshow: isHero ? true : false,
				slideshowSpeed: isHero ? 5000 : 7000,
				animationSpeed: isHero ? 600 : 600,
				pauseOnHover: true,
				controlNav: !isHero, // hide thumbnails/nav for hero
				directionNav: isHero ? false : true,
				smoothHeight: false
			});
		});
		$('.flexslider2').flexslider({
			animation: "slide",
			controlNav: "thumbnails"
		  });
	/* owl-carousel SLIDER */
		$('.owl-carousel').owlCarousel({
			loop: true,
			margin: 10,
			responsiveClass: true,
			autoplay: true,
			responsive: {
			  0: {
				items: 1,
				nav: false
			  },
			  600: {
				items: 3,
				nav: false
			  },
			  1000: {
				items: 4,
				nav: true,
				margin: 20
			  }
			}
		});
	
  }); // End of use strict