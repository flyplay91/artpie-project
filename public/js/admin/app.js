/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***********************************!*\
  !*** ./resources/js/admin/app.js ***!
  \***********************************/
$(document).ready(function () {
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
  $('body').on('click', '.btn-add-coll', function () {
    $(this).siblings().toggleClass('active');
  });

  if ($(".ad-gallerys-sidebar .chkBox2 input:checked").length == 1) {
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

  $('.ad-gallerys-sidebar .chkBox2 input').change(function () {
    if ($('.ad-gallerys-sidebar .chkBox2 input:checked').length == 1) {
      $('.coll-btns').addClass('active');
      $('.hdrItems-list--addmore').addClass('active');

      if ($('#adGallerysItems').length > 0) {
        macyInstance.reInit();
      }

      var coll_name = $(this).val();
      var coll_id = $(this).data('id');
      var getUrl = window.location;
      var baseUrl = getUrl.protocol + '//' + getUrl.host + '/';
      $('.edit-coll-name').val(coll_name);
      $('.coll-btns form').attr('action', baseUrl + 'admin-collection/' + coll_id);
    } else {
      $('.coll-btns').removeClass('active');
      $('.hdrItems-list--addmore').removeClass('active');

      if ($('#adGallerysItems').length > 0) {
        macyInstance.reInit();
      }
    }
  });
  $('body').on('click', '.btn-edit-coll', function () {
    $('.coll-btns .block-coll__edit form').toggleClass('active');
  });
});
/******/ })()
;