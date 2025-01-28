<?php

  $home_st = \app\models\HomePage::find()->asArray()->one();

  $this->title = $home_st['title'];
  $this->registerMetaTag(['name' =>'description', 'content' =>$home_st['description']]);


  if($_SERVER['REQUEST_URI'] == "/index.php") {
    header("Location: /",TRUE,301);
    exit();
  }
  $pr_settings = \app\models\ProjSettings::find()->asArray()->one();

  $maxSquer = \app\models\Projects::find()->max('area');

  setlocale(LC_TIME, "ru_RU.utf8");
?>

<div class="home-page">

  <div class="idompk-projects">
    <div class="container">
      <div class="idompk-projects__container">
        <div class="idompk-projects__aside">
          <div class="idompk-projects__content">
            <?=$home_st['text_3']?>
          </div>
          <div class="idompk-projects__counter">
            <div class="idompk-projects__counter-num idom_number_all">0</div>
            <div class="idompk-projects__counter-text">
              <p>проектов домов в каталоге с готовой рабочей документацией</p></div>
          </div>
          <a href="/catalog/proekty-domov" class="quick-search__link"><?=\app\models\T::t('Расширенный поиск')?><i class="idom_icon-2 idom_icon-2-arrow-left"></i></a>
        </div>
        <div class="idompk-projects__search">
          <form action="/catalog/proekty-domov/go_filter" method="GET" class="quick-search">
            <div class="quick-search__header"><?=\app\models\T::t('Быстрый поиск')?></div>
            <div class="filters_element">
              <p class="heading"><?=\app\models\T::t('Спальни')?></p>
              <div class="form_element">
                <div class="checkbox checkbox_var-2">
                  <input type="checkbox" value="1" class="erker" name="spalni[]" />
                  <label><span>1</span></label>
                </div>
                <div class="checkbox checkbox_var-2">
                  <input type="checkbox" value="2" class="erker" name="spalni[]" />
                  <label><span>2</span></label>
                </div>
                <div class="checkbox checkbox_var-2">
                  <input type="checkbox" value="3" class="erker" name="spalni[]" />
                  <label><span>3</span></label>
                </div>
                <div class="checkbox checkbox_var-2">
                  <input type="checkbox" value="4" class="erker" name="spalni[]" />
                  <label><span>4</span></label>
                </div>
                <div class="checkbox checkbox_var-2">
                  <input type="checkbox" value="5" class="erker" name="spalni[]" />
                  <label><span>5+</span></label>
                </div>
              </div>
            </div>

            <div class="filters_element">
              <p class="heading"><?=\app\models\T::t('Санузлы')?></p>
              <div class="form_element">
                <div class="checkbox checkbox_var-2">
                  <input type="checkbox" value="1" class="erker" name="zanuzel[]" />
                  <label><span>1</span></label>
                </div>
                <div class="checkbox checkbox_var-2">
                  <input type="checkbox" value="2" class="erker" name="zanuzel[]" />
                  <label><span>2</span></label>
                </div>
                <div class="checkbox checkbox_var-2">
                  <input type="checkbox" value="3" class="erker" name="zanuzel[]" />
                  <label><span>3</span></label>
                </div>
                <div class="checkbox checkbox_var-2">
                  <input type="checkbox" value="4" class="erker" name="zanuzel[]" />
                  <label><span>4</span></label>
                </div>
                <div class="checkbox checkbox_var-2">
                  <input type="checkbox" value="5" class="erker" name="zanuzel[]" />
                  <label><span>5+</span></label>
                </div>
              </div>
            </div>

            <div class="filters_element">
              <p class="heading"><?=\app\models\T::t('Этажность')?></p>
              <div class="form_element">
                <div class="checkbox checkbox_var-2">
                  <input type="checkbox" value="1" class="erker" name="eta[]" />
                  <label><span>1</span></label>
                </div>
                <div class="checkbox checkbox_var-2">
                  <input type="checkbox" value="10" class="erker" name="eta[]" />
                  <label><span>1.5</span></label>
                </div>
                <div class="checkbox checkbox_var-2">
                  <input type="checkbox" value="2" class="erker" name="eta[]" />
                  <label><span>2</span></label>
                </div>
                <div class="checkbox checkbox_var-2">
                  <input type="checkbox" value="20" class="erker" name="eta[]" />
                  <label><span>2.5</span></label>
                </div>
                <div class="checkbox checkbox_var-2">
                  <input type="checkbox" value="3" class="erker" name="eta[]" />
                  <label><span>3</span></label>
                </div>
              </div>
            </div>
            <div class="filters_element">
              <div class="form_element">
                <div class="row">
                  <div class="col-auto">
                    <div class="checkbox">
                      <input type="checkbox" name="cokol" class="dop_vall" value="1" />
                      <label><?=\app\models\T::t('Цокольный этаж')?></label>
                    </div>
                  </div>
                  <div class="col-auto">
                    <div class="checkbox">
                      <input type="checkbox" name="pogreb" class="dop_vall" value="1" />
                      <label><?=\app\models\T::t('Погреб')?></label>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="filters_element">
              <p class="heading"><?=\app\models\T::t('Гараж (Кол-во автомест)')?></p>
              <div class="form_element">
                <div class="checkbox checkbox_var-2">
                  <input type="checkbox" value="0" class="erker" name="garaj[]" />
                  <label><span>0</span></label>
                </div>
                <div class="checkbox checkbox_var-2">
                  <input type="checkbox" value="1" class="erker" name="garaj[]" />
                  <label><span>1</span></label>
                </div>
                <div class="checkbox checkbox_var-2">
                  <input type="checkbox" value="2" class="erker" name="garaj[]" />
                  <label><span>2</span></label>
                </div>
                <div class="checkbox checkbox_var-2">
                  <input type="checkbox" value="3" class="erker" name="garaj[]" />
                  <label><span>3+</span></label>
                </div>
              </div>
            </div>

            <!--<div class="filters_element filters_element--place">
              <p class="heading"><?/*=\app\models\T::t('Площадь дома (кв. м.)')*/?></p>
              <div class="form_element">
                <div class="row">
                  <div class="col-6 pr-0 d-flex justify-content-between">
                    <input type="number" value="0" name="area_ot" />
                    <div class="form_element__sep"></div>
                  </div>
                  <div class="col-6 pl-0 d-flex justify-content-between">
                    <input type="number" value="1420" name="area_do"/>
                  </div>
                </div>
              </div>
            </div>-->
            <div class="quick-search-squar filters_element filters_element--range-place mt-0">
              <p class="heading"><?=\app\models\T::t('Площадь дома (кв. м.)')?></p>
              <div class="range_inputs" id="slide_squat">
                <div class="range_inputs_element range_element"><input class="before" type="text" name="area_ot" value="0"/></div>
                <div class="range_element range_element__sep text-center"> &mdash; </div>
                <div class="range_element range_inputs_element"><input class="after" type="text" name="area_do" value="<?=$maxSquer?>"/></div>
                <div class="range_element range_element__kv text-center"> кв.м. </div>
              </div>
              <div class="range_slider_element range_element"><div class="range range_square"></div></div>
<!--              <div class="range_inputs" id="slide_squat">-->
<!--                <div class="range_inputs_element range_element"><input class="before" type="text" value="0"/></div>-->
<!--                <div class="range_element range_element__sep text-center"> &mdash; </div>-->
<!--                <div class="range_element range_inputs_element"><input class="after" type="text" value="--><?//=$maxSquer?><!--"/></div>-->
<!--                <div class="range_element range_element__kv text-center"> кв.м. </div>-->
<!--              </div>-->
            </div>

            <div class="quick-search__buttons">
              <button type="submit" class="quick-search__button"><?=\app\models\T::t('Показать')?> <span class="idom_number_all fast_filter_total_projects"></span></button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="idompk-popular">
    <div class="idompk-popular__container container">
      <div class="idompk-popular__items row">
        <?php  foreach (\app\models\HomePageCategory::find()->orderBy(['id'=>SORT_ASC])->all() as $key=>$category) {
          $url_name = \app\models\FilterItem::find()->where(['id'=>$category->url])->asArray()->one();
          ?>
          <div class="idompk-popular__item col-12 col-xl-6">
            <div class="idompk-popular__item-row">
              <div class="idompk-popular__item-body">
                <div class="idompk-popular__title">
                  <a href="/catalog/proekty-domov/<?=$url_name['url']?>"><?php echo $category->name; ?></a>
                </div>
                <div class="idompk-popular__meta-row row">
                  <?php  foreach (\app\models\HomePageItem::find()->where(['category' => $category['id'] ])->orderBy(['id'=>SORT_ASC])->all() as $popular) {
                    $url_name = \app\models\FilterItem::find()->where(['id'=>$popular->url])->asArray()->one();
                    ?>
                    <div class="idompk-popular__meta-col col-4"><a href="/catalog/proekty-domov/<?=$url_name['url']?>"><?php echo str_replace(' ', ' ',$popular->title); ?></a></div>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="idom_two-col">
      <div class="idom_two-col__item idom_two-col__item_orange">
        <div class="idom_two-col__item-image"><img src="/img/icons/calculator-svgrepo-com.svg" alt=""/></div>
        <div class="idom_two-col__item-info">
          <a href="/kalkulyator-stroitelstva-doma">Онлайн калькулятор</a>
          <p>Узнайте стоимость строительства дома под ключ до покупки проекта.</p>
        </div>
      </div>
      <div class="idom_two-col__item idom_two-col__item_blue">
        <div class="idom_two-col__item-image"><img src="/img/icons/check-list-and-pencil-svgrepo-com.svg" alt=""/></div>
        <div class="idom_two-col__item-info">
          <a href="/baza-znanij">Полезные советы и статьи</a>
          <p>Узнайте больше до покупки проекта и сравните цены на различные материалы.</p>
        </div>
      </div>
    </div>
  </div>

  <?php if ($home_st['text_2']) { ?>
  <div class="container">
    <?php echo $home_st['text_2']; ?>
  </div>
  <?php } ?>

  <?php if (\app\models\SitePages::find()->where(['parent_id' => 12 ])->count() > 0) {?>
    <div class="container">
      <div class="idompk-popular__headline">
        <h2 class="idompk-popular__header h2"><?=\app\models\T::t('Новые статьи в нашем блоге')?></h2>
        <a class="idom_link" href="/articles"><?=\app\models\T::t('Все статьи')?><i class="idom_icon-2 idom_icon-2-arrow-left"></i></a>
      </div>

      <div class="row">
        <?php foreach (\app\models\SitePages::find()->where(['parent_id' => 12])->orderBy(['id'=>SORT_DESC])->LIMIT(6)->asArray()->all() as $item) {
          ?>
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
  <?php } ?>

  <div class="container pt-5 pb-4">
    <!-- Yandex.RTB R-A-2365726-3 -->
        <div id="yandex_rtb_R-A-2365726-3"></div>
        <script>window.yaContextCb.push(()=>{
          Ya.Context.AdvManager.render({
            "blockId": "R-A-2365726-3",
            "renderTo": "yandex_rtb_R-A-2365726-3"
          })
        })
        </script>
  </div>

</div>

<script>

  $(function() {

    function slide_change_square ( event, ui ) {
      $('#slide_squat .before').val(ui.values[0]);
      $('#slide_squat .after').val(ui.values[1]);


    };

  $(".range_square").slider({
    range: true,
    min: 0,
    max: <?=$maxSquer?>,
    values: [ 0, <?=$maxSquer?>],
    slide: slide_change_square,
    stop: function(event, ui ) {
      var mass = {
        area_ot: $( ".range_square" ).slider( "values", 0 ),
        area_do: $( ".range_square" ).slider( "values", 1 )
      };
      get_pr(mass);
    }

  });

  $("#slide_squat").on("keyup", function(){
    var mass = {
      area_ot: $( ".range_square" ).slider( "values", 0 ),
      area_do: $( ".range_square" ).slider( "values", 1 )
    };
    get_pr();
  });

    function get_pr() {

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

      // $.ajax({
      //   type: "GET",
      //   async: false,
      //   dataType: 'json',
      //   url: "/site/set_pr",
      //   data: arr,
      //   success: function(data,status) {
      //     if(data.status=='ok')
      //     {
      //       if(parseInt(data.total)>0) {
      //         $('.fast_filter_total_projects').text(data.total);
      //       }else {
      //         $('.fast_filter_total_projects').text("0");
      //       }
      //
      //       //
      //       // $('#cont_projec').html(data.res);
      //       // $('.idom_pagination').html(data.pages_link);
      //     }
      //
      //   }
      // });
    }
  });
</script>