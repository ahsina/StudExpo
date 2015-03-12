Handlebars.registerHelper('is', function (value, test, options) {
	if(value && value === test) return options.fn(this)
	else return options.inverse(this)
});

jQuery(function ($) {
	var template = {
		modal: $('#handlebars-modal').length ? Handlebars.compile( $('#handlebars-modal').html() ) : null,
		gallery: $('#handlebars-gallery').length ? Handlebars.compile( $('#handlebars-gallery').html() ) : null,
	};

	var $body = $('body');

	$body.on('change', '.upload input[type="file"]', function (e) {
		e.preventDefault()

		var $this = $(this),
			$input = $this.next().find('input');

			$input.val($this.val().split('\\')[2]);
	});

	$('.scrollbar').each(function () {
		var $this = $(this),
			$swiperSlide = $('.swiper-slide', $this),
			$swiperSlideItems = $('> *', $swiperSlide);

		var width = 0;

		$swiperSlideItems.each(function () {
			width += $(this).outerWidth(true);
		});

		$swiperSlide.width(width);

		new Swiper($this[0], {
			mousewheelControl: true,
			scrollContainer: true,
			scrollbar: {
				container: '.swiper-scrollbar',
				hide: false
			}
		});
	});

	$('.slider').each(function () {
		var cPag = '',
			$this = $(this),
			$swiperSlide = $('.swiper-slide', $this),
			$swiperPagination = $('.swiper-pagination', $this);

		$this.on('click', '.slider__next', function (e) {
			e.preventDefault()

			var $current = $('.swiper-active-switch', $this),
				$next = $current.next();

			if($next.length > 0 ) $next.trigger('click');
			else $('.swiper-pagination-switch', $this).first().trigger('click');
		}).on('click', '.slider__prev', function (e) {
			e.preventDefault()

			var $current = $('.swiper-active-switch', $this),
				$prev = $current.prev();

			if($prev.length > 0) $prev.trigger('click');
			else $('.swiper-pagination-switch', $this).last().trigger('click');
		});

		if($this.attr('num')) cPag = '-' + $this.attr('num');

		var looping = true;
		if ($('.swiper-slide').length < 2) {
			looping = false;
		}
		
		if($('.page').hasClass('page-product-details')) {
				
			if (looping) {
				new Swiper($this[0], {
					autoplay: 7000,
					loop: looping,
					pagination: '.swiper-pagination' + cPag,
					paginationClickable: true
				});
			}
			else {
				new Swiper($this[0], {
					paginationClickable: false
				});
			}

		} else {
			if (looping) {
				new Swiper($this[0], {
					autoplay: 5000,
					loop: looping,
					pagination: '.swiper-pagination' + cPag,
					paginationClickable: true
				});
			}
			else {
				new Swiper($this[0], {
					paginationClickable: false
				});
			}
		}
	});

	$('.list-products__filters__filter h3').on('click', function () {
		var $this = $(this);

		if($this.parent().hasClass('list-products__filters__filter--open')) $this.parent().removeClass('list-products__filters__filter--open');
		else $this.parent().addClass('list-products__filters__filter--open');
	});

	$('.container-bandeau .bandeau').on('click', function () {
		var $this = $(this);

		if($this.parent().parent().hasClass('container-bandeau--open')) $this.parent().parent().removeClass('container-bandeau--open');
		else $this.parent().parent().addClass('container-bandeau--open');
	});

	$('.list-products__sort-by select, .page-workbook__filters-select select').on('change', function () {
		var $this = $(this),
			$parent = $this.parent(),
			$value = $('.value', $parent);

		$value.text($this.find('option:selected').text());
	}).trigger('change');

	$('.page-workbook').each(function () {
		var $this = $(this);
		var $products = $('.page-workbook__products', $this);

		$products.isotope({itemSelector: '.product'});
	});

	$('.header__navbar-mobile').each(function () {
		var $this = $(this),
			$btnMenu = $('.btn-menu', $this),
			$btnSearch = $('.btn-search', $this);

		var $headerDefault = $('.header__navbar-default'),
			$headerSup = $('.header__navbar-sup'),
			$formSearch = $('form', $this);

		$btnMenu.on('click', function (e) {
			e.preventDefault();

			if($(this).hasClass('btn-menu--active')) {
				$(this).removeClass('btn-menu--active');
				$headerDefault.removeClass('show');
				$headerSup.removeClass('show');
			}
			else {
				$(this).addClass('btn-menu--active');
				$headerDefault.addClass('show');
				$headerSup.addClass('show');
			}
		});

		$btnSearch.on('click', function (e) {
			e.preventDefault();

			if ($(this).hasClass('btn-search--active')) {
				$(this).removeClass('btn-search--active');
				$formSearch.hide();
			}
			else {
				$(this).addClass('btn-search--active');
				$formSearch.show();
			}
		});
	});

	$('.page-index__gallery').each(function () {
		var $this = $(this),
			$items = $('.swiper-container a', $this);

		$this.on('click', '.gallery__start', function (e) {
			e.preventDefault();

			var images = [];

			$items.each(function () {
				var $item = $(this);

				images.push({
					link: $item.data('link'),
					title: $item.data('title'),
					text: $item.data('text'),
					image: $item.data('image')
				})
			});

			var $modal = $(template.gallery({
					count: images.length,
					images: images
				})
			);

			$modal.appendTo($body).modal().on('shown.bs.modal', function () {
				var mySwiper = new Swiper($('.swiper-container', $modal)[0], {
					loop: true,
					calculateHeight: true,
					onSlideChangeEnd: function (swiper) {
						$('.swiper-index', $modal).text(swiper.activeLoopIndex + 1);
					}
				});

				mySwiper.resizeFix();
			}).on('hidden.bs.modal', function () {
				$modal.remove();
			})
		})
		.on('click', '.swiper-slide a', function (e) {
			e.preventDefault();

			var $item = $(this);

			$('.gallery__item--active', $this).removeClass('gallery__item--active');

			$item.addClass('gallery__item--active');

			$('.gallery__current', $this).find('img').prop('src', $item.data('image')).end().find('.gallery__current__caption').find('h4').text($item.data('title')).end().find('p').text($item.data('text')).end().find('.btn:first').attr('href', $item.data('link')).end().find('.btn-bookit').attr('href', $item.data('bookitlink'));
		}).find('.swiper-slide a:first').trigger('click');
	});

	$('.header__navbar-default').each(function () {
		var $this = $(this);

		var $navBarNav = $('.navbar-nav', $this),
			$headerMobile = $('.header__navbar-mobile');

		$navBarNav.on('click', '> li > a.no-link', function (e) {
			e.preventDefault();

			var $nav = $(this).next();

			if($nav.hasClass('open')) {
				$(this).removeClass('open').parent().removeClass('open');
				$nav.removeClass('open');
			}
			else {
				if(!$headerMobile.is(':visible')) $('.header__navbar-default .open').removeClass('open');

				$(this).addClass('open').parent().addClass('open');
				$nav.addClass('open');
			}
		});
	});

	$('.footer').each(function () {
		var $this = $(this);
		var $headerMobile = $('.header__navbar-mobile');

		$this.on('click', 'h4', function (e) {
			if($headerMobile.is(':visible')) {
				var $nav = $(this).next();

				if($nav.hasClass('open')) {
					$(this).removeClass('open');
					$nav.removeClass('open');
				}
				else {
					$(this).addClass('open');
					$nav.addClass('open');
				}
			}
		});
	});


	$('[data-split]').each(function () {
		var $this = $(this);
		var $items = $('ul li', $this);
		var split = $this.data('split'),
			splitClass = $this.data('split-class');

		var $col = null,
			i = 0;

		$items.each(function () {
			var $item = $(this);

			if(i == split) {
				i = 0;

				if($col != null) $col.insertBefore($this.parent().find('> div:last'));

				$col = null;
			}

			if($col == null) $col = $('<div />').addClass(splitClass).append($('<ul />'));

			$('ul', $col).append($item);
			i++;
		});

		if ($col != null) $col.insertBefore($this.parent().find('> div:last'));

		$this.remove();
	});

	if($('.back-to-top').length > 0) {
		$(window).scroll(function() {
			var windowHeight = $(window).height();
			var documentHeight = $(document).height();
			var movePosition = $(document).scrollTop();
			var footerHeight = $('.footer').height();
			var heightToBottom = documentHeight - movePosition - windowHeight;

			if(movePosition == 0) $('.back-to-top').removeClass('back-to-top-fixed');
			else if(heightToBottom > footerHeight) $('.back-to-top').addClass('back-to-top-fixed');
			else $('.back-to-top').removeClass('back-to-top-fixed');
		});
	}

	$('.back-to-top').click(function (e) {
		e.preventDefault();

		$('html, body').animate({ scrollTop: 0 }, 0);
	});

	$('.colors').each(function () {
		var $this = $(this);

		$this.on('click', '.colors__color', function (e) {
			e.preventDefault();

			$('.colors__color.selected').removeClass('selected');
			$(this).addClass('selected');
			$('.list-products__filters__filter span.title').text($(this).find('img').attr('title'));
		});
	});

	/********** PRESS RELEASE ARTICLE **********/
	/*Suppression popin*/
	$.fn.removePop = function () {
		if($(window).width() < 376 && $('.temp-article').hasClass('fancyPressReleaseArticle')) {
			$('.temp-article').removeClass('fancyPressReleaseArticle');
			$('.page-press-room.press-release .bloc .bloc-temp .temp-article').css({cursor: 'auto'});
		}
		else if(!$('.temp-article').hasClass('fancyPressReleaseArticle')) {
			$('.temp-article').addClass('fancyPressReleaseArticle')
			$('.page-press-room.press-release .bloc .bloc-temp .temp-article').css({cursor: 'pointer'});
		}
	}
	
	$(window).removePop();//Suppression popin

	$(window).resize(function () {
		$(window).removePop();//Suppression popin
	});
	/********** PRESS RELEASE ARTICLE **********/

	/********** FANCYBOX WITH TITLE **********/
	var cRef = '',
		cTitre = '',
		cDescription = '',
		cVideo = '',
		nW = 700,
		nH = 0,
		nID = 0;

	/***** MODAL WITH TITLE *****/
	$('.fancyBoxTitle').click(function (e) {
		e.preventDefault();

		cRef = $(this).attr('ref');

		if(cRef == 'compare') {
			cTitre = '<h4>' + $(this).attr('title') + '</h4>';
			nW = 900;
			nH = 600;
		}
		else if (cRef == 'compareerror') {
			cTitre = '<div class="error">you can only compare products from the same category.</div>';
			nID = $(this).attr('dataID');
			nW = 550;
			nH = 150;
		}
		else if (cRef == 'delitem') {
			cTitre = '<h4>' + $(this).attr('title') + '</h4>';
			nID = $(this).attr('dataID');
			nW = 500;
			nH = 120;
		}
		else if (cRef == 'delworkbook') {
			cTitre = '<h4>' + $(this).attr('title') + '</h4>';
			nID = $(this).attr('dataID');
			nW = 500;
			nH = 120;
		}
		else if (cRef == 'editnote') {
			cTitre = '<h4>' + $(this).attr('title') + '</h4>';
			nID = $(this).attr('dataID');
			nW = 700;
			nH = 380;
		}
		else if (cRef == 'shareemail') {
			cTitre = '<h4>' + $(this).attr('title') + '</h4>';
			nID = $(this).attr('dataID');
			nW = 600;
			nH = 600;
		}
		else if (cRef == 'moveitem') {
			cTitre = '<h4>' + $(this).attr('title') + '</h4>';
			nID = $(this).attr('dataID');
			nW = 850;
			nH = 110;
		}
		else if (cRef == 'createworkbook') {
			cTitre = '<h4>' + $(this).attr('title') + '</h4>';
			nID = $(this).attr('dataID');
			nW = 700;
			nH = 150;
		}
		else if (cRef == 'renameworkbook') {
			cTitre = '<h4>' + $(this).attr('title') + '</h4>';
			nID = $(this).attr('dataID');
			nW = 850;
			nH = 110;
		}
		else if (cRef == 'savetoworkbook1') {
			cTitre = '<h4>' + $(this).attr('title') + '</h4>';
			nID = $(this).attr('dataID');
			nW = 700;
			nH = 390;
		}
		else if (cRef == 'savetoworkbook2') {
			cTitre = '<h4>' + $(this).attr('title') + '</h4>';
			nID = $(this).attr('dataID');
			nW = 700;
			nH = 360;
		}
		else if (cRef == 'upload') {
			cTitre = '<h4>' + $(this).attr('title') + '</h4>';
			nW = 900;
			nH = 420;
		}
		else if (cRef == 'signin') {
			cTitre = '<h4>' + $(this).attr('title') + '</h4>';
			nW = 300;
			nH = 340;
		}

		$('.fancyBoxTitle').fancybox({
			beforeShow: function () {
				this.title = cTitre;
				if(nID > 0) $('#dataID').val(nID);

				if (cRef == 'moveitem') {
					$('#listWorkBooks select').change(function () {
						$('#listWorkBooks select').next('span').find('strong').html($('#listWorkBooks select option:selected').text());
					});
				}
			},
			helpers : {
				title: {
					type: 'inside',
					position: 'top'
				}
			},
			maxWidth	: nW,
			fitToView	: false,
			width		: '80%',
			height		: 'auto',
			autoSize	: false,
			closeClick	: false,
			openEffect	: 'fade',
			closeEffect	: 'fade'
		});
	});
	/***** MODAL WITH TITLE *****/

	/***** MODAL VIDEO *****/
	$('.swiper-slide__video').click(function (e) {
		e.preventDefault();

		cVideo = $(this).parent('div').attr('data-video') + '?rel=0&showinfo=0&autoplay=1';
		cTitre = $(this).parent('div').attr('data-title');
		cDescription = $(this).parent('div').attr('data-description');

		$('.swiper-slide__video').fancybox({
			beforeShow: function () {
				$('iframe').attr('src', cVideo);
				$('h5').html(cTitre + '<small>' + cDescription + '</small>');
				$('.fancybox-skin').css({backgroundColor: '#000'});
			},
			helpers : {
				title: {
					type: 'inside',
					position: 'top'
				}
			},
			maxWidth	: 900,
			maxHeight	: 580,
			fitToView	: false,
			width		: '100%',
			height		: '100%',
			autoSize	: false,
			autoSclae	: true,
			openEffect	: 'none',
			closeEffect	: 'none',
			tpl: {
				closeBtn : '<a title="Close" class="fancybox-item fancybox-close" href="javascript:;" style="top: 9px; right: 9px;"></a>',
			}
		});
	});

	/***** MODAL VIDEO *****/

	/********** FANCYBOX WITH TITLE **********/

	/********** header fixe **********/
	$(window).scroll(function() {   

	    var scroll = $(window).scrollTop();

	    if (scroll >= 30 && $("body").width() > 1024)  {

	        $("#header").addClass("header-fixe");
			$('.header__navbar-sup').removeClass("navbar-sup_sup");
			$('.authenticated').removeClass("open");
			
			$('.page').addClass('page-fixe');
			$(".compare-products").addClass("header-compare-fixe");
			$(".page-product-category").css('top', '86px');
	    }

	    else {

	        $("#header").removeClass("header-fixe");
	        $('.page').removeClass('page-fixe');
	        $(".compare-products").removeClass("header-compare-fixe");
	        $(".page-product-category").css('top', '0px');

	    }

	}); 

    $("#header").hover(

    	function() {

			var scroll = $(window).scrollTop();

    		if (scroll >= 30 && $("body").width() > 1024) {

    			$('#header').addClass("navbar-sup-effet");
    			$(".compare-products").addClass("header-compare-sup-effet");
    		}

    	}, function() {

			var scroll = $(window).scrollTop();

			$('#header').removeClass("navbar-sup-effet");
			$(".compare-products").removeClass("header-compare-sup-effet");

    		if (scroll >= 30 && $("body").width() > 1024) {

				$('.header__navbar-sup').removeClass("navbar-sup_sup");
				$('.authenticated').removeClass("open");
			}
    	}
    );

	$('.header__navbar-sup').each(function () {
		var $this = $(this);

		$this.on('click', '.authenticated > a', function (e) {
			e.preventDefault();

			var $link = $(this),
				$parent = $link.parent();

			if($parent.hasClass('open')) $parent.removeClass('open');
			else $parent.addClass('open');

			if ($this.hasClass('navbar-sup_sup')) $this.removeClass('navbar-sup_sup');
			
			else $this.addClass('navbar-sup_sup');

		});
	});


	/********** /header fixe **********/


	/********** Plié Deplié du bouton de partage sur la page workbook **********/

	$('.share > a').on('click', function (e) {
		e.preventDefault();
		e.stopPropagation();

		var
			$this = $(this),
			$shareBox = $this.parent();

		if ($shareBox.hasClass('share--open')) {

			$shareBox.removeClass('share--open');

		} else {

			$shareBox.addClass('share--open');

			$('body').one('click', function (e) {

				$shareBox.removeClass('share--open');

			});
		}
	});

	/********** /Plié Deplié du bouton de partage sur la page workbook **********/

	/********** Afficher cacher version mobile de filter by et sort by **********/

	$('.bloc-btn-mobile').each(function () {
		var $this = $(this);

		$this.on('click', '.btn-filter', function (e) {
			e.preventDefault();

			var $link = $(this),
				$parent = $link.parent().parent().parent();

			if ($parent.hasClass('filter_by--open')) {

				$parent.removeClass('filter_by--open');
			}

			else {

				$parent.addClass('filter_by--open');
			};
		});

		$this.on('click', '.btn-sortBy', function (e) {
			e.preventDefault();

			var $link = $(this),
				$parent = $link.parent().parent().parent();

			if ($parent.hasClass('sort_by--open')) {

				$parent.removeClass('sort_by--open');
			}

			else {

				$parent.addClass('sort_by--open');
			};


		});

		$this.on('click', '.cancel', function (e) {
			e.preventDefault();

			var $link = $(this),
				$parent = $link.parent().parent().parent();

			if ($parent.hasClass('sort_by--open')) {

				$parent.removeClass('sort_by--open');
			};

			if ($parent.hasClass('filter_by--open')) {

				$parent.removeClass('filter_by--open');
			};

		});
	});
	/********** /Afficher cacher version mobile de filter by et sort by **********/

	$('.menu-deroulant-style').selectpicker();

	/*Contact Form Display question if radio button checked */

    $('.contact-question-yes').click(function() {
	   	if($('#Yes').is(':checked')) {
	   		$('.question-yes').hide();
	   		$('.question-no').show();
	   }
	});

	$('.contact-question-no').click(function() {
	   	if($('#No').is(':checked')) {
	   		$('.question-no').hide();
	   		$('.question-yes').show();
	   }
	});

	$('body').on('click', '.btn-print', function (e) {
		e.preventDefault();

		window.print();
		console.log("toto");
	});
	
	$('.fancyPressReleaseArticle').click(function(e){
		var image = $(this).find('a').first().attr('href');
		var href = $(this).attr('data-href') + '?url=' + image;
		$(this).attr('href', href);
		$('.fancyPressReleaseArticle').fancybox({
			helpers : {
				title: null
			},
		});
	});

  $("#owl-demo").owlCarousel({

  autoPlay: 3000, //Set AutoPlay to 3 seconds

  items : 4,
  itemsDesktop : [1199,3],
  itemsDesktopSmall : [979,3]

  });

});


//GetfileName
function browseFile() {
	document.getElementById('image').click();
}

function setFileName(fileName) {

	// If you want to delete the file's extension
	//fileName = fileName.substr(0, fileName.lastIndexOf('.'));

	// For Chrome : delete file's URL (fakepath)
	document.getElementById('txtFile').value = fileName.replace(/C:\\fakepath\\/i, '');
}