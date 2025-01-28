<?php

  $ref=$_SERVER['REQUEST_URI'];

  $refArt = explode('/',$ref)[count(explode('/',$ref))-2];

  if ($ref!='') $ref='?'.$ref;

//  var_dump($refArt);
//  exit();
  if ($refArt == 'articles') {
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: https://idompk.ru/baza-znanij/' . explode('/', $ref)[count(explode('/', $ref)) - 1]);
  }

  $this->title = $page['title'];
  $this->registerMetaTag(['name' =>'description', 'content' =>$page['description']]);

  $page['content'] = str_replace('[calc]', Yii::$app->view->renderFile('@app/views/calc/widget.php'), $page['content']);

  $categorys = \app\models\BazaZnanijCategory::find()->all();

  setlocale(LC_TIME, "ru_RU.utf8");
?>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet" /><script src="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script>
  <link href="/css/jquery-ui.min.css" rel="stylesheet" /><script src="/js/jquery-ui.min.js"></script><script>
  $(function () {
    var fotorama = $('.fotorama-sl')
      .fotorama({allowfullscreen: true, nav: "thumbs"})
      .data('fotorama');
    var fotoramaV = $('.fotorama-slv')
      .fotorama({allowfullscreen: true})
      .data('fotorama');


    $('.fotorama-link').on('click',function(e){
      e.preventDefault();
      fotorama.requestFullScreen();
    })
    $('.fotorama-video').on('click',function(e){
      e.preventDefault();
      fotoramaV.requestFullScreen();
    })
  });

  $( function() {
    if ($("#accordion").length) {
      $("#accordion").accordion({
        heightStyle: "content"
      });
    }

    if ($(".fixme").length) {
      var ttop = $(".fixme").offset().top;


      $(window).scroll(function () {

        var offsetFromScreenTop = ttop - $(window).scrollTop();

        if (offsetFromScreenTop < 1) {
          $('.idom_pd-miniNav').addClass('idom_pd-miniNav-fixed');
        } else {
          $('.idom_pd-miniNav').removeClass('idom_pd-miniNav-fixed');
        }

      });

      $('.fixme a').click(function () {
        $('html, body').animate({
          scrollTop: $($(this).attr('href')).offset().top
        }, 500);
        return false;
      });

      // Cache selectors
      var topMenu = $(".fixme .container"),
        topMenuHeight = topMenu.outerHeight() + 15,
        // All list items
        menuItems = topMenu.find("a"),
        // Anchors corresponding to menu items
        scrollItems = menuItems.map(function () {
          var item = $($(this).attr("href"));
          if (item.length) {
            return item;
          }
        });

// Bind to scroll
      $(window).scroll(function () {
        // Get container scroll position
        var fromTop = $(this).scrollTop() + topMenuHeight;

        // Get id of current scroll item
        var cur = scrollItems.map(function () {
          if ($(this).offset().top < fromTop)
            return this;
        });
        // Get the id of the current element
        cur = cur[cur.length - 1];
        var id = cur && cur.length ? cur[0].id : "";
        // Set/remove active class
        menuItems
          .parent().removeClass("active")
          .end().filter("[href='#" + id + "']").parent().addClass("active");
      });
    }
  });
</script>


<div class="idom_broadcrumbs">
  <div class="container">
    <ul>
      <li><a href="/"><?=$_SERVER['HTTP_HOST']?></a></li>
      <li><a href="/baza-znanij">Помощь</a></li>
      <?=$page['crumbs_title']?'<li>'.$page['crumbs_title'].'</li>':''?>
    </ul>
  </div>
</div>


  <?=$page['content']?>

