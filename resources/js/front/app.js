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
              html += '<a href="' + baseUrl + 'admin-gallery/'+ key +'/edit">';
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

});