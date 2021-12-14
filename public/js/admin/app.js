/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***********************************!*\
  !*** ./resources/js/admin/app.js ***!
  \***********************************/
var baseUrl = window.location.protocol + '//' + window.location.host + '/';
$(document).ready(function () {
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
  } // Date Picker


  $('.date-picker').datepicker({});
  $('body').on('click', '.btn-add-coll', function () {
    $(this).siblings().toggleClass('active');
  }); // Collection list event when page loads

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
  } // Select collection list events on click collection


  $('.ad-gallerys-sidebar .chkBox2 input.checkbox-coll').change(function () {
    var total_coll_count = $('.checkbox-coll').length;
    var selected_coll_count = $('.checkbox-coll:checked').length;

    if (total_coll_count == selected_coll_count) {
      $('.checkbox-all-colls').prop('checked', true);
    } else {
      $('.checkbox-all-colls').prop('checked', false);
    }

    if ($('.ad-gallerys-sidebar .chkBox2 input.checkbox-coll:checked').length == 1) {
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
  }); // Toggle edit collection form

  $('body').on('click', '.btn-edit-del-coll', function () {
    $('.coll-btns .block-coll__edit form').toggleClass('active');
  }); // Check/Uncheck all collection checkbox

  $('.checkbox-all-colls').change(function () {
    if ($(this).prop('checked')) {
      $('.ad-gallerys-sidebar .chkBox2 input').prop('checked', true);
    } else {
      $('.ad-gallerys-sidebar .chkBox2 input').prop('checked', false);
    }
  });
  $('.checkbox-coll, .checkbox-all-colls').change(function () {
    var selected_coll_ids = [];
    $('.ad-gallerys-sidebar .chkBox2').each(function () {
      if ($(this).find('.checkbox-coll:checked').length > 0) {
        var selected_coll_id = $(this).find('.checkbox-coll:checked').data('id');
        selected_coll_ids.push(selected_coll_id);
      }
    });
    $.ajax({
      url: "/api/api-select-collections",
      method: "post",
      beforeSend: function beforeSend() {
        $("#adGallerysItems").empty();
      },
      data: {
        selected_collection_ids: selected_coll_ids
      },
      success: function success(result) {
        if (typeof result.collection_ids != 'undefined') {
          var coll_count = result.collection_ids.length;
        }

        var html = '';

        if (coll_count == 1) {
          html += '<div class="hdrItems-list active hdrItems-list--addmore">';
          html += '<div class="hdrItems-list__inner flex aic jcc" style="height: 200px">';
          html += '<a class="btn-gallery-create" href="' + baseUrl + 'admin-gallery/create?' + result.collection_ids + '">Add More Items</a>';
          html += '</div>';
          html += '</div>';
        }

        $.each(result.gallery_ids_images, function (key, val) {
          html += '<div class="hdrItems-list">';
          html += '<div class="hdrItems-list__inner">';
          html += '<a href="' + baseUrl + 'admin-gallery/' + key + '/edit">';

          if (val.g_all_checked == 'false') {
            html += '<div class="hdrItems-list__inner-overlay"><label>Edit required</label></div>';
          }

          html += '<img src="/images/' + val.g_image + '">';
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
  }); // Update gallery page click change image button

  $('body').on('click', '.btn-change-image', function () {
    $('.block-change-image input').trigger('click');
  }); // Add Category 

  $('body').on('click', '.btn-insert-category', function () {
    var $cat_name = $('.insert-cat-name').val();

    if ($cat_name != '') {
      $.ajax({
        url: "/api/api-categories",
        method: "post",
        beforeSend: function beforeSend() {
          $(".selectbox-categories").empty();
        },
        data: {
          cat_name: $cat_name
        },
        success: function success(result) {
          console.log(result);
          var html = '';
          $.each(result.categories, function (key, val) {
            html += '<option value="' + key + '">' + val + '</option>';
          });
          $('.selectbox-categories').append(html);
        }
      });
    }
  }); // Add Artist 

  $('body').on('click', '.btn-insert-artist', function () {
    var $art_name = $('.insert-artist-name').val();

    if ($art_name != '') {
      $.ajax({
        url: "/api/api-artists",
        method: "post",
        beforeSend: function beforeSend() {
          $(".selectbox-artists").empty();
        },
        data: {
          artist_name: $art_name
        },
        success: function success(result) {
          console.log(result);
          var html = '';
          $.each(result.artists, function (key, val) {
            html += '<option value="' + key + '">' + val + '</option>';
          });
          $('.selectbox-artists').append(html);
        }
      });
    }
  }); // Update page save & delete

  $('body').on('click', '.btn-save-gallery-trigger', function () {
    $('.btn-save-gallery').trigger('click');
  });
  $('body').on('click', '.btn-delete-gallery-trigger', function () {
    $('.btn-delete-gallery').trigger('click');
  });
  $('body').on('click', '.btn-add-category', function () {
    $('.insert-category').toggleClass('active');
  });
  $('body').on('click', '.btn-add-artist', function () {
    $('.insert-artist').toggleClass('active');
  });
  $('.checkbox-enable-pieces').change(function () {
    if ($(this).prop('checked')) {
      $('.piece-count').addClass('active');
    } else {
      $('.piece-count').removeClass('active');
    }
  }); // Admin Update header data

  $('body').on('click', '.btn-change-header-image', function () {
    $('.block-header-image input').trigger('click');
  });
  $('body').on('click', '.btn-update-cancel', function () {
    $('.bg-overlay, .popup-header').removeClass('active');
  });
  $('body').on('click', '.btn-add-header', function () {
    $('.bg-overlay').addClass('active');
    $('.popup-header').addClass('active');
  });
  $('body').on('click', '.btn-edit-header', function () {
    var header_id = $('.ad-header > .hdrBg').data('id');
    $.ajax({
      url: "/api/api-select-header-data",
      method: "post",
      beforeSend: function beforeSend() {
        $('.popup-header').empty();
      },
      data: {
        headerId: header_id
      },
      success: function success(result) {
        $('.bg-overlay').addClass('active');
        $('.popup-header').addClass('active');
        var html = '';
        $.each(result.categories, function (key, val) {
          html += '<div class="popup-header-image text-center" data-id="' + key + '">';
          html += '<form action="' + baseUrl + 'admin-header-data/' + key + '" method="POST" enctype="multipart/form-data">';
          html += '<input type="hidden" name="_token" value="' + $('meta[name="csrf-token"]').attr('content') + '">';
          html += '<input type="hidden" name="_method" value="PUT">';
          html += '<img src="/images/' + val.h_image + '">';
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
});
/******/ })()
;