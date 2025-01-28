<?php
$filter = unserialize(Yii::$app->session['projects_'.$name_filter]);

  $pages = new \yii\data\Pagination(['totalCount' => $count, 'pageSize' => 20]);
$pages->pageSizeParam = false;

$sorts = [
    'priority-up' => ['type' => 'priority', 'stype' => 'up', 'name' => 'популярные'],
    'area-down' => ['type' => 'area', 'stype' => 'down', 'name' => 'большая площадь'],
    'area-up' => ['type' => 'area', 'stype' => 'up', 'name' => 'меньшая площадь'],
    'price_pr-down' => ['type' => 'price_pr', 'stype' => 'down', 'name' => 'выше стоимость'],
    'price_pr-up' => ['type' => 'price_pr', 'stype' => 'up', 'name' => 'ниже стоимость'],
    'spalen-down' => ['type' => 'spalen', 'stype' => 'down', 'name' => 'больше спален'],
    'spalen-up' => ['type' => 'spalen', 'stype' => 'up', 'name' => 'меньше спален']
];
?>

<?php
$activeSort = $sorts['priority-up'];
if(!empty($filter['sort']))
    $activeSort = $sorts[$filter['sort']['tp'].'-'.$filter['sort']['type']];

$a = Yii::$app->request->url;
$b = Yii::$app->getRequest()->getQueryString();
if (strpos($a, 'page') !== false) {
  if ($name_filter != 's-cenoj-na-stroitelstvo') {
    preg_match('/<h1[^>]*?>(.*?)<\/h1>/si', $pr_settings['text'], $matches);
    $this->title = $matches[1].' - страница '.substr(strrchr($b, "="), 1).' из '.ceil($count/20);
    $this->registerMetaTag(['name' =>'description', 'content' =>$pr_settings['description'].' Страница '.substr(strrchr($b, "="), 1).' из '.ceil($count/20)]);
  } else {
    preg_match('/<h1[^>]*?>(.*?)<\/h1>/si', $pr_settings['text_price'], $matches);
    $this->title = $matches[1].' - страница '.substr(strrchr($b, "="), 1).' из '.ceil($count/20);
    $this->registerMetaTag(['name' =>'description', 'content' =>$pr_settings['description'].' Страница '.substr(strrchr($b, "="), 1).' из '.ceil($count/20)]);
  }
} else {
  if($filter['cenoj'] && $name_filter == 's-cenoj-na-stroitelstvo')
  {
    $this->title = $pr_settings['title_s'];
    $this->registerMetaTag(['name' =>'description', 'content' =>$pr_settings['description_s']]);
  }
  else
  {
    $this->title = $pr_settings['title'];
    $this->registerMetaTag(['name' =>'description', 'content' =>$pr_settings['description']]);
  }
}
  $proj_settings = \app\models\ProjSettings::find()->asArray()->one();
  $adv_settings = \app\models\AdvSettings::find()->asArray()->one();
?>


<div class="idom_broadcrumbs idom_broadcrumbs-catalog">
  <div class="container">
    <ul itemscope itemtype="https://schema.org/BreadcrumbList">
      <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="/"><span itemprop="name">idompk.ru</span></a></li>
      <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="/catalog/proekty-domov"><span itemprop="name">Каталог проектов</span></a></li>
      <?php if (count($filter)>1) { ?><li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><span itemprop="name"><?=$filter['name']?></span></li> <?php } ?>
    </ul>
  </div>
</div>

<div class="idompk-mobile-filter js-mobile-filter">
  <div class="idompk-mobile-filter__container container">
    <div class="idompk-mobile-filter__close js-mobile-filter-close"></div>
    <div class="idompk-mobile-filter__body js-mobile-filter-body"></div>
  </div>
</div>
<!-- idompk-mobile-filter -->

<div class="idompk-mobile-filter idompk-mobile-filter--sorting js-mobile-sorting">
  <div class="idompk-mobile-filter__container container">
    <div class="idompk-mobile-filter__close js-mobile-sorting-close"></div>
    <div class="idompk-mobile-filter__body js-mobile-sorting-body"></div>
  </div>
</div>
<!-- idompk-mobile-filter -->


<div class="idom_catalog-page pb-5">

  <div class="idom_catalog-page--header">
    <div class="container">
      <?php /* [+] Доработки декабрь 2020 */ ?>
       <?php if($name_filter != 's-cenoj-na-stroitelstvo') {
            $txt = $pr_settings['text'];
            } else {
           $txt = $pr_settings['text_price'];
            }
            $txt = str_replace('<ul class="list_inline">', '<div class="idompk-tags"><ul class="list_inline">',$txt);
       $txt = str_replace('</ul>', '</ul></div>',$txt);
       echo $txt;
            ?>
        <div class="idompk-tags-more"><a class="idompk-tags-more__link" href="#" data-show="Показать все категории" data-hide="Свернуть"></a></div>
      <?php /* [-] Доработки декабрь 2020 */ ?>
    </div>
  </div>

  <div>
    <?=$adv_settings['filter_top_banner']?>
  </div>

  <div class="idom_catalog-page--buttons">
    <div class="container">
      <div class="row cols-2">
        <div class="col">
          <button class="idom_catalog-page__button idom_catalog-page__button--filter js-mobile-filter-open">Фильтр</button>
        </div>
        <div class="col">
          <button class="idom_catalog-page__button idom_catalog-page__button--sorting js-mobile-sorting-open">Сортировать</button>
        </div>
      </div>
    </div>
  </div>


  <div class="idom_catalog-page--body bg-white">
    <div class="row">
      <div class="idom_catalog-page__content col-auto">
        <div class="idom_catalog-page--body--header">
            <div class="row new-catalog--filter">
              <div class="col-md-auto sorting-box-prjects">
                <a class="filter-item filter-item--1" style="text-decoration: none;"><i id="count_find_word" class="font-weight-bold" style="font-style: normal;">Найдено проектов: </i> <i style="font-style: normal;" id="count_find_projects"><?=$count?></i></a>
                <?php  if (\app\models\Projects::find()->where('prcie_all > 0')->count() > 0) {
                  ?>
                    <div class="checkbox" style="margin-bottom: -8px;">
                    <input id="cchk" style="pointer-events: none;cursor: default" type="checkbox" value="1" class="cenoj" name="cenoj" <?=!empty($filter['cenoj'])?'checked':''?> />
                    <label for="cchk">
                  <a class="filter-item filter-item--1" style="text-decoration: none;"><span class="font-weight-bold" style="text-decoration: none;">С ценой на строительство</span> <span class="color-orange"></span></a></label>
                    </div><?php }  ?>
              </div>
              <div class="col-md-auto sorting-box-wrapper">
                <div class="sorting-box">
                  <span class="sorting-title sorting-box__title">Сортировать по:</span>
                  <div class="sorting-box__select">
                    <div class="sorting-box__select-current"><?php echo $activeSort['name']; ?></div>
                    <div class="sorting-box__select-dropdown">
                        <?php foreach ($sorts as $srt): ?>
                      <a class="sorting-item sort_type_c sorting-box__item<?php if($activeSort['name'] == $srt['name']) echo ' is-active'; ?>" data-type="<?php echo $srt['type']; ?>" data-stype="<?php echo $srt['stype']; ?>" href="#"><?php echo $srt['name']; ?></a>
                        <?php endforeach; ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <div class="idom_catalog-page--body--projects">
          <div class="row" id="cont_projec">
            <?php if (!$projects) { ?>
              <div class="col">
                <div class="alert alert-danger" role="alert">У нас нет проектов по выбранных параметрам.
                    <a href="/catalog/proekty-domov/reset_filer">Сбросьте фильтр</a>.</div>
              </div>
            <?php } else { ?>
              <?php foreach ($projects as $rec) {
                echo '<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-4 idom-projects-item">' . $this->render('block', ['rec' => $rec]) . '</div>';
              }
            }?>
          </div>
        </div>
      </div>
      <div class="idom_catalog-page__aside col-auto">
      
        <div class="filters_list">
          <div class="filters_list__body">

            <div class="idom_catalog-page--body--header">
              <div class="row new-catalog--filter">
                <div class="col-md-auto new-catalog--filter-box">
                  <span class="filter-item filter-item--1" style="text-decoration: none;">
                    <i id="count_find_word" class="font-weight-bold" style="font-style: normal;">Фильтр подбора</i>
                  </span>
                  <div class="idom_clear-box1" id="filters_element-fixed" style="display: block;"><a<?php if(count($filter)<3): ?> class="is-disabled"<?php endif; ?> id="reset_filter_a" href="/catalog/proekty-domov/reset_filer">Сбросить</a></div>
                </div>
              </div>
            </div>



            <div class="filters_element filters_element--select">
              <div class="form_element">
                <div class="form-control-title">Тип строения</div>
                <select dir="rtl" id="townhouse_s_select" class="form-control">
                  <?php
                  $townhouse_s = ['all_reset'=>'Все','1'=>'Дома и Коттеджи','2'=>'Таунхаусы','3'=>'Дуплексы','4'=>'Бани','5'=>'Гаражи', '6' => 'Многоквартирные'];
                  foreach ($townhouse_s as $rec=>$rec_val)
                  { ?>
                    <option dir="ltr" value="<?=$rec?>" <?=$filter['townhouse_s']==$rec?'selected="selected"':''?>><?=$rec_val?></option>
                  <?php  } ?>
                  </select>
              </div>
            </div>

            <div class="filters_element filters_element--select">
              <div class="form_element">
                <div class="form-control-title">Стиль</div>
                <select dir="rtl" id="style_select" class="form-control">
                  <option dir="ltr" value="all_reset" <?=!$filter['style_pr']?'selected="selected"':''?>>Все</option>
                  <?php foreach (\app\models\StylePr::find()->orderBy(['position'=>SORT_ASC])->asArray()->all() as $rec)
                  { ?>
                    <option dir="ltr" value="<?=$rec['id']?>" <?=$filter['style_pr']==$rec['id']?'selected="selected"':''?>><?=$rec['name']?></option>
                  <?php  } ?>
                  </select>
              </div>
            </div>

            <div class="filters_element filters_element--select">
              <div class="form_element">
                <div class="form-control-title">Материал стен</div>
                <select dir="rtl" id="material_select" class="form-control">
                  <option dir="ltr" value="all_reset" <?=!$filter['material']?'selected="selected"':''?>>Все</option>
                  <?php foreach (\app\models\Materials::find()->orderBy(['position'=>SORT_ASC])->asArray()->all() as $rec)
                  { ?>
                    <option dir="ltr" value="<?=$rec['id']?>" <?=$filter['material']==$rec['id']?'selected="selected"':''?>><?=$rec['name']?></option>
                  <?php  } ?>
                  </select>
              </div>
            </div>

            <div class="filters_element filters_element--floors">
              <div class="idom_switcher-box__title">Этажность</div>
              <div class="row">
                <div class="col-6 pr-0">
                  <div class="row">
                    <?php
                    $eth = ['1'=>'1','10'=>'1.5 (1+м)','2'=>'2','20'=>'2.5 (2+м)','3'=>'3'];
                    $eth_c = false;
                    foreach ($eth as $key=>$val)
                    { ?>
                  <div class="col-<?php echo $eth_c ? '8' : '4'; ?>">
                      <div class="checkbox">
                        <input type="checkbox" value="<?=$key?>" class="eta" name="eta" <?=in_array($key,$filter['eta'])?'checked':''?> />
                        <label><?=$val?></label>
                      </div>
                  </div>
                    <?php $eth_c = !$eth_c; } ?>
                  </div>
                </div>
                <div class="col-6">
                  <div class="checkbox">
                    <input type="checkbox" class="cokol" <?=$filter['cokol']?'checked':''?>/>
                    <label>Цокольный этаж</label>
                  </div>
                  <div class="checkbox">
                    <input type="checkbox" class="pogreb" <?=$filter['pogreb']?'checked':''?>/>
                    <label>Погреб</label>
                  </div>
                </div>
              </div>
            </div>

            <div class="idom_switcher-box">
              <div class="idom_switcher-box__title">Площадь и размеры</div>
              <div class="idom_switcher-box__content" style="display: block">
                <div class="filters_element filters_element--range-place mt-0">
                  <p class="heading">Площадь дома <span class="idom-tooltip" data-toggle="tooltip" data-placement="top" title="Полезная площадь дома, т.е. без учета террасы, крыльца и балконов.">?</span></p>
                  <div class="range_inputs" id="slide_squat">
                    <div class="range_inputs_element range_element"><input class="before" type="text" placeholder="0"/></div>
                    <div class="range_element range_element__sep text-center"> &mdash; </div>
                    <div class="range_element range_inputs_element"><input class="after" type="text" placeholder="0"/></div>
                    <div class="range_element range_element__kv text-center"> кв.м. </div>
                    <div class="range_slider_element range_element"><div class="range range_square"></div></div>
                  </div>
                </div>
                <div class="filters_element mt-0">
                  <p class="heading">Ширина <span class="idom-tooltip" data-toggle="tooltip" data-placement="top" title="Вводите точку для не целых чисел. Например: 8.5">?</span></p>
                  <div class="range_inputs" id="gb_h">
                    <div class="range_inputs_element range_element"><input class="before" type="text" placeholder="0"/></div>
                    <div class="range_element range_element__sep text-center"> &mdash; </div>
                    <div class="range_element range_inputs_element"><input class="after" type="text" placeholder="0"/></div>
                    <div class="range_element range_element__kv text-center"> м. </div>
                    <div class="range_slider_element range_element"><div class="range range_gb_h"></div></div>
                  </div>
                </div>
                <div class="filters_element mt-0 mb-0">
                  <p class="heading">Глубина <span class="idom-tooltip" data-toggle="tooltip" data-placement="top" title="Вводите точку для не целых чисел. Например: 8.5">?</span></p>
                  <div class="range_inputs" id="gb_d">
                    <div class="range_inputs_element range_element"><input class="before" type="text" placeholder="0"/></div>
                    <div class="range_element range_element__sep text-center"> &mdash; </div>
                    <div class="range_element range_inputs_element"><input class="after" type="text" placeholder="0"/></div>
                    <div class="range_element range_element__kv text-center"> м. </div>
                    <div class="range_slider_element range_element"><div class="range range_gb_d"></div></div>
                  </div>
                </div>
              </div>
            </div>

            <?php /* [+] Доработки декабрь 2020 */
                $all_checked = empty($filter['only_fact_razmer']) && empty($filter['only_inverse_razmer']);
            ?>
            <div class="filters_element mt-0">
              <div class="form_element">
                <div class="checkbox checkbox--fluid">
                  <input type="checkbox" value="1" class="razmer only_fact_razmer" name="only_fact_razmer" <?=(!empty($filter['only_fact_razmer']) || $all_checked)?'checked':''?> />
                  <label><span>Показывать только указанные размеры <b>(Ш х Г)</b></span></label>
                </div>
                <div class="checkbox checkbox--fluid">
                  <input type="checkbox" value="1" class="razmer only_inverse_razmer" name="only_inverse_razmer" <?=(count($filter)>1 && (!empty($filter['only_inverse_razmer']) || $all_checked))?'checked':''?> />
                  <label><span>Добавить дома с инверсией размеров <b>(Г х Ш)</b></span></label>
                </div>
              </div>
            </div>
            <?php /* [-] Доработки декабрь 2020 */ ?>

            <div class="idom_switcher-box idom_switcher-box--active">
              <div class="idom_switcher-box__title">Стоимость</div>
              <div class="idom_switcher-box__content" style="display: block;">
                <div class="filters_element mt-0">
                  <p class="heading">Стоимость проекта</p>
                  <div class="range_inputs" id="slide_price">
                    <div class="range_inputs_element range_element"><input class="before" type="text" placeholder="0"/></div>
                    <div class="range_element range_element__sep text-center"> &mdash; </div>
                    <div class="range_element range_inputs_element"><input class="after" type="text" data-wd_max="10" placeholder="0"/></div>
                    <div class="range_element range_element__kv text-center"> <?=$proj_settings['currencySymbol']?></div>
                    <div class="range_slider_element range_element"><div class="range range_price"></div></div>
                  </div>
                </div>
<!--                <div class="filters_element">-->
<!--                  <p class="heading">Стоимость строительства</p>-->
<!--                  <div class="range_inputs" id="slide_build_price">-->
<!--                    <div class="range_inputs_element range_element"><input class="before" type="text" placeholder="0"/></div>-->
<!--                    <div class="range_element range_element__sep text-center"> &mdash; </div>-->
<!--                    <div class="range_element range_inputs_element"><input class="after" type="text" placeholder="0"/></div>-->
<!--                    <div class="range_element range_element__kv text-center"> --><?//=$proj_settings['currencySymbol']?><!--</div>-->
<!--                    <div class="range_slider_element range_element"><div class="range range_build_price"></div></div>-->
<!--                  </div>-->
<!--                </div>-->
              </div>
            </div>

            <div class="filters_element">
              <p class="idom_switcher-box__title">Гараж (Кол-во автомест)</p>
              <div class="form_element">
                <?php
                $garaj = ['0'=>'0','1'=>'1','2'=>'2','3'=>'3+'];
                foreach ($garaj as $key=>$val) { ?>
                  <div class="checkbox checkbox_var-2">
                     <input type="checkbox" value="<?=$key?>" class="garaj" name="garaj" <?=in_array($key,$filter['garaj'])?'checked':''?> />
                    <label><span><?=$val?></span></label>
                  </div>
                <?php } ?>
              </div>
            </div>

            <div class="filters_element">
              <p class="idom_switcher-box__title">Комнаты</p>
              <p class="heading">Спальни <span class="idom-tooltip" data-toggle="tooltip" data-placement="top" title="Если вам нужно 4 спальных комнаты, но не нашли подходящего варианта, выберите 3 и ниже выберите кабинет. В такой конфигурации кабинет можно заменить на любое помещение.">?</span></p>
              <div class="form_element">
                <?php
                $spalni = ['1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5+'];
                foreach ($spalni as $key=>$val) { ?>
                  <div class="checkbox checkbox_var-2">
                    <input type="checkbox" value="<?=$key?>" class="spalni" name="spalni" <?=in_array($key,$filter['spalni'])?'checked':''?> />
                    <label><span><?=$val?></span></label>
                  </div>
                <?php } ?>
              </div>
            </div>

            <div class="filters_element">
              <p class="heading">Санузлы <span class="idom-tooltip" data-toggle="tooltip" data-placement="top" title="Санузлы включают также и ванные комнаты">?</span></p>
              <div class="form_element">
                <?php
                $zanuzel = ['1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5+'];
                foreach ($zanuzel as $key=>$val) { ?>
                  <div class="checkbox checkbox_var-2">
                    <input type="checkbox" value="<?=$key?>" class="zanuzel" name="zanuzel" <?=in_array($key,$filter['zanuzel'])?'checked':''?> />
                    <label><span><?=$val?></span></label>
                  </div>
                <?php } ?>
              </div>
            </div>

            <?php /* [+] Доработки декабрь 2020 */ ?>
            <div class="filters_element filters_element--kotelna">
              <div class="form_element">
                  <?php
                  foreach (\app\models\DopPr::find()->andWhere(['category' => 'rooms'])->orderBy(['position'=>SORT_ASC])->asArray()->all() as $dop)
                  { ?>
                      <div class="checkbox">
                          <input type="checkbox" name="dop[]" class="dop_vall" value="<?=$dop['id']?>" <?=in_array($dop['id'],$filter['dop'])?'checked':''?> />
                          <label><span><?=$dop['name']?></span></label>
                      </div>
                  <?php  } ?>
              </div>
            </div>
            <?php /* [-] Доработки декабрь 2020 */ ?>

            <div class="filters_element">
              <p class="idom_switcher-box__title">Внешние особенности</p>
              <p class="heading">Эркер</p>
              <div class="form_element">
                <?php
                $erker = ['0'=>'0','1'=>'1','2'=>'2+'];
                foreach ($erker as $key=>$val) { ?>
                  <div class="checkbox checkbox_var-2">
                    <input type="checkbox" value="<?=$key?>" class="erker" name="erker" <?=in_array($key,$filter['erker'])?'checked':''?> />
                    <label><span><?=$val?></span></label>
                  </div>
                <?php } ?>
              </div>

              <?php /* [+] Доработки декабрь 2020 */ ?>
              <div class="form_element form_element--vnesh">
                  <?php
                  foreach (\app\models\DopPr::find()->andWhere(['category' => 'outer'])->orderBy(['position'=>SORT_ASC])->asArray()->all() as $dop)
                  { ?>
                      <div class="checkbox">
                          <input type="checkbox" name="dop[]" class="dop_vall" value="<?=$dop['id']?>" <?=in_array($dop['id'],$filter['dop'])?'checked':''?> />
                          <label><span><?=$dop['name']?></span></label>
                      </div>
                  <?php  } ?>
                  <?php
                  foreach (\app\models\DopInfo::find()->andWhere(['category' => 'outer'])->orderBy(['position'=>SORT_ASC])->asArray()->all() as $dopInfo)
                  { ?>
                      <div class="checkbox">
                          <input type="checkbox" name="dopInfo[]" class="dop_vall1" value="<?=$dopInfo['id']?>" <?=in_array($dopInfo['id'],$filter['dopInfo'])?'checked':''?> />
                          <label><span><?=$dopInfo['name']?></span></label>
                      </div>
                  <?php  } ?>
              </div>
              <?php /* [-] Доработки декабрь 2020 */ ?>
            </div>

            <?php /* [+] Доработки декабрь 2020 */ ?>
            <div class="filters_element">
              <p class="idom_switcher-box__title">Внутренние особенности</p>
              <div class="form_element">
                  <?php
                  foreach (\app\models\DopPr::find()->andWhere(['category' => 'inner'])->orderBy(['position'=>SORT_ASC])->asArray()->all() as $dop)
                  { ?>
                      <div class="checkbox">
                          <input type="checkbox" name="dop[]" class="dop_vall" value="<?=$dop['id']?>" <?=in_array($dop['id'],$filter['dop'])?'checked':''?> />
                          <label><span><?=$dop['name']?></span></label>
                      </div>
                  <?php  } ?>
                  <?php
                  foreach (\app\models\DopInfo::find()->andWhere(['category' => 'inner'])->orderBy(['position'=>SORT_ASC])->asArray()->all() as $dopInfo)
                  { ?>
                      <div class="checkbox">
                          <input type="checkbox" name="dopInfo[]" class="dop_vall1" value="<?=$dopInfo['id']?>" <?=in_array($dopInfo['id'],$filter['dopInfo'])?'checked':''?> />
                          <label><span><?=$dopInfo['name']?></span></label>
                      </div>
                  <?php  } ?>
              </div>
              </div>
            <?php /* [-] Доработки декабрь 2020 */ ?>

            <?php /* [+] Доработки декабрь 2020 */ ?>
            <div class="filters_element">
              <p class="idom_switcher-box__title">Форма</p>
              <div class="form_element">
                  <?php
                  foreach (\app\models\DopInfo::find()->andWhere(['category' => 'form'])->orderBy(['position'=>SORT_ASC])->asArray()->all() as $dopInfo)
                  { ?>
                      <div class="checkbox">
                          <input type="checkbox" name="dopInfo[]" class="dop_vall1" value="<?=$dopInfo['id']?>" <?=in_array($dopInfo['id'],$filter['dopInfo'])?'checked':''?> />
                          <label><span><?=$dopInfo['name']?></span></label>
                      </div>
                  <?php  } ?>
              </div>
            </div>
            <?php /* [-] Доработки декабрь 2020 */ ?>

            <?php /* [+] Доработки декабрь 2020 */ ?>
            <div class="filters_element filters_element--krisha">
              <div class="row">
                <div class="col-6">
                  <p class="idom_switcher-box__title">Крыша</p>
                  <div class="form_element">
                      <?php
                      foreach (\app\models\DopInfo::find()->andWhere(['category' => 'roof'])->orderBy(['position'=>SORT_ASC])->asArray()->all() as $dopInfo)
                      { ?>
                          <div class="checkbox checkbox--fluid">
                              <input type="checkbox" name="dopInfo[]" class="dop_vall1" value="<?=$dopInfo['id']?>" <?=in_array($dopInfo['id'],$filter['dopInfo'])?'checked':''?> />
                              <label><span><?=$dopInfo['name']?></span></label>
                          </div>
                      <?php  } ?>
                  </div>
                </div>
                <div class="col-6">
                  <p class="idom_switcher-box__title">Прочее</p>
                  <div class="form_element">
                      <?php
                      foreach (\app\models\DopInfo::find()->andWhere(['category' => 'other'])->orderBy(['position'=>SORT_ASC])->asArray()->all() as $dopInfo)
                      { ?>
                          <div class="checkbox checkbox--fluid">
                              <input type="checkbox" name="dopInfo[]" class="dop_vall1" value="<?=$dopInfo['id']?>" <?=in_array($dopInfo['id'],$filter['dopInfo'])?'checked':''?> />
                              <label><span><?=$dopInfo['name']?></span></label>
                          </div>
                      <?php  } ?>
                  </div>
                </div>
              </div>
            </div>
            <?php /* [-] Доработки декабрь 2020 */ ?>


          </div>

          <?php /* [+] Доработки декабрь 2020 */ ?>
          <div class="filters_list__footer">
            <button class="filters_list__button filters_list__button--go js-mobile-filter-close">Применить</button>
            <button onclick="window.location='/catalog/proekty-domov/reset_filer';" class="filters_list__button filters_list__button--reset<?php if(empty($filter)): ?> is-disabled<?php endif; ?>">Сбросить</button>
          </div>
          <?php /* [-] Доработки декабрь 2020 */ ?>
        </div>
      </div>
    </div>
  </div>

  <div class="idom_catalog-page--footer bg-white">

    <div class="row">
      <div class="col-12">
        <div class="text-center show-more" <?=$_GET['page']?'style="display: none;"':''?>>
          <a class="show-more__link" id="next_proj" data-count="<?=count($projects)+20?>" href="#" <?=($count-count($projects))>0?'':'style="display: none;"'?> >Показать ещё <b><?=($count-count($projects))<=20?($count-count($projects)):'20'?></b> из <b><?=$count-count($projects)?></b></a>
        </div>
      </div>
      <div class="col-12">
        <div class="idom_pagination">
          <?php
          echo \yii\widgets\LinkPager::widget([
            'pagination' => $pages,
            'options' => [
              'class' => '',
            ],
            'prevPageLabel'=>'Назад',
            'nextPageLabel'=>'Вперед',
          ]);
          ?>
        </div>
      </div>

      <div class="col-12">
        <?=$adv_settings['filter_bottom_banner']?>
      </div>
      <div class="col-12" style="padding: 30px 0 20px 0;">
          <!-- Yandex.RTB R-A-2365726-1 -->
          <div id="yandex_rtb_R-A-2365726-1"></div>
          <script>window.yaContextCb.push(()=>{
            Ya.Context.AdvManager.render({
              "blockId": "R-A-2365726-1",
              "renderTo": "yandex_rtb_R-A-2365726-1"
            })
          })
          </script>
      </div>

      <div class="col-12">
        <?php if($name_filter != 's-cenoj-na-stroitelstvo') {
          if (strpos($a, 'page') == false) {
            echo $pr_settings['text2'];
          }
        } else {
          if (strpos($a, 'page') == false) {
            echo $pr_settings['text2_price'];
          }
        }?>
      </div>
    </div>

  </div>

</div>

<noindex>

<script>

  $(function() {

    function slide_change_price ( event, ui ) {
      $(this).parents('.range_inputs').find('.before').val(ui.values[0]);
      $(this).parents('.range_inputs').find('.after').val(ui.values[1]);

      $('.filters_list__button--go').removeAttr('disabled');

      $.fn.changeDeleteLink();
    };

    $(".range_price").slider({
      range: true,
      min: 0,
      max: <?=\app\models\Projects::find()->max('price_pr')?>*<?=$proj_settings['currencyIndex']?>,
      values: [ <?=$filter['st_pr_ot']?:0?>, <?=$filter['st_pr_do']?:\app\models\Projects::find()->max('price_pr')?>*<?=$proj_settings['currencyIndex']?>],
      slide: slide_change_price,
      stop: function(event, ui ) {
        var mass = {
          st_pr_ot: $( ".range_price" ).slider( "values", 0 ),
          st_pr_do: $( ".range_price" ).slider( "values", 1 )
        };
        get_pr(mass);
      }
    });

    $(".range_gb_d").slider({
      range: true,
      min: 0,
      step: 0.01,
      max: <?=\app\models\Projects::find()->max('dlina_doma')?>,
      values: [ <?=$filter['gb_d_ot']?:0?>, <?=$filter['gb_d_do']?:\app\models\Projects::find()->max('dlina_doma')?>],
      slide: slide_change_price,
      stop: function(event, ui ) {
          var mass = {
              gb_d_ot: $( ".range_gb_d" ).slider( "values", 0 ),
              gb_d_do: $( ".range_gb_d" ).slider( "values", 1 ),
              gb_s_ot: $( "#gb_h .before" ).val(),
              gb_s_do: $( "#gb_h .after" ).val(),
              only_fact_razmer: 0,
              only_inverse_razmer: 0
          };

          if($('.only_fact_razmer')[0].checked)
              mass['only_fact_razmer'] = 1;

          if($('.only_inverse_razmer')[0].checked)
              mass['only_inverse_razmer'] = 1;

          get_pr(mass);
      }
    });

    $(".range_gb_h").slider({
      range: true,
      min: 0,
      step: 0.01,
      max: <?=\app\models\Projects::find()->max('shirina_doma')?>,
      values: [ <?=$filter['gb_s_ot']?:0?>, <?=$filter['gb_s_do']?:\app\models\Projects::find()->max('shirina_doma')?>],
      slide: slide_change_price,
      stop: function(event, ui ) {
          var mass = {
              gb_s_ot: $( ".range_gb_h" ).slider( "values", 0 ),
              gb_s_do: $( ".range_gb_h" ).slider( "values", 1 ),
              gb_d_ot: $( "#gb_d .before" ).val(),
              gb_d_do: $( "#gb_d .after" ).val(),
              only_fact_razmer: 0,
              only_inverse_razmer: 0
          };
          if($('.only_fact_razmer')[0].checked)
              mass['only_fact_razmer'] = 1;

          if($('.only_inverse_razmer')[0].checked)
              mass['only_inverse_razmer'] = 1;
          get_pr(mass);
      }
    });

    function slide_change_build_price ( event, ui ) {
      $(this).parents('.range_inputs').find('.before').val(ui.values[0]);
      $(this).parents('.range_inputs').find('.after').val(ui.values[1]);

      $('.filters_list__button--go').removeAttr('disabled');

      $.fn.changeDeleteLink();
    };

    $(".range_build_price").slider({
      range: true,
      min: 0,
      max: <?=\app\models\Projects::find()->max('prcie_all')?>*<?=$proj_settings['currencyIndex']?>,
      values: [ <?=$filter['st_st_ot']?:0?>, <?=$filter['st_st_do']?:\app\models\Projects::find()->max('prcie_all')?>*<?=$proj_settings['currencyIndex']?>],
      slide: slide_change_build_price,
      stop: function(event, ui ) {
        var mass = {
          st_st_ot: $( ".range_build_price" ).slider( "values", 0 ),
          st_st_do: $( ".range_build_price" ).slider( "values", 1 )
        };
        get_pr(mass);
      }
    });

    function slide_change_square ( event, ui ) {
      $(this).parents('.range_inputs').find('.before').val(ui.values[0]);
      $(this).parents('.range_inputs').find('.after').val(ui.values[1]);

      $('.filters_list__button--go').removeAttr('disabled');

      $.fn.changeDeleteLink();
    };

    $(".range_square").slider({
      range: true,
      min: 0,
      max: <?=\app\models\Projects::find()->max('area')?>,
      values: [ <?=$filter['area_ot']?:0?>, <?=$filter['area_do']?:\app\models\Projects::find()->max('area')?>],
      slide: slide_change_square,
      stop: function(event, ui ) {
        var mass = {
          area_ot: $( ".range_square" ).slider( "values", 0 ),
          area_do: $( ".range_square" ).slider( "values", 1 )
        };
        get_pr(mass);
      }

    });

    $("#slide_price").on("keyup", function(){
      var mass = {
        st_pr_ot: $( ".range_price" ).slider( "values", 0 ),
        st_pr_do: $( ".range_price" ).slider( "values", 1 )
      };
      get_pr(mass);
    });

    $("#gb_h").on("keyup", function(){
      var mass = {
        gb_s_ot: $( ".range_gb_h" ).slider( "values", 0 ),
        gb_s_do: $( ".range_gb_h" ).slider( "values", 1 ),
        gb_d_ot: $( "#gb_d .before" ).val(),
        gb_d_do: $( "#gb_d .after" ).val()
      };
      get_pr(mass);
    });

    $("#gb_d").on("keyup", function(){
      var mass = {
        gb_d_ot: $( ".range_gb_d" ).slider( "values", 0 ),
        gb_d_do: $( ".range_gb_d" ).slider( "values", 1 ),
        gb_s_ot: $( "#gb_h .before" ).val(),
        gb_s_do: $( "#gb_h .after" ).val()
      };
      get_pr(mass);
    });

    $("#slide_build_price").on("keyup", function(){
      var mass = {
        st_st_ot: $( ".range_build_price" ).slider( "values", 0 ),
        st_st_do: $( ".range_build_price" ).slider( "values", 1 )
      };
      get_pr(mass);
    });
    $("#slide_squat").on("keyup", function(){
      var mass = {
        area_ot: $( ".range_square" ).slider( "values", 0 ),
        area_do: $( ".range_square" ).slider( "values", 1 )
      };
      get_pr(mass);
    });

    $( "#style_select" ).change(function() {
      var mass = {
        style_pr: $(this).val()
      };
      get_pr(mass);
    });

    $( "#townhouse_s_select" ).change(function() {
      var mass = {
        townhouse_s: $(this).val()
      };
      get_pr(mass);
    });

    $( "#material_select" ).change(function() {
      var mass = {
        material: $(this).val()
      };
      get_pr(mass);
    });

    $('.dop_vall').click(function() {
      var mass = {};
      var i=0;
      $(".dop_vall").each(function(){
        if ($(this)[0].checked) {
          mass[i] = $(this).val();
          i++;
        }
      });
      var res = {dop: 'all_reset'};
      if(i>0)
          res = {dop: mass};

      get_pr(res);
    });

    $('.dop_vall1').click(function() {
      var mass = {};
      var i=0;
      $(".dop_vall1").each(function(){
        if ($(this)[0].checked) {
          mass[i] = $(this).val();
          i++;
        }
      });
      var res = {dopInfo: 'all_reset'};
      if(i>0)
        res = {dopInfo: mass};

      get_pr(res);
    });

    $('.mansard').click(function() {
      var mass = {};
      var i=0;
      $(".mansard").each(function(){
        if ($(this)[0].checked) {
          mass[i] = $(this).val();
          i++;
        }
      });
      var res = {mansard: 'all_reset'};
      if(i>0)
        res = {mansard: mass};
      get_pr(res);
    });

    $('.cokol').click(function() {
      var mass = {};
      var i=0;
      $(".cokol").each(function(){
        if ($(this)[0].checked) {
          mass[i] = $(this).val();
          i++;
        }
      });
      var res = {cokol: 'all_reset'};
      if(i>0)
        res = {cokol: mass};
      get_pr(res);
    });

    $('.pogreb').click(function() {
      var mass = {};
      var i=0;
      $(".pogreb").each(function(){
        if ($(this)[0].checked) {
          mass[i] = $(this).val();
          i++;
        }
      });
      var res = {pogreb: 'all_reset'};
      if(i>0)
        res = {pogreb: mass};
      get_pr(res);
    });

    $('.is_popular').click(function() {
      var mass = {};
      var i=0;
      $(".is_popular").each(function(){
        if ($(this)[0].checked) {
          mass[i] = $(this).val();
          i++;
        }
      });
      var res = {is_popular: 'all_reset'};
      if(i>0)
        res = {is_popular: mass};
      get_pr(res);
    });

    $('.is_sale').click(function() {
      var mass = {};
      var i=0;
      $(".is_sale").each(function(){
        if ($(this)[0].checked) {
          mass[i] = $(this).val();
          i++;
        }
      });
      var res = {is_sale: 'all_reset'};
      if(i>0)
        res = {is_sale: mass};
      get_pr(res);
    });



    $('.eta').click(function() {
      var mass = {};
      var i=0;
      $(".eta").each(function(){
        if ($(this)[0].checked) {
          mass[i] = $(this).val();
          i++;
        }
      });
      var res = {eta: 'all_reset'};
      if(i>0)
        res = {eta: mass};
      get_pr(res);
    });

      $('.cenoj').click(function() {

          var res = {cenoj: 'all_reset'};
          if($(this)[0].checked)
              res = {cenoj: 1};
          get_pr(res);
      });


      $('.only_fact_razmer').click(function(e) {
          if(!$('.only_inverse_razmer')[0].checked)
          {
              e.preventDefault();
              return false;
          }
          var res = {only_fact_razmer: 0};

          if($('.only_fact_razmer')[0].checked)
              res = {only_fact_razmer: 1};

          get_pr(res);
      });

      $('.only_inverse_razmer').click(function(e) {
          if(!$('.only_fact_razmer')[0].checked)
          {
              e.preventDefault();
              return false;
          }
          var res = {only_inverse_razmer: 0};

          if($('.only_inverse_razmer')[0].checked)
              res = {only_inverse_razmer: 1};

          get_pr(res);
      });

    $('.spalni').click(function() {
      var mass = {};
      var i=0;
      $(".spalni").each(function(){
        if ($(this)[0].checked) {
          mass[i] = $(this).val();
          i++;
        }
      });
      var res = {spalni: 'all_reset'};
      if(i>0)
        res = {spalni: mass};
      get_pr(res);
    });

    $('.zanuzel').click(function() {
      var mass = {};
      var i=0;
      $(".zanuzel").each(function(){
        if ($(this)[0].checked) {
          mass[i] = $(this).val();
          i++;
        }
      });
      var res = {zanuzel: 'all_reset'};
      if(i>0)
        res = {zanuzel: mass};
      get_pr(res);
    });



    $('.erker').click(function() {
      var mass = {};
      var i=0;
      $(".erker").each(function(){
        if ($(this)[0].checked) {
          mass[i] = $(this).val();
          i++;
        }
      });
      var res = {erker: 'all_reset'};
      if(i>0)
        res = {erker: mass};
      get_pr(res);
    });


    $('.garaj').click(function() {
      var mass = {};
      var i=0;
      $(".garaj").each(function(){
        if ($(this)[0].checked) {
          mass[i] = $(this).val();
          i++;
        }
      });
      var res = {garaj: 'all_reset'};
      if(i>0)
        res = {garaj: mass};
      get_pr(res);
    });


    $(document).on("click", ".sort_type_c", function(e) {
      e.preventDefault();
      var type = 'down';
      var tp = $(this).attr('data-type');
      if($(this).hasClass('sorting-item--down'))
        type = 'up';

      type = $(this).attr('data-stype');

      //$('.sort_type_c').removeClass('sorting-item--up').removeClass('sorting-item--down');
      //$(this).addClass('sorting-item--'+type);
console.log(tp);
      var arr = {sort:{tp:tp,type:type}};
      get_pr(arr);
    });

    function get_pr(arr) {
        arr['name_filter'] = '<?php echo $name_filter; ?>';
      $.ajax({
        type: "POST",
        async: false,
        dataType: 'json',
        url: "/site/set_pr",
        data: arr,
        success: function(data,status) {
          if(data.status=='ok')
          {
              if(parseInt(data.total)>0) {
                  $('#count_find_projects').text(data.total);
              }else {
                  $('#count_find_projects').text("0");
              }
            if(parseInt(data.all)>0)
            {

              $('#next_proj').text('Показать ещё '+data.next+' из '+data.all);
              $('#next_proj').data('count',parseInt(data.limit));
              $('#next_proj').show();
            }
            else {
                $('#next_proj').hide();
            }

            $('#cont_projec').html(data.res);
            $('.idom_pagination').html(data.pages_link);
          }


          if ($('.fotorama-item').length != 0) {
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
        }
      });
    }

    $(document).on("click", "#next_proj", function(event) {
      event.preventDefault();
        let name_filter = '<?php echo $name_filter; ?>';
      $.ajax({
        type: "GET",
        async: false,
        dataType: 'json',
        url: "/site/get_pr",
        data: {
          limit: $(this).data('count'),
            name_filter: name_filter
        },
        success: function(data,status) {
          if(data.status=='ok')
          {
            if(parseInt(data.all)>0)
            {
              $('#next_proj').text('Показать ещё '+data.next+' из '+data.all);
              $('#next_proj').show();
              $('#next_proj').data('count',parseInt(data.limit));
            }
            else
              $('#next_proj').hide();
            $('#cont_projec').html(data.res);
            $('.idom_pagination').html(data.pages_link);
          }


          if ($('.fotorama-item').length != 0) {
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
        }
      });
    });




    $('.range_inputs').each(function() {
      var before = $(this).find( ".range" ).slider( "values", 0 ),
        after = $(this).find( ".range" ).slider( "values", 1 );

      $(this).find('.before').val(before);
      $(this).find('.after').val(after);

      $(this).find('.before').bind("change keyup input click", function() {
        //alert(1);
        $(this).parents('.range_inputs').find('.range').slider( "values", 0, $(this).val() );
      });
      $(this).find('.after').bind("change keyup input click", function() {
        $(this).parents('.range_inputs').find('.range').slider( "values", 1, $(this).val() );
      });
    });
  });

  $(document).on("click", ".proj_in_title", function(){
    $($($(this).data("target")).find("h2 strong")).text($(this).data("project"));
    $("#smeta_project").val($(this).data("project"));
  });


  $(document).on("ready", function(){
    $.fn.changeDeleteLink();
  });

  $(document).on("change click focus", ".before, .after, #townhouse_s_select, #style_select, #material_select, .cenoj, .eta, .cokol, .pogreb, .spalni, .zanuzel, .erker, .garaj, .dop_vall, .dop_vall1, .is_popular, .is_sale", function(){
      $.fn.changeDeleteLink();
  });
  (function($) {
    //////////////////////////////////////////////////////////////////////////////////////////////////////
    $.fn.changeDeleteLink = function () {
      var value_2 = $("#slide_price .before").val();
      var value_3 = $("#slide_price .after").val();
      var value_21 = $("#slide_build_price .before").val();
      var value_31 = $("#slide_build_price .after").val();
      var value_4 = $("#townhouse_s_select").val();
      var value_5 = $("#style_select").val();
      var value_6 = $("#material_select").val();

      var urlEnd = window.location.href;

      var check_1 = 0;
      $(".eta").each(function(){
        if ($(this).prop('checked')) {
          check_1 += 1
        } else {}
      });
      var check_2 = 0;
      $(".cokol").each(function(){
        if ($(this).prop('checked')) {
          check_2 += 1
        } else {}
      });
      var check_2_21 = 0;
      $(".pogreb").each(function(){
        if ($(this).prop('checked')) {
          check_2_21 += 1
        } else {}
      });
      var check_2_1 = 0;
      $(".is_popular").each(function(){
        if ($(this).prop('checked')) {
          check_2_1 += 1
        } else {}
      });
      var check_2_2 = 0;
      $(".is_sale").each(function(){
        if ($(this).prop('checked')) {
          check_2_2 += 1
        } else {}
      });

      var check_3 = 0;
      $(".spalni").each(function(){
        if ($(this).prop('checked')) {
          check_3 += 1
        } else {}
      });

      var check_3_31 = 0;
      $(".zanuzel").each(function(){
        if ($(this).prop('checked')) {
          check_3_31 += 1
        } else {}
      });

      var check_3_32 = 0;
      $(".erker").each(function(){
        if ($(this).prop('checked')) {
          check_3_32 += 1
        } else {}
      });

      var check_3_33 = 0;
      $(".garaj").each(function(){
        if ($(this).prop('checked')) {
          check_3_33 += 1
        } else {}
      });

        var check_4_44 = 0;
        // if($(".cenoj")[0].checked)
        //     check_4_44 = 1;

      var value_7 = $("#slide_squat .before").val();
      var value_8 = $("#slide_squat .after").val();
      var value_9 = $("#gb_h .before").val();
      var value_10 = $("#gb_h .after").val();
      var value_11 = $("#gb_d .before").val();
      var value_12 = $("#gb_d .after").val();

      var check_4 = 0;
      $(".dop_vall").each(function(){
        if ($(this).prop('checked')) {
          check_4 += 1
        } else {}
      });

      var check_4_21 = 0;
      $(".dop_vall1").each(function(){
        if ($(this).prop('checked')) {
          check_4_21 += 1
        } else {}
      });


      if (value_2 != 0 || value_3 != <?=\app\models\Projects::find()->max('price_pr')?> || value_4 != 'all_reset' || value_5 != 'all_reset' || value_6 != 'all_reset' || check_1 != 0 || check_2 != 0 || check_2_21 != 0 || check_2_1 != 0 || check_2_2 != 0 || check_3 != 0|| check_3_31 != 0 || check_3_32 != 0 || check_3_33 != 0  || check_4_44 !=0 || value_7 != 0 || value_8 != <?=\app\models\Projects::find()->max('area')?> || value_9 != 0 || value_10 != parseFloat(<?=\app\models\Projects::find()->max('shirina_doma')?>) || value_11 != 0 || value_12 != parseFloat(<?=\app\models\Projects::find()->max('dlina_doma')?>) || check_4 != 0 || check_4_21 != 0 || urlEnd.indexOf("/best") != -1 || urlEnd.indexOf("/new") != -1 || urlEnd.indexOf("/sale") != -1) {
        $("#filters_element-fixed a").removeClass('is-disabled');
        $('#count_find_word').html('Найдено проектов: ');
      } else {
          $("#filters_element-fixed a").addClass('is-disabled');
          $('#count_find_word').html('Найдено проектов: ');
      }
     /* console.log(value_2);
      console.log(value_3);
      console.log(value_21); /!*value_21 != 0 || value_31 != /*\app\models\Projects::find()->max('prcie_all')* ||*!/
      console.log(value_31);
      console.log(value_4);
      console.log(value_5);
      console.log(value_6);
      console.log(check_1);
      console.log(check_2);
      console.log(check_2_21);
      console.log(check_2_1);
      console.log(check_2_2);
      console.log(check_3);
      console.log(check_3_31);
      console.log(check_3_32);
      console.log(check_3_33);
      console.log(check_4_44);
      console.log(value_7);
      console.log(value_8);
      console.log(value_9);
      console.log(value_10);
      console.log(value_11);
      console.log(value_12);
      console.log(check_4);
      console.log(check_4_21);*/
      return this;
    };
  })(jQuery);
</script>
</noindex>
