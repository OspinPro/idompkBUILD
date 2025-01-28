<?php
  $this->title = $page['title'];
  $this->registerMetaTag(['name' =>'description', 'content' =>$page['description']]);

  $page['content'] = str_replace('[calc]', Yii::$app->view->renderFile('@app/views/calc/widget.php'), $page['content']);

  $items = \app\models\MapItem::find()->orderBy(['id'=>SORT_DESC])->asArray()->all();

  if ($page['parent_id'] != null) {
    $pageParent = \app\models\SitePages::find()->where(['id'=>$page['parent_id']])->asArray()->one();
  }
  setlocale(LC_TIME, "ru_RU.utf8");
?>
<script src="https://api-maps.yandex.ru/2.1/?apikey=0f2c9d06-16fe-48c0-8dcc-b80d01f31f1b&lang=ru_RU"></script>
<!--  <link href="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet" />-->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script>-->
<!--  <link href="/css/jquery-ui.min.css" rel="stylesheet" />-->
<!--<script src="/js/jquery-ui.min.js"></script>-->
<script>
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
    <ul class="px-0">
      <li><a href="/"><?=\app\models\T::t('Проекты домов')?></a></li>
      <?=$pageParent?'<li><a href="/'.$pageParent['link_url'].'">'.$pageParent['crumbs_title'].'</a></li>':''?>
      <?=$page['crumbs_title']?'<li>'.$page['crumbs_title'].'</li>':''?>
    </ul>
  </div>
</div>

<div style="height: 0; overflow: hidden">
  <div class="fotorama"></div>
</div>

<?php if ($page['page_type'] == 1) { ?>
  <?=$page['content']?>
  <div class="idom_articles">
    <div class="container">
      <div class="row">
        <?php foreach (\app\models\SitePages::find()->where(['parent_id' => $page['id']])->orderBy(['id'=>SORT_DESC])->asArray()->all() as $item) { ?>
        <div class="col-md-6 col-lg-6 col-xl-4">
          <div class="idom_articles__item">
            <div class="idom_articles__item-image">
              <a class="idom_articles__item-header-link" href="<?=$item['link_url']?>" title="<?=$item['link_title']?>">
                <img src="/img/uploads/other/medium/<?=unserialize($item['preview_image'])[0]?>" alt="<?=$item['link_title']?>" />
              </a>
            </div>
            <div class="idom_articles__item-header">
              <span class="idom_articles__item-header-date"><?php echo strftime("%e %B %G", date_create($item['date_create'])->getTimestamp())?></span>
              <a class="idom_articles__item-header-link" href="<?=$item['link_url']?>" title="<?=$item['link_title']?>"><?=$item['link_title']?></a>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
  </div>
<?php } else if ($page['page_type'] == 2) {?>
  <?=$page['content']?>
  <div class="idom_articles">
    <div class="container">
      <div class="row">
        <?php foreach (\app\models\SitePages::find()->where(['parent_id' => $page['id']])->orderBy(['id'=>SORT_DESC])->asArray()->all() as $item) { ?>
          <div class="col-12">
            <div class="idom_articles__item">
              <div class="idom_articles__item-image" style="max-width: 400px;">
                <a class="idom_articles__item-header-link" href="<?=$item['link_url']?>" title="<?=$item['link_title']?>">
                  <img src="/img/uploads/other/medium/<?=unserialize($item['preview_image'])[0]?>" alt="<?=$item['link_title']?>" />
                </a>
              </div>
              <div class="idom_articles__item-header">
                <span class="idom_articles__item-header-date"><?php echo strftime("%e %B %G", date_create($item['date_create'])->getTimestamp())?></span>
                <a class="idom_articles__item-header-link" href="<?=$item['link_url']?>" title="<?=$item['link_title']?>"><?=$item['link_title']?></a>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
<?php } else { ?>
  <?php
  $parentPageType = \app\models\SitePages::find()->where(['id'=>$page['parent_id']])->asArray()->one();
  if ($parentPageType['page_type'] != 0) { ?>
  <div class="container"><p><?php echo strftime("%e %B %G", date_create($page['date_create'])->getTimestamp())?></p></div>
  <?php } ?>

<?php
  $page['content'] = str_replace('[map]', '<div id="projects_map" style="width: 100%; height: 600px;"></div>', $page['content']);
  ?>
  <?=$page['content']?>
<?php } ?>

<script>
  $(function() {

    var coords = [];

    <?php  foreach ($items as $itm)
    { ?>
    coords[<?=$itm['id']?>] = [
      [<?=$itm['coordinates']?>],
      [
        <?php foreach (array_reverse(unserialize($itm['images'])) as $img)
        { ?>
        "/<?=$img?>",
        <?php break; } ?>
      ],
      '<?=$itm['id']?>'
    ];
    <?php }  ?>



    ymaps.ready(function () {
      var myMap = new ymaps.Map('projects_map', {
        center: [55.751574, 37.573856],
        zoom: 15,
        controls: []
      });
      myMap.controls.add('zoomControl', {
        float: "none",
        position: {
          bottom: 160,
          left: 20
        }
      });
      myMap.behaviors.disable('scrollZoom');

      let fotorama = $('.fotorama')
        .fotorama({allowfullscreen: true, nav: "thumbs"})
        .data('fotorama');

      <?php
      foreach ($items as $itm)
      {
      $imgs = array_reverse(unserialize($itm['images']));

      ?>
      var nIm_<?=$itm['id']?> = coords[<?=$itm['id']?>][1];

      MyIconContentLayout = ymaps.templateLayoutFactory.createClass(
        '<img style="border:2px solid #00b05a;" src="/img/uploads/map/thumb'+nIm_<?=$itm['id']?>+'" />'
      ),

        mark<?=$itm['id']?> = new ymaps.Placemark(coords[<?=$itm['id']?>][0],{},{
          // iconLayout: 'islands#redIcon',
          // iconImageHref: '#',
          // iconContentSize: [48, 48],
          // iconImageOffset: [-48, -48],
          // iconContentOffset: [15, 15],
          // iconContentLayout: MyIconContentLayout
        });
      myMap.geoObjects.add(mark<?=$itm['id']?>);


      mark<?=$itm['id']?>.events.add('click', function(e) {

        $(function () {
          fotorama.load([
            <?php foreach ($imgs as $rr) { ?>
              {img: `/img/uploads/map/original/<?=$rr?>`, thumb: `/img/uploads/map/thumb/<?=$rr?>`},
            <?php } ?>
          ]);
          fotorama.requestFullScreen();
        });



      });
      <?php  } ?>

      var centerAndZoom = ymaps.util.bounds.getCenterAndZoom(
        myMap.geoObjects.getBounds(),
        myMap.container.getSize(),
        myMap.options.get('projection')
      );

      if(centerAndZoom.zoom <=11 && centerAndZoom.zoom >=3)
        myMap.setCenter(centerAndZoom.center, parseInt(centerAndZoom.zoom));
      else
        myMap.setCenter(centerAndZoom.center, 12);


    });
  });
</script>
