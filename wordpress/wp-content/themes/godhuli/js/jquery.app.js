/**
 * Initiate all custom js calls for the theme
 *
 * @package Godhuli
 */


(function ($) {

	'use strict';

	function initNavbar() {

		var scroll = $( window ).scrollTop();

		$( '.navbar-toggle' ).on(
			'click',
			function (event) {
				$( this ).toggleClass( 'open' );
				$( '#navigation' ).slideToggle( 400 );
			}
		);

		$( '.navigation-menu>li' ).slice( -2 ).addClass( 'last-elements' );
		$( '.nav-collapse' ).removeClass( 'nav-collapse-0' );

		$( '.menu-arrow,.submenu-arrow' ).on(
			'click',
			function (e) {
				if ($( window ).width() < 992) {
					e.preventDefault();
					$( this ).parent( 'li' ).toggleClass( 'open' ).find( '.submenu:first' ).toggleClass( 'open' );
				}
			}
		);
	}

	$( 'a[href*=".jpg"], a[href*=".jpeg"], a[href*=".png"], a[href*=".gif"]' ).colorbox(
		{
			transition:'elastic',
			speed 	:350,
			rel: 'gallery',
			opacity:.85,
			closeButton: true,
			scalePhotos: true,
			maxWidth: '90%',
			maxHeight: '90%',

			title: function() {
				return $( this ).find( 'img' ).attr( 'alt' );
			}
		}
	);



	function initSearch() {
		$( '.toggle-search' ).on(
			'click',
			function () {
				var targetId = $( this ).data( 'target' );
				var $searchBar;
				if (targetId) {
					$searchBar = $( targetId );
					$searchBar.toggleClass( 'open' );
				}
			}
		);
		$( '.toggle-search' ).on(
			'focus',
			function () {
				var targetId = $( this ).data( 'target' );
				var $searchBar;
				if (targetId) {
					$searchBar = $( targetId );
					$searchBar.toggleClass( 'open' );
				}
			}
		);
	}

	function initNavitemActive() {
		$( ".navigation-menu a" ).each(
			function () {
				if (this.href == window.location.href) {
					$( this ).parent().addClass( "active" ); // add active to li of the current link
					$( this ).parent().parent().parent().addClass( "active" ); // add active class to an anchor
					$( this ).parent().parent().parent().parent().parent().addClass( "active" ); // add active class to an anchor
				}
			}
		);
	}

	function initMainSlider() {
		$( '.main-slider' ).owlCarousel(
			{
				autoplay:2000,
				loop:true,
				smartSpeed:2000,
				dots:false,
				nav:true,
				margin:0,
				mouseDrag:true,
				autoHeight:false,
				items:1,
				singleItem:true,
				animateIn:"fadeIn",
				animateOut:"fadeOut",
				autoplayHoverPause: true
			}
		);
	}



	function initselect2() {
		$('select').select2();
	}


	function scrollAnimate() {

		//$( 'a[href*="#"]:not( a.comment-reply-link, a.search-trigger )' ).on(

		// filter handling for a /dir/ OR /indexordefault.page
		function filterPath(string) {
			return string
				.replace(/^\//, '')
				.replace(/(index|default).[a-zA-Z]{3,4}$/, '')
				.replace(/\/$/, '');
		}

		var locationPath = filterPath(location.pathname);
		$('a[href*="#"]:not( a.comment-reply-link, a.search-trigger )').each(function () {
			var thisPath = filterPath(this.pathname) || locationPath;
			var hash = this.hash;
			if ($("#" + hash.replace(/#/, '')).length) {
				if (locationPath == thisPath && (location.hostname == this.hostname || !this.hostname) && this.hash.replace(/#/, '')) {
					var $target = $(hash), target = this.hash;
					if (target) {
						$(this).click(function (event) {
							event.preventDefault();
							$('html, body').animate({scrollTop: $target.offset().top}, 1000, function () {
								location.hash = target;
								$target.focus();
								if ($target.is(":focus")){ //checking if the target was focused
									return false;
								}else{
									$target.attr('tabindex','-1'); //Adding tabindex for elements not focusable
									$target.focus(); //Setting focus
								};
							});
						});
					}
				}
			}
		});


	}

	function init() {
		initNavbar();
		initSearch();
		initNavitemActive();
		initMainSlider();
		initselect2();
		scrollAnimate();
	}

	init();


})( jQuery )
