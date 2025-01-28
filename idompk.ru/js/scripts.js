window.indexedDB = window.indexedDB || window.mozIndexedDB || window.webkitIndexedDB || window.msIndexedDB;
window.IDBTransaction = window.IDBTransaction || window.webkitIDBTransaction || window.msIDBTransaction;
window.IDBKeyRange = window.IDBKeyRange || window.webkitIDBKeyRange || window.msIDBKeyRange;
if (!window.indexedDB) {
  console.log("Ваш браузер не поддерживат стабильную версию IndexedDB. Такие-то функции будут недоступны");
}
const dbName = "idompk";
var customerData = [];
/*$.getJSON( "contacts.json", function( json ) {
  customerData.push(json[0]);
});*/
var request = indexedDB.open(dbName, 1);
request.onerror = function(event) {};
request.onupgradeneeded = function(event) {
  var db = event.target.result;
  var objectStore = db.createObjectStore("contacts", { keyPath: "id"});
  objectStore.createIndex("title", "title", { unique: false });
  objectStore.createIndex("city", "city", { unique: true });
  for (var i in customerData) {
    objectStore.add(customerData[i]);
  }
};


const request1 = window.indexedDB.open("idompk", 1);
request1.onsuccess = () => {
  const db = request1.result;
  const transaction = db.transaction(
    [ "contacts" ],
    "readwrite"
  );
  const invStore = transaction.objectStore("contacts");

  const getRequest = invStore.getAll();
  getRequest.onsuccess = () => {
    //$("#idompk-c_phone_1").text(getRequest.result[0].c_phone_1);
  };
};

/* ^^^
 * Глобальные-вспомогательные функции
 * ========================================================================== */

/* ^^^
 * Viewport Height Correction
 *
 * @link https://www.npmjs.com/package/postcss-viewport-height-correction
 * ========================================================================== */
function setViewportProperty(){
  var vh = window.innerHeight * 0.01;
  document.documentElement.style.setProperty('--vh', vh + 'px');
}
window.addEventListener('resize', setViewportProperty);
setViewportProperty(); // Call the fuction for initialisation


$(document).ready(function() {

  $('.responsive').slick({
    dots: true,
    autoplay: true,
    autoplaySpeed: 7000,
    infinite: true,
    speed: 1000,
    slidesToShow: 2,
    slidesToScroll: 2,
    prevArrow: '<button type="button" class="slick-prev"><i class="idom_icon-2 idom_icon-2-chevron-left"></i></button>',
    nextArrow: '<button type="button" class="slick-next"><i class="idom_icon-2 idom_icon-2-chevron-left"></i></button>',
    responsive: [
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
    ]
  });

  $('.idom_navigation .dropdown').on('hidden.bs.dropdown', function () {
    $('body,html').animate({
      scrollTop: 0
    }, 800);
  });

  $(function() {
    $(window).scroll(function() {
      if ($(this).scrollTop() != 0) {
        $('#jsToTopPage').fadeIn();
      } else {
        $('#jsToTopPage').fadeOut();
      }
    });
    $('#jsToTopPage').click(function() {
      $('body,html').animate({
        scrollTop: 0
      }, 800);
    });
  });

  if ($('.with-caption').length) {
    $('.with-caption').magnificPopup({
      type: 'image',
      closeBtnInside: false,
      mainClass: 'mfp-with-zoom mfp-img-mobile',
      image: {
        verticalFit: true
      },
      gallery: {
        enabled: true
      }
    });
    $('.with-caption').on('click', function(){
      setTimeout(function(){
        if($('.idompk-plans.is-mirrored').length) {
          $('.mfp-gallery').addClass('mfp-is-mirrored');
        } else {
          $('.mfp-gallery').removeClass('mfp-is-mirrored');
        }
      }, 200);
    });
  }


  $(document).on('click','#jsOpenFinderMobile, .idom_top-find__btn-reset', function(){
    $(this).parent().toggleClass('idom-mobile-head-icons--active');
    $('.idom_top-find').toggleClass('idom_top-find--active-mobile');
  });

  $('#navbar').on('show.bs.collapse', function () {
    $('.idom_header__phone-block').addClass('idom_header__phone-block--active');
    $('.idom_header__links').addClass('idom_header__links--active');
  });

  $('#navbar').on('hidden.bs.collapse', function () {
    $('.idom_header__phone-block').removeClass('idom_header__phone-block--active');
    $('.idom_header__links').removeClass('idom_header__links--active');
  });

  $('.idom_order-item__info-line--click').on('click', function(){
    $(this).toggleClass('idom_order-item__info-line--active');
    if ($(this).find('.checkbox input').prop('checked')) {
      $(this).find('.checkbox input').prop('checked',false);
    } else {
      $(this).find('.checkbox input').prop('checked',true);
    }
  });
  $('.idom_order-item__info-line--click label').on('click', function(){
    $(this).parents('.row').toggleClass('idom_order-item__info-line--active');
  });

  $('.idom_credit-box__item .idom-credit-box__collapser').on('click', function(e){
    e.preventDefault();
    $('.idom_credit-box__content').slideToggle();
  });

  $('.idom_feedback-info-delivery__item').on('click', function(){
    $('.idom_feedback-info-delivery__item').removeClass('idom_feedback-info-delivery__item--active');
    $(this).addClass('idom_feedback-info-delivery__item--active');
    $(this).find('.radio input').prop('checked',true);
  });

  $('.idom_feedback-info-pay__item').on('click', function(){
    $('.idom_feedback-info-pay__item').removeClass('idom_feedback-info-pay__item--active');
    $(this).addClass('idom_feedback-info-pay__item--active');
    $(this).find('.radio input').prop('checked',true);
  });



  $('.idom-order-presum-btn--to-step1').on('click', function(e){
    e.preventDefault();
    $('html, body').animate({scrollTop: 0}, 1);
    $('.idom_order-steps-list .idom_order-step').removeClass('idom_order-step--active');
    $('.idom_order-steps-list .idom_order-step:first-child').addClass('idom_order-step--active');
    $('.idom_order-steps-content .idom_order-content').removeClass('idom_order-content--active');
    $('.idom_order-steps-content .idom_order-content:first-child').addClass('idom_order-content--active');
  });

  $('.idom-order-presum-btn--to-step2').on('click', function(e){
    e.preventDefault();
    $('html, body').animate({scrollTop: 0}, 1);
    $('.idom_order-steps-list .idom_order-step').removeClass('idom_order-step--active');
    $('.idom_order-steps-list .idom_order-step:last-child').addClass('idom_order-step--active');
    $('.idom_order-steps-content .idom_order-content').removeClass('idom_order-content--active');
    $('.idom_order-steps-content .idom_order-content:last-child').addClass('idom_order-content--active');
  });

  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  });


  if ($(".idom_number_all").length) {
    $(".idom_number_all").text($("#js-projects_count").val());
  }
  if ($(".idom_number_gz").length) {
    $(".idom_number_gz").text($("#js-projects_count_gz").val());
  }
  if ($(".idom_number_kr").length) {
    $(".idom_number_kr").text($("#js-projects_count_kr").val());
  }

  $(".idom_phone").mask("+7 (999) 999-9999");

  $(document).on('submit',"#idom_js_form_send_our",function(e) {
    e.preventDefault();
    var formData = new FormData($('#idom_js_form_send_our')[0]);
    $.ajax({
      url: "/site/form_send_our",
      cache: false,
      async: false,
      type: "POST",
      dataType: 'json',
      processData: false,
      contentType: false,
      data: formData,
      beforeSend: function () {
        $(".idom_overlay").fadeIn();
      },
      success: function (data, status) {
        $(".idom_feedback-main__input, .idom_feedback-main__textarea").val("");
        $(".file_text").text("Прикрепите файл");
        $("body").append('<div class="idom_thanks-popup"><i class="idom_icon idom_icon-close idom_icon-close-thanks"></i><span class="idom_thanks-popup__title">Спасибо!</span><p>Мы свяжемся с Вами в ближайшее время.</p></div>');
      }
    });
  });

  $(document).on('submit',"#idom_js_form_send_our_simpler",function(e) {
    e.preventDefault();
    var formData = new FormData($('#idom_js_form_send_our_simpler')[0]);
    $.ajax({
      url: "/site/form_send_our",
      cache: false,
      async: false,
      type: "POST",
      dataType: 'json',
      processData: false,
      contentType: false,
      data: formData,
      beforeSend: function () {
        $(".idom_overlay").fadeIn();
      },
      success: function (data, status) {
        $(".idom_feedback-main__input, .idom_feedback-main__textarea").val("");
        $(".file_text").text("Прикрепите файл");
        $("body").append('<div class="idom_thanks-popup"><i class="idom_icon idom_icon-close idom_icon-close-thanks"></i><span class="idom_thanks-popup__title">Спасибо!</span><p>Мы свяжемся с Вами в ближайшее время.</p></div>');
      }
    });
  });

  $(document).on('submit',"#idom_js_form_send_our_buy",function(e) {
    e.preventDefault();
    var formData = new FormData($('#idom_js_form_send_our_buy')[0]);
    $.ajax({
      url: "/site/form_send_our",
      cache: false,
      async: false,
      type: "POST",
      dataType: 'json',
      processData: false,
      contentType: false,
      data: formData,
      beforeSend: function () {
        $(".idom_overlay").fadeIn();
      },
      success: function (data, status) {
        $(".idom_feedback-main__input, .idom_feedback-main__textarea").val("");
        $("body").append('<div class="idom_thanks-popup"><i class="idom_icon idom_icon-close idom_icon-close-thanks"></i><span class="idom_thanks-popup__title">Спасибо!</span><p>Мы свяжемся с Вами в ближайшее время.</p></div>');
      }
    });
  });

  $(document).on('submit',"#idom_js_form_callback",function(e) {
    e.preventDefault();
    var formData = new FormData($('#idom_js_form_callback')[0]);
    $.ajax({
      url: "/site/form_callback",
      cache: false,
      async: false,
      type: "POST",
      dataType: 'json',
      processData: false,
      contentType: false,
      data: formData,
      beforeSend: function () {
        $(".idom_overlay").fadeIn();
      },
      success: function (data, status) {
        $(".idom_callback_form").fadeOut();
        $(".idom_callback_formM").fadeOut();
        $(".idom_feedback-main__input").val("");
        $("body").append('<div class="idom_thanks-popup"><i class="idom_icon idom_icon-close idom_icon-close-thanks"></i><span class="idom_thanks-popup__title">Спасибо!</span><p>Мы свяжемся с Вами в ближайшее время.</p><p>Режим работы: пн-пт, с 10.00 до 19.00</p></div>');
      }
    });
  });

  $(document).on('submit',"#idom_js_form_main_0",function(e) {

    e.preventDefault();
    var formData = new FormData($('#idom_js_form_main_0')[0]);
    $.ajax({
      url: "/site/form_main_0",
      cache: false,
      async: false,
      type: "POST",
      dataType: 'json',
      processData: false,
      contentType: false,
      data: formData,
      beforeSend: function () {
        $(".idom_overlay").fadeIn();
      },
      success: function (data, status) {
        $(".idom_feedback-main__input, .idom_feedback-main__textarea").val("");
        $(".file_text").text("Прикрепите файл");
        $("body").append('<div class="idom_thanks-popup"><i class="idom_icon idom_icon-close idom_icon-close-thanks"></i><span class="idom_thanks-popup__title">Спасибо!</span><p>Мы свяжемся с Вами в ближайшее время.</p></div>');
      }
    });
  });

  $(document).on('submit',"#idom_js_form_main_1",function(e) {
    e.preventDefault();
    var formData = new FormData($('#idom_js_form_main_1')[0]);
    $.ajax({
      url: "/site/form_main_1",
      cache: false,
      async: false,
      type: "POST",
      dataType: 'json',
      processData: false,
      contentType: false,
      data: formData,
      beforeSend: function () {
        $(".idom_overlay").fadeIn();
      },
      success: function (data, status) {
        $(".idom_callback_form-d").remove();
        $(".idom_feedback-main__input, .idom_feedback-main__textarea").val("");
        $(".file_text").text("Прикрепите файл");
        $("body").append('<div class="idom_thanks-popup"><i class="idom_icon idom_icon-close idom_icon-close-thanks"></i><span class="idom_thanks-popup__title">Спасибо!</span><p>Мы свяжемся с Вами в ближайшее время.</p></div>');
      }
    });
  });



  $(document).on('submit',"#idom_js_form_order",function(e) {
    e.preventDefault();
    var formData = new FormData($('#idom_js_form_order')[0]);
    $.ajax({
      url: "/site/form_order",
      cache: false,
      async: false,
      type: "POST",
      dataType: 'json',
      processData: false,
      contentType: false,
      data: formData,
      beforeSend: function () {
        $(".idom_overlay").fadeIn();
      },
      error: function (status) {
        console.log(status);
      },
      success: function (data, status) {
        $(".idom_feedback-main__input, .idom_feedback-main__textarea").val("");
        $("body").append('<div class="idom_order-popup"><i class="idom_icon idom_icon-close idom_icon-close-order"></i><span class="idom_thanks-popup__title">Спасибо!</span><p>После получения заявки мы свяжемся с вами и сообщим о способах оплаты и сроках готовности проекта.</p></div>');
      }
    });
  });







  $(document).on('change', '[name="idom_js_form_main_1__area"]', function(e){
    if ($('[name="idom_js_form_main_1__area"]:checked').val() == 1) {
      $('.jsAreaAddress').show();
      $('.jsAreaTime').hide();
    } else {
      $('.jsAreaAddress').hide();
      $('.jsAreaTime').show();
    }
  });



  $(document).on('click', '.idom_header__phone-block__callback-link', function(e){
    e.preventDefault();
    $(".idom_overlay").fadeIn();
    $(".idom_callback_form-d").remove();
    $("body").append('<div class="idompk-modal-form idompk-modal-form--small idom_callback_form idom_callback_form-d"><i class="idom_icon idom_icon-close idom_icon-close-thanks"></i><span class="idom_feedback-main__title">Заказать обратный звонок</span><form class="idom_js_form_callback" method="post" id="idom_js_form_callback" enctype="multipart/form-data"><fieldset><div class="row idom_feedback-main__row"><div class="col-md-12 idom_feedback-main__item"><input class="idom_feedback-main__input idom_phone" name="idom_js_form_callback__phone" type="text" placeholder="Телефон" required="" /></div><div class="col-md-12 idom_feedback-main__item"><select class="idom_feedback-main__input idom_feedback-main__input--select"><option style="display:none;"></option><option value="1">Строительство</option><option value="2">Реконструкция/Достройка</option><option value="3">Проектирование</option><option value="4">Покупка готового проекта</option><option value="5">Инженерные сети</option></select><div class="idom_feedback-main__input-note is-visible">Выберите тему</div></div></div><div class="row"><div class="col-md-12 idom_feedback-main__item idom_feedback-main__item--submit"><div id="idom_js_form_callback_captcha"></div><input type="hidden" name="idom_js_form_callback__form" value="Форма: Заказать обратный звонок!" /><input class="idom_feedback-main__button" type="submit" value="Отправить" /></div></div></fieldset><div class="idompk-iagree">Нажимая кнопку «Отправить», я даю согласие на обработку моих персональных данных, в соответствии с Федеральным законом №152-ФЗ «О персональных данных».</div></form></div>');
    $(".idom_phone").mask("+7 (999) 999-9999");
  });


  $(document).on('click', '#js-idom_letter-me', function(e){
    e.preventDefault();
    $(".idom_overlay").fadeIn();
    $(".idom_callback_form-mail").remove();
    $("body").append('<div class="idompk-modal-form idompk-modal-form--large idom_callback_form idom_callback_form-mail"><i class="idom_icon idom_icon-close idom_icon-close-thanks"></i><span class="idom_feedback-main__title">Укажите свой e-mail!</span><form class="idom_js_form_callback" method="post" id="idom_js_form_callback-mail" enctype="multipart/form-data"><fieldset><div class="row idom_feedback-main__row"><div class="col-md-12 idom_feedback-main__item"><input class="idom_feedback-main__input" name="idom_js_form_callback__mail" type="text" placeholder="E-mail" required></div></div><div class="row"><div class="col-md-12 idom_feedback-main__item"><div id="idom_js_form_callback_captcha"></div><input type="hidden" name="idom_js_form_callback__form" value="Форма: Отправить проект на почту!"><input type="hidden" id="idom_js_form_callback__name" name="name" value=""><input type="hidden" id="idom_js_form_callback__id" name="ids" value=""><input type="hidden" id="idom_js_form_callback__url" name="url" value=""><input type="hidden" id="idom_js_form_callback__image" name="image" value=""><input class="idom_feedback-main__button" type="submit" value="Отправить"></div></div></fieldset></form></div>');
    $("#idom_js_form_callback__name").val($(this).data("name"));
    $("#idom_js_form_callback__id").val($(this).data("id"));
    $("#idom_js_form_callback__url").val($(this).data("url"));
    $("#idom_js_form_callback__image").val($(this).data("image"));
  });

  $(document).on('submit',"#idom_js_form_callback-mail",function(e) {
    e.preventDefault();
    var formData = new FormData($('#idom_js_form_callback-mail')[0]);
    $.ajax({
      url: "/site/form_send_to_mail",
      cache: false,
      async: false,
      type: "POST",
      dataType: 'json',
      processData: false,
      contentType: false,
      data: formData,
      beforeSend: function () {
        $(".idom_overlay").fadeIn();
      },
      error: function (status) {
        console.log(status);
      },
      success: function (data, status) {
        $(".idom_callback_form-mail").remove();
        $(".idom_feedback-main__input").val("");
        $("body").append('<div class="idom_thanks-popup"><i class="idom_icon idom_icon-close idom_icon-close-thanks"></i><span class="idom_thanks-popup__title">Письмо отправлено!</span><p>На указаный e-mail было отправленно письмо с данными о проекте.</p></div>');
      }
    });
  });


  $(document).on('click', '#js-idom_ask-project', function(e){
    e.preventDefault();
    $(".idom_overlay").fadeIn();
    $(".idom_callback_form-ask-project").fadeIn();
   /* var formStr = '<div class="idompk-modal-form idompk-modal-form--large idompk-modal-form idompk-modal-form--large idom_callback_form idom_callback_form-1 idom_callback_form-ask-project"><i class="idom_icon idom_icon-close  idom_icon-close-thanks"></i><span class="idom_feedback-main__title">Вопрос по проекту $project_id</span><form class="idom_js_form_ask-project" method="post" id="idom_js_form_ask-project" enctype="multipart/form-data"><fieldset><div class="row idom_feedback-main__row"><div class="col-md-4 idom_feedback-main__item"><input class="idom_feedback-main__input" name="idom_js_form_main_1__name" type="text" placeholder="Ваше имя" required></div><div class="col-md-4 idom_feedback-main__item"><input class="idom_feedback-main__input idom_phone" name="idom_js_form_main_1__phone" type="text" placeholder="Телефон" required></div><div class="col-md-4 idom_feedback-main__item"><input class="idom_feedback-main__input" name="idom_js_form_main_1__mail" type="text" placeholder="E-mail"></div></div><div class="row idom_feedback-main__row"><div class="col-md-12 idom_feedback-main__item"><textarea class="idom_feedback-main__textarea" name="idom_js_form_main_1__message" placeholder="Ваше сообщение"></textarea></div></div><div class="row"><div class="col-md-12 idom_feedback-main__item idom_feedback-main__item--submit"><div id="idom_js_form_main_1_captcha"></div><input type="hidden" name="idom_js_form_main_1__form" value="Форма: Задать вопрос по проекту!"><input type="hidden" id="idom_feedback-main__name" name="name" value=""><input type="hidden" id="idom_feedback-main__id" name="ids" value=""><input type="hidden" id="idom_feedback-main__url" name="url" value="" required><input type="hidden" id="idom_feedback-main__image" name="image" value=""><input class="idom_feedback-main__button" type="submit" value="Отправить"></div></div></fieldset><div class="idompk-iagree">Нажимая кнопку «Отправить», я даю согласие на обработку моих персональных данных, в соответствии с Федеральным законом №152-ФЗ «О персональных данных».</div></form></div>';
    formStr = formStr.replace('$project_id', $('.idom_item-page_top-info__number span').html());
    $("body").append(formStr);*/
    $(".idom_phone").mask("+7 (999) 999-9999");
    // $("#idom_feedback-main__name").val($(this).data("name"));
    // $("#idom_feedback-main__id").val($(this).data("id"));
    // $("#idom_feedback-main__url").val($(this).data("url"));
    // $("#idom_feedback-main__image").val($(this).data("image"));
  });

  $(document).on('submit',"#idom_js_form_ask-project",function(e) {
    e.preventDefault();
    var formData = new FormData($('#idom_js_form_ask-project')[0]);
    $.ajax({
      url: "/site/form_ask_project",
      cache: false,
      async: false,
      type: "POST",
      dataType: 'json',
      processData: false,
      contentType: false,
      data: formData,
      beforeSend: function () {
        $(".idom_overlay").fadeIn();
      },
      error: function (status) {
        console.log(status);
      },
      success: function (data, status) {
        $(".idom_callback_form-ask-project").fadeOut();
        $(".idom_feedback-main__input, #idom_js_form_ask-project textarea").val("");
        $("body").append('<div class="idom_thanks-popup"><i class="idom_icon idom_icon-close idom_icon-close-thanks"></i><span class="idom_thanks-popup__title">Спасибо!</span><p>Мы свяжемся с Вами в ближайшее время.</p></div>');
      }
    });
  });


  $(document).on('click', '#js-idom_view-project', function(e){
    e.preventDefault();
    $(".idom_overlay").fadeIn();
    $(".idom_callback_form-ask-project").remove();
    $("body").append('<div class="idompk-modal-form idompk-modal-form--large idom_callback_form idom_callback_form-1 idom_callback_form-ask-project  idom_callback_form-view-project"><i class="idom_icon idom_icon-close  idom_icon-close-thanks"></i><div class="row"><div class="col-md-7 d-none d-md-block"><div class="img"><img src="/img/uploads/other/cover_booking.jpg"></div></div><div class="col-md-5"><span class="idom_feedback-main__title">Записаться на строящиеся объекты компании iDomPK</span><p>Укажите удобное для вас время и дату, чтобы мы смогли организовать для вас просмотр наших строящихся объектов.</p><form class="idom_js_form_ask-project" method="post" id="idom_js_form_view-project" enctype="multipart/form-data"><fieldset><div class="row idom_feedback-main__row"><div class="col-md-12 idom_feedback-main__item"><input class="idom_feedback-main__input" name="idom_js_form_main_1__name" type="text" placeholder="Ваше имя" required></div><div class="col-md-12 idom_feedback-main__item"><input class="idom_feedback-main__input idom_phone" name="idom_js_form_main_1__phone" type="text" placeholder="Телефон" required></div><div class="col-6 col-sm-12 col-lg-6 idom_feedback-main__item"><input class="idom_feedback-main__input idom_date" name="idom_js_form_main_1__date" type="text" id="datepickerForm" autocomplete="off" placeholder="Дата"></div><div class="col-6 col-sm-12 col-lg-6 idom_feedback-main__item"><select class="idom_feedback-main__select idom_time" name="idom_js_form_main_1__time"><option value="8:00 – 14:00">8:00 – 14:00</option><option value="14:00 – 20:00">14:00 – 20:00</option></select></div></div><div class="row idom_feedback-main__row"><div class="col-md-12 idom_feedback-main__item"><select class="idom_feedback-main__select idom_region" name="idom_js_form_main_1__region"><option value="Московская область">Московская область</option><option value="Ленинградская область">Ленинградская область</option></select></div></div><div class="row"><div class="col-md-12 idom_feedback-main__item"><div id="idom_js_form_main_1_captcha"></div><input type="hidden" name="idom_js_form_main_1__form" value="Форма: Записаться на строящиеся объекты компании iDomPK"><input class="idom_feedback-main__button" type="submit" value="Отправить"></div></div></fieldset></form></div></div></div>');
    $(".idom_phone").mask("+7 (999) 999-9999");
    $( "#datepickerForm" ).datepicker({dateFormat: 'dd.mm.yy'});
  });

  $(document).on('submit',"#idom_js_form_view-project",function(e) {
    e.preventDefault();
    var formData = new FormData($('#idom_js_form_view-project')[0]);
    $.ajax({
      url: "/site/form_view_project",
      cache: false,
      async: false,
      type: "POST",
      dataType: 'json',
      processData: false,
      contentType: false,
      data: formData,
      beforeSend: function () {
        $(".idom_overlay").fadeIn();
      },
      error: function (status) {
        console.log(status);
      },
      success: function (data, status) {
        $(".idom_callback_form-ask-project").remove();
        $(".idom_feedback-main__input, #idom_js_form_ask-project textarea").val("");
        $("body").append('<div class="idom_thanks-popup"><i class="idom_icon idom_icon-close idom_icon-close-thanks"></i><span class="idom_thanks-popup__title">Спасибо!</span><p>Мы свяжемся с Вами в ближайшее время.</p></div>');
      }
    });
  });


  $(document).on('click', '#js-idom_credit-project', function(e){
    e.preventDefault();
    $(".idom_overlay").fadeIn();
    $(".idom_callback_form-ask-project").remove();
    $("body").append('<div class="idompk-modal-form idompk-modal-form--large idom_callback_form idom_callback_form-1 idom_callback_form-ask-project"><i class="idom_icon idom_icon-close  idom_icon-close-thanks"></i><span class="idom_feedback-main__title">Заявка на одобрение кредита</span><form class="idom_js_form_ask-project" method="post" id="idom_js_form_credit-project" enctype="multipart/form-data"><fieldset><div class="row idom_feedback-main__row"><div class="col-md-4 idom_feedback-main__item"><input class="idom_feedback-main__input" name="idom_js_form_main_1__name" type="text" placeholder="Ваше имя" required></div><div class="col-md-4 idom_feedback-main__item"><input class="idom_feedback-main__input idom_phone" name="idom_js_form_main_1__phone" type="text" placeholder="Телефон" required></div><div class="col-md-4 idom_feedback-main__item"><input class="idom_feedback-main__input" name="idom_js_form_main_1__mail" type="text" placeholder="E-mail"></div></div><div class="row idom_feedback-main__row"><div class="col-md-12 idom_feedback-main__item"><textarea class="idom_feedback-main__textarea" name="idom_js_form_main_1__message" placeholder="Ваше сообщение"></textarea></div></div><div class="row"><div class="col-md-12 idom_feedback-main__item"><div id="idom_js_form_main_1_captcha"></div><input type="hidden" name="idom_js_form_main_1__form" value="Форма: Кредит по проекту!"><input type="hidden" id="idom_feedback-main__name" name="name" value=""><input type="hidden" id="idom_feedback-main__id" name="ids" value=""><input type="hidden" id="idom_feedback-main__url" name="url" value="" required><input type="hidden" id="idom_feedback-main__image" name="image" value=""><input type="hidden" id="idom_feedback-main__allsum" name="allsum" value=""><input type="hidden" id="idom_feedback-main__firstsum" name="firstsum" value=""><input type="hidden" id="idom_feedback-main__firstprocent" name="firstprocent" value=""><input type="hidden" id="idom_feedback-main__year" name="year" value=""><input type="hidden" id="idom_feedback-main__yearprocent" name="yearprocent" value=""><input type="hidden" id="idom_feedback-main__creditsum" name="creditsum" value=""><input type="hidden" id="idom_feedback-main__monthsum" name="monthsum" value=""><input class="idom_feedback-main__button" type="submit" value="Отправить"></div></div></fieldset></form></div>');
    $(".idom_phone").mask("+7 (999) 999-9999");
    $("#idom_feedback-main__name").val($(this).data("name"));
    $("#idom_feedback-main__id").val($(this).data("id"));
    $("#idom_feedback-main__url").val($(this).data("url"));
    $("#idom_feedback-main__image").val($(this).data("image"));
    $("#idom_feedback-main__allsum").val($(this).data("allsum"));
    $("#idom_feedback-main__firstsum").val($(this).data("firstsum"));
    $("#idom_feedback-main__firstprocent").val($(this).data("firstprocent"));
    $("#idom_feedback-main__year").val($(this).data("year"));
    $("#idom_feedback-main__yearprocent").val($(this).data("yearprocent"));
    $("#idom_feedback-main__creditsum").val($(this).data("creditsum"));
    $("#idom_feedback-main__monthsum").val($(this).data("monthsum"));

  });

  $(document).on('submit',"#idom_js_form_credit-project",function(e) {
    e.preventDefault();
    var formData = new FormData($('#idom_js_form_credit-project')[0]);
    $.ajax({
      url: "/site/form_credit_project",
      cache: false,
      async: false,
      type: "POST",
      dataType: 'json',
      processData: false,
      contentType: false,
      data: formData,
      beforeSend: function () {
        $(".idom_overlay").fadeIn();
      },
      error: function (status) {
        console.log(status);
      },
      success: function (data, status) {
        $(".idom_callback_form-ask-project").remove();
        $(".idom_feedback-main__input, #idom_js_form_ask-project textarea").val("");
        $("body").append('<div class="idom_thanks-popup"><i class="idom_icon idom_icon-close idom_icon-close-thanks"></i><span class="idom_thanks-popup__title">Спасибо!</span><p>Мы свяжемся с Вами в ближайшее время.</p></div>');
      }
    });
  });


  $(document).on('click', '#js-idom_ask-project-smeta', function(e){
    e.preventDefault();
    $(".idom_overlay").fadeIn();
    $(".idom_callback_form-ask-project-smeta").fadeIn();
    /*var formStr = '<div class="idompk-modal-form idompk-modal-form--large idom_callback_form idom_callback_form-1 idom_callback_form-ask-project-smeta"> <i class="idom_icon idom_icon-close  idom_icon-close-thanks"></i><span class="idom_feedback-main__title">Запросить смету</span> <form class="idom_js_form_ask-project-smeta" method="post" id="idom_js_form_ask-project-smeta" enctype="multipart/form-data"> <fieldset> <div class="row idom_feedback-main__row"> <div class="col-md-4 idom_feedback-main__item"> <label class="idom_feedback-main__label idom_feedback-main__label-2">Ваш регион</label> <select class="idom_feedback-main__select" name="idom_js_form_main_1__city"> <option value="Московская область">Московская область</option> <option value="Ленинградская область">Ленинградская область</option> </select> </div> <div class="col-md-8 idom_feedback-main__item"> <label class="idom_feedback-main__label idom_feedback-main__label-2 d-none d-md-block">&nbsp;</label> <p class="idompk-iagree2 mb-0">Мы ведём строительство, в основном, в этих двух регионах.<br/>Можем рассмотреть заявку из соседних регионов.</p> </div> </div> <div class="row idom_feedback-main__row"> <div class="col-md-4 idom_feedback-main__item"><input class="idom_feedback-main__input" name="idom_js_form_main_1__name" type="text" placeholder="Ваше имя *" required></div> <div class="col-md-4 idom_feedback-main__item"><input class="idom_feedback-main__input idom_phone" name="idom_js_form_main_1__phone" type="text" placeholder="Телефон *" required></div> <div class="col-md-4 idom_feedback-main__item"><input class="idom_feedback-main__input" name="idom_js_form_main_1__mail" type="text" placeholder="E-mail *" required></div> </div> <div class="row idom_feedback-main__row"> <div class="col-md-12 idom_feedback-main__item mb-1"> <div class="idom-check-blue"> <div class="radio"> <input type="radio" name="idom_js_form_main_1__area" value="1" id="checkbox_444" checked="checked"> <label for="checkbox_444"><span>У меня есть участок</span></label> </div> <div class="radio"> <input type="radio" name="idom_js_form_main_1__area" value="0" id="checkbox_555"> <label for="checkbox_555"><span>У меня нет участка</span></label> </div> </div> </div> <div class="col-md-12 idom_feedback-main__item jsAreaAddress"> <input class="idom_feedback-main__input" name="idom_js_form_main_1__area_address" type="text" placeholder="Адрес участа или кадастровый номер"> </div> <div class="col-md-12 idom_feedback-main__item jsAreaTime" style="display: none"> <select class="idom_feedback-main__select" name="idom_js_form_main_1__area_time" style="font-weight: bold;color: #3d7caf;"> <option value="Уже занимаюсь вопросом. Куплю в ближайшие 1-2 месяца">Уже занимаюсь вопросом. Куплю в ближайшие 1-2 месяца</option> <option value="Планирую приобрести в ближайшие 6 месяцев">Планирую приобрести в ближайшие 6 месяцев</option> <option value="Срок покупки участка не определён">Срок покупки участка не определён</option> </select> </div> </div> <div class="row idom_feedback-main__row"> <div class="col-md-12 idom_feedback-main__item"> <label class="idom_feedback-main__label">Выберите срок начала строительства</label> <select class="idom_feedback-main__select" name="idom_js_form_main_1__build_time" style="font-weight: bold;color: #3d7caf;"> <option value="Готов начать в ближайшие 1-2 месяца">Готов начать в ближайшие 1-2 месяца</option> <option value="Готов начать в ближайшие 6 месяцев">Готов начать в ближайшие 6 месяцев</option> <option value="Планирую начать строительство в следующем году">Планирую начать строительство в следующем году</option> <option value="Пока просто хочу понять стоимость дома">Пока просто хочу понять стоимость дома</option> </select> </div> </div> <div class="row idom_feedback-main__row"> <div class="col-md-12 idom_feedback-main__item"><textarea class="idom_feedback-main__textarea" name="idom_js_form_main_1__message" placeholder="Сообщение"></textarea></div> </div> <div class="row"> <div class="col-md-9 idom_feedback-main__item mb-0"><div class="file" style="float: right; width: 200px; margin-bottom: 10px;"><input type="file" name="idom_js_form_main_1__file[]" data-placeholder="Прикрепите файл" multiple><span class="file_text">Прикрепите файл</span><div class="file_icon"><i class="idom_icon-2 idom_icon-2-download"></i></div></div></div> <div class="col-md-3 idom_feedback-main__item idom_feedback-main__item--submit mt-0 "> <div id="idom_js_form_main_1_captcha"></div> <input type="hidden" name="idom_js_form_main_1__form" value="Форма: Запрос сметы к проекту!"><input type="hidden" id="idom_feedback-main__name" name="name" value=""><input type="hidden" id="idom_feedback-main__id" name="ids" value=""><input type="hidden" id="idom_feedback-main__url" name="url" value=""><input type="hidden" id="idom_feedback-main__image" name="image" value=""><input class="idom_feedback-main__button" style="width: 100% !important; max-width: none" type="submit" value="Отправить"></div> </div> </fieldset> <div class="idompk-iagree text-right">Нажимая кнопку «Отправить», я даю согласие на обработку моих персональных данных, в соответствии с Федеральным законом №152-ФЗ «О персональных данных». </div> </form> </div>';*/
    // formStr = formStr.replace('$project_id', $('.idom_item-page_top-info__number span').html());
    // $("body").append(formStr);
    $(".idom_phone").mask("+7 (999) 999-9999");
    // $("#idom_feedback-main__name").val($(this).data("name"));
    // $("#idom_feedback-main__id").val($(this).data("id"));
    // $("#idom_feedback-main__url").val($(this).data("url"));
    // $("#idom_feedback-main__image").val($(this).data("image"));
  });

  $(document).on('submit',"#idom_js_form_ask-project-smeta",function(e) {
    e.preventDefault();
    var formData = new FormData($('#idom_js_form_ask-project-smeta')[0]);
    $.ajax({
      url: "/site/form_ask_project",
      cache: false,
      async: false,
      type: "POST",
      dataType: 'json',
      processData: false,
      contentType: false,
      data: formData,
      beforeSend: function () {
        $(".idom_overlay").fadeIn();
      },
      error: function (status) {
        console.log(status);
      },
      success: function (data, status) {
        $(".idom_callback_form-ask-project-smeta").fadeOut();
        $(".idom_feedback-main__input, #idom_js_form_ask-project textarea").val("");
        $("body").append('<div class="idom_thanks-popup"><i class="idom_icon idom_icon-close idom_icon-close-thanks"></i><span class="idom_thanks-popup__title">Спасибо!</span><p>Мы свяжемся с Вами в ближайшее время.</p></div>');
      }
    });
  });


  $(document).on('click', '#js-idom_ask-project-change', function(e){
    e.preventDefault();
    $(".idom_overlay").fadeIn();
    $(".idom_callback_form-ask-project-change").fadeIn();
  /*  var formStr = '<div class="idompk-modal-form idompk-modal-form--large idom_callback_form idom_callback_form-1 idom_callback_form-ask-project-change"><i class="idom_icon idom_icon-close  idom_icon-close-thanks"></i><span class="idom_feedback-main__title">Запросить стоимость изменений проекта $project_id</span><form class="idom_js_form_ask-project-change" method="post" id="idom_js_form_ask-project-change" enctype="multipart/form-data"><fieldset><div class="row idom_feedback-main__row"><div class="col-md-4 idom_feedback-main__item"><input class="idom_feedback-main__input" name="idom_js_form_main_1__name" type="text" placeholder="Ваше имя" required></div><div class="col-md-4 idom_feedback-main__item"><input class="idom_feedback-main__input idom_phone" name="idom_js_form_main_1__phone" type="text" placeholder="Телефон" required></div><div class="col-md-4 idom_feedback-main__item"><div class="file"><input type="file" name="idom_js_form_main_1__file[]" data-placeholder="Прикрепите файл" multiple><span class="file_text">Прикрепите файл</span><div class="file_icon"><i class="idom_icon-2 idom_icon-2-download"></i></div></div></div></div><div class="row idom_feedback-main__row"><div class="col-md-12 idom_feedback-main__item"><textarea class="idom_feedback-main__textarea" name="idom_js_form_main_1__message" placeholder="Ваш вопрос"></textarea></div></div><div class="row"><div class="col-md-12 idom_feedback-main__item idom_feedback-main__item--submit"><div id="idom_js_form_main_1_captcha"></div><input type="hidden" name="idom_js_form_main_1__form" value="Форма: Задать вопрос по проекту!"><input type="hidden" id="idom_feedback-main__name" name="name" value=""><input type="hidden" id="idom_feedback-main__id" name="ids" value=""><input type="hidden" id="idom_feedback-main__url" name="url" value="" required><input type="hidden" id="idom_feedback-main__image" name="image" value=""><input class="idom_feedback-main__button" type="submit" value="Отправить"></div></div></fieldset><div class="idompk-iagree">Нажимая кнопку «Отправить», я даю согласие на обработку моих персональных данных, в соответствии с Федеральным законом №152-ФЗ «О персональных данных».</div></form></div>';
    formStr = formStr.replace('$project_id', $('.idom_item-page_top-info__number span').html());
    $("body").append(formStr);*/
    $(".idom_phone").mask("+7 (999) 999-9999");
    // $("#idom_feedback-main__name").val($(this).data("name"));
    // $("#idom_feedback-main__id").val($(this).data("id"));
    // $("#idom_feedback-main__url").val($(this).data("url"));
    // $("#idom_feedback-main__image").val($(this).data("image"));
  });

  $(document).on('submit',"#idom_js_form_ask-project-change",function(e) {
    e.preventDefault();
    var formData = new FormData($('#idom_js_form_ask-project-change')[0]);
    $.ajax({
      url: "/site/form_ask_project",
      cache: false,
      async: false,
      type: "POST",
      dataType: 'json',
      processData: false,
      contentType: false,
      data: formData,
      beforeSend: function () {
        $(".idom_overlay").fadeIn();
      },
      error: function (status) {
        console.log(status);
      },
      success: function (data, status) {
        $(".idom_callback_form-ask-project-change").fadeOut();
        $(".idom_feedback-main__input, #idom_js_form_ask-project textarea").val("");
        $("body").append('<div class="idom_thanks-popup"><i class="idom_icon idom_icon-close idom_icon-close-thanks"></i><span class="idom_thanks-popup__title">Спасибо!</span><p>Мы свяжемся с Вами в ближайшее время.</p></div>');
      }
    });
  });

  $(document).on('submit',"#idom_js_form_buy_project",function(e) {
    e.preventDefault();
    var formData = new FormData($('#idom_js_form_buy_project')[0]);
    var $active = $('.idompk-form-addons__item.is-active');
    var dops = [];
    if($active.length) {
      $active.each(function(){
        dops.push($(this).find('.idompk-form-addons__item-title').text());
      });
      dops = dops.join(';');
    } else dops = '';

    formData.append('dops', dops);

    $.ajax({
      url: "/site/form_buy_project",
      cache: false,
      async: false,
      type: "POST",
      dataType: 'json',
      processData: false,
      contentType: false,
      data: formData,
      beforeSend: function () {
        $(".idom_overlay").fadeIn();
      },
      error: function (status) {
        console.log(status);
      },
      success: function (data, status) {
        $("#idom_js_form_buy_project textarea, #idom_js_form_buy_project input[type=text]").val("");
        $(".idom_callback_form-buy-project").remove();
        $("body").append('<div class="idom_thanks-popup"><i class="idom_icon idom_icon-close idom_icon-close-thanks"></i><span class="idom_thanks-popup__title">Спасибо!</span><p>Мы свяжемся с Вами в ближайшее время.</p></div>');
      }
    });
  });


  $(document).on('click', '.jsToCalc', function(e){
    e.preventDefault();
    $([document.documentElement, document.body]).animate({
      scrollTop: $(".idom_builds_calc__item-title").eq(0).offset().top - 170
    }, 2000);
  });

  $(document).on('click', '.idom_header__phone-block__callback-link-2', function(e){
    e.preventDefault();
    $(".idom_overlay").fadeIn();
    $(".idom_callback_form-d").remove();
    $("body").append('<div class="idompk-modal-form idompk-modal-form--large idom_callback_form idom_callback_form-1 idom_callback_form-d"><i class="idom_icon idom_icon-close  idom_icon-close-thanks"></i><span class="idom_feedback-main__title">Опишите как можно подробнее вашу задачу!</span><form class="idom_js_form_main_1" method="post" id="idom_js_form_main_1" enctype="multipart/form-data"><fieldset><div class="row idom_feedback-main__row"><div class="col-md-4 idom_feedback-main__item"><input class="idom_feedback-main__input" name="idom_js_form_main_1__name" type="text" placeholder="Ваше имя" required></div><div class="col-md-4 idom_feedback-main__item"><input class="idom_feedback-main__input idom_phone" name="idom_js_form_main_1__phone" type="text" placeholder="Телефон" required></div><div class="col-md-4 idom_feedback-main__item"><div class="file"><input type="file" name="idom_js_form_main_1__file[]" data-placeholder="Прикрепите файл" multiple><span class="file_text">Прикрепите файл</span><div class="file_icon"><i class="idom_icon-2 idom_icon-2-download"></i></div></div></div></div><div class="row idom_feedback-main__row"><div class="col-md-12 idom_feedback-main__item"><textarea class="idom_feedback-main__textarea" name="idom_js_form_main_1__message" placeholder="Ваше сообщение"></textarea></div></div><div class="row"><div class="col-md-12 idom_feedback-main__item idom_feedback-main__item--submit"><div id="idom_js_form_main_1_captcha"></div><input type="hidden" name="idom_js_form_main_1__form" value="Форма: Опишите как можно подробнее вашу задачу!"><input class="idom_feedback-main__button" type="submit" value="Отправить"></div></div></fieldset><div class="idompk-iagree">Нажимая кнопку «Отправить», я даю согласие на обработку моих персональных данных, в соответствии с Федеральным законом №152-ФЗ «О персональных данных».</div></form></div>');
    $(".idom_phone").mask("+7 (999) 999-9999");
    $('input[type="file"]').each(function() {
      if ($(this).closest('div.file').length == 0) {
        $(this).wrap('<div class="file"></div>');
        $(this).after('<span class="file_text">' + $(this).attr('data-placeholder') + '</span><div class="file_icon"></div>');
      }
    });
    $('input[type="file"]').on('change', function() {
      if ( $(this).val().lastIndexOf('\\')){
        var i = $(this).val().lastIndexOf('\\')+1;
      }
      else{
        var i = $(this).val().lastIndexOf('/')+1;
      }
      var filename = $(this).val().slice(i);

      var uploaded = $(this).closest('.file').find('.file_text');
      uploaded.text(filename);
      uploaded.addClass('added');
      uploaded.attr('data-wdcontain', 1);
    });
  });


  $(document).on('click', '.idom_icon-close-thanks', function(e){
    e.preventDefault();
    $(this).parent().fadeOut();
    $(".idom_overlay").fadeOut();
    $(".idom_thanks-popup").remove();

    if ($('.fotorama__video').length) {
      $(".fotorama__video iframe").attr("src", ' ');
    }
  });

  $(document).on('click', '.idom_overlay', function(e){
    e.preventDefault();
    $(".idom_overlay").fadeOut();
    $('.idom_callback_form').remove();
    $(".idom_thanks-popup").remove();
    $(".idom_callback_formM").fadeOut();

    if ($('.fotorama__video').length) {
      $(".fotorama__video iframe").attr("src", ' ');
    }
  });


  $(document).on('click', '.idom_icon-close-order', function(e){
    e.preventDefault();
    $(this).parent().fadeOut();
    $(".idom_overlay").fadeOut();
    $(".idom_order-popup").remove();
    window.location.href = "/";
  });

  $(document).on('click', '.idom_icon-close-preorder', function(e){
    e.preventDefault();
    $(this).parent().fadeOut();
    $(".idom_overlay").fadeOut();
    $(".idom_order-popup").remove();
  });

  $(document).on("click", ".add_to_cart_n", function(event) {
    event.preventDefault();
    var ts = $(this);
    $(".idom_overlay").fadeIn();
    $(".idom_thanks-popup").remove();
    var formStr = '<div class="idompk-modal-form idompk-modal-form--buy idompk-modal-form--large idompk-modal-form idompk-modal-form--large idom_callback_form idom_callback_form-1 idom_callback_form-buy-project"><i class="idom_icon idom_icon-close idom_icon-close-thanks"></i><span class="idom_feedback-main__title">Покупка проекта $project_id</span><form class="idom_js_form_buy_project" method="post" id="idom_js_form_buy_project" enctype="multipart/form-data"><input name="project_id" type="hidden" value="$project_id"/> <fieldset><div class="idompk-form-addons row"><div class="col-12 col-md-6"><a href="#" class="idompk-form-addons__item is-supper-active" data-price="0"><span class="idompk-form-addons__item-title">АС документация</span><span class="idompk-form-addons__item-text">Архитектурный и конструктивный разделы</span></a></div><div class="col-12 col-md-6"><a href="#" class="idompk-form-addons__item" data-price="4000"><span class="idompk-form-addons__item-title">Посадка дома на участок</span><span class="idompk-form-addons__item-text">Потребуется схема вашего участка</span></a></div><div class="col-12 col-md-6"><a href="#" class="idompk-form-addons__item" data-price="2000"><span class="idompk-form-addons__item-title">Копия проекта</span><span class="idompk-form-addons__item-text">Печатная копия формата А3</span></a></div><div class="col-12 col-md-6"><a href="#" class="idompk-form-addons__item" data-price="0" data-free="1"><span class="idompk-form-addons__item-title">Зеркальное исполнение</span><span class="idompk-form-addons__item-text">Отражение дома по горизонтали</span></a></div></div><div class="row idom_feedback-main__row"><div class="col-12 idompk-form-addons__content"><div class="idompk-form-addons__content-title">Инженерные сети</div><div class="idompk-form-addons__content-text">В типовом исполнении инженерные сети есть не для всех проектов. Наличие и стоимость сетей уточняйте у наших менеджеров.</div></div></div><div class="row idom_feedback-main__row"><div class="col-12"><div class="idompk-form-addons__price"><div class="idompk-form-addons__price-title">Итоговая стоимость проекта:</div><div class="idompk-form-addons__price-num"><span>$project_price</span> <br/><div class="zkfree_info" style="display: none;font-size: 13px;">Зеркальное исполнение бесплатно</div> </div></div></div></div><div class="row idom_feedback-main__row"><div class="col-12 idom_feedback-main__row-title">Информация о вас</div><div class="col-md-4 idom_feedback-main__item"><input class="idom_feedback-main__input" name="idom_js_form_main_1__name" type="text" placeholder="Ваше имя" required /></div><div class="col-md-4 idom_feedback-main__item"><input class="idom_feedback-main__input idom_phone" name="idom_js_form_main_1__phone" type="text" placeholder="Телефон" required /></div><div class="col-md-4 idom_feedback-main__item"><input class="idom_feedback-main__input" name="idom_js_form_main_1__mail" type="text" placeholder="E-mail" /></div></div><div class="row idom_feedback-main__row"><div class="col-12 idom_feedback-main__item"><input class="idom_feedback-main__input" name="idom_js_form_main_1__address" type="text" placeholder="Адрес доставки" required /></div></div><div class="row idom_feedback-main__row"><div class="col-md-12 idom_feedback-main__item"><textarea class="idom_feedback-main__textarea" name="idom_js_form_main_1__message" placeholder="Ваше сообщение"></textarea></div></div><div class="row idompk-form-addons__submit"><div class="col-12 col-md-auto idompk-form-addons__for-jur">Для юридических лиц и ИП</div><div class="col-12 col-md-auto"><div class="file"><input type="file" name="idom_js_form_main_1__file[]" data-placeholder="Прикрепите реквизиты" multiple="" /><span class="file_text">Прикрепите реквизиты</span><div class="file_icon"><i class="idom_icon-2 idom_icon-2-download"></i></div></div></div><div class="col-12 col-md-auto idom_feedback-main__item idom_feedback-main__item--submit"><div id="idom_js_form_main_1_captcha"></div><input type="hidden" name="idom_js_form_main_1__form" value="Форма: Покупка проекта" /><input type="hidden" id="idom_feedback-main__name" name="name" value="" /><input type="hidden" id="idom_feedback-main__id" name="ids" value="" /><input type="hidden" id="idom_feedback-main__url" name="url" value="" required /><input type="hidden" id="idom_feedback-main__image" name="image" value="" /><input class="idom_feedback-main__button" type="submit" value="Отправить" /></div></div></fieldset><div class="idompk-iagree">Нажимая кнопку «Отправить», я даю согласие на обработку моих персональных данных, в соответствии с Федеральным законом №152-ФЗ «О персональных данных».</div></form></div>';
    formStr = formStr.replace(/\$project_id/g, ts.data('num'));
    let prc = $('.idom_price span').html();
    if(!prc)
      prc = ts.data('price');

    formStr = formStr.replace('$project_price', prc);
    $("body").append(formStr);
  });


  if ($('#idom_top-find-input').length) {
    $("#idom_top-find-input").autocomplete({
      minLength: 2,
      appendTo: "#idom_top-find-result",
      search: function( event, ui ) {
        $('.idom_top-find__btn-reset').show();
        $('#idom_top-find-result').addClass('idom_top-find-result--active');
      },
      source: function (request, response) {
        $.ajax({
          url: "/site/finder",
          dataType: "json",
          data: {
            term: request.term
          },
          success: function (data) {
            console.log(data.length)
              if (data.length) {
                $('#idom_top-find-result').addClass('idom_top-find-result--active');
                $('#idom_top-find-empty').html('');
                $('#idom_top-find-empty').hide();
                response(data);
              } else {
                $('#idom_top-find-result').removeClass('idom_top-find-result--active');
                $('#idom_top-find-empty').show();
                $('#idom_top-find-empty').html('<b>Вы уверены?</b><p>У нас нет проекта с таким номером. Попробуйте ввести только числа.</p>')
              }
          }
        });
      },
      close: function( event, ui ) {
        $('#idom_top-find-input').val('');
        $('#idom_top-find-result').removeClass('idom_top-find-result--active');
      }
    }).autocomplete("instance")._renderItem = function (ul, item) {
      return $("<li>")
        .append("<a href='" + item.url + "'><span class='idom_image'><img src='" + item.img + "' alt='" + item.label + "' alt='" + item.label + "'/></span><span class='idom_title'>" + item.label + "</span></a>")
        .appendTo(ul);
    };

    const target = document.querySelector('#idom_top-find-input')

    document.addEventListener('click', (event) => {
      const withinBoundaries = event.composedPath().includes(target)

      if (withinBoundaries) {
        target.innerText = 'Click happened inside element'
      } else {
        $('#idom_top-find-input').val('');
        $('#idom_top-find-result').removeClass('idom_top-find-result--active');
        $('#idom_top-find-empty').html('');
        $('#idom_top-find-empty').hide();
      }
    })
  }
  if ($('#idom_top-find-input2').length) {
    $("#idom_top-find-input2").autocomplete({
      minLength: 2,
      appendTo: "#idom_top-find-result2",
      search: function( event, ui ) {
        $('.idom_top-find__btn-reset2').show();
        $('#idom_top-find-result2').addClass('idom_top-find-result--active2');
      },
      source: function (request, response) {
        $.ajax({
          url: "/site/finder",
          dataType: "json",
          data: {
            term: request.term
          },
          success: function (data) {
            console.log(data.length)
              if (data.length) {
                $('#idom_top-find-result2').addClass('idom_top-find-result--active2');
                $('#idom_top-find-empty2').html('');
                $('#idom_top-find-empty2').hide();
                response(data);
              } else {
                $('#idom_top-find-result2').removeClass('idom_top-find-result--active2');
                $('#idom_top-find-empty2').show();
                $('#idom_top-find-empty2').html('<b>Вы уверены?</b><p>У нас нет проекта с таким номером. Попробуйте ввести только числа.</p>')
              }
          }
        });
      },
      close: function( event, ui ) {
        $('#idom_top-find-input2').val('');
        $('#idom_top-find-result2').removeClass('idom_top-find-result--active2');
      }
    }).autocomplete("instance")._renderItem = function (ul, item) {
      return $("<li>")
        .append("<a href='" + item.url + "'><span class='idom_image'><img src='" + item.img + "' alt='" + item.label + "' alt='" + item.label + "'/></span><span class='idom_title'>" + item.label + "</span></a>")
        .appendTo(ul);
    };

    const target = document.querySelector('#idom_top-find-input2')

    document.addEventListener('click', (event) => {
      const withinBoundaries = event.composedPath().includes(target)

      if (withinBoundaries) {
        target.innerText = 'Click happened inside element'
      } else {
        $('#idom_top-find-input2').val('');
        $('#idom_top-find-result2').removeClass('idom_top-find-result--active2');
        $('#idom_top-find-empty2').html('');
        $('#idom_top-find-empty2').hide();
      }
    })
  }

  $(document).on("click", ".to-favorite, .compare_add_btn", function(event) {
    event.preventDefault();
    var ts = $(this);
    $.ajax({
      type: "GET",
      async: false,
      dataType: 'json',
      url: "/izbrannoe/set",
      data:  {
        id: ts.data('id')
      },
      success: function(data,status) {
        if(data.status=='unset')
        {
          if ($('.idom_favorite-page').length) {
            ts.parents('.idom_project-item').hide();
          }
          ts.removeClass("active");
          if(ts.hasClass('to-favorite'))
            ts.find('span').html('Избранное');
        }
        else
        {
          ts.addClass("active");
          ts.find('span').html('Удалить');
        }
        $('#count_izb').text(data.cn);
        if(parseFloat($('.idom_header__links-favorits #count_izb').text())<1) {
          $('.idom_header__links-favorits').removeClass('idom_header__links-favorits--active');
        } else {
          $('.idom_header__links-favorits').addClass('idom_header__links-favorits--active');
        }
      }
    });
  });

  $(document).on("click", ".to-comparison, .comparison_add_btn", function(event) {
    event.preventDefault();
    var ts = $(this);
    $.ajax({
      type: "GET",
      async: false,
      dataType: 'json',
      url: "/comparison/set",
      data:  {
        id: ts.data('id')
      },
      success: function(data,status) {
        if(data.status=='unset')
        {
          if ($('.idom_comparison__wrapper').length) {
            ts.parents('.idom_comparison__item').hide();
          }
          ts.removeClass("active");
          if(ts.hasClass('to-comparison'))
            ts.find('span').html('Сравнение');
        }
        else
        {
          ts.addClass("active");
            ts.find('span').html('Удалить');
        }
        $('#count_comparison').text(data.cn);
        if(parseFloat($('.idom_header__links-compare #count_comparison').text())<1) {
          $('.idom_header__links-compare').removeClass('idom_header__links-compare--active');
        } else {
          $('.idom_header__links-compare').addClass('idom_header__links-compare--active');
        }
      }
    });
  });

  if ($('.fotorama-one').length) {
    $('.fotorama-one')
      .on('fotorama:fullscreenenter fotorama:fullscreenexit', function (e, fotorama) {
        if (e.type === 'fotorama:fullscreenenter') {
          fotorama.setOptions({
            fit: 'contain'
          });
        } else {
          fotorama.setOptions({
            fit: 'contain'
          });
        }
      })
      .fotorama({
        nav:"thumbs",
        allowfullscreen:"native",
        fit:"contain",
        width:"100%",
        ratio:1.58,
        thumbwidth:130,
        thumbheight:80,
        thumbmargin:8,
        thumbborderwidth:0
      });
  };

  if ($('.fotorama-in').length) {
    $('.fotorama-in')
      .on('fotorama:fullscreenenter fotorama:fullscreenexit', function (e, fotorama) {
        if (e.type === 'fotorama:fullscreenenter') {
          fotorama.setOptions({
            fit: 'contain'
          });
        } else {
          fotorama.setOptions({
            fit: 'cover'
          });
        }
      })
      .fotorama({
        nav:"thumbs",
				allowfullscreen:"native",
				fit:"cover",
				width:"100%",
				ratio:1.58,
				thumbwidth:130,
				thumbheight:80,
				thumbmargin:8,
				thumbborderwidth:0
			});
  };

  if ($('.fotorama-item').length) {
    $('.fotorama-item')
      .on('fotorama:fullscreenenter fotorama:fullscreenexit', function (e, fotorama) {
        if (e.type === 'fotorama:fullscreenenter') {
          fotorama.setOptions({
            fit: 'contain'
          });
        } else {
          fotorama.setOptions({
            fit: 'cover'
          });
        }
      })
      .fotorama({
        allowfullscreen:"native",
        fit:"cover",
        minwidth:"100%",
        height:260
      });
  };




  $(".cal_box_m_1 input").on("change click", function(){
    var fp = $(".cal_box_f input:checked").attr("data-f_value");
    $("#projects-price_vznos b").text(new Intl.NumberFormat('de-DE').format(fp));

    var allsum = 0;

    $(".cal_box_m_1 input").each(function(){
      if ($(this).is(":checked") ) {
        allsum += parseInt($(this).val());
      } else {

      }
    });

    if ($("#checkbox_1").is(":checked")) {
      $(".cal_box").eq(1).addClass("cal_box_hide");
      $(".cal_box").eq(1).find("input").prop("checked",false);
    } else {
      $(".cal_box").eq(1).removeClass("cal_box_hide");
      allsum = 0;
      $(".cal_box_m_1 input").each(function(){
        if ($(this).is(":checked") ) {
          allsum += parseInt($(this).val());
        } else {

        }
      });
    }

    $("#projects-prcie_all b, #full_pp b").text(new Intl.NumberFormat('de-DE').format(allsum));
  });

  if($('.idom_builds_calc').length) {

    var allsum = 0;
    $(".idom_builds_calc .tab-content .active .jsPriceInput").each(function(){
        allsum += parseInt($(this).val());
    });
    $(".idom_full-price").text(new Intl.NumberFormat('de-DE').format(allsum));

    $(".idom_builds_calc .tab-pane").each(function(){
      var allsubsum = 0;
      $(this).find(".jsPriceInput").each(function(){
        allsubsum += parseInt($(this).val());
      });
      $(this).find(".idom_builds_calc__item-prices-all .b2").text(new Intl.NumberFormat('de-DE').format(allsubsum));
    });

    $(document).on('click', '.idom_builds_calc .nav-link', function(){

      var allsum = 0;
      $(".idom_builds_calc .tab-content .active .jsPriceInput").each(function(){
        allsum += parseInt($(this).val());
      });
      $(".idom_full-price").text(new Intl.NumberFormat('de-DE').format(allsum));

      $.fn.creditFunction();

    });
  }

  $(document).on("click",".js-rolling-open",function(e){
    e.preventDefault();
    $(this).hide();
    $(".js-rolling-close").show();
    $(".js-rolling").slideDown();
  });
  $(document).on("click",".js-rolling-close",function(e){
    e.preventDefault();
    $(this).hide();
    $(".js-rolling-open").show();
    $(".js-rolling").slideUp();
  });

  $(document).on("click", "#js-idom_miracle, .js-idom_line__z", function(e){
    e.preventDefault();
    if ($('#idom_line__z').prop('checked')) {
      $('html').removeClass('idom_image-rotate');
      $('#js-idom_miracle').html('<i class="idom_icon idom_icon-miracle"></i>').attr('title','Зеркальное исполнение');
      $('#idom_line__z').prop('checked',false);
    } else {
      $('html').addClass('idom_image-rotate');
      $('#js-idom_miracle').html('<i class="idom_icon idom_icon-miracle"></i>').attr('title','Оригинальное исполнение');
      $('#idom_line__z').prop('checked',true);
    }
  });
  if ($('#idom_line__z').length) {
    if (!$('#idom_line__z').prop('checked')) {
      $('html').removeClass('idom_image-rotate');
      $('#js-idom_miracle').html('<i class="idom_icon idom_icon-miracle"></i>').attr('title','Зеркальное исполнение');
    } else {
      $('html').addClass('idom_image-rotate');
      $('#js-idom_miracle').html('<i class="idom_icon idom_icon-miracle"></i>').attr('title','Оригинальное исполнение');
    }
  }


	
	$(".type_project_link").on("click touchstart", function(){
		$("#type_project_title").val($(this).parents(".col").find(".green_rounded_element_name").text());
		$("#type_project_price").val($(this).parents(".col").find(".green_round_area span").text()+" руб/м.кв.");
	});
	
	$(".free_call_blocks_links").on("click touchstart", function(){
		$("#free_call_blocks_title").val($(this).parents(".wrapper").find("h1").text());
	});
	
});




//фильтры
$(function() {
	$('.filter_mobile_btn').click(function() {
		$('.filters_list_container').addClass('opened');
	});
	$('.filters_list_container .close, .filters_element-fixed a.green_button').click(function(e) {
		e.preventDefault();
		$('.filters_list_container').removeClass('opened');
	});
	
	$('body').mouseup(function (e) {
		var block = $('.filters_list_container');
		
		if (e.target!=block[0]&&!block.has(e.target).length) {
			block.removeClass('opened');
		}
	});
});

//автодобавление id и for для радиокнопок и чекбоксов
$(function() {
  if (!$(".house_detail_other_facts").length) {
    for (var i = 0; i < $('.checkbox').length; i++) {
      if (!$('.checkbox').eq(i).find('input[type="checkbox"]').is('[id]')) {
        $('.checkbox').eq(i).find('input[type="checkbox"]').attr('id', 'checkbox_' + i);
        $('.checkbox').eq(i).find('label').attr('for', 'checkbox_' + i);
      }
    }
    for (var j = 0; j < $('.radio').length; j++) {
      if (!$('.radio').eq(j).find('input[type="radio"]').is('[id]')) {
        $('.radio').eq(j).find('input[type="radio"]').attr('id', 'radio_' + j);
        $('.radio').eq(j).find('label').attr('for', 'radio_' + j);
      }
    }
  }
});

//стилизация input type=file
$(function() {
	$('input[type="file"]').each(function() {
		if ($(this).closest('div.file').length == 0) {
			$(this).wrap('<div class="file"></div>');
			$(this).after('<span class="file_text">' + $(this).attr('data-placeholder') + '</span><div class="file_icon"></div>');
		}
	});
	$(document).on('change', 'input[type="file"]',  function() {
		if ( $(this).val().lastIndexOf('\\')){
			var i = $(this).val().lastIndexOf('\\')+1;
		}
		else{
			var i = $(this).val().lastIndexOf('/')+1;
		}						
		var filename = $(this).val().slice(i);	
		
		var uploaded = $(this).closest('.file').find('.file_text');
		// console.log(uploaded);
		uploaded.text(filename);
		uploaded.addClass('added');
		uploaded.attr('data-wdcontain', 1);
	});
});

//меню готовых проектов
$(function() {
	if ($('html.mobile').length == 0 && $('html.tablet').length == 0) {
		$('.project_menu_container, .gold_btn.main_menu_btn').mouseenter(function() {
			var height = $('.project_menu_container .container').outerHeight();
			
			$('.project_menu_container').addClass('opened');
			$('.project_menu_container').css('max-height', height + 100);
		});
		
		$('.project_menu_container, .gold_btn.main_menu_btn').mouseleave(function() {
			$('.project_menu_container').removeClass('opened');
			$('.project_menu_container').css('max-height', 0);
		});
	}
});

//гамбургер
$(function() {
	$('.hamburger').click(function() {
		$('.outer').addClass('opened');
		$('.main_menu_container').addClass('opened');
	});
	$('.main_menu_container .close').click(function() {
		$('.outer').removeClass('opened');
		$('.main_menu_container').removeClass('opened');
	});
	$('body').mouseup(function (e) {
		var block = $('.main_menu_container');
		
		if (e.target!=block[0]&&!block.has(e.target).length) {
			block.removeClass('opened');
			$('.outer').removeClass('opened');
		}
	});
});









$(function() {
	$('.main_menu_dropdown').each(function() {
		if ($(this).find('.toggle_btn').length == 0) {
			$(this).find(".submenu").before('<span class="toggle_btn"></span>')
		}
	});
	
	$('.toggle_btn').click(function() {
		
		if ($(this).hasClass('active')) {
			$('.toggle_btn').removeClass('active')
			$('.main_menu_dropdown .submenu').css('display', 'none');
			
			$(this).removeClass('active');
			$(this).siblings('.submenu').css('display', 'none');
		} else {
			$('.toggle_btn').removeClass('active')
			$('.main_menu_dropdown .submenu').css('display', 'none');
			
			$(this).addClass('active');
			$(this).siblings('.submenu').css('display', 'inline-block');
		}
	});
});

//скрипт-пример реализации открытия и закрытия попапа с успешной отправкой
$('#test_success_btn, #test_success2_btn').click(function() {
	$('.modal').modal('hide');
	
	setTimeout(function() {
		$('#modal_success').modal('show');
		setTimeout(function() {
			$('#modal_success').modal('hide');
		}, 3000);
	}, 600);
});
$('#test_order_success_btn').click(function() {
	$('.modal').modal('hide');
	
	$('#modal_order_success').modal('show');
});

//spinner
$(function() {
    var action;
    $(".data-dwn, .data-up").click(function () {
        btn = $(this);
        input = btn.closest('.number-spinner').find('input');
        btn.closest('.number-spinner').find('button').prop("disabled", false);

    	if (btn.attr('data-dir') == 'up') {
			if ( input.attr('data-max') == undefined || parseInt(input.val()) < parseInt(input.attr('data-max')) ) {
				input.val(parseInt(input.val())+1);
			}
    	} else {
			if ( input.attr('data-min') == undefined || parseInt(input.val()) > parseInt(input.attr('data-min')) ) {
				input.val(parseInt(input.val())-1);
			}
    	}
		
		btn.closest('.number-spinner').find('input').trigger('click');
    });
});

//купить проект
$(function() {
	var summ = function() {
		var complectation = $('.idom_order-line__price-as').val(),
			passport = $('.idom_order-line__price-ps').val(),
      p_attach = $('.idom_order-line__price-uchastok').val(),
			copy = $('.idom_order-line__price-copy').val(),
			copy_number = $('.project_copy_number').val(),
			mkad = $('.delivery_mkad .price_element span').text();

		complectation = complectation.replace(/[^0-9]/g, "");
		complectation = parseInt(complectation, 10);

    passport = passport.replace(/[^0-9]/g, "");
    passport = parseInt(passport, 10);

    p_attach = p_attach.replace(/[^0-9]/g, "");
    p_attach = parseInt(p_attach, 10);

    // console.log('cop0-'+copy);
		copy = copy.replace(/[^0-9]/g, "");
    // console.log('cop1-'+copy);
		copy = parseInt(copy, 10);
    // console.log('cop2-'+copy);
		copy = copy * copy_number;
		// console.log('cop3-'+copy);

		mkad = mkad.replace(/[^0-9]/g, "");
		mkad = parseInt(mkad, 10);

		var summ = complectation;

		if ($('#project_passport').is(':checked')) {
			summ = summ + passport;
		}
    if ($('#project_attach').length) {
      if ($('#project_attach').is(':checked')) {
        summ = summ + p_attach;
      }
    }

		if ($('#project_copy').is(':checked')) {
			summ = summ + copy;
		}
		if ($('#project_courier_inmkad').is(':checked')) {
			summ = summ + mkad;
		}



		function nuberDots(summ){
			str = summ+'';

			for(i=0; i<10;i++)str = str.replace(/(\d)(\d\d\d)(\.|\,|$)/, "$1.$2$3");
			return str.replace(/^(.*)\.(\d)$/, "$1\.$20");
		}

		$('.final_price').text(nuberDots(summ));


    if ($("#idom_js_form_order").length) {
      var allsum = 0;
      $(".idom_order-box").each(function(){
        var summa1 = 0;
        $(this).find(".idom_order-line").each(function(){
          if ($(this).find("input").is(':checked')) {
            summa1 += parseFloat($(this).find(".idom_order-line__price").val());
            // console.log(summa1);
            // console.log("++++++++++++++++++++++++++++++++++");
          }
        });

        main_price = parseFloat($(this).find('.idom_order-line__price-as').val());

        summa1 = summa1 + main_price;

        if ($(this).find(".project_copy").is(':checked')) {
          copy = $(this).find('.project_copy').parents(".row").find('.idom_order-line__price').val();
          // console.log(copy);
          copy_number = $(this).find('.project_copy_number').val();
          // console.log(copy_number);
          //copy = copy.replace('.', '');
          //copy = parseFloat(copy);
          copy = parseFloat(copy) * parseFloat(copy_number);
          summa1 = summa1 + copy;
          // console.log(copy);
        }

        // console.log('Пре сумма-'+summa1);


        $(this).find(".idom_summa-item").text(nuberDots(summa1));
        $(this).find('.idom_summa-item__input').val(summa1);
        // console.log("---------------------------------");

        allsum += parseInt($(this).find(".idom_summa-item__input").val());
         // console.log('Вся сумма-'+allsum);
      });

      $('.final_price').text(nuberDots(allsum));
      $('.final_price_str').val(nuberDots(allsum));
    }
	};
	
	$('#idom_js_form_order input, .idom_order-item__info-line--click').bind("change keyup input click", function() {
		if ($(this).attr('class') == 'project_copy') {
			if ($(this).prop('checked') == true) {
				$(this).parents(".row").find('.copy_number_line').removeClass('hdn');
        if ($(this).parents(".row").find('.project_copy_number').val() == 0) {
          $(this).parents(".row").find('.project_copy_number').val(1);
        }
			} else {
        $(this).parents(".row").find('.copy_number_line').addClass('hdn');
        if ($(this).parents(".row").find('.project_copy_number').val() == 1) {
          $(this).parents(".row").find('.project_copy_number').val(0);
        }
			}
		}
		
		if ($(this).attr('name') == 'project_delivery') {
			if ($(this).prop('checked') == true) {
				$('.order_form_delivery_pickup, .order_form_delivery_courier, .address_line').addClass('hdn')
				if ($(this).attr('id') == 'project_pickup') {
					$('.order_form_delivery_pickup').removeClass('hdn');
					$('#project_courier_inmkad').prop('checked', false);
				} else if ($(this).attr('id') == 'project_courier') {
					$('.order_form_delivery_courier').removeClass('hdn');
					$('.address_line').removeClass('hdn');
				}
			}
		}
		
		summ();
	});

	$('#project_courier').trigger('click')

});



$.fn.orderSum = function() {



  return this;
};

$.fn.calcFunction = function() {

  if ($("#packet_sel").val() == '1') {

    var col0 = ($("#sq_val").val() != 0) ? parseInt($("#sq_val").val()) : 0;
    var col1 = 0;
    var col2 = 0;
    var col3 = 0;
    var col4 = 0;
    var summ = 0;

    $(".calc_blue .col01 .checkbox").each(function(){
      col1 += ($(this).find("input").prop("checked")) ? parseInt($(this).find("input").attr("data-price_s")) : 0;
    });

    if ($("#style_sel").val() == 2 || $("#style_sel").val() == 4 || $("#style_sel").val() == 5) {
      col2 = 50;
    } else {
      col2 = 0;
    }

    if ($("#check_9").prop("checked")) {
      if (col0<=150) {
        col3 = 15000;
      }
      if (col0>150 && col0<=250) {
        col3 = 25000;
      }
      if (col0>250) {
        col3 = 35000;
      }
    } else {
      col3 = 0;
    }

    if ($("#check_10").prop("checked")) {
      col4 = 45000;
    } else {
      col4 = 0;
    }

    summ = col0*col1+col0*parseInt(col2)+parseInt(col3)+parseInt(col4);

    $("#ovp_price").text(summ.toLocaleString('de-DE'));
    $("#pr_all_all").val(summ);

  } else {

    var col0 = ($("#sq_val").val() != 0) ? parseInt($("#sq_val").val()) : 0;
    var col1 = 0;
    var col2 = 0;
    var col3 = 0;
    var col4 = 0;
    var summ = 0;

    $(".calc_blue .col01 .checkbox").each(function(){
      col1 += ($(this).find("input").prop("checked")) ? parseInt($(this).find("input").attr("data-price_c")) : 0;
    });

    if ($("#style_sel").val() == 2 || $("#style_sel").val() == 4 || $("#style_sel").val() == 5) {
      col2 = 50;
    } else {
      col2 = 0;
    }

    if ($("#check_9").prop("checked")) {
    	if (col0<=150) {
        col3 = 15000;
			}
      if (col0>150 && col0<=250) {
        col3 = 25000;
      }
      if (col0>250) {
        col3 = 35000;
      }
    } else {
      col3 = 0;
    }

    if ($("#check_10").prop("checked")) {
      col4 = 45000;
    } else {
      col4 = 0;
    }

    summ = col0*col1+col0*parseInt(col2)+parseInt(col3)+parseInt(col4);

    $("#ovp_price").text(summ.toLocaleString('de-DE'));
    $("#pr_all_all").val(summ);
  }

  return this;
};



function isVisible(elem) {

  var coords = elem.getBoundingClientRect();

  var windowHeight = document.documentElement.clientHeight;

  var topVisible = coords.top > 0 && coords.top < windowHeight;
  var bottomVisible = coords.bottom < windowHeight && coords.bottom > 0;

  return topVisible || bottomVisible;
}

function showVisible() {
  var imgs = document.getElementsByTagName('img');
  for (var i = 0; i < imgs.length; i++) {

    var img = imgs[i];

    var realsrc = img.getAttribute('realsrc');
    if (!realsrc) continue;

    if (isVisible(img)) {
      img.src = realsrc;
      img.setAttribute('realsrc', '');
    }
  }

}

window.onscroll = showVisible;
showVisible();



function toggleDropdown (e) {
  const _d = $(e.target).closest('.dropdown'),
    _m = $('.dropdown-menu', _d);
  setTimeout(function(){
    const shouldOpen = e.type !== 'click' && _d.is(':hover');
    _m.toggleClass('show', shouldOpen);
    _d.toggleClass('show', shouldOpen);
    $('[data-toggle="dropdown"]', _d).attr('aria-expanded', shouldOpen);
  }, e.type === 'mouseleave' ? 10 : 0);
}

$('body')
  .on('mouseenter mouseleave','.dropdown',toggleDropdown)
  .on('click', '.dropdown-menu .idom_toggler', toggleDropdown);

/* not needed, prevents page reload for SO example on menu link clicked */
$('.dropdown .idom_toggler').on('click tap', e => e.preventDefault())




jQuery(function() {
  jQuery(window).scroll(function() {
    if (jQuery('.idom_builds_calc').length) {
      var offsetLinks = parseInt(jQuery('.idom_builds_calc').offset().top);
      var offsetLinksHeight = parseInt(jQuery('.idom_builds_calc').outerHeight());
      var hideLength = offsetLinks + offsetLinksHeight+150;

      if (jQuery(this).scrollTop() < hideLength && jQuery(this).scrollTop() > offsetLinks) {
        jQuery('.idom_builds_calc__price-all').addClass('idom_builds_calc__price-all--active');
      } else {
        jQuery('.idom_builds_calc__price-all').removeClass('idom_builds_calc__price-all--active');
      }
    }
  });
});

$( function() {
  if ($( "#jsSliderPriceBuildSlider" ).length) {
    $("#jsSliderPriceBuildSlider").slider({
      range: "min",
      min: 0,
      max: 30000000,
      value: 3656850,
      create: function () {
        $('#jsSliderPriceBuildValue').text($(this).slider("value").toLocaleString('ru-RU'));
        $.fn.creditFunction();
      },
      slide: function (event, ui) {
        $('#jsSliderPriceBuildValue').text(ui.value.toLocaleString('ru-RU'));
        $.fn.creditFunction();
      }
    });
  }
  if ($( "#jsSliderFirst" ).length) {
    $("#jsSliderFirst").slider({
      range: "min",
      min: 25,
      max: 100,
      value: 58.5,
      create: function () {
        $('#jsSliderFirstValue').text($(this).slider("value"));
        $.fn.creditFunction();
      },
      slide: function (event, ui) {
        $('#jsSliderFirstValue').text(ui.value);
        $.fn.creditFunction();
      }
    });
  }
  if ($( "#jsSliderYear" ).length) {
    $("#jsSliderYear").slider({
      range: "min",
      min: 1,
      max: 30,
      value: 15,
      create: function () {
        $('#jsSliderYearValue').text($(this).slider("value"));
        $.fn.creditFunction();
      },
      slide: function (event, ui) {
        $('#jsSliderYearValue').text(ui.value);
        $.fn.creditFunction();
      }
    });
  }
});




$.fn.creditFunction = function() {

  var startPriceText = $('.idom_builds_calc__price-all .idom_builds_calc__price-all-price .idom_full-price').text();

  if (!startPriceText) {
    startPriceText = $('#jsSliderPriceBuildValue').text();
    startPriceText = startPriceText.replace(/\s/g, '');
  }

  // console.log(startPriceText);

  var startPrice = parseInt(startPriceText.replace(/\./g,''));

  if (startPrice > 30000000) { startPrice = 30000000}

  var firstValueProcent = parseInt($('#jsSliderFirstValue').text());
  var firstValue = parseInt(startPrice / 100 * firstValueProcent);

  var year = parseInt($('#jsSliderYearValue').text());
  var yearDef = year*12;
  var procentAll = parseInt($('#jsProcentAll').text());
  var procentAllDef = parseFloat(procentAll/100/12);
  var summCredit = startPrice-firstValue;
  var delta = procentAllDef*(1+procentAllDef)**yearDef/((1+procentAllDef)**yearDef-1);
  var monthPrice = parseInt(delta*summCredit);


  $('#jsSummCredit').text(summCredit.toLocaleString('ru-RU'));
  $('#jsMonthPrice').text(monthPrice.toLocaleString('ru-RU'));
  $('#jsSliderFirstValuePrice').text(firstValue.toLocaleString('ru-RU'));

  $('#js-idom_credit-project').data('allsum',startPrice);
  $('#js-idom_credit-project').data('firstsum',firstValue);
  $('#js-idom_credit-project').data('firstprocent',firstValueProcent);
  $('#js-idom_credit-project').data('year',year);
  $('#js-idom_credit-project').data('yearprocent',procentAll);
  $('#js-idom_credit-project').data('creditsum',summCredit);
  $('#js-idom_credit-project').data('monthsum',monthPrice);


  return this;
};

function setCookies(name,value,days) {
  var expires = "";
  if (days) {
    var date = new Date();
    date.setTime(date.getTime() + (days*24*60*60*1000));
    expires = "; expires=" + date.toUTCString();
  }
  document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}
function getCookies(name) {
  var nameEQ = name + "=";
  var ca = document.cookie.split(';');
  for(var i=0;i < ca.length;i++) {
    var c = ca[i];
    while (c.charAt(0)==' ') c = c.substring(1,c.length);
    if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
  }
  return null;
}

// Доработки декабрь 2020
$(function(){

  $('#showMoreProjectsMain').click(function(e) {
      e.preventDefault();
      let showProjects = Number($('#projectsMainShow').html());
      let totalProjects = Number($('#totalProjectsMain').html());
      let limit = Number($(this).data('limit'));
      let newCount = showProjects + limit;
      if(newCount > totalProjects)
        newCount = totalProjects;

      $('.projectMain:nth-child(-n+'+newCount+')').show();

      $('#projectsMainShow').html(newCount);

      if(newCount == totalProjects)
        $('#showMoreProjectsMainWrapper').hide();
  });

  $(document).on('change',".idompk-projects__search > form.quick-search input",function(e) {

    var formData = new FormData($('.idompk-projects__search > form.quick-search')[0]);
    $.ajax({
      url: "/catalog/proekty-domov/count_filter",
      cache: false,
      async: false,
      type: "POST",
      processData: false,
      contentType: false,
      data: formData,
      error: function (status) {
        console.log(status);
      },
      success: function (data, status) {
        $('.fast_filter_total_projects').html(data);
      }
    });
  });

  // Выбор региона
  var $dropdown = $('.js-iregion-dropdown');
  var $country = $('.js-iregion-options');
  var $cityTitle = $('.js-iregion-city-title');
  var $countryTitle = $('.js-iregion-country-title');
  var $control = $('.js-iregion-item-current');
  var $option = $('.js-iregion-option');
  var $phones = $('.idom_header__time, .idom_footer-adress');

  function showDropdown(current){
    $dropdown.removeClass('is-opened');

    if(current) {
      current.addClass('is-opened');

    }

  }

  function showRegion(current) {
    $country.filter('[data-country]').removeClass('is-active');

    if(current) {
      current.addClass('is-active');

    }

  }

  function setControlActive(current) {
    current.addClass('is-active').siblings().removeClass('is-active');

    var isCountry = current.data().hasOwnProperty('country');

    if(isCountry) {
      $option
        .filter('[data-country="' + current.data('country') + '"]')
          .addClass('is-active')
            .siblings()
            .removeClass('is-active');

      $countryTitle.html(current.html());
      setCookies('country', current.data('country'), 365);
    } else {
      $option
        .filter('[data-city="' + current.data('city') + '"]')
          .addClass('is-active')
            .siblings()
            .removeClass('is-active');


      var country = current.closest($country).data('country');
      $cityTitle.filter('[data-country="' + country + '"]').html(current.html());
      setCookies('city', current.data('city'), 365);
    }

  }

  function showPhones() {
    var active = '[data-country].is-active';

    var country = $option
                    .filter(active)
                    .data('country');

    var city = $country
                    .filter(active)
                    .find($option)
                      .filter('.is-active')
                      .data('city');

    $phones
      .removeClass('is-active')
      .filter('[data-country="' + country + '"]')
        .addClass('is-active')
        .end()
      .filter('[data-city="' + city + '"]')
        .addClass('is-active');

  }

  function handleOption(event){
    event.preventDefault();

    var $this = $(this);
    var region = $this.data('country') ? $this.data('country') : '';


    if(region) {
      showRegion($country.filter('[data-country="' + region + '"]'));

    }

    setControlActive($this);
    showPhones();
    showDropdown(null);

  }

  function handleControl(event) {
    event.preventDefault();

    var $this = $(this);
    var $parent = $this.closest($country);

    showDropdown($parent.find($dropdown));

  }

  function initIregion(){
    $control.on('click', handleControl);
    $option.on('click', handleOption);

    $(document).on('click', function(event){
      if(!$(event.target).closest('.iregion').length) {
        showDropdown(null);

      }

    });

  }

  if($('.iregion').length) {
    initIregion();

  }

  // Слайдер на главной
  $('.js-idompk-hero-slider').slick({
    dots: true,
    autoplay: true,
    autoplaySpeed: 7000,
    infinite: true,
    fade: true,
    speed: 1000,
    slidesToShow: 1,
    slidesToScroll: 1,
    prevArrow: '<button type="button" class="slick-prev"><i class="idom_icon-2 idom_icon-2-chevron-left"></i></button>',
    nextArrow: '<button type="button" class="slick-next"><i class="idom_icon-2 idom_icon-2-chevron-left"></i></button>',
    responsive: [
      {
        breakpoint: 992,
        settings: {
          dots: false,
          slidesToShow: 1,
          slidesToScroll: 1,
          prevArrow: '<button type="button" class="slick-prev"><i class="idom_icon-2 idom_icon-2-arrow-left"></i></button>',
          nextArrow: '<button type="button" class="slick-next"><i class="idom_icon-2 idom_icon-2-arrow-left"></i></button>',
        }
      }
    ]
  });

  // Мобильные телефоны
  $('.idom-mobile-head-icons > a').on('click', function(event){
    event.preventDefault();
    $('.idompk-phones').slideToggle();
  });
  $(document).on('click', function(event){
    if(!$(event.target).closest('.idompk-phones, .idom-mobile-head-icons').length) {
      $('.idompk-phones').slideUp();
    }
  });
  $('.idompk-phones__close').on('click', function(event){
    $('.idompk-phones').slideUp();
  });

  // Теги каталога
  var $tagsParent = $('.idompk-tags');
  var $tagsList =  $tagsParent.find('.list_inline');
  var $tagsMore = $('.idompk-tags-more');
  var $tagsMoreLink = $('.idompk-tags-more__link');

  function showIdompkTagsLink() {
    var height = $tagsParent.height();
    var listHeight = $tagsList.outerHeight();

    if(listHeight > height) {
      $tagsMore.addClass('is-visible');
    } else {
      $tagsMore.removeClass('is-visible');
    }
  }


  var height = $tagsList.height();
  var maxHeight = 0;
  function setMaxHeight(){
    height = $tagsList.height();
    //maxHeight = $tagsParent.height();
    maxHeight = window.matchMedia('(min-width:992px)').matches ? 60 : 52;
  }

  showIdompkTagsLink();
  setMaxHeight();
  $(window).on('resize', function(){
    setMaxHeight();
    showIdompkTagsLink();
  });

  $tagsMoreLink.on('click', function(event){
    event.preventDefault();

    var $this = $(this);

    if($this.hasClass('is-active')) {
      $tagsParent.animate({
        'max-height': maxHeight
      });
    } else {
      $tagsParent.animate({
        'max-height': height
      });
    }

    $this.toggleClass('is-active');
  });

  // Переоформленная выборка сортировки
  var $sortingBox = $('.sorting-box');

  function initSortingBox(){
    $sortingBox.each(function(){
      var $sorting = $(this);
      var $title = $sorting.find('.sorting-box__select-current');
      var $dropdown = $sorting.find('.sorting-box__select-dropdown');
      var $otions = $sorting.find('.sorting-box__item');

      var hideDropdown = function(){
        $dropdown.removeClass('is-opened');
      };

      var showDropdown = function(){
        $dropdown.addClass('is-opened');
      };

      var setTitle = function(){
        $title.html($(this).html());
      };

      var setOptionActive = function(event){
        event.preventDefault();

        $(this)
          .addClass('is-active')
          .siblings()
            .removeClass('is-active');
      };

      $(document).on('click', function(event){
        if(!$(event.target).closest($sorting).length) {
          hideDropdown()
        }
      });

      $title.on('click', showDropdown);
      $otions.on('click', setTitle);
      $otions.on('click', hideDropdown);
      $otions.on('click', setOptionActive);
    });
  }

  if($sortingBox.length) {
    initSortingBox();
  }

  var cutFilter = false;

  function shiftingFilter(){
    if(window.matchMedia('(min-width: 992px)').matches) {
      if(cutFilter) {

        $('.filters_list').appendTo($('.idom_catalog-page__aside'));
        cutFilter = false;

      }
    } else {
      if(!cutFilter) {

        $('.filters_list').appendTo($('.js-mobile-filter-body'));
        cutFilter = true;

      }
    }
  }

  var cutSorting = false;

  function shiftingSorting(){
    if(window.matchMedia('(min-width: 992px)').matches) {
      if(cutSorting) {

        $('.sorting-box__select-dropdown').appendTo($('.sorting-box__select'));
        cutSorting = false;

      }
    } else {
      if(!cutSorting) {

        $('.sorting-box__select-dropdown').appendTo($('.js-mobile-sorting-body'));
        cutSorting = true;

      }
    }
  }

  setTimeout(shiftingFilter, 500);
  setTimeout(shiftingSorting, 500);
  $(window).on('resize', shiftingFilter);
  $(window).on('resize', shiftingSorting);

  function closetMobileFilter(){
    $('.filters_list__body').scrollTop(0);
    $('.js-mobile-filter').removeClass('is-opened');
    $('html, body').css('overflow', 'auto');
  }

  function openMobileFilter(){
    $('.js-mobile-filter').addClass('is-opened');
    $('html, body').animate({
      scrollTop: 0
    }, 5, function(){
      $('html, body').css('overflow', 'hidden');
    });
  }

  function closetMobileSorting(){
    $('.filters_list__body').scrollTop(0);
    $('.js-mobile-sorting').removeClass('is-opened');
    $('html, body').css('overflow', 'auto');
  }

  function openMobileSorting(){
    $('.js-mobile-sorting').addClass('is-opened');
    $('html, body').animate({
      scrollTop: 0
    }, 5, function(){
      $('html, body').css('overflow', 'hidden');
    });
  }

  $('.js-mobile-filter-close').on('click', closetMobileFilter);
  $('.js-mobile-filter-open').on('click', openMobileFilter);
  $('.js-mobile-sorting-close').on('click', closetMobileSorting);
  $('.js-mobile-sorting-open').on('click', openMobileSorting);


  var mobileFilterControls = '.idompk-mobile-filter :checkbox, .idompk-mobile-filter select, .idompk-mobile-filter :text'
  $(document).on('change', mobileFilterControls, function(){
    $('.filters_list__button--go').removeAttr('disabled');
  });

  var mobileSortingControls = '.idompk-mobile-filter .sorting-box__select-dropdown a';
  $(document).on('click', mobileSortingControls, function(){
    closetMobileSorting();
  });

  // Конаткты. Прокрутка к филиалам
  $('.idompk-filials__tag').on('click', function(event){
    event.preventDefault();

    var indx = $(this).data('index');

    $('html, body').animate({
      scrollTop: $('.idompk-filials__item[data-index="' + indx + '"]').offset().top
    })
  });

  // Зеркальное отображение планов 
  $('.idompk-plan-reverse__link').on('click', function(event){
    event.preventDefault();

    $(this).toggleClass('is-active');
    $('.idompk-plans').toggleClass('is-mirrored');
  });

  // Прокрутка к комментариям
  $('.idompk-plan-help__note-link').on('click', function(event){
    event.preventDefault();

    $('html, body').animate({
      scrollTop: $('.idompk-plan-commets').offset().top
    }, 2000);
  });

  $(document).on('change', '.idompk-modal-form select', function(){
    $(this).next().removeClass('is-visible');
  });

  function numberWithCommas(x) {
      return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
  }

  $(document).on('click', '.idompk-form-addons__item', function(event){
    event.preventDefault();

    $(this).toggleClass('is-active');

    var price = Number($('.idom_price span').html().replace('.', ''));


    var $active = $('.idompk-form-addons__item.is-active');
    var newPrice = 0;
  var zIsActive = 0;
    if($active.length) {
      $active.each(function(){
        if($(this).data('free'))
          zIsActive = 1;
        newPrice += Number($(this).data('price'));
      });
    }

    price = price + newPrice;

    $('.idompk-form-addons__price-num span').html(numberWithCommas(price));

    if(zIsActive)
      $('.zkfree_info').show();
    else
      $('.zkfree_info').hide();

  });

  // Калькулятор на странице калькулятора
  var $calcItem = $('.idompk-calc__item').not('.idompk-calc__item--supper');
  var $calcSupperItem = $('.idompk-calc__item--supper');

  $calcSupperItem.on('click', function(event){
    event.preventDefault();
    $(this).toggleClass('is-active');
  });

  $calcItem.on('click', function(event){
    event.preventDefault();
    $calcItem.removeClass('is-active');
    $(this).addClass('is-active');
  });


  var $calcInput = $('.idompk-calc__range-input-control');
  var $calcInput2 = $('.idompk-calc_cokol__range-input-control');
  var calcSlider = null;

  if ($('.idompk-calc__range-control').length) {
    calcSlider = $('.idompk-calc__range-control').slider({
      range: "min",
      min: 50,
      max: 600,
      value: 150,
      create: function () {
        var $this = $(this);
        $calcInput.val($this.slider("value").toLocaleString('ru-RU'));

        $calcInput.on('change', function(){
          $this.slider('value', $(this).val());
        });
      },
      slide: function (event, ui) {
        $calcInput.val(ui.value.toLocaleString('ru-RU'));
        $('#calcSquare').trigger('keyup');
      }
    });
  }

  if ($('.idompk-calc_cokol__range-control').length) {
    let calcSlider2 = $('.idompk-calc_cokol__range-control').slider({
      range: "min",
      min: 50,
      max: 600,
      value: 150,
      create: function () {
        var $this = $(this);
        $calcInput2.val($this.slider("value").toLocaleString('ru-RU'));

        $calcInput2.on('change', function(){
          $this.slider('value', $(this).val());
        });
      },
      slide: function (event, ui) {
        $calcInput2.val(ui.value.toLocaleString('ru-RU'));
        $('#calcCokolSquare').trigger('keyup');
      }
    });
  }

  // Вспдывающая форма калькулятора
  $(document).on('click', '.calc-price__order-button', function(e){
    e.preventDefault();
    $(".idom_overlay").fadeIn();
    $(".idom_callback_form-d").remove();
    $("body").append('<div class="idompk-modal-form idompk-modal-form--large idom_callback_form idom_callback_form-1 idom_callback_form-d"><i class="idom_icon idom_icon-close idom_icon-close-thanks"></i><span class="idom_feedback-main__title">Опишите как можно подробнее вашу задачу!</span><form class="idom_js_form_main_1" method="post" id="idom_js_form_main_1" enctype="multipart/form-data"><fieldset><div class="row idom_feedback-main__row"><div class="col-md-4 idom_feedback-main__item"><input class="idom_feedback-main__input" name="idom_js_form_main_1__name" type="text" placeholder="Ваше имя" required /></div><div class="col-md-4 idom_feedback-main__item"><input class="idom_feedback-main__input idom_phone" name="idom_js_form_main_1__phone" type="text" placeholder="Телефон" required /></div><div class="col-md-4 idom_feedback-main__item"><input class="idom_feedback-main__input" name="idom_js_form_main_1__mail" type="text" placeholder="E-mail" /></div></div><div class="row idom_feedback-main__row"><div class="col-md-12 idom_feedback-main__item"><textarea class="idom_feedback-main__textarea" name="idom_js_form_main_1__message" placeholder="Ваше сообщение"></textarea></div></div><div class="row"><div class="col-md-12 idom_feedback-main__item idom_feedback-main__item--submit"><div id="idom_js_form_main_1_captcha"></div><input type="hidden" name="idom_js_form_main_1__form" value="Форма: Опишите как можно подробнее вашу задачу!" /><input class="idom_feedback-main__button" type="submit" value="Отправить" /></div></div></fieldset><div class="idompk-iagree">Нажимая кнопку «Отправить», я даю согласие на обработку моих персональных данных, в соответствии с Федеральным законом №152-ФЗ «О персональных данных».</div></form></div>');
    $(".idom_phone").mask("+7 (999) 999-9999");
  });

  // Спойлер калькулятора
  $(document).on('click', '.idompk-calc-addons-spoiler__link', function(event){
    event.preventDefault();
    $(this).toggleClass('is-active');

    $(this).closest('.tab-pane').find('.idompk-calc-addons').toggleClass('is-all-visible');
  });

  // Вспдывающая форма калькулятора
  $(document).on('click', '.idompk-complex-calc__output-button-link', function(e){
    e.preventDefault();
    $(".idom_overlay").fadeIn();
    $(".idom_callback_form-d").remove();
    $("body").append('<div class="idompk-modal-form idompk-modal-form--large idom_callback_form idom_callback_form-1 idom_callback_form-d"><i class="idom_icon idom_icon-close idom_icon-close-thanks"></i><span class="idom_feedback-main__title">Опишите как можно подробнее вашу задачу!</span><form class="idom_js_form_main_1" method="post" id="idom_js_form_main_1" enctype="multipart/form-data"><fieldset><div class="row idom_feedback-main__row"><div class="col-md-4 idom_feedback-main__item"><input class="idom_feedback-main__input" name="idom_js_form_main_1__name" type="text" placeholder="Ваше имя" required /></div><div class="col-md-4 idom_feedback-main__item"><input class="idom_feedback-main__input idom_phone" name="idom_js_form_main_1__phone" type="text" placeholder="Телефон" required /></div><div class="col-md-4 idom_feedback-main__item"><input class="idom_feedback-main__input" name="idom_js_form_main_1__mail" type="text" placeholder="E-mail" /></div></div><div class="row idom_feedback-main__row"><div class="col-md-12 idom_feedback-main__item"><textarea class="idom_feedback-main__textarea" name="idom_js_form_main_1__message" placeholder="Ваше сообщение"></textarea></div></div><div class="row"><div class="col-md-12 idom_feedback-main__item idom_feedback-main__item--submit"><div id="idom_js_form_main_1_captcha"></div><input type="hidden" name="idom_js_form_main_1__form" value="Форма: Опишите как можно подробнее вашу задачу!" /><input class="idom_feedback-main__button" type="submit" value="Отправить" /></div></div></fieldset><div class="idompk-iagree">Нажимая кнопку «Отправить», я даю согласие на обработку моих персональных данных, в соответствии с Федеральным законом №152-ФЗ «О персональных данных».</div></form></div>');
    $(".idom_phone").mask("+7 (999) 999-9999");
  });

  $('.js-complex-calc-supper-button').on('click', function(event){
    event.preventDefault();
    $('.js-complex-calc-supper-button').removeClass('is-active');
    $(this).addClass('is-active');
  });

  $('.js-complex-calc-button').on('click', function(event){
    event.preventDefault();
    $(this).toggleClass('is-active');
  });

  $('.idompk-fullwidth-slider__items').slick({
    dots: true,
    autoplay: true,
    autoplaySpeed: 7000,
    infinite: true,
    centerPadding: '0px',
    speed: 1000,
    slidesToShow: 1,
    slidesToScroll: 1,
    centerMode: true,
    variableWidth: true,
    prevArrow: '<button type="button" class="slick-prev"><i class="idom_icon-2 idom_icon-2-chevron-left"></i></button>',
    nextArrow: '<button type="button" class="slick-next"><i class="idom_icon-2 idom_icon-2-chevron-left"></i></button>',
    responsive: [
      {
        breakpoint: 991,
        settings: {
          // centerMode: true,
          centerPadding: '0px',
          variableWidth: false,
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
    ]
  });

  if ($('.calc-price__value-fixed').length) {
    $(window).on('scroll', function() {
      var offsetLinks = $('.idompk-calc').eq(0).offset().top;

      var hideOffset = $('.calc-price__content-text').eq(0).offset().top;
      var hideOffsetHeight = $('.calc-price__content-text').eq(0).outerHeight();

      var hideLength = hideOffset + hideOffsetHeight-50;

      if ($(this).scrollTop() < hideLength && $(this).scrollTop() > offsetLinks) {
        $('.calc-price__value-fixed').addClass('calc-price__value-fixed--active');
      } else {
        $('.calc-price__value-fixed').removeClass('calc-price__value-fixed--active');
      }
    });
  }

});

if (navigator.userAgent.match(/Android/i)
  || navigator.userAgent.match(/webOS/i)
  || navigator.userAgent.match(/iPhone/i)
  || navigator.userAgent.match(/iPad/i)
  || navigator.userAgent.match(/iPod/i)
  || navigator.userAgent.match(/BlackBerry/i)
  || navigator.userAgent.match(/Windows Phone/i)) {
  document.body.classList.add('idom-mobile');
} else {
  document.body.classList.remove('idom-mobile');
}