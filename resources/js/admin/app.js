var baseUrl = window.location.protocol + '//' + window.location.host + '/';

$(document).ready(function() {
  if ($('#adGallerysItems').length > 0) {
    var macyInstance = Macy({
      container: '#adGallerysItems',
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

    macyInstance.on(macyInstance.constants.EVENT_IMAGE_COMPLETE, function (ctx) {
      $('#adGallerysItems').addClass('initialized');
    });
  }

  // Date Picker
  $('.date-picker').datepicker({
  });
  
  
  $('body').on('click', '.btn-add-coll', function() {
    $(this).siblings().toggleClass('active');
  });

  // Collection list event when page loads
  if ($(".ad-gallerys-sidebar .chkBox2 input.checkbox-coll:checked").length == 1) {
    var selected_coll_id = $(".ad-gallerys-sidebar .chkBox2 input.checkbox-coll:checked").data('id');
    $('.btn-gallery-create').attr('href', baseUrl + 'admin-gallery/create?' + selected_coll_id);
    $('.coll-btns').addClass('active');
    $('.hdrItems-list--addmore').addClass('active');
    if ($('#adGallerysItems').length > 0) {
      macyInstance.reInit();
    }
  } else {
    $('.coll-btns').removeClass('active');
    $('.hdrItems-list--addmore').removeClass('active');
    if ($('#adGallerysItems').length > 0) {
      macyInstance.reInit();
    }
  }

  $('.checkbox-all-colls').change(function() {
    $('.coll-btns').removeClass('active');
    if ($(this).is(':checked')) {
      $('.checkbox-coll').prop('checked', false);
    } else {
      $('.checkbox-coll').prop('checked', true);
      
    }
  });

  // Select collection list events on click collection
  $('.ad-gallerys-sidebar .chkBox2 input.checkbox-coll').change(function() {
    // var total_coll_count = $('.checkbox-coll').length;
    var selected_coll_count = $('.checkbox-coll:checked').length;
    if (selected_coll_count > 0) {
      $('.checkbox-all-colls').prop('checked', false);
    } else {
      $('.checkbox-all-colls').prop('checked', true);
    }

    if($('.ad-gallerys-sidebar .chkBox2 input.checkbox-coll:checked').length == 1) {
      var selected_coll_name = $('.ad-gallerys-sidebar .chkBox2 input.checkbox-coll:checked').val();
      $('.selected-coll-name').text(selected_coll_name);
      $('.coll-btns').addClass('active');
      $('.hdrItems-list--addmore').addClass('active');
      if ($('#adGallerysItems').length > 0) {
        macyInstance.reInit();
      }

      var coll_name = $(this).val();
      var coll_id = $(this).data('id');
      
      $('.edit-coll-name').val(coll_name);
      $('.coll-btns form').attr('action', baseUrl + 'admin-collection/' + coll_id);
      $('.btn-gallery-create').attr('href', baseUrl + 'admin-gallery/create?' + coll_id);
    } else if ($('.ad-gallerys-sidebar .chkBox2 input.checkbox-coll:checked').length == 0) {
      $('.selected-coll-name').text('');
    } else {
      $('.selected-coll-name').text('');
      $('.coll-btns').removeClass('active');
      $('.hdrItems-list--addmore').removeClass('active');
      if ($('#adGallerysItems').length > 0) {
        macyInstance.reInit();
      }
    }
  });

  $('.checkbox-enable-pieces').change(function() {
    if ($(this).is(':checked')) {
      $(this).val('yes');
    } else {
      $(this).val('no');
    }
  });

  // Toggle edit collection form
  $('body').on('click', '.btn-edit-del-coll', function() {
    $('.coll-btns .block-coll__edit form').toggleClass('active');
  });
  
  $('.checkbox-filter-coll').change(function() {
    var selected_coll_ids = [];
    $('.ad-gallerys-sidebar .chkBox2').each(function() {
      if ($(this).find('.checkbox-filter-coll:checked').length > 0) {
        var selected_coll_id = $(this).find('.checkbox-filter-coll:checked').data('id');
        selected_coll_ids.push(selected_coll_id);
      }
    });
    
    $.ajax({
      url: "/api/api-select-collections",
      method: "post",
       beforeSend: function(){
         $("#adGallerysItems").empty();
       },
      data: {
        selected_collection_ids: selected_coll_ids,
      },
      success: function(result) {
        var hide_add_more = false;
        if (result.collection_ids[0] == 'any') {
          hide_add_more = true;
        }
        if (typeof result.collection_ids != 'undefined') {
          var coll_count = result.collection_ids.length;
        }
        
        var html = '';
        
        if (hide_add_more != true) {
          if (coll_count == 1) {
            html += '<div class="hdrItems-list active hdrItems-list--addmore">';
              html += '<div class="hdrItems-list__inner flex aic jcc" style="height: 200px">';
                html += '<a class="btn-gallery-create" href="'+ baseUrl +'admin-gallery/create?'+ result.collection_ids + '">Add More Items</a>';
              html += '</div>';
            html += '</div>';  
          }
        }
        
        
        $.each(result.gallery_ids_images, function (key, val) {
          html += '<div class="hdrItems-list">';
            if (val.g_all_checked == 'false') {
              html += '<div class="hdrItems-list__inner required">';  
            } else {
              html += '<div class="hdrItems-list__inner">';
            }
              html += '<a href="' + baseUrl + 'admin-gallery/'+ key +'/edit">';
                if (val.g_all_checked == 'false') {
                  html += '<div class="hdrItems-list__inner-overlay"><label>Edit required</label></div>';
                }
                html += '<img src="/images/'+ val.g_image +'">';
              html += '</a>';
            html += '</div>';
          html += '</div>';
        });
        
        $('#adGallerysItems').append(html);
        if ($('#adGallerysItems').length > 0) {
          macyInstance.reInit();
        }
      }
    });

  });

  
  
  // Update gallery page click change image button
  $('body').on('click', '.btn-change-image', function() {
    $('.block-change-image input').trigger('click');
  });

  // Add Category 
  $('body').on('click', '.btn-insert-category', function() {
    var $cat_name = $('.insert-cat-name').val();
    if ($cat_name != '') {
      $.ajax({
        url: "/api/api-categories",
        method: "post",
         beforeSend: function(){
           $(".selectbox-categories").empty();
         },
        data: {
          cat_name: $cat_name,
        },
        success: function(result) {
          var html = '';
          
          $.each(result.categories, function (key, val) {
            html += '<option value="' + key + '">'+ val +'</option>';
          });
          
          $('.selectbox-categories').append(html);
          
        }
      });
    }
  });

  // Add Artist 
  $('body').on('click', '.btn-insert-artist', function() {
    var $art_name = $('.insert-artist-name').val();
    var $art_description = $('.insert-artist-description').val();
    
    if ($art_name != '') {
      $.ajax({
        url: "/api/api-artists",
        method: "post",
         beforeSend: function(){
           $(".selectbox-artists").empty();
         },
        data: {
          artist_name: $art_name,
          artist_description: $art_description,
        },
        success: function(result) {
          $('.bg-overlay').removeClass('active');
          $('.popup-insert-artist').removeClass('active');
          

          var html = '';
          $.each(result.artists, function (key, val) {
            html += '<option value="' + key + '">'+ val +'</option>';
          });
          
          $('.selectbox-artists').append(html);
          
        }
      });
    }
  });


  // Update page save & delete
  $('body').on('click', '.btn-save-gallery-trigger', function() {
    $('.input-artist-name').val($('.selectbox-artists').find(":selected").text());
    $('.btn-save-gallery').trigger('click');
  });
  $('body').on('click', '.btn-delete-gallery-trigger', function() {
    $('.btn-delete-gallery').trigger('click');
  });

  $('body').on('click', '.btn-add-category', function() {
    $('.insert-category').toggleClass('active');
  });

  $('body').on('click', '.btn-add-artist', function() {
    $('.bg-overlay').addClass('active');
    $('.popup-insert-artist').addClass('active');
  });

  $('body').on('click', '.btn-cancel-artist', function() {
    $('.bg-overlay').removeClass('active');
    $('.popup-insert-artist').removeClass('active');
  });

  $('.checkbox-enable-pieces').change(function() {
    if ($(this).prop('checked')) {
      $('.piece-count').addClass('active');
    } else {
      $('.piece-count').removeClass('active');
    }
  });

  // Admin Update header data
  $('body').on('click', '.btn-change-header-image', function() {
    $('.block-header-image input').trigger('click');
  });

  $('body').on('click', '.btn-update-cancel', function() {
    $('.bg-overlay, .popup-header').removeClass('active');
  });

  $('body').on('click', '.btn-add-header', function() {
    $('.bg-overlay').addClass('active');
    $('.popup-header').addClass('active');
  });



  $('body').on('click', '.btn-edit-header', function() {
    var header_id = $('.ad-header > .hdrBg').data('id');
    $.ajax({
      url: "/api/api-select-header-data",
      method: "post",
      beforeSend: function() {
        $('.popup-header').empty();
      },
      data: {
        headerId: header_id,
      },
      success: function(result) {
        $('.bg-overlay').addClass('active');
        $('.popup-header').addClass('active');
        
        var html = '';
        
        $.each(result.categories, function (key, val) {
          html += '<div class="popup-header-image text-center" data-id="'+ key +'">';
            html += '<form action="' + baseUrl + 'admin-header-data/'+ key +'" method="POST" enctype="multipart/form-data">';
              html += '<input type="hidden" name="_token" value="' + $('meta[name="csrf-token"]').attr('content') + '">';
            
              html += '<input type="hidden" name="_method" value="PUT">';
              html += '<img src="/images/'+ val.h_image +'">';
              html += '<div class="block-header-image">';
                html += '<input type="file" name="image" multiple class="custom-file-input form-control" id="customFile">';
                html += '<label class="custom-file-label" for="customFile">Select Images</label>';
              html += '</div>';
            
              html += '<input type="text" value="' + val.h_title + '" name="title" class="input-header-title">';
              html += '<input type="text" value="' + val.h_subtitle + '" name="sub_title" class="input-header-subtitle">';
              html += '<div class="flex aic jcb">';
                html += '<a href="javascript:void(0)" class="btn-grey btn-change-header-image">Change Image</a>';
                html += '<button type="submit" class="btn-grey btn-update-header">Update</button>';
                html += '<a href="javascript:void(0)" class="btn-grey btn-update-cancel">Cancel</a>';
              html += '</div>';
            html += '</form>';
          html += '</div>';
        });
        
        
        $('.popup-header').append(html);
      }
    });
  });

  if ($('.ad-header .bHdrTxt h1').text() == '') {
    $('.btn-add-header').addClass('active');
    $('.btn-edit-header').removeClass('active');
  } else {
    $('.btn-add-header').removeClass('active');
    $('.btn-edit-header').addClass('active');
  }

  // Order items
  $('body').on('click', '.btn-view-items', function() {
    $('.popup-order-items').empty()
    var item_html = $(this).closest('tr').find('.td-order-item').html();
    $('.bg-overlay').addClass('active');
    $('.popup-order-items').show();
    $('.popup-order-items').append(item_html);
  });

  $('body').on('click', '.btn-cancel-popup', function() {
    $('.bg-overlay').removeClass('active');
    $('.popup-order-items').hide();
  });

  $('body').on('click', '.btn-update-popup', function() {
    $('.btn-update-status').trigger('click');
  });

  // Admin user check investor user
  $('.investor-user input').change(function() {
    var user_id = $(this).data('user-id');
    if ($(this).is(':checked')) {
      $.ajax({
        url: "/api/api-investor-user",
        method: "post",
        data: {
          user_id: user_id,
          checked: 'true',
        },
        success: function(result) {
          console.log(result);
        }
      });
    } else {
      $.ajax({
        url: "/api/api-investor-user",
        method: "post",
        data: {
          user_id: user_id,
          checked: 'false',
        },
        success: function(result) {
        }
      });
    }
  });

  // image upload change event
  $('#uploadImage').change(function(){
    $('.btn-upload-image').trigger('click');
  });
  
});