<?php
  $this->title = 'Помощь';
  $this->registerMetaTag(['name' =>'description', 'content' =>'Помощь']);

  $categorys = \app\models\BazaZnanijCategory::find()->orderBy(['position'=>SORT_DESC])->all();

  $firstCatIndex = $categorys[0]->id;

  setlocale(LC_TIME, "ru_RU.utf8");
?>

<script>
  $(document).ready(function(){
    $('.jsChangeCategory').on('click', function(e){
      e.preventDefault();
      let idCat = $(this).attr('href');
      let nameCat = $(this).text();

      console.log(idCat.split('#')[1])

      $('.idom_broadcrumbs ul li:last-child').text(nameCat);
      $('h1').text(nameCat);
      $('.idom_articles__item').hide();
      $(`[data-id="${idCat.split('#')[1]}"]`).show();
    })
  });
</script>

<div class="idom_broadcrumbs">
  <div class="container">
    <ul>
      <li><a href="/"><?=$_SERVER['HTTP_HOST']?></a></li>
      <li><a href="/baza-znanij">Помощь</a></li>
      <li><?=$categorys[0]->name ?></li>
    </ul>
  </div>
</div>

<div class="idom_help-articles">
  <div class="container">
    <h1><?=$categorys[0]->name ?></h1>
    <div class="idom_help-articles__content">
      <div class="jsSticky0">
        <div class="jsSticky">
          <div class="idom_help-articles__categorys">
            <ul>
              <?php foreach ($categorys as $cat) { ?>
              <li><a class="jsChangeCategory" href="#cat<?=$cat->id?>"><?=$cat->name?></a></li>
              <?php } ?>
            </ul>
          </div>
          <div class="idom_help-articles__categorys-adv" style="padding: 40px 0 0 0;">
           <!-- Yandex.RTB R-A-2365726-6 -->
            <div id="yandex_rtb_R-A-2365726-6"></div>
            <script>
            window.yaContextCb.push(()=>{
              Ya.Context.AdvManager.render({
                "blockId": "R-A-2365726-6",
                "renderTo": "yandex_rtb_R-A-2365726-6"
              })
            })
            </script>
          </div>
        </div>
      </div>
      <div>
        <div class="idom_articles">
          <?php foreach (\app\models\BazaZnanijArticles::find()->orderBy(['date_create'=>SORT_DESC])->asArray()->all() as $item) { ?>
            <div class="idom_articles__item" data-id="cat<?=$item['category_id']?>" <?=$item['category_id']!=$firstCatIndex?'style="display:none"':'';?>>
              <div class="idom_articles__item-image">
                <a class="idom_articles__item-header-link" href="/baza-znanij/<?=$item['link_url']?>" title="<?=$item['link_title']?>">
                  <img src="/img/uploads/other/original/<?=unserialize($item['img_preview'])[0]?>" alt="<?=$item['link_title']?>" />
                </a>
              </div>
              <div class="idom_articles__item-header">
                <a class="idom_articles__item-header-link" href="/baza-znanij/<?=$item['link_url']?>" title="<?=$item['link_title']?>"><?=$item['link_title']?></a>
              </div>
            </div>
          <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!--<script src="/js/sticky.min.js"></script>-->
<!--<script>-->
<!--  let sticky = new Sticky('.jsSticky');-->
<!--</script>-->


<script type="text/javascript" src="/js/rAF.js"></script>
<script type="text/javascript" src="/js/ResizeSensor.js"></script>
<script type="text/javascript" src="/js/sticky-sidebar.js"></script>
<script type="text/javascript">

  var stickySidebar = new StickySidebar('.jsSticky0', {
    topSpacing: 20,
    bottomSpacing: 20,
    containerSelector: '.idom_help-articles__content',
    innerWrapperSelector: '.jsSticky'
  });
</script>