require('./bootstrap');

// Pan Zoom plugin JS
/*@license 
Fullscreen Image Zoom and Pan with Jquery
version @VERSION@

Original version by Samil Hazir (https://github.com/saplumbaga)
V.2.0 by JM Alarcon (https://github.com/jmalarcon/)

https://github.com/saplumbaga/jquery.pan
https://github.com/jmalarcon/jquery.pan
 */

jQuery.fn.extend({

	pan: function () {

		var panWrapper = document.createElement('div');
		$(panWrapper).addClass("panWrapper");

		var panImg = document.createElement('img');
		$(panImg).addClass("i").css("position", "absolute");

		var zi = document.createElement('a');
		$(zi).addClass("controls in");
		$(panWrapper).append(zi);

		var zo = document.createElement('a');
		$(zo).addClass("controls out");
		$(panWrapper).append(zo);

		var close = document.createElement('a');
		$(close).addClass("controls close");
		$(panWrapper).append(close);

		$(panWrapper).append(panImg);
		$("body").append(panWrapper);

		//Remove from set those image elements that are already shown in their natural size (they don't need zoom at all)
		//If the element is not an image it's not filtered
		var finalSet = $(this).filter(function() {
			if (this.tagName == "IMG" ) {
				var nW = this.naturalWidth || 0,
					nH = this.naturalHeight || 0,
					w = $(this).outerWidth(),
                    h = $(this).outerHeight();
				if (nW > w || nH > h)
				return true;
			}
			else {
				return true;
			}
		});

		finalSet.css('cursor', 'zoom-in');

		finalSet.click(function (e) {
			var t = $(this);
			var big = t.attr("data-big");
			//If there's no data-big attribute, use the src of the image (sometimes they are simply limited in size with CSS and you just need a zoom of that)
			if (big == undefined) 
				big = t.attr("src");
			$(".panWrapper").show();
			$(".panWrapper img.i").css("width", "auto").attr("src", big).on('load', function () { panInit(e); });
			return false;
		});

		$(zi).click(function (e) {
			var panImg = $(".panWrapper img.i");
			panImg.css("width", parseInt(parseInt(panImg.css("width")) * 1.2));
			panInit(e);
		});

		$(zo).click(function (e) {
			var panImg = $(".panWrapper img.i");
			panImg.css("width", parseInt(parseInt(panImg.css("width")) / 1.2) + 1);
			panInit(e);
		});

		$(close).click(function (e) {
			$(".panWrapper").fadeOut("slow");
		});

		$(panImg).click(function(){
			$(close).click();
		});

		$(panWrapper).on('mousemove touchmove', function (e) {
			panInit(e);
		});

		$("body").keydown(function (e) {
			if (e.keyCode == 27) {
				$(close).click();
			}
		});

		$(panWrapper).mousewheel(function (wheelEvent) {

			if (wheelEvent.deltaY > 0)
				$(zo).click();
			else
				$(zi).click();

			panInit(wheelEvent);

		});

        //The next function encapsulates the whole logic of getting the pointer position in every case
        function __getPointerPos(event, prop) {
            var pos = event[prop];  //Normal mousemove event
            if (pos == undefined) {
                pos = 0;    //Default value if the next conditionals don't work
                if (event.touches)  //jQuery for touch pointer move. Not available in jQuery 1.x
                    pos = event.touches[0][prop];
                else if (event.originalEvent) { //original window event
                    if (event.originalEvent.touches)
                        pos = event.originalEvent.touches[0][prop];
                }
            }
            return pos;
        }
        function __getPointerPosX(event) {
            return __getPointerPos(event, 'pageX');
        }
        function __getPointerPosY(event) {
            return __getPointerPos(event, 'pageY');
        }

		function panInit(event) {
			event.preventDefault();
			var panImg = $(".panWrapper img.i");
			var panWrapper = $(".panWrapper");

			var w = parseInt(panImg.css("width"));  //Image width
			var h = parseInt(panImg.css("height")); //Image height
            var vpW = $(panWrapper).width();   //Viewport width
            var vpH = $(panWrapper).height();   //Viewport height

            /*Margin on the left (difference between the width of the container and the image width). 
            If the image is wider than the container, it's negative (the image goes outside the viewport), 
            if the image is less wide than the container, it's positive (it's the ammount of margin on the left to center the image) */
			var ml = -(w - vpW);
            //Idem with the height
            var mt = -(h - vpH);  
            //The amount of scroll from the top in the current page, to correct for pointer position
            var scrollHOffset = window.pageXOffset || document.documentElement.scrollLeft,
                scrollVOffset = window.pageYOffset || document.documentElement.scrollTop;
            
            //Left position of the pointer in page (first, try mouse, then try jQuery touch, default case native event touch for old jQuery versions), and in Viewport (substracting the scroll from left)
            var posOfPointerInPageX     = __getPointerPosX(event),
                posOfPointerInViewportX =  posOfPointerInPageX - scrollHOffset,
                vpW = $(panWrapper).width();   //Viewport width
            if (posOfPointerInViewportX < 0 ) posOfPointerInViewportX = 0; //In touch devices this can be slightly outside the viewport boundaries
            if (posOfPointerInViewportX > vpW ) posOfPointerInViewportX = vpW;

            //Top position of the pointer in page (first, try mouse, then try jQuery touch, default case native event touch for old jQuery versions), and in Viewport (substracting the scroll from top)
            var posOfPointerInPageY     = __getPointerPosY(event),
                posOfPointerInViewportY =  posOfPointerInPageY - scrollVOffset,
                vpH = $(panWrapper).height();   //Viewport height
            if (posOfPointerInViewportY < 0 ) posOfPointerInViewportY = 0; //In touch devices this can be slightly outside the viewport boundaries
            if (posOfPointerInViewportY > vpH ) posOfPointerInViewportY = vpH;

            //New left: the new amount we need to move from the left to show other parts of the image depending on the current mouse position
            var nl = Math.floor((ml * posOfPointerInViewportX) / vpW);
            //New top: the new amount we need to move from the top to show other parts of the image depending on the current mouse position
            var nt = Math.floor(mt * posOfPointerInViewportY / vpH);

			if (vpW > w && vpH > h) {   //If the image is smaller than the available viewport, center it in both directions
				nl = (vpW - w) / 2;
				nt = (vpH - h) / 2;
			}
			else if (vpW > w) { //If the image width is less than the viewport, center it horizontally
				nl = (vpW - w) / 2;
			}
			else if (vpH > h) { //If the image height is less than the viewport height, center it vertically
				nt = (vpH - h) / 2;
			}
            
            //Position image in viewport as calculated
            panImg.css("left", nl + 'px');
			panImg.css("top", nt + 'px');
		}
		return finalSet;
	}
});

(function () {
	var prefix = "", _addEventListener, onwheel, support;

	if (window.addEventListener) {
		_addEventListener = "addEventListener";
	} else {
		_addEventListener = "attachEvent";
		prefix = "on";
	}

	if (document.onmousewheel !== undefined) {
		support = "mousewheel";
	}
	try {
		WheelEvent("wheel");
		support = "wheel";
	} catch (e) { }
	if (!support) {
		support = "DOMMouseScroll";
	}

	window.addWheelListener = function (elem, callback, useCapture) {
		_addWheelListener(elem, support, callback, useCapture);

		if (support == "DOMMouseScroll") {
			_addWheelListener(elem, "MozMousePixelScroll", callback, useCapture);
		}
	};

	function _addWheelListener(elem, eventName, callback, useCapture) {
		elem[_addEventListener](prefix + eventName, support == "wheel" ? callback : function (originalEvent) {
			!originalEvent && (originalEvent = window.event);

			var event = {
				originalEvent: originalEvent,
				target: originalEvent.target || originalEvent.srcElement,
				type: "wheel",
				deltaMode: originalEvent.type == "MozMousePixelScroll" ? 0 : 1,
				deltaX: 0,
				delatZ: 0,
				pageX: originalEvent.pageX,
				pageY: originalEvent.pageY,
				preventDefault: function () {
					originalEvent.preventDefault ?
						originalEvent.preventDefault() :
						originalEvent.returnValue = false;
				}
			};

			if (support == "mousewheel") {
				event.deltaY = - 1 / 40 * originalEvent.wheelDelta;
				originalEvent.wheelDeltaX && (event.deltaX = - 1 / 40 * originalEvent.wheelDeltaX);
			} else {
				event.deltaY = originalEvent.detail;
			}

			return callback(event);

		}, useCapture || false);
	}

	$.fn.mousewheel = function (handler) {
		return this.each(function () {
			window.addWheelListener(this, handler, true);
		});
	};
})(jQuery);

// ============================================= //
// ============================================= //
// ============================================= //
var baseUrl = window.location.protocol + '//' + window.location.host + '/';

$(document).ready(function() {
  if ($('#hdrItems').length > 0) {
    var macyInstance = Macy({
      container: '#hdrItems',
      margin: {
        x: 25,
        y: 25  
      },
      columns: 3,
      breakAt: {
        520: 2,
        400: 1
      }
    });
  }

  // Select filter options
  $('.checkbox-some-filter').change(function() {
    if ($(this).closest('.filterItems').find('.checkbox-some-filter:checked').length > 0) {
      $(this).closest('.filterItems').find('.checkbox-any-filter').prop('checked', false);
    }
  });

  $('.checkbox-any-filter').change(function() {
    if ($(this).closest('.filterItems').find('.checkbox-any-filter:checked').length > 0) {
      $(this).closest('.filterItems').find('.checkbox-some-filter').prop('checked', false);
    }
  });

  // Filter ajax
  $('.checkbox-filter').change(function() {
    var category_ids_arr = [];
    var price_arr = [];
    var size_arr = [];

    $('.hdrItem--category .chkBox2').each(function() {
      if ($(this).find('.checkbox-filter:checked').length > 0) {
        var selected_cat_id = $(this).find('.checkbox-filter:checked').val();
        category_ids_arr.push(selected_cat_id);
      }
    });
    $('.hdrItem--price .chkBox2').each(function() {
      if ($(this).find('.checkbox-filter:checked').length > 0) {
        var selected_price = $(this).find('.checkbox-filter:checked').val();
        price_arr.push(selected_price);
      }
    });
    $('.hdrItem--size .chkBox2').each(function() {
      if ($(this).find('.checkbox-filter:checked').length > 0) {
        var selected_size = $(this).find('.checkbox-filter:checked').val();
        size_arr.push(selected_size);
      }
    });

    $.ajax({
      url: "/api/api-select-gallerys",
      method: "post",
       beforeSend: function(){
         $("#hdrItems").empty();
       },
      data: {
        selected_cat_ids: category_ids_arr,
        selected_price: price_arr,
        selected_size: size_arr,
      },
      
      success: function(result) {
        var html = '';

        $.each(result.gallery_ids_images, function (key, val) {
          html += '<div class="hdrItems-list">';
            html += '<div class="hdrItems-list__inner">';
              html += '<a class="image-gallery" href="javascript:void(0)" data-id="'+ key +'">';
                html += '<div class="hdrItems-list__inner-overlay"></div>';
                html += '<img src="/images/'+ val +'">';
              html += '</a>';
            html += '</div>';
          html += '</div>';
        });
        
        $('#hdrItems').append(html);
        if ($('#hdrItems').length > 0) {
          macyInstance.reInit();
        }
      }
    });
  });

  // Update gallery popup
  $('body').on('click', '.gallery-data-content__item', function() {
    $(this).siblings().removeClass('active');
    $(this).toggleClass('active');
    $('.gallery-data-content__item > div').stop().slideUp();
    $('.gallery-data-content__item.active > div').stop().slideDown();
    return false;
  });

  // Open gallery popup & get data
  $('body').on('click', '.image-gallery', function() {
    var gallery_id = $(this).data('id');
    getGalleryAjax(gallery_id);
  });

  $('body').on('click', '.bg-overlay label', function() {
    $('#mainWrapper').removeClass('active');
    $('.bg-overlay').removeClass('active');
    $('.popup-user').removeClass('active');
    $('.popup-gallery-data').removeClass('active');
  });

  // Account page popup events
  $('body').on('click', '.btn-user-info', function() {
    $('.popup-user--info').addClass('active');
    $('.bg-overlay').addClass('active');
  });

  var address_field_count = $('.update-user-address').length;
  if (address_field_count == 1) {
    var click_count = 1;
  } else if (address_field_count == 2) {
    var click_count = 2;
  } else if (address_field_count == 3) {
    var click_count = 3;
  } else if (address_field_count == 4) {
    var click_count = 4;
  } else if (address_field_count == 5) {
    var click_count = 5;
  }
  
  $('body').on('click', '.circle-plus', function() {
    click_count += 1;
    if (click_count < 6 ) {
      var address_template = '<div class="update-user-address--'+ click_count +' input-group mb-3"><div class="input-group-prepend"><span class="input-group-text">Address '+ click_count +'</span></div><input type="text" name="address_'+click_count+'" value="" class="form-control"></div>';

      $('.circle-plus').before(address_template);
    } else {
      $('.circle-plus').hide();
    }
  });

  $('body').on('click', '.btn-close-account', function() {
    $('.popup-user--close').addClass('active');
    $('.bg-overlay').addClass('active');
  });

  $('body').on('click', '.btn-update-password', function() {
    $('.popup-user--password').addClass('active');
    $('.bg-overlay').addClass('active');
  });

  // Checkout page qty minus/plus events
  

  $('body').on('click', '.checkout-gallery-qty .btn-plus-qty', function() {
    var current_qty = parseInt($(this).closest('.checkout-gallery-qty').find('input').val());
    var current_price = parseFloat($(this).closest('.checkout-gallery-item').find('.checkout-gallery-price label').text());
    current_qty = current_qty+1;
    $(this).closest('.checkout-gallery-qty').find('input').val(current_qty);
    var total_price = (current_qty*current_price).toFixed(2);
    $(this).closest('.checkout-gallery-item').find('.checkout-gallery-subtotal-price label').text(total_price);
    
    cal_total();
  });

  $('body').on('click', '.checkout-gallery-qty .btn-minus-qty', function() {
    var current_qty = parseInt($(this).closest('.checkout-gallery-qty').find('input').val());
    if (current_qty == 1) {
      $(this).addClass('disabled');
    } else {
      $(this).removeClass('disabled');
      var current_price = parseFloat($(this).closest('.checkout-gallery-item').find('.checkout-gallery-price label').text());
      current_qty = current_qty-1;
      $(this).closest('.checkout-gallery-qty').find('input').val(current_qty);
      var total_price = (current_qty*current_price).toFixed(2);
      $(this).closest('.checkout-gallery-item').find('.checkout-gallery-subtotal-price label').text(total_price);

      cal_total();
    }
  });

  cal_total();

  // Click pay button on the checkout page
  $('body').on('click', '.btn-pay-popup', function() {
    $('.bg-overlay').addClass('active');
    $('.popup-pay').addClass('active');
  });

  $('body').on('click', '.bg-overlay label, .btn-cancel-pay', function() {
    $('.bg-overlay').removeClass('active');
    $('.popup-pay').removeClass('active');
  });

  $('body').on('click', '.btn-make-pay', function() {
    $('.btn-update-user').trigger('click');
  })

});

function cal_total() {
  t_price = 0;

  if ($('.checkout-gallery-info__inner .checkout-gallery-item').length > 1) {
    $('.checkout-gallery-info__inner .checkout-gallery-item').each(function() {
      var s_price =  parseFloat(($(this).find('.checkout-gallery-subtotal-price label').text()));
      t_price += s_price;
    });
    $('.checkout-gallery-total-price label').text(t_price.toFixed(2));
    $('.total-price-value').val(t_price.toFixed(2));
  } else {
    var s_price =  parseFloat(($('.checkout-gallery-subtotal-price label').text()));
    $('.checkout-gallery-total-price label').text(s_price.toFixed(2));
    $('.total-price-value').val(s_price.toFixed(2));
  }
}

function getGalleryAjax($id) {
  $.ajax({
    url: "/api/api-get-gallery",
    method: "post",
      beforeSend: function(){
        $(".popup-gallery-data__inner").empty();
      },
    data: {
      gallery_id: $id,
    },
    success: function(result) {
      $('#mainWrapper').addClass('active');
      $('.bg-overlay').addClass('active');
      $('.popup-gallery-data').addClass('active');
      var user_id = $('.popup-gallery-data').data('user-id');
      
      var html = '';
      
      $.each(result.gallery_Obj, function (key, val) {
        html += '<div class="gallery-data-image" data-id="'+ key +'">';
          html += '<a class="pan" data-big="/images/' + val.g_image + '" href="">';
            html += '<img src="/images/'+ val.g_image +'">';
          html += '</a>';
        html += '</div>';
        html += '<div class="gallery-data-info flex flex-column">';
          html += '<h2>' + val.g_title + '</h2>';
          html += '<div class="gallery-data-items">';
            html += '<div class="gallery-data-content__item">';
              html += '<label class="flex aic">작품소개';
                html += '<img class="icon-up-arrow" src="/images/up-arrow.png">';
                html += '<img class="icon-down-arrow" src="/images/down-arrow.png">';
              html += '</label>';
              html += '<div>' + val.g_description + '</div>';
            html += '</div>';
            html += '<div class="gallery-data-content__item">';
              html += '<label class="flex aic">화가소개';
                html += '<img class="icon-up-arrow" src="/images/up-arrow.png">';
                html += '<img class="icon-down-arrow" src="/images/down-arrow.png">';
              html += '</label>';
              html += '<div>'+ val.g_artistname +'</div>';
            html += '</div>';
            html += '<div class="gallery-data-content__item">';
              html += '<label class="flex aic">화가의 다른 작품들';
                html += '<img class="icon-up-arrow" src="/images/up-arrow.png">';
                html += '<img class="icon-down-arrow" src="/images/down-arrow.png">';
              html += '</label>';
              html += '<div>ccc</div>';
            html += '</div>';
            html += '<div class="gallery-data-content__item">';
              html += '<label class="flex aic">가격정책';
                html += '<img class="icon-up-arrow" src="/images/up-arrow.png">';
                html += '<img class="icon-down-arrow" src="/images/down-arrow.png">';
              html += '</label>';
              html += '<div>ddd</div>';
            html += '</div>';
          html += '</div>';

          html += '<div class="gallery-entire-buy">';
            html += '<div class="gallery-entire-buy-info flex aic">';
              html += '<label>가격: </label>';
              html += '<span>'+ val.g_price +' RMB</span>';
            html += '</div>';
            html += '<div class="gallery-entire-buy-btn">';
              html += '<a href="/checkout?g_id='+ key +'">실물구매</a>';
            html += '</div>';
          html += '</div>';

          html += '<div class="gallery-pieces-buy">';
            html += '<div class="gallery-pieces-buy-info flex aic">';
              html += '<label>수량: </label>';
              html += '<input type="number" value="">';
              html += '<span> /' + val.g_pieces + ' </span>';
            html += '</div>';
            html += '<div class="gallery-pieces-buy-price flex aic">';
              html += '<label>금액: </label>';
              html += '<span>' + val.g_price + ' RMB</span>';
            html += '</div>';
            html += '<div class="gallery-pieces-buy-btn">';
              html += '<a href="#">쪼각구매</a>';
            html += '</div>';
          html += '</div>';
        html += '</div>';
      });

      $('.popup-gallery-data__inner').append(html);
      $('.pan').pan();
    }
  });
}