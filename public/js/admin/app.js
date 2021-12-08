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
  }

  $('body').on('click', '.btn-add-coll', function () {
    $(this).siblings().toggleClass('active');
  }); // Collection list event when page loads

  if ($(".ad-gallerys-sidebar .chkBox2 input.checkbox-coll:checked").length == 1) {
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
    if ($('.ad-gallerys-sidebar .chkBox2 input.checkbox-coll:checked').length == 1) {
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
    } else {
      $('.coll-btns').removeClass('active');
      $('.hdrItems-list--addmore').removeClass('active');

      if ($('#adGallerysItems').length > 0) {
        macyInstance.reInit();
      }
    }
  }); // Toggle edit collection form

  $('body').on('click', '.btn-edit-coll', function () {
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
        $(".ad-gallerys-items").empty();
      },
      data: {
        selected_collection_ids: selected_coll_ids
      },
      success: function success(result) {
        console.log(result);
        var html = '';
        macyInstance.reInit();
        $.each(result.gallery_ids_images, function (key, val) {
          html += '<div class="hdrItems-list">';
          html += '<div class="hdrItems-list__inner">';
          html += '<img src="/images/' + val + '">';
          html += '</div>';
          html += '</div>';
        });
        $(".ad-gallerys-items").append(html);

        if ($('#adGallerysItems').length > 0) {
          macyInstance.reInit();
        }
      }
    });
  });
});
/******/ })()
;