/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***********************************!*\
  !*** ./resources/js/admin/app.js ***!
  \***********************************/
var baseUrl = window.location.protocol + '//' + window.location.host + '/';
var page = 1;
var selected_coll_ids = [];
var ajaxLoading = false;
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
  });
  $('.checkbox-enable-pieces').change(function () {
    if ($(this).is(':checked')) {
      $(this).val('yes');
    } else {
      $(this).val('no');
    }
  }); // Toggle edit collection form

  $('body').on('click', '.btn-edit-coll', function () {
    $('.coll-btns .block-coll__edit form').toggleClass('active');
  });
  $('.checkbox-filter-coll').change(function () {
    var selected_coll_ids = [];

    if ($(this).hasClass('checkbox-all-colls')) {
      if ($('.checkbox-all-colls').is(':checked')) {
        $('.checkbox-coll').prop('checked', false);
      } else {
        $('.checkbox-coll').prop('checked', true);
      }
    } else {
      if ($('.checkbox-coll:checked').length == 0) {
        $('.checkbox-all-colls').prop('checked', true);
      } else {
        $('.checkbox-all-colls').prop('checked', false);
      }
    }

    $('.ad-gallerys-sidebar .chkBox2').each(function () {
      if ($(this).find('.checkbox-filter-coll:checked').length > 0) {
        var selected_coll_id = $(this).find('.checkbox-filter-coll:checked').data('id');
        selected_coll_ids.push(selected_coll_id);
      }
    });
    $("#adGallerysItems").empty();
    page = 1;
    noOfImages = 0;
    noLoaded = 0;
    loadMoreData(page, selected_coll_ids);
  });
  $('.ad-gallerys-sidebar .chkBox2').each(function () {
    if ($(this).find('.checkbox-filter-coll:checked').length > 0) {
      var selected_coll_id = $(this).find('.checkbox-filter-coll:checked').data('id');
      selected_coll_ids.push(selected_coll_id);
    }
  });
  loadMoreData(page, selected_coll_ids);
  $(window).on('scroll', function () {
    if (ajaxLoading) {
      return;
    }

    if ($(window).scrollTop() + $(window).height() >= $('body').height()) {
      page++;
      selected_coll_ids = [];
      $('.ad-gallerys-sidebar .chkBox2').each(function () {
        if ($(this).find('.checkbox-filter-coll:checked').length > 0) {
          var selected_coll_id = $(this).find('.checkbox-filter-coll:checked').data('id');
          selected_coll_ids.push(selected_coll_id);
        }
      });
      loadMoreData(page, selected_coll_ids);
    }
  }); // run function when user click load more button

  function loadMoreData(page, selected_coll_ids) {
    ajaxLoading = true;
    var $list = $('#adGallerysItems');
    $.ajax({
      url: baseUrl + "api/api-select-collections",
      type: 'get',
      datatype: 'html',
      beforeSend: function beforeSend() {
        $('.ajax-loading').html('Loading..').show();
      },
      data: {
        page: page,
        selected_collection_ids: selected_coll_ids
      }
    }).done(function (data) {
      if (data.length == 0) {
        if ($('.checkbox-coll:checked').length == 1) {
          var selected_coll_id = $('.checkbox-coll:checked').data('id');
          $('.btn-add-gallery').attr('href', '/admin-gallery/create?' + selected_coll_id);
          $('.btn-add-gallery').addClass('active');
        }

        $('.ajax-loading').html("No more!");
      } else {
        $('.ajax-loading').hide();
        $list.append(data);
        $list.find('img').not('.loaded').on('load', function () {
          $(this).addClass('loaded');

          if ($list.find('img').not('.loaded').length == 0) {
            $list.find('.hdrItems-list').addClass('initialized');
            macyInstance.reInit();
          }
        });
      }

      if ($('.checkbox-coll:checked').length == 1) {
        var selected_coll_id = $('.checkbox-coll:checked').data('id');
        $('.btn-add-gallery').attr('href', '/admin-gallery/create?' + selected_coll_id);
        $('.btn-add-gallery').addClass('active');

        if ($('.hdrItems-list').length == 0) {
          $('.block-coll__edit').addClass('active');
          $('.block-coll__delete').addClass('active');
        } else {
          $('.block-coll__edit').addClass('active');
          $('.block-coll__delete').removeClass('active');
        }
      } else {
        $('.btn-add-gallery').removeClass('active');
        $('.block-coll__edit').removeClass('active');
        $('.block-coll__delete').removeClass('active');
      }

      ajaxLoading = false;
    }).fail(function (jqXHR, ajaxOptions, thrownError) {
      alert('Something went wrong.');
    });
  } // Update gallery page click change image button


  $('body').on('click', '.btn-change-image', function () {
    $('.block-change-image input').trigger('click');
  }); // Add Artist 

  $('body').on('click', '.btns-insert-cancel-artist .btn-insert-artist', function () {
    var $art_name_en = $('.insert-artist .insert-artist-name').val();
    var $art_description_en = $('.insert-artist .insert-artist-description').val();
    var $art_name_ch = $('.insert-artist .insert-artist-name-ch').val();
    var $art_description_ch = $('.insert-artist .insert-artist-description-ch').val();
    var $art_name_ko = $('.insert-artist .insert-artist-name-ko').val();
    var $art_description_ko = $('.insert-artist .insert-artist-description-ko').val();
    $('.input-artist-name').val($art_name_en);
    $('.input-artist-name-ch').val($art_name_ch);
    $('.input-artist-name-ko').val($art_name_ko);

    if ($art_name_en != '') {
      $.ajax({
        url: "/api/api-artists",
        method: "post",
        beforeSend: function beforeSend() {
          $(".selectbox-artists").empty();
        },
        data: {
          artist_name_en: $art_name_en,
          artist_description_en: $art_description_en,
          artist_name_ch: $art_name_ch,
          artist_description_ch: $art_description_ch,
          artist_name_ko: $art_name_ko,
          artist_description_ko: $art_description_ko
        },
        success: function success(result) {
          $('.bg-overlay').removeClass('active');
          $('.popup-insert-artist').removeClass('active');
          var html = '';

          for (var key in result.artists) {
            if (result.artists.hasOwnProperty(key)) {
              lastKey = key;
            }
          }

          $.each(result.artists, function (key, val) {
            if (result.artists[lastKey] == val) {
              html += '<option value="' + key + '" selected>' + val + '</option>';
            } else {
              html += '<option value="' + key + '">' + val + '</option>';
            }
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
    $('.bg-overlay').addClass('active');
    $('.insert-category').addClass('active');
  });
  $('body').on('click', '.btn-cancel-category', function () {
    $('.bg-overlay').removeClass('active');
    $('.insert-category').removeClass('active');
    $('.popup-update-category-artist').removeClass('active');
  });
  $('body').on('click', '.btn-category-insert-cancel .btn-insert-category', function () {
    var $cat_name_en = $('.insert-category .insert-cat-name-en').val();
    var $cat_name_ch = $('.insert-category .insert-cat-name-ch').val();
    var $cat_name_ko = $('.insert-category .insert-cat-name-ko').val();

    if ($cat_name_en != '' && $cat_name_ch != '' && $cat_name_ko != '') {
      $.ajax({
        url: "/api/api-categories",
        method: "post",
        beforeSend: function beforeSend() {
          $(".selectbox-categories").empty();
        },
        data: {
          cat_name_en: $cat_name_en,
          cat_name_ch: $cat_name_ch,
          cat_name_ko: $cat_name_ko
        },
        success: function success(result) {
          var html = '';

          for (var key in result.categories) {
            if (result.categories.hasOwnProperty(key)) {
              lastKey = key;
            }
          }

          $.each(result.categories, function (key, val) {
            if (result.categories[lastKey] == val) {
              html += '<option value="' + key + '" selected>' + val + '</option>';
            } else {
              html += '<option value="' + key + '">' + val + '</option>';
            }
          });
          $('.selectbox-categories').append(html);
          $('.bg-overlay').removeClass('active');
          $('.insert-category').removeClass('active');
        }
      });
    } else {
      alert('????????? ???????????? ?????? ??????????????????.');
    }
  });
  $('body').on('click', '.btn-delete-category', function () {
    var selected_cat_id = $('.selectbox-categories option:selected').val();

    if (selected_cat_id != 0) {
      $.ajax({
        url: "/api/api-delete-categories",
        method: "post",
        beforeSend: function beforeSend() {
          $('.selectbox-categories').empty();
        },
        data: {
          selected_cat_id: selected_cat_id
        },
        success: function success(result) {
          var html = '';

          for (var key in result.categories) {
            if (result.categories.hasOwnProperty(key)) {
              lastKey = key;
            }
          }

          $.each(result.categories, function (key, val) {
            if (result.categories[lastKey] == val) {
              html += '<option value="' + key + '" selected>' + val + '</option>';
            } else {
              html += '<option value="' + key + '">' + val + '</option>';
            }
          });
          $('.selectbox-categories').append(html);
        }
      });
    }
  });
  $('body').on('click', '.btn-delete-artist', function () {
    var selected_artist_id = $('.selectbox-artists option:selected').val();

    if (selected_artist_id != 0) {
      $.ajax({
        url: "/api/api-delete-artist",
        method: "post",
        beforeSend: function beforeSend() {
          $('.selectbox-artists').empty();
        },
        data: {
          selected_artist_id: selected_artist_id
        },
        success: function success(result) {
          var html = '';

          for (var key in result.artists) {
            if (result.artists.hasOwnProperty(key)) {
              lastKey = key;
            }
          }

          $.each(result.artists, function (key, val) {
            if (result.artists[lastKey] == val) {
              html += '<option value="' + key + '" selected>' + val + '</option>';
            } else {
              html += '<option value="' + key + '">' + val + '</option>';
            }
          });
          $('.selectbox-artists').append(html);
        }
      });
    }
  });
  $('body').on('click', '.btn-edit-category', function () {
    var selected_cat_id = $('.selectbox-categories option:selected').val();

    if (selected_cat_id != 0) {
      $.ajax({
        url: "/api/api-get-categories",
        method: "post",
        beforeSend: function beforeSend() {
          $('.popup-update-category-artist').empty();
        },
        data: {
          selected_cat_id: selected_cat_id
        },
        success: function success(result) {
          var html = '';
          $.each(result.category, function (key, val) {
            html += '<div class="flex aic flex-column update-category" data-category-id="' + key + '">';
            html += '<input type="text" value="' + val.category_ko + '" name="category_name_ko" placeholder="??????(?????????)" class="form-control insert-cat-name-ko mb-2">';
            html += '<input type="text" value="' + val.category_ch + '" name="category_name_ch" placeholder="??????(??????)" class="form-control insert-cat-name-ch mb-2">';
            html += '<input type="text" value="' + val.category_en + '" name="category_name" placeholder="??????(??????)" class="form-control insert-cat-name-en mb-2">';
            html += '<div class="btn-category-update-cancel flex aie jce">';
            html += '<a href="javascript:void(0)" class="btn-insert-category mr-2">??????</a>';
            html += '<a href="javascript:void(0)" class="btn-cancel-category">??????</a>';
            html += '</div>';
            html += '</div>';
          });
          $('.popup-update-category-artist').append(html);
          $('.bg-overlay').addClass('active');
          $('.popup-update-category-artist').addClass('active');
          $('body').on('click', '.btn-category-update-cancel .btn-insert-category', function () {
            var $cat_id = $('.update-category').data('category-id');
            var $cat_name_en = $('.update-category .insert-cat-name-en').val();
            var $cat_name_ch = $('.update-category .insert-cat-name-ch').val();
            var $cat_name_ko = $('.update-category .insert-cat-name-ko').val();

            if ($cat_name_en != '' && $cat_name_ch != '' && $cat_name_ko != '') {
              $.ajax({
                url: "/api/api-update-categories",
                method: "post",
                beforeSend: function beforeSend() {// $(".selectbox-categories").empty();
                },
                data: {
                  cat_id: $cat_id,
                  cat_name_en: $cat_name_en,
                  cat_name_ch: $cat_name_ch,
                  cat_name_ko: $cat_name_ko
                },
                success: function success(result) {
                  $('.bg-overlay').removeClass('active');
                  $('.popup-update-category-artist').removeClass('active');
                }
              });
            } else {
              alert('????????? ???????????? ??????????????????.');
            }
          });
        }
      });
    }
  });
  $('body').on('click', '.btn-add-artist', function () {
    $('.bg-overlay').addClass('active');
    $('.popup-insert-artist').addClass('active');
  });
  $('body').on('click', '.btn-cancel-artist', function () {
    $('.bg-overlay').removeClass('active');
    $('.popup-insert-artist').removeClass('active');
    $('.popup-update-category-artist').removeClass('active');
  });
  var en_name = $('.selectbox-artists option:selected').attr('data-name-en');
  var ch_name = $('.selectbox-artists option:selected').attr('data-name-ch');
  var ko_name = $('.selectbox-artists option:selected').attr('data-name-ko');
  $('.input-artist-name').val(en_name);
  $('.input-artist-name-ch').val(ch_name);
  $('.input-artist-name-ko').val(ko_name);
  $('.form-group').on('change', 'select.selectbox-artists', function (e) {
    var en_name = $(e.target).find("option:selected").attr('data-name-en');
    var ch_name = $(e.target).find("option:selected").attr('data-name-ch');
    var ko_name = $(e.target).find("option:selected").attr('data-name-ko');
    $('.input-artist-name').val(en_name);
    $('.input-artist-name-ch').val(ch_name);
    $('.input-artist-name-ko').val(ko_name);
  }); // Edit page validate

  var title_ko = $('input[name=title_ko]').val();
  var title_ch = $('input[name=title_ch]').val();
  var title_en = $('input[name=title]').val();
  var width = $('input[name=width]').val();
  var height = $('input[name=height]').val();
  var actual_price = $('input[name=actual_price]').val();
  var retail_price = $('input[name=retail_price]').val();
  var check_safe_children = $('input[name=safe_children]').is(':checked');
  var select_category = $('.selectbox-categories option:selected').val();
  var selectbox_artists = $('.selectbox-artists option:selected').val();

  if (title_ko == '') {
    $('input[name=title_ko]').css('border-color', 'red');
  }

  if (title_ch == '') {
    $('input[name=title_ch]').css('border-color', 'red');
  }

  if (title_en == '') {
    $('input[name=title]').css('border-color', 'red');
  }

  if (width == '') {
    $('input[name=width]').css('border-color', 'red');
  }

  if (height == '') {
    $('input[name=height]').css('border-color', 'red');
  }

  if (actual_price == '') {
    $('input[name=actual_price]').css('border-color', 'red');
  }

  if (retail_price == '') {
    $('input[name=retail_price]').css('border-color', 'red');
  }

  if (check_safe_children == false) {
    $('.safe-children-label').css('border', 'solid 1px red');
  }

  if (select_category == '0') {
    $('.selectbox-categories').css('border-color', 'red');
  }

  if (selectbox_artists == '0') {
    $('.selectbox-artists').css('border-color', 'red');
  } // ======================================================================= //


  $('body').on('click', '.btn-edit-artist', function () {
    var selected_artist_id = $('.selectbox-artists option:selected').val();

    if (selected_artist_id != 0) {
      $.ajax({
        url: "/api/api-get-artist",
        method: "post",
        beforeSend: function beforeSend() {
          $('.popup-update-category-artist').empty();
        },
        data: {
          selected_artist_id: selected_artist_id
        },
        success: function success(result) {
          $('.popup-update-category-artist').addClass('update-artist-popup');
          html = '';
          $.each(result.artist, function (key, val) {
            html += '<div class="flex flex-column update-artist" data-artist-id="' + key + '">';
            html += '<div class="mb-3">';
            html += '<input type="text" value="' + val.artist_name_ko + '" placeholder="????????? ??????(?????????)" name="art_name_ko" class="form-control insert-artist-name-ko mb-2">';
            html += '<textarea name="art_description_ko" rows="5" placeholder="????????? ??????(?????????)" class="form-control insert-artist-description-ko">' + val.artist_description_ko + '</textarea>';
            html += '</div>';
            html += '<div class="mb-3">';
            html += '<input type="text" value="' + val.artist_name_ch + '" placeholder="????????? ??????(??????)" name="art_name_ch" class="form-control insert-artist-name-ch mb-2">';
            html += '<textarea name="art_description_ch" rows="5" placeholder="????????? ??????(??????)" class="form-control insert-artist-description-ch">' + val.artist_description_ch + '</textarea>';
            html += '</div>';
            html += '<div class="mb-3">';
            html += '<input type="text" value="' + val.artist_name_en + '" placeholder="????????? ??????(??????)" name="art_name" class="form-control insert-artist-name mb-2">';
            html += '<textarea name="art_description" rows="5" placeholder="????????? ??????(??????)" class="form-control insert-artist-description">' + val.artist_description_en + '</textarea>';
            html += '</div>';
            html += '<div class="btns-update-cancel-artist flex aic jce mt-3">';
            html += '<a href="javascript:void(0)" class="btn-grey btn-insert-artist mr-2">??????</a>';
            html += '<a href="javascript:void(0)" class="btn-grey btn-cancel-artist">??????</a>';
            html += '</div>';
            html += '</div>';
          });
          $('.popup-update-category-artist').append(html);
          $('.bg-overlay').addClass('active');
          $('.popup-update-category-artist').addClass('active');
          $('body').on('click', '.btns-update-cancel-artist .btn-insert-artist', function () {
            var $artist_id = $('.update-artist').data('artist-id');
            var $art_name_en = $('.update-artist .insert-artist-name').val();
            var $art_description_en = $('.update-artist .insert-artist-description').val();
            var $art_name_ch = $('.update-artist .insert-artist-name-ch').val();
            var $art_description_ch = $('.update-artist .insert-artist-description-ch').val();
            var $art_name_ko = $('.update-artist .insert-artist-name-ko').val();
            var $art_description_ko = $('.update-artist .insert-artist-description-ko').val();
            $('.input-artist-name').val($art_name_en);
            $('.input-artist-name-ch').val($art_name_ch);
            $('.input-artist-name-ko').val($art_name_ko);

            if ($art_name_en != '' && $art_name_ch != '' && $art_name_ko != '') {
              $.ajax({
                url: "/api/api-update-artist",
                method: "post",
                data: {
                  artist_id: $artist_id,
                  artist_name_en: $art_name_en,
                  artist_description_en: $art_description_en,
                  artist_name_ch: $art_name_ch,
                  artist_description_ch: $art_description_ch,
                  artist_name_ko: $art_name_ko,
                  artist_description_ko: $art_description_ko
                },
                success: function success(result) {
                  $('.bg-overlay').removeClass('active');
                  $('.popup-update-category-artist').removeClass('active');
                }
              });
            } else {
              alert('????????? ???????????? ??????????????????.');
            }
          });
        }
      });
    }
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
  } // Order items


  $('body').on('click', '.btn-view-items', function () {
    $('.popup-order-items').empty();
    $('.bg-overlay').addClass('active');
    var order_info = $(this).closest('tr').find('.order-item-info').html();
    $('.popup-order-items').append(order_info);
    $('.popup-order-items').addClass('active');
  });
  $('body').on('click', '.btn-cancel-status', function () {
    $('.bg-overlay').removeClass('active');
    $('.popup-order-items').removeClass('active');
  });
  $('body').on('click', '.btn-update-popup', function () {
    $('.btn-update-status').trigger('click');
  }); // Admin user check investor user

  $('.investor-user input').change(function () {
    var user_id = $(this).data('user-id');

    if ($(this).is(':checked')) {
      $(this).closest('.boxCtnt').find('.admin-user input').prop('checked', false);
      $.ajax({
        url: "/api/api-investor-user",
        method: "post",
        data: {
          user_id: user_id,
          checked: 'true'
        },
        success: function success(result) {
          console.log(result);
        }
      });
    } else {
      $.ajax({
        url: "/api/api-investor-user",
        method: "post",
        data: {
          user_id: user_id,
          checked: 'false'
        },
        success: function success(result) {}
      });
    }
  }); // Make Super admin 

  $('.admin-user input').change(function () {
    var user_id = $(this).data('user-id');

    if ($(this).is(':checked')) {
      $(this).closest('.boxCtnt').find('.investor-user input').prop('checked', false);
      $.ajax({
        url: "/api/api-admin-user",
        method: "post",
        data: {
          user_id: user_id,
          checked: 'true'
        },
        success: function success(result) {
          console.log(result);
        }
      });
    } else {
      $.ajax({
        url: "/api/api-admin-user",
        method: "post",
        data: {
          user_id: user_id,
          checked: 'false'
        },
        success: function success(result) {}
      });
    }
  }); // Deposit page buttons event

  $('body').on('click', '.block-admin-deposits .btn', function () {
    var button_status = '';

    if ($(this).hasClass('btn-confirm-deposit')) {
      button_status = 'confirm';
    } else {
      button_status = 'cancel';
    }

    var depositId = $(this).closest('tr').data('deposit-id');
    var $this = $(this);
    $.ajax({
      url: "/api/confirm-deposit",
      method: "post",
      data: {
        status: button_status,
        deposit_id: depositId
      },
      success: function success(result) {
        if (result.status == 'confirm') {
          $this.closest('tr').find('.status').text('??????');
        } else {
          $this.closest('tr').find('.status').text('??????');
        }

        $this.closest('td').find('button').hide();
      }
    });
  }); // image upload change event

  $('#uploadImage').change(function () {
    $('.btn-upload-image').trigger('click');
  });
});
/******/ })()
;