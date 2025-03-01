; (function($) {
	'use strict';

	// Nav Menu
	function navMenu() {
		$('.oxence-nav-menu').each(function() {
			const selector = $(this),
				navMenu = selector.find('.primary-menu'),
				navToggler = selector.find('.navbar-toggler'),
				slidePanel = selector.find('.slide-panel-wrapper'),
				slideOverly = selector.find('.slide-panel-overly'),
				panelClose = selector.find('.slide-panel-close'),
				showPanel = 'show-panel',
				breakpoint = $(this).data('breakpoint');

			navMenu.find("li a").each(function() {
				if($(this).children('.submenu-toggler').length < 1) {
					if($(this).next().length > 0) {
						$(this).append('<span class="submenu-toggler"><i class="far fa-angle-down"></i></span>');
					}
				}
			});
			navToggler.on('click', function(e) {
				slidePanel.addClass(showPanel);
				e.preventDefault();
			});
			panelClose.on('click', function(e) {
				e.preventDefault();
				slidePanel.removeClass(showPanel);
			});
			slideOverly.on('click', function(e) {
				e.preventDefault();
				slidePanel.removeClass(showPanel);
			});
			slidePanel.find('.submenu-toggler').on('click', function(e) {
				e.preventDefault();
				$(this).parent().parent().siblings().children('ul.sub-menu').slideUp();
				$(this).parent().next('ul.sub-menu').stop(true, true).slideToggle(350);
				$(this).toggleClass('sub-menu-open');
			});

			function breakpointCheck() {
				var winWidth = window.innerWidth;

				if(winWidth <= breakpoint) {
					selector.addClass('breakpoint-on');
				} else {
					selector.removeClass('breakpoint-on');
				}
			}
			breakpointCheck();

			$(window).on('resize', function() {
				breakpointCheck();
			});
		});
	}

	// Easy Pie Chart
	function activeEasyPieChart() {
		$('.oxence-progress-bar.team-default').each(function() {
			const progressChart = $(this).find('.progress-chart');
			progressChart.easyPieChart({
				size: 125,
				scaleLength: 0,
				lineWidth: 7,
				lineCap: 'square',
				barColor: '#3180fc',
				trackColor: '#e9eaec',
				animate: ({
					duration: 1500,
					enabled: true
				}),
				rotate: 90,
			});
		});
	}

	// Preloader
	function preloader() {
		if($('.site-preloader').length) {
			$('.site-preloader').delay(300).fadeOut(500);
		}
	}

	// Related Portfolio Slider
	function relatedPortfolioSlider() {
		$('.portfolio-related-slider').slick({
			autoplay: true,
			autoplaySpeed: 5000,
			arrows: false,
			dots: true,
			infinite: true,
			rows: 0,
			slidesToShow: 3,
			slidesToScroll: 1,
			centerMode: true,
			centerPadding: 0,
			speed: 500,
			responsive: [{
				breakpoint: 1025,
				settings: {
					slidesToShow: 2,
					centerMode: false,
				}
			}, {
				breakpoint: 768,
				settings: {
					slidesToShow: 1,
				}
			}]
		});
	}

	// Portfolio Slider
	function portfolioGallery() {
		$('.portfolio-gallery-slider').slick({
			autoplay: true,
			autoplaySpeed: 5000,
			arrows: false,
			dots: false,
			infinite: true,
			rows: 0,
			slidesToShow: 1,
			slidesToScroll: 1,
			centerMode: true,
			centerPadding: 0,
			speed: 500,
		});
	}

	// ===== Popup video
	function popupVideo() {
		$('.popup-video').magnificPopup({
			type: 'iframe',
		});
	}

	// ===== Cart Click Event
	function cartClickEvents() {
        // h-btn-cart
        $(".add_to_cart_button").on('click', function (e) {
            e.preventDefault();

			$('.widget-cart-wrap').addClass('cart-open');
        });

		$('.cart-close').on('click', function (e) {
            e.preventDefault();

			$('.widget-cart-wrap').removeClass('cart-open');
		});
    }

	/** ==== Document Ready ==== */
	$(document).ready(function() {
		navMenu();
		activeEasyPieChart();
		relatedPortfolioSlider();
		portfolioGallery();
		popupVideo();
		cartClickEvents();
	});

	/** ==== Window Load ==== */
	$(window).on('load', function() {
		preloader();
	});

	$(window).on("elementor/frontend/init", function() {
		var moduleHandler = elementorModules.frontend.handlers.Base;

		// Slider
		var oxenceSlider = moduleHandler.extend({
			getDefaultSettings: function getDefaultSettings() {
				return {
					autoplay: true,
					arrows: false,
					container: '.oxence-slider-active',
					dots: true,
					infinite: true,
					rows: 0,
					slidesToShow: 1,
					slidesToScroll: 1,
					centerMode: true,
					centerPadding: 0,
					prevArrow: '<div class="slick-arrow slick-prev"><i class="far fa-angle-left"></i></div>',
					nextArrow: '<div class="slick-arrow slick-next"><i class="far fa-angle-right"></i></div>',
				};
			},
			getDefaultElements: function getDefaultElements() {
				return {
					$container: this.findElement(this.getSettings('container'))
				};
			},
			getSlickSettings: function getSlickSettings() {
				var settings = {
					infinite: !!this.getElementSettings('loop'),
					autoplay: !!this.getElementSettings('autoplay'),
					autoplaySpeed: this.getElementSettings('autoplay_speed'),
					speed: this.getElementSettings('speed'),
					arrows: !!this.getElementSettings('show_arrows'),
					dots: !!this.getElementSettings('show_dots'),
					pauseOnHover: !!this.getElementSettings('pause_on_hover'),
					centerMode: !!this.getElementSettings('center_mode'),
					slidesToShow: parseInt(this.getElementSettings('slides_per_view')) || 1,
					slidesToScroll: parseInt(this.getElementSettings('slides_to_scroll')) || 1,
				};
				let responsiveSettings = [];
				const breakpoints = elementorFrontend.config.responsive.activeBreakpoints;
				Object.keys(breakpoints).forEach(breakpointName => {
					const slidesPerViewKey = 'slides_per_view' + ('desktop' === breakpointName ? '' : '_' + breakpointName),
						slidesPerScrollKey = 'slides_to_scroll' + ('desktop' === breakpointName ? '' : '_' + breakpointName);
					const breakpoint_data = {
						breakpoint: breakpoints[breakpointName].value + 1,
						settings: {
							slidesToShow: parseInt(this.getElementSettings(slidesPerViewKey)),
							slidesToScroll: parseInt(this.getElementSettings(slidesPerScrollKey)),
						}
					}
					responsiveSettings.push(breakpoint_data);
				});
				settings.responsive = responsiveSettings;
				return $.extend({}, this.getSettings(), settings);
			},
			bindEvents: function bindEvents() {
				this.elements.$container.slick(this.getSlickSettings());
			},
		});

		// Counter
		var counterHandler = function($scope, $) {
			setTimeout(function() {
				elementorFrontend.waypoint($scope.find('.elementor-counter-number'), function() {
					var $number = $(this),
						data = $number.data();
					var decimalDigits = data.toValue.toString().match(/\.(.*)/);
					if(decimalDigits) {
						data.rounding = decimalDigits[1].length;
					}
					$number.numerator(data);
				});
			}, 150);
		};

		// Offcanvas
		var offcanvasToggle = function($scope, $) {
			$scope.find('.oxence-offcanvas').each(function() {
				var selector = $(this),
					toggle = selector.find('.offcanvas-toggle'),
					overly = selector.find('.offcanvas-overly'),
					close = selector.find('.offcanvas-close'),
					wrapper = selector.find('.oxence-offcanvas-wrapper');
				toggle.on('click', function(e) {
					wrapper.toggleClass('show-offcanvas');
				});
				overly.on('click', function(e) {
					wrapper.removeClass('show-offcanvas');
				});
				close.on('click', function(e) {
					wrapper.removeClass('show-offcanvas');
				});
			});
		};

		// Accordion
		var accordionHandler = function($scope, $) {
			$scope.find(".oxence-accordion .accordion-item .accordion-header").on("click", function(e) {
				e.preventDefault();
				const target = $(this).data("target"),
					parent = $(this).parents(".oxence-accordion"),
					active_items = parent.find(".accordion-header.active");
				$.each(active_items, function(index, item) {
					var item_target = $(item).data("target");
					if(item_target != target) {
						$(item).removeClass("active");
						$(this).parent().removeClass("active-accordion");
						$(item_target).slideUp(400);
					}
				});
				$(this).parent().toggleClass("active-accordion");
				$(this).toggleClass("active");
				$(target).slideToggle(400);
			});
		};

		// Isotope Filter
		var isotopeFilter = function($scope, $) {
			$scope.find('.isotope-filter').each(function() {
				$(this).imagesLoaded(function() {
					$('.isotope-filter-grid').each(function() {
						var iso = new Isotope(this, {
							layoutMode: 'masonry',
							itemSelector: '.isotope-filter-item',
							percentPosition: true,
							masonry: {
								columnWidth: '.isotope-filter-item',
							},
						});
						var filterItem = $(this).parent().find('.filter-nav-items li');
						filterItem.on('click', function(event) {
							event.preventDefault();
							var filterValue = event.target.getAttribute('data-filter');
							iso.arrange({
								filter: filterValue
							});
							filterItem.removeClass('active');
							$(this).addClass('active');
						});
					});
				});
			});
		};

		// Search Widget
		var widgetSearch = function($scope, $) {
			$scope.find('.oxence-search-wrapper').each(function() {
				var selector = $(this),
					searchButton = selector.find('.search-btn');
				searchButton.on('click', function(e) {
					e.preventDefault();
					selector.toggleClass('show-search');
				});
			});
		};

		// Progress Bar
		var progressBar = function($scope, $) {
			setTimeout(function() {
				elementorFrontend.waypoint($scope.find('.elementor-progress-bar'), function() {
					var $progressbar = $(this);
					$progressbar.css('width', $progressbar.data('max') + '%');
				});
				elementorFrontend.waypoint($scope.find('.elementor-counter-number'), function() {
					var $number = $(this),
						data = $number.data();
					var decimalDigits = data.toValue.toString().match(/\.(.*)/);
					if(decimalDigits) {
						data.rounding = decimalDigits[1].length;
					}
					$number.numerator(data);
				});
			}, 150);

			elementorFrontend.waypoint($scope.find('.oxence-progress-bar'), function() {
				const progressChart = $(this).find('.progress-chart');
				progressChart.easyPieChart({
					size: 125,
					scaleLength: 0,
					lineWidth: 7,
					lineCap: 'square',
					barColor: '#3180fc',
					trackColor: '#e9eaec',
					animate: ({
						duration: 1500,
						enabled: true
					}),
					rotate: 90,
				});
			});
		};

		// Content Switcher
		var contentSwitcher = function($scope) {
			$scope.find('.oxence-content-switcher').each(function() {
				var selector = $(this),
					toggleSwitch = selector.find('.switcher-input-label'),
					input = selector.find('input.switcher-checkbox'),
					primarySwitcher = selector.find('.primary-switch'),
					secondarySwitcher = selector.find('.secondary-switch'),
					primaryContent = selector.find('.primary-switch-content'),
					secondaryContent = selector.find('.secondary-switch-content');
				toggleSwitch.on('click', function(e) {
					if(input.is(':checked')) {
						primarySwitcher.removeClass('active');
						primaryContent.removeClass('active');
						secondarySwitcher.addClass('active');
						secondaryContent.addClass('active');
					} else {
						secondarySwitcher.removeClass('active');
						secondaryContent.removeClass('active');
						primarySwitcher.addClass('active');
						primaryContent.addClass('active');
					}
				});
			});
		};

		// Sticky Section
		var stickySection = function($scope) {
			$.each($scope, function(index) {
				const $sticky = $(this),
					$stickyH = $sticky.height(),
					$stickyID = $sticky.data('id'),
					$stickyPos = $sticky.position(),
					$currStickyPos = $stickyPos.top + $stickyH,
					$stickyAfter = '<div class="oxence-sticky-gap sticky-gap-' + $stickyID + '" style="height: ' + $stickyH + 'px"></div>';
				if($sticky.hasClass('oxence-sticky')) {
					$sticky.after($stickyAfter);
					const $stickyGap = $('.sticky-gap-' + $stickyID + '');
					$(window).on("scroll", function() {
						if($(this).scrollTop() < $currStickyPos) {
							$sticky.removeClass('oxence-sticky-active');
							$stickyGap.removeClass('active-sticky-gap');
						} else {
							$sticky.addClass('oxence-sticky-active');
							$stickyGap.addClass('active-sticky-gap');
						}
					});
				}
			});
		};

		elementorFrontend.hooks.addAction('frontend/element_ready/oxence-portfolio.default', function($scope) {
			elementorFrontend.elementsHandler.addHandler(oxenceSlider, {
				$element: $scope
			});
		});

		elementorFrontend.hooks.addAction('frontend/element_ready/oxence-team.default', function($scope) {
			elementorFrontend.elementsHandler.addHandler(oxenceSlider, {
				$element: $scope
			});
		});

		elementorFrontend.hooks.addAction('frontend/element_ready/oxence-services.default', function($scope) {
			elementorFrontend.elementsHandler.addHandler(oxenceSlider, {
				$element: $scope
			});
		});

		elementorFrontend.hooks.addAction('frontend/element_ready/oxence-recent-posts.default', function($scope) {
			elementorFrontend.elementsHandler.addHandler(oxenceSlider, {
				$element: $scope
			});
		});

		elementorFrontend.hooks.addAction('frontend/element_ready/oxence-testimonial.default', function($scope) {
			elementorFrontend.elementsHandler.addHandler(oxenceSlider, {
				$element: $scope
			});
		});

		elementorFrontend.hooks.addAction('frontend/element_ready/oxence-text-timeline.default', function($scope) {
			elementorFrontend.elementsHandler.addHandler(oxenceSlider, {
				$element: $scope
			});
		});

		elementorFrontend.hooks.addAction("frontend/element_ready/oxence-nav-menu.default", function() {
			if(window.elementorFrontend.isEditMode()) {
				navMenu();
			}
		});

		elementorFrontend.hooks.addAction("frontend/element_ready/oxence-counter.default", counterHandler);
		elementorFrontend.hooks.addAction("frontend/element_ready/oxence-offcanvas.default", offcanvasToggle);
		elementorFrontend.hooks.addAction("frontend/element_ready/oxence-accordion.default", accordionHandler);
		elementorFrontend.hooks.addAction("frontend/element_ready/oxence-portfolio.default", isotopeFilter);
		elementorFrontend.hooks.addAction("frontend/element_ready/oxence-mini-search.default", widgetSearch);
		elementorFrontend.hooks.addAction("frontend/element_ready/oxence-progress-bar.default", progressBar);
		elementorFrontend.hooks.addAction("frontend/element_ready/oxence-content-switcher.default", contentSwitcher);
		elementorFrontend.hooks.addAction("frontend/element_ready/oxence-play-video.default", popupVideo);
		elementorFrontend.hooks.addAction("frontend/element_ready/section", stickySection);
	});
})(jQuery);