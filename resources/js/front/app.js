require('./bootstrap');
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
        console.log(result);
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
    $('.popup-gallery-data').removeClass('active');
  });

});

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
      console.log(result);
      var html = '';
      
      $.each(result.gallery_Obj, function (key, val) {
        html += '<div class="gallery-data-image" data-id"'+ key +'">';
          html += '<img src="/images/'+ val.g_image +'">';
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
              html += '<span>'+ val.g_price +'RMB</span>';
            html += '</div>';
            html += '<div class="gallery-entire-buy-btn">';
              html += '<a href="#">실물구매</a>';
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
      
    }
  });
}