jQuery(function($) {
	"use strict";
	var on_touch = !$('body').hasClass('ts_desktop');

	/** Mega menu **/
	ts_mega_menu_change_state();
	$('.elementor-widget-wp-widget-nav_menu .menu-item-has-children .sub-menu').before('<span class="ts-menu-drop-icon"></span>');

	/** Menu on IPAD **/
	if( on_touch || $(window).width() < 768 ) {
		ts_menu_action_on_ipad();
	}

	/** Sticky Menu **/
	if( typeof miti_params != 'undefined' && miti_params.sticky_header == 1 ) {
		ts_sticky_menu();
	}

	$('.icon-menu-sticky-header .icon').on('click', function(){
		$('header .header-bottom').slideToggle();
		$(this).toggleClass('active');
		ts_mega_menu_change_state();
	});

	/*** Store Notice ***/
	if( $('.ts-store-notice').length && typeof Cookies == 'function' ) {
		$('.ts-store-notice .close').on('click', function(){
			$('.ts-store-notice').slideUp();
			Cookies.set('ts_store_notice', 'hidden', { expires: 1 });
		});
	}

	/** Device - Resize action **/
	$(window).on('resize orientationchange', function(){
		ts_mega_menu_change_state();
	});

	/** To Top button **/
	$(window).on('scroll', function(){
		if( $(this).scrollTop() > 100 ) {
			$('#to-top').addClass('on');
		} else {
			$('#to-top').removeClass('on');
		}
	});
	$('#to-top .scroll-button').on('click', function(){
		$('body,html').animate({
			scrollTop: '0px'
		}, 1000);
		return false;
	});

	/** Quickshop **/
	$(document).on('click', 'a.quickshop', function(e){
		e.preventDefault();

		var product_id = $(this).data('product_id');
		if( product_id === undefined ) {
			return;
		}

		var container = $('#ts-quickshop-modal');
		container.addClass('loading');
		container.find('.quickshop-content').html('');
		$.ajax({
			type: 'POST'
			, url: miti_params.ajax_url
			, data: { action: 'miti_load_quickshop_content', product_id: product_id }
			, success: function(response) {
				container.find('.quickshop-content').html(response);

				setTimeout(function(){
					container.removeClass('loading').addClass('show');
				}, container.find('.product-type-variable').length ? 500 : 100);

				var $target = container.find('.woocommerce-product-gallery.images');

				if( typeof $.fn.flexslider == 'function' ) {
					var options = $.extend({
						selector: '.woocommerce-product-gallery__wrapper > .woocommerce-product-gallery__image', /* in target */
						start: function(){
							$target.css('opacity', 1);
						},
						after: function(slider) {
							quickshop_init_zoom(container.find('.woocommerce-product-gallery__image').eq(slider.currentSlide), $target);
						}
					}, miti_params.flexslider);

					$target.flexslider(options);

					container.find('.woocommerce-product-gallery__wrapper .woocommerce-product-gallery__image:eq(0) .wp-post-image').one('load', function(){
						var $image = $(this);

						if( $image ) {
							setTimeout(function(){
								var setHeight = $image.closest('.woocommerce-product-gallery__image').height();
								var $viewport = $image.closest('.flex-viewport');

								if( setHeight && $viewport ) {
									$viewport.height(setHeight);
								}
							}, 100);
						}
					}).each(function(){
						if( this.complete ) {
							$(this).trigger('load');
						}
					});
				}
				else {
					$target.css('opacity', 1);
				}

				quickshop_init_zoom(container.find('.woocommerce-product-gallery__image').eq(0), $target);

				$target.on('woocommerce_gallery_reset_slide_position', function(){
					if( typeof $.fn.flexslider == 'function' ) {
						$target.flexslider(0);
					}
				});

				$target.on('woocommerce_gallery_init_zoom', function(){
					quickshop_init_zoom(container.find('.woocommerce-product-gallery__image').eq(0), $target);
				});

				container.find('form.variations_form').wc_variation_form();
				container.find('form.variations_form .variations select').change();
				$('body').trigger('wc_fragments_loaded');

				container.find('form.variations_form').on('click', '.reset_variations', function(){
					$(this).parents('.variations').find('.ts-product-attribute .option').removeClass('selected');
				});
			}
		});
	});

	function quickshop_init_zoom(zoomTarget, $target) {
		if( typeof $.fn.zoom != 'function' ) {
			return;
		}

		var galleryWidth = $target.width(), zoomEnabled = false;

		$(zoomTarget).each(function(index, target) {
			var image = $(target).find('img');

			if( image.attr('data-large_image_width') > galleryWidth ) {
				zoomEnabled = true;
				return false;
			}
		});

		/* But only zoom if the img is larger than its container. */
		if( zoomEnabled ) {
			var zoom_options = $.extend({
				touch: false
			}, miti_params.zoom_options);

			if( 'ontouchstart' in document.documentElement ) {
				zoom_options.on = 'click';
			}

			zoomTarget.trigger('zoom.destroy');
			zoomTarget.zoom(zoom_options);

			setTimeout(function(){
				if( zoomTarget.find(':hover').length ) {
					zoomTarget.trigger('mouseover');
				}
			}, 100);
		}
	}

	$(document).on('click', '.ts-popup-modal .close, .ts-popup-modal .overlay', function(){
		$('.ts-popup-modal').removeClass('show');
		$('.ts-popup-modal .quickshop-content').html(''); /* prevent conflict with lightbox on single product */
	});

	/** Wishlist **/
	$(document).on('click', '.add_to_wishlist, .product a.compare:not(.added)', function(){
		$(this).addClass('loading');
	});

	$('body').on('added_to_wishlist', function(){
		ts_update_tini_wishlist();
		$('.add_to_wishlist').removeClass('loading');
		$('.yith-wcwl-wishlistaddedbrowse.show, .yith-wcwl-wishlistexistsbrowse.show').parent('.button-in.wishlist').addClass('added');
	});

	$('body').on('removed_from_wishlist added_to_cart', function(){
		if( $('.wishlist_table').length ) {
			ts_update_tini_wishlist();
		}
	});

	/** Compare **/
	$('body').on('yith_woocompare_open_popup', function(){
		$('.product a.compare').removeClass('loading');
	});

	/*** Color Swatch ***/
	$(document).on('click', '.products .product .color-swatch > div', function(){
		$(this).siblings().removeClass('active');
		$(this).addClass('active');
		/* Change thumbnail */
		var image_src = $(this).data('thumb');
		$(this).closest('.product').find('figure img:first').attr('src', image_src).removeAttr('srcset sizes');
		/* Change price */
		var term_id = $(this).data('term_id');
		var variable_prices = $(this).parent().siblings('.variable-prices');
		var price_html = variable_prices.find('[data-term_id="' + term_id + '"]').html();
		$(this).closest('.product').find('.meta-wrapper .price').html(price_html).addClass('variation-price');
	});

	/*** Product Stock - Variable Product ***/
	function single_variable_product_reset_stock(wrapper) {
		var stock_html = wrapper.find('.availability').data('original');
		var classes = wrapper.find('.availability').data('class');
		if( classes == '' ) {
			classes = 'in-stock';
		}
		wrapper.find('.availability .availability-text').html(stock_html);
		wrapper.find('.availability').removeClass('in-stock out-of-stock').addClass(classes);
	}

	$(document).on('found_variation', 'form.variations_form', function(){
		var wrapper = $(this).parents('.summary');
		if( wrapper.find('.single_variation .stock').length > 0 ) {
			var stock_html = wrapper.find('.single_variation .stock').html();
			var classes = wrapper.find('.single_variation .stock').hasClass('out-of-stock') ? 'out-of-stock' : 'in-stock';
			wrapper.find('.availability .availability-text').html(stock_html);
			wrapper.find('.availability').removeClass('in-stock out-of-stock').addClass(classes);
		}
		else {
			single_variable_product_reset_stock(wrapper);
		}
	});

	$(document).on('reset_image', 'form.variations_form', function(){
		var wrapper = $(this).parents('.summary');
		single_variable_product_reset_stock(wrapper);
	});

	/*** Variation attribute ***/
	$(document).on('change', 'form.variations_form .variations select', function(){
		var data = $(this).val();

		var dataAttr = ( data.length > 0 ) ? $(this).find("option[value='"+data+"']").text() : ' ';
		var attributes = $(this).parents('tr');
		var html = $("<span class='ts-value'></span>").text(dataAttr);

		attributes.find('td.label .ts-value').remove();
		attributes.find('td.label').append(html)
	});

	$('form.variations_form .variations select').trigger('change');

	/*** Variation price ***/
	$(document).on('found_variation', 'form.variations_form', function(e, variation) {
		var summary = $(this).parents('.summary');
		if( variation.price_html ) {
			summary.find('.ts-variation-price').html(variation.price_html).removeClass('hidden');
			summary.find('p.price').addClass('hidden');
		}
	});

	$(document).on('reset_image', 'form.variations_form', function(){
		var summary = $(this).parents('.summary');
		summary.find('p.price').removeClass('hidden');
		summary.find('.ts-variation-price').addClass('hidden');
	});

	/*** Hide product attribute if not available ***/
	$(document).on('update_variation_values', 'form.variations_form', function(){
		if( $(this).find('.ts-product-attribute').length > 0 ) {
			$(this).find('.ts-product-attribute').each(function(){
				var attr = $(this);
				var values = [];
				attr.siblings('select').find('option').each(function(){
					if( $(this).attr('value') ) {
						values.push($(this).attr('value'));
					}
				});
				attr.find('.option').removeClass('hidden');
				attr.find('.option').each(function(){
					if( $.inArray($(this).attr('data-value'), values) == -1 ) {
						$(this).addClass('hidden');
					}
				});
			});
		}
	});

	/*** Single ajax add to cart ***/
	if( typeof miti_params != 'undefined' && miti_params.ajax_add_to_cart == 1 && !$('body').hasClass('woocommerce-cart') ) {
		$(document).on('submit', '.product:not(.product-type-external) .summary form.cart', function(e){
			e.preventDefault();
			var form = $(this);
			var product_url = form.attr('action');
			var data = form.serialize();
			if( !form.hasClass('variations_form') && !form.hasClass('grouped_form') ) {
				data += '&add-to-cart=' + form.find('[name="add-to-cart"]').val()
			}
			form.find('.single_add_to_cart_button').removeClass('added').addClass('loading');
			$.post(product_url, data, function(result) {
				$(document.body).trigger('wc_fragment_refresh');
				var message_wrapper = $('#ts-ajax-add-to-cart-message');
				var error = '';
				result = $('<div>' + result + '</div>');
				if( result.find('.woocommerce-error').length ) {
					error = result.find('.woocommerce-error li:first').html();
				}
				form.find('.single_add_to_cart_button').removeClass('loading').addClass('added');
				message_wrapper.removeClass('error');
				if( error ) {
					message_wrapper.addClass('error');
					message_wrapper.find('.error-message').html(error);
					form.find('.single_add_to_cart_button').removeClass('added');
				}

				message_wrapper.addClass('show');
				setTimeout(function(){
					message_wrapper.removeClass('show');
				}, 2000);
			});
		});
	}

	/*** Custom Orderby on Product Page ***/
	$('form.woocommerce-ordering ul.orderby ul a').on('click', function(e){
		e.preventDefault();
		if( $(this).hasClass('current') ) {
			return;
		}
		var form = $('form.woocommerce-ordering');
		var data = $(this).attr('data-orderby');
		form.find('select.orderby').val(data).trigger('change');
	});

	/*** Per page on Product page ***/
	$('form.product-per-page-form ul.perpage ul a').on('click', function(e){
		e.preventDefault();
		if( $(this).hasClass('current') ) {
			return;
		}
		var form = $('form.product-per-page-form');
		var data = $(this).attr('data-perpage');
		form.find('select.perpage').val(data);
		form.submit();
	});

	/*** Product Columns Selector ***/
	$('.ts-product-columns-selector span').on('click', function(){
		var col = $(this).data('col');
		var style = $(this).data('style');
		$(this).addClass('selected').siblings().removeClass('selected');
		$('#main-content .woocommerce.main-products').removeClass('columns-1 columns-2 columns-3 columns-4 columns-5 columns-6');
		$('#main-content .woocommerce.main-products').removeClass('style-column-1 style-column-1-1 style-column-2 style-column-3 style-column-4 style-column-5 style-column-6');
		$('#main-content .woocommerce.main-products').addClass(['columns-' + col, 'style-column-' + style]);
	});

	/*** Quantity on shop page ***/
	$(document).on('change', '.products .product input[name="quantity"]', function(){
		var add_to_cart_button = $(this).parents('.product').find('.add_to_cart_button');
		var quantity = parseInt($(this).val());
		add_to_cart_button.attr('data-quantity', quantity);
		/* For non ajax */
		var href = '?add-to-cart=' + add_to_cart_button.eq(0).attr('data-product_id') + '&quantity=' + quantity;
		add_to_cart_button.attr('href', href);
	});

	/*** Widget toggle ***/
	$('.widget-title-wrapper a.block-control').on('click', function(e){
		e.preventDefault();
		$(this).toggleClass('active');
		$(this).parent().siblings(':not(script)').fadeToggle(200);
	});

	ts_widget_toggle();
	if( !on_touch ) {
		$(window).on('resize', function(){
			ts_widget_toggle();
		});
	}

	/*** Sort by toggle ***/
	$('.woocommerce-ordering li .orderby-current, .product-per-page-form li .perpage-current').on('click', function(e){
		$(this).siblings('.dropdown').fadeToggle(200);
		$(this).toggleClass('active');
		$(this).parent().parent().toggleClass('active');
		var type = $(this).hasClass('orderby-current') ? 'perpage' : 'orderby';
		hide_orderby_per_page_dropdown(type);
	});

	function hide_orderby_per_page_dropdown(type) {
		if( type == 'orderby' ) {
			var selector = $('.woocommerce-ordering li .orderby-current');
		}
		else if( type == 'perpage' ) {
			var selector = $('.product-per-page-form li .perpage-current');
		}
		else {
			var selector = $('.woocommerce-ordering li .orderby-current, .product-per-page-form li .perpage-current');
		}
		selector.siblings('.dropdown').fadeOut(200);
		selector.removeClass('active');
		selector.parent().parent().removeClass('active');
	}

	/* Image Lazy Load */
	if( $('img.ts-lazy-load').length ) {
		$(window).on('scroll ts_lazy_load', function(){
			var scroll_top = $(this).scrollTop();
			var window_height = $(this).height();
			$('img.ts-lazy-load:not(.loaded)').each(function(){
				if( $(this).data('src') && $(this).offset().top < scroll_top + window_height + 900 ) {
					$(this).attr('src', $(this).data('src')).addClass('loaded');
				}
			});
		});

		setTimeout(function(){
			if( $('img.ts-lazy-load:first').offset().top < $(window).scrollTop() + $(window).height() + 200 ) {
				$(window).trigger('ts_lazy_load');
			}
		}, 100);
	}

	/* WooCommerce Quantity Increment */
	$(document).on('click', '.plus, .minus', function(){
		var $qty = $(this).closest('.quantity').find('.qty'),
			currentVal = parseFloat($qty.val()),
			max = parseFloat($qty.attr('max')),
			min = parseFloat($qty.attr('min')),
			step = $qty.attr('step');

		if( !currentVal || currentVal === '' || currentVal === 'NaN' ) currentVal = 0;
		if( max === '' || max === 'NaN' ) max = '';
		if( min === '' || min === 'NaN' ) min = 0;
		if( step === 'any' || step === '' || step === undefined || parseFloat(step) === 'NaN' ) step = 1;

		if( $(this).is('.plus') ) {
			if( max && (max == currentVal || currentVal > max) ) {
				$qty.val(max);
			} else {
				$qty.val(currentVal + parseFloat(step));
			}
		} else {
			if( min && (min == currentVal || currentVal < min) ) {
				$qty.val(min);
			} else if( currentVal > 0 ) {
				$qty.val(currentVal - parseFloat(step));
			}
		}

		$qty.trigger('change');
	});

	/* Ajax Search */
	if( typeof miti_params != 'undefined' && miti_params.ajax_search == 1 ) {
		ts_ajax_search();
	}
	/* Shopping Cart Sidebar */
	$(document).on('click', '.search-button .icon, .shopping-cart-wrapper .cart-control', function(e){
		$('.ts-floating-sidebar .close').trigger('click');
		var is_cart = $(this).is('.cart-control');
		if( is_cart ) {
			if( $('#ts-shopping-cart-sidebar').length ) {
				e.preventDefault();
				$('#ts-shopping-cart-sidebar').addClass('active');
				$('body').addClass('floating-sidebar-active');

				/* Reset Dropdown Icon Class On Ipad */
				if( on_touch || $(window).width() < 768 ) {
					$('.ts-header .ts-menu-drop-icon').removeClass('active');
					$('.ts-header .ts-menu .sub-menu').hide();
				}

				/* Reset Menu One Page */
				setTimeout(function(){
					var menu_title_back = $('.tab-mobile-menu li.active span').text();/* main menu */
					$('#group-icon-header li.parent, #group-icon-header .ts-menu-drop-icon').removeClass('active');
					$('#group-icon-header ul.sub-menu, #group-icon-header .mobile-menu-wrapper').css('overflow', '');
					$('#group-icon-header ul.sub-menu').css('z-index', '');
					$('#group-icon-header .menu-title span').text(menu_title_back);
				}, 300);

				$('#group-icon-header').removeClass('active');
				$('body').removeClass('menu-mobile-active');
				$(this).removeClass('active');
			}
		}
		else if( $('#ts-search-sidebar').length > 0 ) {
			$('#ts-search-sidebar').addClass('active');
			$('body').addClass('floating-sidebar-active');
			setTimeout(function(){
				$('#ts-search-sidebar input[name="s"]').focus();
			}, 600);

			/* Reset search header version 1 */
			$('.header-middle .ts-search-by-category').removeClass('active');
			$('header .search-button').removeClass('active');
			$('body').removeClass('search-active');

			/* Reset Dropdown Icon Class On Ipad */
			$('.ts-menu-drop-icon').removeClass('active');
			var on_touch = !$('body').hasClass('ts_desktop');
			if( on_touch || $(window).width() < 768 ) {
				$('.ts-menu-drop-icon').removeClass('active');
				$('.ts-menu .sub-menu').hide();
			}
		}
		else if( $('.header-middle .ts-search-by-category').length > 0 ) {
			$('.header-middle .ts-search-by-category').toggleClass('active');
			$('header .search-button').toggleClass('active');
			$('body').toggleClass('search-active');
			setTimeout(function(){
				$('.header-middle .ts-search-by-category input[name="s"]').focus();
			}, 600);

			/* Reset Dropdown Icon Class On Ipad */
			$('.ts-menu-drop-icon').removeClass('active');
			var on_touch = !$('body').hasClass('ts_desktop');
			if( on_touch || $(window).width() < 768 ) {
				$('.ts-menu-drop-icon').removeClass('active');
				$('.ts-menu .sub-menu').hide();
			}
		}
	});

	$('.ts-floating-sidebar .overlay, .ts-floating-sidebar .close').on('click', function(){
		$('.ts-floating-sidebar').removeClass('active');

		$('body').removeClass('floating-sidebar-active');

		$('#group-icon-header').removeClass('active');
		$('body').removeClass('menu-mobile-active');
		$('.ts-mobile-icon-toggle .icon').removeClass('active');

		$('.filter-widget-area-button a').removeClass('active');
		$('.filter-widget-area-button a').html(miti_params.filter_button.showfilters);

		$('#main-content').removeClass('show-filter-sidebar');
		update_filter_area_main_content_height();
	});

	/* Add To Cart Effect */
	if( !$('body').hasClass('woocommerce-cart') ) {
		$(document.body).on('adding_to_cart', function(e, $button, data) {
			if( wc_add_to_cart_params.cart_redirect_after_add == 'no' ) {
				if( typeof miti_params != 'undefined' && miti_params.add_to_cart_effect == 'show_popup' && typeof $button != 'undefined' ) {
					var product_id = $button.attr('data-product_id');
					var container = $('#ts-add-to-cart-popup-modal');
					container.addClass('adding');
					$.ajax({
						type: 'POST'
						, url: miti_params.ajax_url
						, data: { action: 'miti_load_product_added_to_cart', product_id: product_id }
						, success: function(response) {
							container.find('.add-to-cart-popup-content').html(response);
							if( container.hasClass('loading') ) {
								container.removeClass('loading').addClass('show');
							}
							container.removeClass('adding');
						}
					});
				}
			}
		});

		$(document.body).on('added_to_cart', function(e, fragments, cart_hash, $button) {
			/* Show Cart Sidebar */
			if( typeof miti_params != 'undefined' && miti_params.show_cart_after_adding == 1 ) {
				$('.shopping-cart-wrapper .cart-control').trigger('click');
				return;
			}
			/* Cart Fly Effect */
			if( typeof miti_params != 'undefined' && typeof $button != 'undefined' ) {
				if( miti_params.add_to_cart_effect == 'fly_to_cart' ) {
					var cart = $('.shopping-cart-wrapper');
					if( cart.length == 2 ) {
						if( $(window).width() > 767 ) {
							cart = $('.shopping-cart-wrapper.hidden-phone');
						}
						else {
							cart = $('.shopping-cart-wrapper.mobile-cart');
						}
					}
					if( cart.length == 1 ) {
						var product_img = $button.closest('section.product').find('figure img').eq(0);
						if( product_img.length == 1 ) {
							var effect_time = 800;
							var cart_in_sticky = $('.is-sticky .shopping-cart-wrapper').length;
							if( cart_in_sticky ) {
								effect_time = 500;
							}

							var imgclone_height = product_img.width() ? 150 * product_img.height() / product_img.width() : 150;
							var imgclone_small_height = product_img.width() ? 75 * product_img.height() / product_img.width() : 75;

							var imgclone = product_img.clone().offset({ top: product_img.offset().top, left: product_img.offset().left })
								.css({ 'opacity': '0.6', 'position': 'absolute', 'height': imgclone_height + 'px', 'width': '150px', 'z-index': '99999999' })
								.appendTo($('body'))
								.animate({ 'top': cart.offset().top + cart.height() / 2, 'left': cart.offset().left + cart.width() / 2, 'width': 75, 'height': imgclone_small_height }, effect_time, 'linear');

							if( !cart_in_sticky ) {
								$('body,html').animate({
									scrollTop: '0px'
								}, effect_time);
							}

							imgclone.animate({
								'width': 0
								, 'height': 0
							}, function(){
								$(this).detach()
							});
						}
					}
				}
				if( miti_params.add_to_cart_effect == 'show_popup' ) {
					var container = $('#ts-add-to-cart-popup-modal');
					if( container.hasClass('adding') ) {
						container.addClass('loading');
					}
					else {
						container.addClass('show');
					}
				}
			}
		});
	}

	/* Disable Ajax Remove Cart Item on Cart and Checkout page */
	if( $('body').hasClass('woocommerce-cart') || $('body').hasClass('woocommerce-checkout') ) {
		$(document.body).off('click', '.remove_from_cart_button');
	}

	/* Show cart after removing item */
	$(document.body).on('click', '.shopping-cart-wrapper .remove_from_cart_button', function(){
		$(this).parents('.shopping-cart-wrapper').addClass('updating');
	});
	$(document.body).on('removed_from_cart', function(){
		if( $('.shopping-cart-wrapper.updating').length && !$('.shopping-cart-wrapper.updating').is(':hover') ) {
			$('.shopping-cart-wrapper').removeClass('updating');
		}
	});

	/* Change cart item quantity */
	$(document).on('change', '.ts-tiny-cart-wrapper .qty', function(){
		var qty = parseFloat($(this).val());
		var max = parseFloat($(this).attr('max'));
		if( max !== 'NaN' && max < qty ) {
			qty = max;
			$(this).val(max);
		}
		var cart_item_key = $(this).attr('name').replace('cart[', '').replace('][qty]', '');
		$(this).parents('.woocommerce-mini-cart-item').addClass('loading');
		$(this).parents('.shopping-cart-wrapper').addClass('updating');
		$('.woocommerce-message').remove();
		$.ajax({
			type: 'POST'
			, url: miti_params.ajax_url
			, data: { action: 'miti_update_cart_quantity', qty: qty, cart_item_key: cart_item_key }
			, success: function(response) {
				if( !response ) {
					return;
				}
				$(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash]);
				if( $('.shopping-cart-wrapper.updating').length && !$('.shopping-cart-wrapper.updating').is(':hover') ) {
					$('.shopping-cart-wrapper').removeClass('updating');
				}
			}
		});
	});

	$(document).on('mouseleave', '.shopping-cart-wrapper.updating', function(){
		$(this).removeClass('updating');
	});

	/* Filter Widget Area */
	var filter_sidebar_interval = 0;
	function update_filter_area_main_content_height() {
		if( !$('#ts-filter-widget-area').length ) {
			return;
		}
		if( $('#ts-filter-widget-area').hasClass('active') ) {
			filter_sidebar_interval = setInterval(function(){
				$('#main-content').css('min-height', $('#ts-filter-widget-area .filter-widget-area').height() + 20);
			}, 1000);
		}
		else {
			clearInterval(filter_sidebar_interval);
			$('#main-content').css('min-height', '');
		}
	}

	update_filter_area_main_content_height();

	$('.filter-widget-area-button a').on('click', function(){
		$(this).toggleClass('active');
		if( $(this).hasClass('active') ) {
			$(this).html(miti_params.filter_button.hidefilters);
		} else {
			$(this).html(miti_params.filter_button.showfilters);
		}

		$('#ts-filter-widget-area').toggleClass('active');

		$('#main-content').toggleClass('show-filter-sidebar');

		update_filter_area_main_content_height();

		hide_orderby_per_page_dropdown('both');
		return false;
	});

	/* Product On Sale Checkbox */
	$('.product-on-sale-form input[type="checkbox"]').on('change', function(){
		$(this).parents('form').submit();
	});

	/* Single post - Related posts - Gallery slider */
	ts_single_related_post_gallery_slider();

	/* Single Product - Variable Product options */
	$(document).on('click', '.variations_form .ts-product-attribute .option a', function(){
		var _this = $(this);
		var val = _this.closest('.option').data('value');
		var selector = _this.closest('.ts-product-attribute').siblings('select');
		if( selector.length > 0 ) {
			if( selector.find('option[value="' + val + '"]').length > 0 ) {
				selector.val(val).change();
				_this.closest('.ts-product-attribute').find('.option').removeClass('selected');
				_this.closest('.option').addClass('selected');
			}
		}
		return false;
	});

	$('.variations_form').on('click', '.reset_variations', function(){
		$(this).closest('.variations').find('.ts-product-attribute .option').removeClass('selected');
	});

	/* Related - Upsell - Crosssell products slider */
	$('.single-product .related .products, .single-product .upsells .products, .woocommerce .cross-sells .products, .error404 .new-arrivals .products').each(function(){
		var _this = $(this);
		if( _this.find('.product').length > 1 ) {
			_this.owlCarousel({
				loop: true
				, nav: true
				, navText: [,]
				, dots: false
				, navSpeed: 1000
				, rtl: $('body').hasClass('rtl')
				, margin: 0
				, navRewind: false
				, responsiveBaseElement: _this
				, responsiveRefreshRate: 1000
				, responsive: { 0: { items: 1 }, 303: { items: 2 }, 553: { items: 3 }, 925: { items: 4 }, 1133: { items: 5 }, 1403: { items: 6 } }
			});
		}
	});

	/* Blog Filter Bar */
	$('.blog-filter-bar li').on('click', function(){
		if( $(this).hasClass('current') ) {
			return;
		}
        
		$(this).addClass('current').siblings().removeClass('current');
		var list_posts = $(this).parent().siblings('.list-posts');
		var data_filter = $(this).data('filter');
        
		list_posts.find('> *').hide();
		var filtered_items = list_posts.find('> ' + data_filter);
		filtered_items = sort_filtered_blogs(filtered_items);
        $('.list-posts .post-item .gallery figure').trigger('refresh.owl.carousel');

		filtered_items.fadeIn();
		list_posts.prepend(filtered_items);
	});

	function sort_filtered_blogs(items) {
		return items.sort(function(a, b) {
			return parseInt( $(a).attr('data-index') ) > parseInt( $(b).attr('data-index') ) ? 1 : -1;
		});
	}

	/* Blog Comment */
	$('.ts-add-comment-button').on('click', function(e){
		e.preventDefault();
		if( $('.commentlist #comment-wrapper').length ) { /* is replying */
			$('#cancel-comment-reply-link').get(0).click();
			if( $('#comment-wrapper').css('display') == 'none' ) {
				$('#comment-wrapper').slideDown();
			}
		}
		else {
			$('#comment-wrapper').slideToggle();
		}
	});

	/* Single Portfolio Scrolling */
	ts_scrolling_fixed($('.single-portfolio.left-thumbnail.gallery .thumbnail'), $('.single-portfolio .entry-content'));

	/* Single Portfolio Slider */
	ts_generate_single_portfolio_slider();
});

/*** Mega menu ***/
var ts_mega_menu_timeout = 0;
function ts_mega_menu_change_state() {
	jQuery('.ts-mobile-icon-toggle .icon').off('click');
	jQuery('.ts-mobile-icon-toggle .icon').on('click', function(){

		var is_active = jQuery(this).hasClass('active');

		/* Reset Dropdown Icon Class On Ipad */
		jQuery('#ts-shopping-cart-sidebar').removeClass('active');
		jQuery('body').removeClass('floating-sidebar-active');
		var on_touch = !jQuery('body').hasClass('ts_desktop');
		if( on_touch || jQuery(window).width() < 768 ) {
			jQuery('.ts-header .ts-menu-drop-icon').removeClass('active');
			jQuery('.ts-header .ts-menu-drop-icon').siblings('.sub-menu').hide();
		}

		/* Reset Menu One Page */
		if( is_active ) {
			setTimeout(function(){
				jQuery('#group-icon-header li.parent').removeClass('active');
				jQuery('#group-icon-header .ts-menu-drop-icon').removeClass('active');
				jQuery('#group-icon-header ul.sub-menu').css('overflow', '');
				jQuery('#group-icon-header .mobile-menu-wrapper').css('overflow', '');
				jQuery('#group-icon-header ul.sub-menu').css('z-index', '');

				var menu_title_back = jQuery('.tab-mobile-menu li.active span').text();/* main menu */
				jQuery('#group-icon-header .menu-title span').text(menu_title_back);
			}, 300);

			jQuery('#group-icon-header').removeClass('active');
			jQuery('body').removeClass('menu-mobile-active');
			jQuery(this).removeClass('active');
		}
		else {
			jQuery('#group-icon-header').addClass('active');
			jQuery('body').addClass('menu-mobile-active');
			jQuery(this).addClass('active');
		}

		/* Mobile Menu One Page Spacing Bottom */
		var position_bottom = jQuery('#group-icon-header .group-button-header').outerHeight();
		jQuery('#group-icon-header .mobile-menu-wrapper').css('margin-bottom', position_bottom);
	});

	/* Reset Dropdown Icon Class On Ipad */
	jQuery('.ts-header .ts-menu-drop-icon').removeClass('active');

	if( window.outerWidth > 767 ) {

		var padding_left = 0, container_width = 0;
		var container = jQuery('.header-sticky .container:first');
		var container_stretch = jQuery('.header-sticky');
		if( container.length <= 0 ) {
			container = jQuery('.header-sticky');
			if( container.length <= 0 ) {
				return;
			}
			container_width = container.outerWidth();
		}
		else {
			container_width = container.width();
			padding_left = parseInt(container.css('padding-left'));
		}
		var container_offset = container.offset();

		var container_stretch_width = container_stretch.outerWidth();
		var container_stretch_offset = container_stretch.offset();
		
		clearTimeout( ts_mega_menu_timeout );
		
		ts_mega_menu_timeout = setTimeout(function(){
			jQuery('.ts-menu nav.main-menu > ul.menu > .ts-megamenu-fullwidth').each(function(index, element) {
				var current_offset = jQuery(element).offset();
				if( jQuery(element).hasClass('ts-megamenu-fullwidth-stretch') ) {
					var left = current_offset.left - container_stretch_offset.left;
					jQuery(element).children('ul.sub-menu').css({ 'width': container_stretch_width + 'px', 'left': -left + 'px', 'right': 'auto' });
				}
				else {
					var left = current_offset.left - container_offset.left - padding_left;
					jQuery(element).children('ul.sub-menu').css({ 'width': container_width + 'px', 'left': -left + 'px', 'right': 'auto' });
				}
			});

			jQuery('.ts-menu nav.main-menu > ul.menu').children('.ts-megamenu-columns-1, .ts-megamenu-columns-2, .ts-megamenu-columns-3, .ts-megamenu-columns-4').each(function(index, element) {
				jQuery(element).children('ul.sub-menu').css({ 'max-width': container_width + 'px' });
				var sub_menu_width = jQuery(element).children('ul.sub-menu').outerWidth();
				var item_width = jQuery(element).outerWidth();
				jQuery(element).children('ul.sub-menu').css({ 'left': '-' + (sub_menu_width / 2 - item_width / 2) + 'px', 'right': 'auto' });

				var container_left = container_offset.left;
				var container_right = container_left + container_width;
				var item_left = jQuery(element).offset().left;

				var overflow_left = (sub_menu_width / 2 > (item_left + item_width / 2 - container_left));
				var overflow_right = ((sub_menu_width / 2 + item_left + item_width / 2) > container_right);
				if( overflow_left ) {
					var left = item_left - container_left - padding_left;
					jQuery(element).children('ul.sub-menu').css({ 'left': -left + 'px', 'right': 'auto' });
				}
				if( overflow_right && !overflow_left ) {
					var left = item_left - container_left - padding_left;
					left = left - (container_width - sub_menu_width);
					jQuery(element).children('ul.sub-menu').css({ 'left': -left + 'px', 'right': 'auto' });
				}
			});

			/* Remove hide class after loading */
			jQuery('ul.menu li.menu-item').removeClass('hide');

		}, 800);

	}
	else { /* Mobile menu action */
		jQuery('.ic-mobile-menu-button').off('click');
		jQuery('.ic-mobile-menu-button').on('click', function(){
			jQuery('#page').addClass('menu-mobile-active');
		});

		jQuery('.ic-mobile-menu-close-button').off('click');
		jQuery('.ic-mobile-menu-close-button').on('click', function(){
			jQuery('#page').removeClass('menu-mobile-active');
		});

		jQuery('#wpadminbar').css('position', 'fixed');

		/* Remove hide class after loading */
		jQuery('ul.menu li.menu-item').removeClass('hide');
	}

}

function ts_menu_action_on_ipad() {
	/* Main Menu Drop Icon */
	jQuery('.ts-menu nav.main-menu .ts-menu-drop-icon').on('click', function(){

		var is_active = jQuery(this).hasClass('active');
		var sub_menu = jQuery(this).siblings('.sub-menu');

		jQuery('.ts-menu nav.main-menu .ts-menu-drop-icon').removeClass('active');
		jQuery('.ts-menu nav.main-menu .sub-menu').hide();

		jQuery(this).parents('.sub-menu').show();
		jQuery(this).parents('.sub-menu').siblings('.ts-menu-drop-icon').addClass('active');

		/* Reset Dropdown Cart */
		jQuery('header .shopping-cart-wrapper').removeClass('active');

		if( sub_menu.length > 0 ) {
			if( is_active ) {
				sub_menu.fadeOut(250);
				jQuery(this).removeClass('active');
			}
			else {
				sub_menu.fadeIn(250);
				jQuery(this).addClass('active');
			}
		}
	});

	/* Mobile Menu Drop Icon */
	if( jQuery('.ts-menu nav.mobile-menu .ts-menu-drop-icon').length > 0 ) {
		jQuery('.ts-menu nav.mobile-menu .sub-menu').hide();
	}

	jQuery('.ts-menu.mobile-menu-wrapper .ts-menu-drop-icon').on('click', function(){
		var is_active = jQuery(this).hasClass('active');
		var sub_menu = jQuery(this).siblings('.sub-menu');
		var li_parent = jQuery(this).parent();
		var ul_submenu = jQuery(this).closest('.sub-menu');

		if( is_active ) {
			if( ul_submenu.length ) {
				var z_index = ul_submenu.css('z-index');
				z_index = parseInt(z_index) - 1;
				ul_submenu.css('z-index', z_index);
				ul_submenu.css('overflow', 'scroll');
				ul_submenu.css('bottom', '0');
			}
			else {
				jQuery('#group-icon-header .mobile-menu-wrapper').css('overflow', 'scroll');
			}

			sub_menu.find('.ts-menu-drop-icon').removeClass('active');
			li_parent.removeClass('active');
			jQuery(this).removeClass('active');

			if( ul_submenu.length == 0 ) { /* First level */
				var menu_title_back = jQuery('.tab-mobile-menu li.active span').text();
			}
			else {
				if( ul_submenu.siblings('a').find('.menu-label').length ) {
					var menu_title_back = ul_submenu.siblings('a').find('.menu-label').text();
				}
				else {
					var menu_title_back = ul_submenu.siblings('a').text();
				}
			}
			jQuery('#group-icon-header .menu-title span').text(menu_title_back);
		}
		else {
			if( ul_submenu.length ) {
				var z_index = ul_submenu.css('z-index');
				z_index = parseInt(z_index) + 1;
				ul_submenu.css('z-index', z_index);
				ul_submenu.css('overflow', 'hidden');
				ul_submenu.css('bottom', 'auto');
			}
			else {
				jQuery('#group-icon-header .mobile-menu-wrapper').css('overflow', 'hidden');
			}
			li_parent.addClass('active');
			jQuery(this).addClass('active');

			if( li_parent.find('> a .menu-label').length ) {
				var menu_title = li_parent.find('> a .menu-label').text();
			}
			else {
				var menu_title = li_parent.find('> a').text();
			}

			jQuery('#group-icon-header .menu-title span').text(menu_title);
		}
	});

}

/*** End Mega menu ***/

/*** Sticky Menu ***/
function ts_sticky_menu() {
	var top_begin = jQuery('header.ts-header').height() + 300;

	var sub_menu = jQuery('.main-menu > ul > li > ul.sub-menu');

	setTimeout(function(){
		jQuery('.header-sticky').mysticky({
			topBegin: top_begin
			, scrollOnTop: function(){
				ts_mega_menu_change_state();

				/* RESET MENU STICKY */
				jQuery('header .header-bottom').css('display', '');
				jQuery('.icon-menu-sticky-header .icon').removeClass('active');

				sub_menu.css('display', 'none');
				setTimeout(function(){
					sub_menu.css('display', '');
				}, 500);
			}
			, scrollOnBottom: function(){
				ts_mega_menu_change_state();

				sub_menu.css('display', 'none');
				setTimeout(function(){
					sub_menu.css('display', '');
				}, 500);
			}
		});
	}, 200);
}

/*** Custom Wishlist ***/
function ts_update_tini_wishlist() {
	if( typeof miti_params == 'undefined' ) {
		return;
	}

	var wishlist_wrapper = jQuery('.my-wishlist-wrapper');
	if( wishlist_wrapper.length == 0 ) {
		return;
	}

	wishlist_wrapper.addClass('loading');

	jQuery.ajax({
		type: 'POST'
		, url: miti_params.ajax_url
		, data: { action: 'miti_update_tini_wishlist' }
		, success: function(response) {
			var first_icon = wishlist_wrapper.children('i.fa:first');
			wishlist_wrapper.html(response);
			if( first_icon.length > 0 ) {
				wishlist_wrapper.prepend(first_icon);
			}
			wishlist_wrapper.removeClass('loading');
		}
	});
}

/*** End Custom Wishlist***/

/*** Widget toggle ***/
function ts_widget_toggle() {
	jQuery('.footer-container .widget-title-wrapper a.block-control').remove();

	if( window.outerWidth >= 768 ) {
		jQuery('.widget-title-wrapper a.block-control').removeClass('active').hide();
		jQuery('.widget-title-wrapper a.block-control').parent().siblings(':not(script)').show();
	}
	else {
		jQuery('.widget-title-wrapper a.block-control').removeClass('active').show();
		jQuery('.widget-title-wrapper a.block-control').parent().siblings(':not(script)').hide();
		jQuery('.footer-container .widget-title-wrapper').siblings(':not(script)').show();
	}
}

/*** Ajax search ***/
function ts_ajax_search() {
	var search_string = '';
	var search_previous_string = '';
	var search_timeout;
	var search_delay = 700;
	var search_input;
	var search_cache_data = {};
	jQuery('body').append('<div id="ts-search-result-container" class="ts-search-result-container woocommerce"></div>');
	var search_result_container = jQuery('#ts-search-result-container');
	var search_result_container_sidebar = jQuery('#ts-search-sidebar .ts-search-result-container');
	var is_sidebar = false;

	jQuery('.ts-header .search-content input[name="s"], #ts-search-sidebar input[name="s"]').on('keyup', function(e){
		is_sidebar = jQuery(this).parents('#ts-search-sidebar').length > 0;
		search_input = jQuery(this);
		search_result_container.hide();

		search_string = jQuery(this).val().trim();
		if( search_string.length < 2 ) {
			search_input.parents('.search-content').removeClass('loading');
			return;
		}

		if( search_cache_data[search_string] ) {
			if( !is_sidebar ) {
				search_result_container.html(search_cache_data[search_string]);
				search_result_container.fadeIn(200);
			}
			else {
				search_result_container_sidebar.html(search_cache_data[search_string]);
			}
			search_previous_string = '';
			search_input.parents('.search-content').removeClass('loading');

			if( !is_sidebar ) {
				search_result_container.find('.view-all-wrapper a').on('click', function(e){
					e.preventDefault();
					search_input.parents('form').submit();
				});
			}
			else {
				search_result_container_sidebar.find('.view-all-wrapper a').on('click', function(e){
					e.preventDefault();
					search_input.parents('form').submit();
				});
			}

			return;
		}

		clearTimeout(search_timeout);
		search_timeout = setTimeout(function(){
			if( search_string == search_previous_string || search_string.length < 2 ) {
				return;
			}

			search_previous_string = search_string;

			search_input.parents('.search-content').addClass('loading');

			/* check category */
			var category = '';
			var select_category = search_input.parents('.search-content').siblings('.select-category');
			if( select_category.length > 0 ) {
				category = select_category.find(':selected').val();
			}

			jQuery.ajax({
				type: 'POST'
				, url: miti_params.ajax_url
				, data: { action: 'miti_ajax_search', search_string: search_string, category: category }
				, error: function(xhr, err) {
					search_input.parents('.search-content').removeClass('loading');
				}
				, success: function(response) {
					if( response != '' ) {
						response = JSON.parse(response);
						if( response.search_string == search_string ) {
							search_cache_data[search_string] = response.html;
							if( !is_sidebar ) {
								search_result_container.html(response.html);

								var top = search_input.offset().top + search_input.outerHeight(true);

								search_result_container.css({
									'position': 'absolute'
									, 'top': top
								}).fadeIn(200);
							}
							else {
								search_result_container_sidebar.html(response.html);
							}

							search_input.parents('.search-content').removeClass('loading');

							if( !is_sidebar ) {
								search_result_container.find('.view-all-wrapper a').on('click', function(e){
									e.preventDefault();
									search_input.parents('form').submit();
								});
							}
							else {
								search_result_container_sidebar.find('.view-all-wrapper a').on('click', function(e){
									e.preventDefault();
									search_input.parents('form').submit();
								});
							}
						}
					}
					else {
						search_input.parents('.search-content').removeClass('loading');
					}
				}
			});
		}, search_delay);
	});

	search_result_container.on('mouseleave', function(){
		search_result_container.hide();
	});

	jQuery('body').on('click', function(){
		search_result_container.hide();
	});

	jQuery(window).on('orientationchange', function(){
		search_previous_string = '';
		search_cache_data = {};
		search_result_container.hide();
	});

	jQuery('.ts-search-by-category select.select-category').on('change', function(){
		search_previous_string = '';
		search_cache_data = {};
		jQuery(this).parents('.ts-search-by-category').find('.search-content input[name="s"]').trigger('keyup');
	});
}

/*** Single post - Related posts - Gallery slider ***/
function ts_single_related_post_gallery_slider() {
	if( jQuery('.single-post figure.gallery, .list-posts .post-item .gallery figure, .ts-blogs-widget .thumbnail.gallery figure').length > 0 ) {
		var _this = jQuery('.single-post figure.gallery, .list-posts .post-item .gallery figure, .ts-blogs-widget .thumbnail.gallery figure');
		var slider_data = {
			items: 1
			, loop: true
			, nav: true
			, dots: false
			, animateIn: 'fadeIn'
			, animateOut: 'fadeOut'
			, navText: [,]
			, navSpeed: 1000
			, rtl: jQuery('body').hasClass('rtl')
			, margin: 10
			, navRewind: false
			, autoplay: true
			, autoplayTimeout: 4000
			, autoplayHoverPause: true
			, autoplaySpeed: false
			, mouseDrag: false
			, responsive: { 0: { items: 1 } }
			, onInitialized: function(){
				_this.removeClass('loading');
				_this.parent('.gallery').addClass('loaded').removeClass('loading');
			}
		};
		_this.each(function(){
			var validate_slider = true;

			if( jQuery(this).find('img').length <= 1 ) {
				validate_slider = false;
			}

			if( validate_slider ) {
				jQuery(this).owlCarousel(slider_data);
			}
			else {
				jQuery(this).removeClass('loading');
				jQuery(this).parent('.gallery').removeClass('loading');
			}
		});
	}

	if( jQuery('.single-post .related-posts.loading').length > 0 ) {
		var _this = jQuery('.single-post .related-posts.loading');
		var slider_data = {
			loop: true
			, dots: false
			, rtl: jQuery('body').hasClass('rtl')
			, margin: 0
			, navRewind: false
			, autoplay: true
			, autoplaySpeed: 1000
			, responsiveBaseElement: _this
			, responsiveRefreshRate: 400
			, responsive: { 0: { items: 1 }, 460: { items: 2 }, 760: { items: 3 }, 1400: { items: 4 } }
			, onInitialized: function(){
				_this.addClass('loaded').removeClass('loading');
			}
		};
		_this.find('.content-wrapper .blogs').owlCarousel(slider_data);
	}

}

/*** Single Portfolio Slider ***/
function ts_generate_single_portfolio_slider() {
	if( jQuery('.single-portfolio.slider .thumbnail figure img').length > 1 ) {
		var wrapper = jQuery('.single-portfolio.slider');
		var element = jQuery('.single-portfolio.slider .thumbnail figure');
		element.owlCarousel({
			items: 1
			, loop: true
			, nav: true
			, navText: [,]
			, dots: false
			, navSpeed: 1000
			, rtl: jQuery('body').hasClass('rtl')
			, navRewind: false
			, autoHeight: true
			, onInitialized: function(){
				wrapper.find('.thumbnail').addClass('loaded').removeClass('loading');
			}
		});
	}
	else {
		jQuery('.single-portfolio.slider .thumbnail').removeClass('loading');
	}
}

/*** Scrolling Fixed ***/
function ts_scrolling_fixed(scrolling_element, fixed_element) {
	if( scrolling_element.length == 0 || fixed_element.length == 0 || jQuery(window).width() < 991
		|| fixed_element.height() >= scrolling_element.height() ) {
		return;
	}

	var fixed_left = fixed_element.offset().left;
	var fixed_width = fixed_element.outerWidth();
	var admin_bar_height = jQuery('#wpadminbar').length > 0 ? jQuery('#wpadminbar').outerHeight() : 0;
	var window_height = jQuery(window).height();

	jQuery(window).on('scroll', function(){
		var window_scroll_top = jQuery(this).scrollTop();
		var sticky_height = 0;
		if( jQuery('.is-sticky .header-sticky').length > 0 ) {
			sticky_height = jQuery('.is-sticky .header-sticky').outerHeight();
		}

		var fixed_height = fixed_element.height();
		var scrolling_height = scrolling_element.height();
		var scrolling_top = scrolling_element.offset().top;
		var start_scroll = fixed_height > window_height ? fixed_height - window_height : 0;

		if( window_scroll_top > scrolling_top + start_scroll - admin_bar_height - 20 ) {
			var top = sticky_height + admin_bar_height + 20;

			if( start_scroll ) {
				top = -start_scroll;
			}
			if( window_scroll_top + top + fixed_height > scrolling_top + scrolling_height ) {
				top = scrolling_height - fixed_height + scrolling_top - window_scroll_top;
			}
			fixed_element.css({
				'position': 'fixed', 'left': fixed_left, 'top': top, 'width': fixed_width
				, 'transition': ((top < 60 + admin_bar_height && sticky_height) || miti_params.sticky_header == 0 ? 'none' : '')
			});
		}
		else {
			fixed_element.attr('style', '');
		}
	});
}