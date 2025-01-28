<?php

$contacts_info = \app\models\Contacts::find()->asArray()->one();

$this->title = $rec['title']; // Только для укр версии
$this->registerMetaTag(['name' => 'description', 'content' => $rec['description']]);


$pr_settings = \app\models\ProjSettings::find()->asArray()->one();


$ids = [];
if($_COOKIE['ids_cart'])
  $ids = json_decode($_COOKIE['ids_cart'],true);


$count_izb = Yii::$app->session['izbrannoe'] ? unserialize(Yii::$app->session['izbrannoe']) : array();

$class_izb = '';
if(in_array($rec['id'],$count_izb)) {
  $class_izb = ' active';
}

$count_comparison = Yii::$app->session['comparison'] ? unserialize(Yii::$app->session['comparison']) : array();

$class_comparison = '';
if(in_array($rec['id'],$count_comparison)) {
  $class_comparison = ' active';
}

  $adv_settings = \app\models\AdvSettings::find()->asArray()->one();

  $dop_rs = explode(',',$rec['dop']);
?>


<div class="idom_broadcrumbs" style="padding-bottom: 0px;">
  <div class="container">
    <ul itemscope itemtype="http://schema.org/BreadcrumbList">
      <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
        <a itemprop="item" href="/"><span itemprop="name"><?=$_SERVER['HTTP_HOST']?></span></a>
        <meta itemprop="position" content="1" />
      </li>
      <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
        <a itemprop="item" href="/catalog/proekty-domov"><span itemprop="name">Каталог проектов</span></a>
        <meta itemprop="position" content="2" />
      </li>
      <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
        <span itemprop="name"><?=$rec['num_pr']?></span>
        <meta itemprop="position" content="3" />
      </li>
    </ul>
  </div>
</div>

<div class="idom_item-page bg-white">

  <div class="container" itemscope itemtype="http://schema.org/Product">
    <h1 itemprop="name"><?=$rec['h1'.$region_flag]?></h1>
    <meta itemprop="sku" content="<?=$rec['num_pr']?>">
    <meta itemprop="mpn" content="<?=$rec['num_pr']?>">
    <meta itemprop="brand" content="idompk">
    <div class="idom_item-page_top-info">
      <div class="row">
        <div class="idom_item-page_top-info__top-row col-lg-8 d-block d-sm-flex justify-content-between align-items-center">
          <div class="idom_item-page_top-info__number">Номер: <span><?=$rec['num_pr']?></span></div>
          <div class="idom_item-page_top-info__controls">
            <div class="ya-share2" data-curtain data-services="vkontakte,facebook,odnoklassniki,telegram,viber,whatsapp"<?php foreach (unserialize($rec['images']) as $img) { ?> data-image="https://idompk.ru/img/uploads/projects/thumb/<?=$img?>"<?php } ?>></div>
            <div class="idom_add-to">
              <a class="to-favorite<?=$class_izb?>" href="#to-favorite" data-id="<?=$rec['id']?>"><span><?php if(!empty($class_izb)): ?>Удалить<?php else: ?>Избранное<?php endif; ?></span></a>
              <a class="to-comparison<?=$class_comparison?>" href="#to-comparison" data-id="<?=$rec['id']?>"><span><?php if(!empty($class_comparison)): ?>Удалить<?php else: ?>Сравнение<?php endif; ?></span></a>
            </div>
          </div>
        </div>
        <div class="col-lg-4 d-flex justify-content-between">
          <?php if($rec['is_have']) { ?><div class="idom_in-sale"><i class="idom_icon-img"></i>Проект есть в наличии</div><?php }?>
          <a class="idom_item-page_top-info__pdf" href="/site/pdf?name=<?=$rec['num_pr']?>" target="_blank"><i class="idom_icon idom_icon-print"></i>Версия для печати</a>
        </div>
      </div>

    </div>
    <div class="row">
      <div class="col-lg-8">

        <div class="idom_project-slides">
          <div class="fotorama-in">
            <?php foreach (unserialize($rec['images']) as $img) { ?>
              <a itemprop="image" href="/img/uploads/projects/original/<?=$img?>" title="Проект <?=$rec['num_pr']?>"><img src="/img/uploads/projects/thumb/<?=$img?>" alt="Проект <?=$rec['num_pr']?>"></a>
            <?php } ?>
          </div>
          <?php if ($rec['is_zerkal']) {?>
            <a href="#miracle" id="js-idom_miracle" title="Зеркальное исполнение"><i class="idom_icon idom_icon-miracle"></i></a>
            <input class="d-none" id="idom_line__z" type="checkbox" />
          <?php }?>
        </div>



        <div class="idom_short-info">
          <div class="idom_item">
            <i class="idom_icon idom_icon-pr-1"></i>
            <span class="b"><?=$rec['area']?> м<sup>2</sup></span>
            <span class="idom_name">Полезная<br/> площадь</span>
          </div>
          <div class="idom_item">
            <i class="idom_icon idom_icon-pr-2"></i>
            <span class="b"><?=$rec['area_tb']?> м<sup>2</sup></span>
            <span class="idom_name">Террасы<br/> и балконы</span>
          </div>
          <div class="idom_item">
            <i class="idom_icon idom_icon-pr-3"></i>
            <?php
            $text_garaj = '';
            if($rec['garaj'] == 1) {$text_garaj = '<span class="b">1</span><span class="idom_name">Количество<br/> автомест</span>';} else if($rec['garaj'] == 2) {$text_garaj = '<span class="b">2</span><span class="idom_name">Количество<br/> автомест</span>';} else if($rec['garaj'] == 3) {$text_garaj = '<span class="b">3</span><span class="idom_name">Количество<br/> автомест</span>';} else if($rec['garaj'] == 4) {$text_garaj = '<span class="b">4</span><span class="idom_name">Количество<br/> автомест</span>';} else if($rec['garaj'] > 4) {$text_garaj = '<span class="b">5+</span><span class="idom_name">Количество<br/> автомест</span>';}
            if ($text_garaj == '') {
              $text_garaj = '<span class="b">0</span><span class="idom_name">Без<br/> гаража</span>';
            }
            echo $text_garaj;
            ?>
          </div>
          <div class="idom_item">
            <i class="idom_icon idom_icon-pr-4"></i>
            <span class="b">
              <?=$rec['spalen']?>
              <?=in_array('-13-',$dop_rs)?print_r('+ '): '' ?>
            </span>
            <span class="idom_name">Количество<br/> спален</span>
          </div>
          <div class="idom_item">
            <i class="idom_icon idom_icon-pr-5"></i>
            <span class="b"><?=$rec['zanuzel']?></span>
            <span class="idom_name">Количество<br/> санузлов</span>
          </div>
        </div>

      </div>
      <div class="col-lg-4">

        <div class="idom_price-box">
          <div class="idom_head">
            <div class="row">
              <?php
              $new_price = $rec['price_pr']-($rec['price_pr']*($rec['is_sale']/100));
              ?>
              <div class="idom_head__col-price col col-lg-12" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                <meta itemprop="priceCurrency" content="RUB">
                <?php if($rec['is_sale'] != 0) { ?>
                  <span class="idom_price" itemprop="price" content="<?=$new_price*$pr_settings['currencyIndex']?>"><span class="b"><?=number_format($new_price*$pr_settings['currencyIndex'],0,'.','.')?></span><?=$pr_settings['currencySymbol']?></span>
                  <div class="idom_price-sale">Скидка <i><?=$rec['is_sale'];?>%</i> <span class="b"><?=number_format($rec['price_pr']*$pr_settings['currencyIndex'],0,'.','.')?></span><?=$pr_settings['currencySymbol']?></div>
                <?php } else { ?>
                  <span class="idom_price" itemprop="price" content="<?=$new_price?>"><span class="b"><?=number_format($new_price*$pr_settings['currencyIndex'],0,'.','.')?></span><?=$pr_settings['currencySymbol']?></span>
                <?php } ?>
                <link itemprop="availability" href="http://schema.org/InStock" />
                <meta itemprop="priceValidUntil" content="2030-11-05" />
                <noindex><a href="https://idompk.ru/catalog/proekty-domov/<?=$rec['num_pr']?>" itemprop="url" class="d-none" rel="nofollow"></a></noindex>
              </div>
              <div class="idom_head__col-buy col col-lg-12">
                <a href="#to-card" class="button button_green add_to_cart_n" data-id="<?=$rec['id']?>" data-num="<?=$rec['num_pr']?>"><?=$ids[$rec['id']]?'В корзине':'Купить проект'?></a>
              </div>
            </div>
            <?php if($rec['prcie_all'] != 0) { ?>
              <div class="idom_price-build text-left">
                <div class="row">
                  <div class="col">
                    <span style="display: block;line-height: 1;    margin-top: -3px; margin-bottom: 5px;">Строительство:</span>
                    <div class="idom_price-build__price"><span class="b"><span style="font-size:16px ">≈</span> <span class="idom_full-price"><?=number_format($rec['prcie_all']*$pr_settings['currencyIndex'],0,'.','.')?></span></span><?=$pr_settings['currencySymbol']?></div>
                  </div>
                  <div class="col">
                    <a href="#smeta" class="button button_green idom_price-build__sm" id="js-idom_ask-project-smeta" style="padding: 0; width: 100%" data-id="<?=$rec['id']?>" data-url="/catalog/proekty-domov/<?=$rec['num_pr']?>" data-image="/img/uploads/projects/original/<?=unserialize($rec['images'])[0]?>">Получить смету</a>
                  </div>
                </div>
                <div class="text-center">
                  <a class="idom_price-build__link jsToCalc" href="#toprice"><i style="position: absolute;transform: rotate(90deg);margin: 2px 0 0 -20px;font-style: normal;">➔</i>Калькулятор цены</a>
                </div>
              </div>
            <?php } else { ?>
            <div class="idom_price-build">
              <span class="idom_price-build__non-sm">Запросите предложение от строителей</span>
              <a href="#smeta" class="button button_green idom_price-build__sm" id="js-idom_ask-project-smeta" data-id="<?=$rec['id']?>" data-url="/catalog/proekty-domov/<?=$rec['num_pr']?>" data-image="/img/uploads/projects/original/<?=unserialize($rec['images'])[0]?>">Запросить смету</a>
              <span class="idom_price-build__calc">Проект дома можно приобрести отдельно.</span>
<!--              <span class="idom_price-build__non-sm">Стоимость строительcтва дома<br/> всего за 2 минуты! <br/><br/><a class="text-color-orange" href="/kalkulyator-stroitelstva-doma">Онлайн-калькулятор</a></span>-->
            </div>
            <?php } ?>
          </div>

          <div class="idom_footer" itemprop="additionalProperty" itemscope itemtype="http://schema.org/PropertyValue">
            <div class="idom_footer__dopinfo">
              <span class="idom_title" itemprop="name">Материалы и параметры</span>
            </div>
            <div class="row" itemprop="value" itemscope itemtype="http://schema.org/PropertyValue">
              <div class="col"><span class="font-weight-bold" itemprop="name">Этажность:</span></div>
              <div class="col" itemprop="value">
                <?php
                $text_ett = '';
                if($rec['cokol'] && $rec['mansard'])
                  $text_ett = '+ Мансардный + Цокольный';
                else if($rec['pogreb'] && $rec['mansard'])
                  $text_ett = '+ Мансардный + Погреб';
                else if($rec['cokol'])
                  $text_ett = '+ Цокольный';
                else if($rec['mansard'])
                  $text_ett = '+ Мансардный';
                else if($rec['pogreb'])
                  $text_ett = '+ Погреб';
                ?>
                <?=$rec['count_et'].''.$text_ett?>
              </div>
            </div>
            <div class="row" itemprop="value" itemscope itemtype="http://schema.org/PropertyValue">
              <div class="col"><span class="font-weight-bold" itemprop="name">Габариты:</span></div>
              <div class="col" itemprop="value"><?=$rec['shirina_doma']?> х <?=$rec['dlina_doma']?> м</div>
            </div>
            <div class="row" itemprop="value" itemscope itemtype="http://schema.org/PropertyValue">
              <div class="col"><span class="font-weight-bold" itemprop="name">Фундамент:</span></div>
              <div class="col" itemprop="value"><?=$rec['fundament']?></div>
            </div>
            <div class="row" itemprop="value" itemscope itemtype="http://schema.org/PropertyValue">
              <div class="col"><span class="font-weight-bold" itemprop="name">Материал стен:</span></div>
              <div class="col" itemprop="value"><?=$rec['desc_material']?></div>
            </div>
            <div class="row" itemprop="value" itemscope itemtype="http://schema.org/PropertyValue">
              <div class="col"><span class="font-weight-bold" itemprop="name">Перекрытия:</span></div>
              <div class="col" itemprop="value"><?=$rec['perekrytija']?></div>
            </div>
            <div class="row" itemprop="value" itemscope itemtype="http://schema.org/PropertyValue">
              <div class="col"><span class="font-weight-bold" itemprop="name">Тип крыши:</span></div>
              <div class="col" itemprop="value"><?=$rec['krysha']?></div>
            </div>
            <div class="row" itemprop="value" itemscope itemtype="http://schema.org/PropertyValue">
              <div class="col"><span class="font-weight-bold" itemprop="name">Кровельный материал:</span></div>
              <div class="col" itemprop="value"><?=$rec['krovlja']?></div>
            </div>
            <div class="row" itemprop="value" itemscope itemtype="http://schema.org/PropertyValue">
              <div class="col"><span class="font-weight-bold" itemprop="name">Наружная отделка:</span></div>
              <div class="col" itemprop="value"><?=$rec['fasad']?></div>
            </div>
            <div class="row" itemprop="value" itemscope itemtype="http://schema.org/PropertyValue">
              <div class="col"><span class="font-weight-bold" itemprop="name">Архитектурный стиль:</span></div>
              <div class="col" itemprop="value">
                <?php
                $stype_pr = \app\models\StylePr::find()->where(['id'=>$rec['style_pr']])->asArray()->one();
                $filter_pr = \app\models\FilterItem::find()->where(['name'=>$stype_pr['name']])->asArray()->one();
                if ($filter_pr) {
                  ?>
                  <a href="/catalog/proekty-domov/<?=$filter_pr['url']?>"><?=$filter_pr['name']?></a>
                <?php } else {?>
                  <?=$stype_pr['name']?>
                <?php } ?>
              </div>
            </div>
            <div class="row pt-2 idom_bottom">
              <div class="col"><span class="b">Дом содержит:</span>
                <?php
                $text_garaj = '';
                if($rec['garaj'] == 1) {$text_garaj = 'Гараж (1 место)';} else if($rec['garaj'] == 2) {$text_garaj = 'Гараж (2 места)';} else if($rec['garaj'] == 3) {$text_garaj = 'Гараж (3 места)';} else if($rec['garaj'] == 4) {$text_garaj = 'Гараж (4 места)';} else if($rec['garaj'] > 4) {$text_garaj = 'Гараж (5+ мест)';}
                if ($text_garaj) {?>
                  <span class="item"><?=$text_garaj;?></span>
                <?php }
                $text_erker = '';
                if($rec['erker'] == 1) {$text_erker = 'Эркер (1 шт.)';} else if($rec['erker'] == 2) {$text_erker = 'Эркер (2 шт.)';} else if($rec['erker'] == 3) {$text_erker = 'Эркер (3 шт.)';} else if($rec['erker'] == 4) {$text_erker = 'Эркер (4 шт.)';} else if($rec['erker'] > 4) {$text_erker = 'Эркер (5+ шт.)';}
                if ($text_erker) {?>
                  <span class="item"><?=$text_erker;?></span>
                <?php }
                foreach (\app\models\DopPr::find()->orderBy(['position'=>SORT_ASC])->asArray()->all() as $dop) { ?>
                  <?=in_array('-'.$dop['id'].'-',$dop_rs)?'<span class="item">'.$dop['name'].'</span>':null?>
                <?php } ?>
              </div>
            </div>
            <div class="row pt-2">
              <div class="col"><span class="b">Состав документации:</span> <?=$rec['razd_pr']?></div>
            </div>
          </div>
        </div>

      </div>
      <div class="col-lg-8">
        <hr/>

        <div class="idom-projects-item__ask-info">
          <div>
            <span class="idom_phone-info">Консультация в WhatsApp: <strong><a class="idom_tel" href="https://api.whatsapp.com/send?phone=79952827078">+7 (995) 282-70-78</a></strong></span>
            <span class="idom_time-info">Ежедневно с 10:00 до 21:00</span>
            <span class="idom_time-info">Бесплатная доставка по всей России: 1-3 дня.</span>
          </div>
          <div>
            <a class="idom_ask" href="#ask" id="js-idom_ask-project" data-id="<?=$rec['id']?>" data-url="/catalog/proekty-domov/<?=$rec['num_pr']?>" data-image="/img/uploads/projects/original/<?=unserialize($rec['images'])[0]?>">Задать вопрос</a>
          </div>
        </div>

        <div>
          <?=$adv_settings['card_banner']?>
        </div>

        <div class="idom_tabs-info">
          <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#plans" role="tab" aria-controls="include" aria-selected="true">Планы этажей</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#include" role="tab" aria-controls="include" aria-selected="false">Состав проекта</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#pay" role="tab" aria-controls="pay" aria-selected="false">Оплата и доставка</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#addition" role="tab" aria-controls="addition" aria-selected="false">Доп. услуги</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane fade show active" id="plans" role="tabpanel">
              <div class="idompk-plan-reverse">
                <a href="#" class="idompk-plan-reverse__link" data-show="Отразить" data-hide="Оригинал" aria-label="Отразить"></a>
              </div>
              <div class="idompk-plans">
                <?php foreach (unserialize($rec['images_plan']) as $key => $img_plan) { ?>
                  <a class="with-caption d-block text-center mb-5" href="/img/uploads/projects/original/<?=$img_plan?>" title="Планировка <?=$key+1?>-го этажа проекта <?=$rec['num_pr']?>"><img src="/img/uploads/projects/medium/<?=$img_plan?>" alt="Планировка <?=$key+1?>-го этажа проекта <?=$rec['num_pr']?>"></a>
                <?php } ?>
              </div>
            </div>
            <div class="tab-pane fade" id="include" role="tabpanel">
              <?php
              $sostav_pr = \app\models\SostavItem::find()->where(['id'=>$rec['sostav']])->asArray()->one();
              ?>
              <?=$sostav_pr['text'];?>
            </div>
            <div class="tab-pane fade" id="pay" role="tabpanel"><?=$pr_settings['panel_2']?></div>
            <div class="tab-pane fade" id="addition" role="tabpanel"><?=$pr_settings['panel_3']?></div>
          </div>
        </div>

        <?php if($rec['prcie_all'] != 0) { ?>
        <div class="idom_builds_calc">

          <div class="idom_builds_calc__price-all">
            <span class="idom_builds_calc__price-all-title">Стоимость строительства</span>
            <span class="idom_builds_calc__price-all-price"><span class="b">≈</span><span class="idom_full-price"><?=number_format($rec['prcie_all']*$pr_settings['currencyIndex'],0,'.','.')?></span><?=$pr_settings['currencySymbol']?></span>
          </div>

          <div class="idom_credit-box idom_credit-box__item">
            <a href="#" class="idom-credit-box__collapser">Кредит от Сбербанка</a>
            <div class="idom_credit-box__content" style="display: none">
              <span class="idom_credit-box__top-info">Не более 8 000 000</span>
              <div class="idom_credit-box__line">
                <span class="idom_credit-box__line-title">Первоначальный взнос</span>
                <span style="display: none" id="jsSliderFirstValue">0</span>
                <div class="idom_credit-box__line-control"><span id="jsSliderFirstValuePrice">0</span><b><?=$pr_settings['currencySymbol']?></b></div>
                <div class="idom_credit-box__line-slide" id="jsSliderFirst"></div>
              </div>
              <div class="idom_credit-box__line">
                <span class="idom_credit-box__line-title">Срок кредита</span>
                <div class="idom_credit-box__line-control"><span id="jsSliderYearValue">0</span><b>лет</b></div>
                <div class="idom_credit-box__line-slide" id="jsSliderYear"></div>
              </div>
              <div class="idom_credit-box__line idom_credit-box__line--price">
                <div class="idom_credit-box__line-col"><span class="idom_credit-box__line-title-min">Процентная ставка</span><span class="idom_credit-box__line-numb" id="jsProcentAll"><?=$pr_settings['procentAll']?></span></div>
                <div class="idom_credit-box__line-col"><span class="idom_credit-box__line-title-min">Сумма кредита</span><span class="idom_credit-box__line-numb" id="jsSummCredit">0</span><span class="idom_credit-box__line-valute"><?=$pr_settings['currencySymbol']?></span></div>
                <div class="idom_credit-box__line-col"><span class="idom_credit-box__line-title-min">Ежемесячный платеж</span><span class="idom_credit-box__line-numb" id="jsMonthPrice">0</span><span class="idom_credit-box__line-valute"><?=$pr_settings['currencySymbol']?></span></div>
              </div>
              <div class="idom_credit-box__line idom_credit-box__line--bottom">
                <div class="idom_credit-box__line-col">
                  <span>Расчет кредита является ориентировочным и не является публичной офертой. <br/>Максимальная сумма кредита 8 000 000 Р для для объектов в Москве и Московской области. </span>
                </div>
                <div class="idom_credit-box__line-col">
                  <a class="idom_ask" href="#ask" id="js-idom_credit-project" data-id="<?=$rec['id']?>" data-url="/catalog/proekty-domov/<?=$rec['num_pr']?>" data-image="/img/uploads/projects/original/<?=unserialize($rec['images'])[0]?>">Отправить заявку</a>
                </div>
              </div>
            </div>
          </div>

          <?php /*
          <div class="idom_builds_calc__promo">
            <span class="idom_builds_calc__promo-title">Конфигуратор цены</span>
            <p>Стоимость строительства основана на базе локальной сметы. При покупке проекта <?=$rec['num_pr']?> будет перерасчет, при условии если компания iDomPK рассматривается в качестве подрядчика на строительство. Окончательная стоимость может отличаться от итоговой от 3 до 7%.</p>
            <a href="#to-card" class="button button_green add_to_cart_n" data-id="<?=$rec['id']?>" data-num="<?=$rec['num_pr']?>"><?=$ids[$rec['id']]?'В корзине':'Купить проект'?></a>
          </div> */ ?>

          <?php

          $vv = json_decode($rec['builds'],true);

          $a = 1;
          foreach ($vv as $vv1) {



            if ($vv1[0]) {
              $nameStep = \app\models\BuildsSteps::find()->where(['id'=>$vv1[0]])->asArray()->one();
            ?>
              <span class="idom_builds_calc__item-title"><?=$nameStep['name']?></span>
              <div class="idom_builds_calc__item">
                <ul class="nav nav-tabs" role="tablist">
                  <?php
                  $gg = count(json_decode(json_encode($vv1), true))-1;
                  for ($i = 1; $i <= $gg; ++$i) {
                    $subSteps = json_decode(json_encode($vv1[$i]), true);
                    if ($subSteps[0]) {
                      $nameSubStep = \app\models\BuildsSubSteps::find()->where(['id'=>$subSteps[0]])->asArray()->one();
                      ?>
                      <li class="nav-item"><a class="nav-link <?php if ($i == 1) {echo ('active');} ?>" data-toggle="tab" href="#tab-<?=$a?>-<?=$i?>" role="tab" aria-controls="include" aria-selected="<?php if ($i == 1) {echo ('true');} else {echo ('false');} ?>"><?=$nameSubStep['name']?></a></li>
                      <?php
                    }
                  }
                  ?>
                </ul>
                <div class="tab-content">
                  <?php
                  for ($i2 = 1; $i2 <= $gg; ++$i2) {
                    $subSteps2 = json_decode(json_encode($vv1[$i2]), true);
                    if ($subSteps2[0]) {
                      $nameSubStep2 = \app\models\BuildsSubSteps::find()->where(['id'=>$subSteps2[0]])->asArray()->one();
                      ?>
                      <div class="tab-pane <?php if ($i2 == 1) {echo ('active');} ?>" id="tab-<?=$a?>-<?=$i2?>" role="tabpanel">
                        <input type="hidden" class="jsPriceInput" value="<?=$subSteps2['price1'][0]*$pr_settings['currencyIndex']?>">
                        <input type="hidden" class="jsPriceInput" value="<?=$subSteps2['price2'][0]*$pr_settings['currencyIndex']?>">
                        <div class="row">
                          <div class="col-md-6">
                            <img src="/img/uploads/other/original/<?=unserialize($nameSubStep2['image'])[0]?>">
                          </div>
                          <div class="col-md-6">
                            <div class="idom_builds_calc__item-prices">
                              <div class="idom_builds_calc__item-prices-all"><span class="b">≈</span><span class="b b2">0</span><?=$pr_settings['currencySymbol']?></div>
                              <div class="idom_builds_calc__item-prices-line"><span class="tit">Работа:</span><span class="b"><?=number_format($subSteps2['price1'][0]*$pr_settings['currencyIndex'],0,'.','.')?></span> <?=$pr_settings['currencySymbol']?></div>
                              <div class="idom_builds_calc__item-prices-line"><span class="tit">Материалы:</span><span class="b"><?=number_format($subSteps2['price2'][0]*$pr_settings['currencyIndex'],0,'.','.')?></span> <?=$pr_settings['currencySymbol']?></div>
                             <!-- <a class="idom_builds_calc__item-prices-link idom_builds_calc__item-prices-link-<?=$a?>-<?=$i2?>" href="#">Спецификация</a> -->
                            </div>
                          </div>
                        </div>
                      </div>
                      <script>
                          $(document).on('click', '.idom_builds_calc__item-prices-link-<?=$a?>-<?=$i2?>', function(e){
                              e.preventDefault();
                              var sc = $(window).scrollTop();
                              $(".idom_overlay").fadeIn();
                              $('.bounce-loader').hide();
                              $(".idom_callback_form-d").remove();
                              $("body").append('<div class="idom_callback_form idom_callback_form-1 idom_callback_form-d idom_callback_form-d2" style="top:'+sc+'px"><i class="idom_icon idom_icon-close  idom_icon-close-thanks"></i><h2><?=$nameStep["name"]?>: Спецификация</h2><?=str_replace(array("\r\n", "\r", "\n"), '',  $nameSubStep2["text"]);?></div>');

                          });
                      </script>
                   <?php }
                  }
                  ?>
                </div>
              </div>
            <?php
              $a++;
            }
          }
          ?>
        </div>
        <?php } ?>

        <?php if($rec['dop_info']) { ?>
          <div class="idom_about-box">
            <h2>Описание проекта <?=$rec['num_pr']?></h2>
            <div itemprop="description"><?=$rec['dop_info']?></div>
          </div>
        <?php } else { ?>
          <div itemprop="description" class="d-none"><?=$rec['description'.$region_flag]?></div>
        <?php } ?>



      </div>
      <div class="col-lg-4">
        <div class="idom_info-box">
          <div class="idom_info-box__more">
            <div class="idom_info-title">Хотите внести правки?</div>
            <p>Проект дома <?=$rec['num_pr']?> может быть изменен в соответствии с вашими пожеланиями и/или адаптирован под ваш участок. Стоимость доработок оценивается индивидуально.</p>
          </div>
          <div class="idom_info-body">
            <a href="#change" class="button button_blue idom_link" id="js-idom_ask-project-change" data-id="<?=$rec['id']?>" data-url="/catalog/proekty-domov/<?=$rec['num_pr']?>" data-image="/img/uploads/projects/original/<?=unserialize($rec['images'])[0]?>">Отправить изменения</a>
          </div>
        </div>

        <?php
        $arr = \app\models\FilterItem::get_by_pr($rec);

          function test($substring, $array){
            foreach ($array as $item){
              if (strpos($item,$substring)!== false){
                return true;
              }
            }
            return false;
          }

        if(count($arr))
        { ?>
          <div class="idom_info-box idom_info-box__more-links">
            <div class="idom_info-box__more">
              <div class="idom_info-title">Основные категории</div>
            </div>
            <div class="idom_info-body <?=test('proekty-domov/new',$arr)?'body_cat':null?>">
              <?php foreach ($arr as $value): ?>
                <div <?=strpos($value, 'proekty-domov/new')?'class="fff"':null ?>><?php echo $value; ?></div>
              <?php endforeach; ?>
            </div>
          </div>
     <?php } ?>


        <div class="idom_info-box idom_info-box__rotator-project">
          <?php
          $prPrev = \app\models\Projects::find()->select(['id', 'num_pr', 'images'])->where(['=','townhouse_s',$rec['townhouse_s']])->orderBy(['id'=>SORT_DESC])->andWhere(['<','id',$rec['id']])->limit(1)->asArray()->all();
          if ($prPrev) { ?>
            <div class="idom_info-box__rotator-project-item">
              <a href="https://idompk.ru/catalog/proekty-domov/<?=$prPrev[0]['num_pr']?>"><img src="/img/uploads/projects/thumb/<?=unserialize($prPrev[0]['images'])[0]?>"></a>
              <a class="idom_info-box__rotator-project__link idom_info-box__rotator-project__link--prev" href="https://idompk.ru/catalog/proekty-domov/<?=$prPrev[0]['num_pr']?>">Предыдущий проект</a>
            </div>
          <?php } ?>

          <?php
          $prNext = \app\models\Projects::find()->select(['id', 'num_pr', 'images'])->where(['=','townhouse_s',$rec['townhouse_s']])->orderBy(['id'=>SORT_ASC])->andWhere(['>','id',$rec['id']])->limit(1)->asArray()->all();
          if ($prNext) { ?>
            <div class="idom_info-box__rotator-project-item">
              <a href="https://idompk.ru/catalog/proekty-domov/<?=$prNext[0]['num_pr']?>"><img src="/img/uploads/projects/thumb/<?=unserialize($prNext[0]['images'])[0]?>"></a>
              <a class="idom_info-box__rotator-project__link idom_info-box__rotator-project__link--next" href="https://idompk.ru/catalog/proekty-domov/<?=$prNext[0]['num_pr']?>">Следующий проект</a>
            </div>
          <?php } ?>
        </div>
        <div class="baza_znanij__list">
          <!-- Yandex.RTB R-A-2365726-7 -->
          <div id="yandex_rtb_R-A-2365726-7"></div>
          <script>
          window.yaContextCb.push(()=>{
            Ya.Context.AdvManager.render({
              "blockId": "R-A-2365726-7",
              "renderTo": "yandex_rtb_R-A-2365726-7"
            })
          })
          </script>
          <!--<h4>Статьи и советы</h4>
          <?php
          $baza = \app\models\BazaZnanijArticles::find()->orderBy(new \yii\db\Expression('rand()'))->limit(2)->all();
          foreach ($baza as $item) {
            ?>
            <div class="idom_articles__item">
              <div class="idom_articles__item-image">
                <a class="idom_articles__item-header-link" href="/baza-znanij/<?=$item->link_url?>" title="<?=$item->link_title?>">
                  <img src="/img/uploads/other/medium/<?=unserialize($item->img_preview)[0]?>" alt="<?=$item->link_title?>" />
                </a>
              </div>
              <div class="idom_articles__item-header">
                <a class="idom_articles__item-header-link" href="/baza-znanij/<?=$item->link_url?>" title="<?=$item->link_title?>"><?=$item->link_title?></a>
              </div>
            </div>
            <?php
          }
          ?>-->
        </div>
      </div>
    </div>
     <div style="padding: 40px 0 0 0;">
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

      <?php $modifications = $article->getModifications();
            if($modifications):
                $count_projects = count($modifications);
      ?>
      <div class="idom_more-items pb-5">
          <div class="text-left"><div class="h2">Варианты проекта (Модификации)</div></div>
          <div class="row idom_more-list" style="justify-content: left;">
              <?php
              $i=0;
                  foreach ($modifications as $project) {
                      $project = $project->toArray();
                      $style = '';
                      if($i > 5)
                          $style = 'display:none;';

                      echo '<div data-number="'.$i.'" class="col-md-6 col-lg-4 projectMain" style="'.$style.'">';
                      echo $this->render('block', ['rec' => $project]);
                      echo '</div>';
                      $i++;
                  }

              ?>
          </div>
          <?php if($count_projects > 6): ?>
          <div id="showMoreProjectsMainWrapper" class="show-more">
              <a id="showMoreProjectsMain" data-limit="6" href="#" class="show-more__link">Показать ещё <b id="projectsMainShow">6</b> из <b id="totalProjectsMain"><?php echo $count_projects; ?></b></a>
          </div>
      <?php endif; ?>
      </div>

      <?php endif; ?>
    <div class="idom_more-items pb-5">
      <div class="text-left"><div class="h2">Похожие по площади</div></div>
      <div class="row idom_more-list">
        <?php
        $cmin = $rec['area']-30;
        $cmax = $rec['area']+30;
        $cc = \app\models\Projects::find()->andWhere(['>=','area',$cmin])->andWhere(['<=','area',$cmax])->andWhere(['!=','id',$rec['id']])->asArray()->count();


        if ($cc == 0) {
          foreach (\app\models\Projects::find()->where(['!=', 'id', $rec['id']])->limit(3)->asArray()->all() as $pr_area) {
            echo '<div class="col-md-6 col-lg-4">';
            echo $this->render('block', ['rec' => $pr_area]);
            echo '</div>';
          }
        } else {
          if ($cc < 8) {
            foreach (\app\models\Projects::find()->andWhere(['>=','area',$cmin])->andWhere(['<=','area',$cmax])->andWhere(['!=','id',$rec['id']])->limit(3)->asArray()->all() as $pr_area) {
              echo '<div class="col-md-6 col-lg-4">';
              echo $this->render('block', ['rec' => $pr_area]);
              echo '</div>';
            }
          } else {
            if ($cc >= 8) {
              foreach (\app\models\Projects::find()->andWhere(['>=','area',$cmin])->andWhere(['<=','area',$cmax])->andWhere(['!=','id',$rec['id']])->limit(3)->asArray()->all() as $pr_area) {
                echo '<div class="col-md-6 col-lg-4">';
                echo $this->render('block', ['rec' => $pr_area]);
                echo '</div>';
              }
            }
          }
        }

        ?>
      </div>
      <a class="button_blue button" href="/catalog/proekty-domov">Вернуться в каталог</a>
    </div>
</div>
</div>
<script type="text/javascript" src="https://vk.com/js/api/share.js?95" charset="windows-1251" async></script>


<div
    class="idompk-modal-form idompk-modal-form--large idom_callback_formM idom_callback_form-1 idom_callback_form-ask-project-smeta"
    style="display: none"><i class="idom_icon idom_icon-close  idom_icon-close-thanks"></i><span
      class="idom_feedback-main__title">Запросить смету</span>
  <form class="idom_js_form_ask-project-smeta" method="post" id="idom_js_form_ask-project-smeta"
        enctype="multipart/form-data">
    <fieldset>
      <div class="row idom_feedback-main__row">
        <div class="col-md-12 idom_feedback-main__item">
          <p class="idompk-iagree2 mb-0">Если вы хотите сориентироваться по цене строительства, то воспользуйтесь нашим <a href="/kalkulyator-stroitelstva-doma">онлайн-калькулятором</a>. Если под сметой вы подразумеваете спецификацию материалов, то она есть в документации каждого проекта. Если же вы желаете получить предложение от нашего подрядчика, то заполните и отправьте данную форму.</p></div>
      </div>
      <div class="row idom_feedback-main__row">
        <div class="col-md-4 idom_feedback-main__item"><input class="idom_feedback-main__input"
                                                              name="idom_js_form_main_1__name" type="text"
                                                              placeholder="Ваше имя *" required></div>
        <div class="col-md-4 idom_feedback-main__item"><input class="idom_feedback-main__input idom_phone"
                                                              name="idom_js_form_main_1__phone" type="text"
                                                              placeholder="Телефон *" required></div>
        <div class="col-md-4 idom_feedback-main__item"><input class="idom_feedback-main__input"
                                                              name="idom_js_form_main_1__mail" type="text"
                                                              placeholder="E-mail *" required></div>
      </div>
      <div class="row idom_feedback-main__row">
        <div class="col-md-12 idom_feedback-main__item mb-1">
          <div class="idom-check-blue">
            <div class="radio"><input type="radio" name="idom_js_form_main_1__area" value="1" id="checkbox_444"
                                      checked="checked"> <label
                  for="checkbox_444"><span>У меня есть участок</span></label></div>
            <div class="radio"><input type="radio" name="idom_js_form_main_1__area" value="0" id="checkbox_555"> <label
                  for="checkbox_555"><span>У меня нет участка</span></label></div>
          </div>
        </div>
        <div class="col-md-12 idom_feedback-main__item jsAreaAddress"><input class="idom_feedback-main__input"
                                                                             name="idom_js_form_main_1__area_address"
                                                                             type="text"
                                                                             placeholder="Адрес участа или кадастровый номер">
        </div>
        <div class="col-md-12 idom_feedback-main__item jsAreaTime" style="display: none"><select
              class="idom_feedback-main__select" name="idom_js_form_main_1__area_time"
              style="font-weight: bold;color: #3d7caf;">
            <option value="Уже занимаюсь вопросом. Куплю в ближайшие 1-2 месяца">Уже занимаюсь вопросом. Куплю в
              ближайшие 1-2 месяца
            </option>
            <option value="Планирую приобрести в ближайшие 6 месяцев">Планирую приобрести в ближайшие 6 месяцев</option>
            <option value="Срок покупки участка не определён">Срок покупки участка не определён</option>
          </select></div>
      </div>
      <div class="row idom_feedback-main__row">
        <div class="col-md-12 idom_feedback-main__item"><label class="idom_feedback-main__label">Выберите срок начала
            строительства</label> <select class="idom_feedback-main__select" name="idom_js_form_main_1__build_time"
                                          style="font-weight: bold;color: #3d7caf;">
            <option value="Готов начать в ближайшие 1-2 месяца">Готов начать в ближайшие 1-2 месяца</option>
            <option value="Готов начать в ближайшие 6 месяцев">Готов начать в ближайшие 6 месяцев</option>
            <option value="Планирую начать строительство в следующем году">Планирую начать строительство в следующем
              году
            </option>
            <option value="Пока просто хочу понять стоимость дома">Пока просто хочу понять стоимость дома</option>
          </select></div>
      </div>
      <div class="row idom_feedback-main__row">
        <div class="col-md-12 idom_feedback-main__item"><textarea class="idom_feedback-main__textarea"
                                                                  name="idom_js_form_main_1__message"
                                                                  placeholder="Сообщение"></textarea></div>
      </div>
      <div class="row">
        <div class="col-md-9 idom_feedback-main__item mb-0">
          <div class="file" style="float: right; width: 200px; margin-bottom: 10px;"><input type="file"
                                                                                            name="idom_js_form_main_1__file[]"
                                                                                            data-placeholder="Прикрепите файл"
                                                                                            multiple><span
                class="file_text">Прикрепите файл</span>
            <div class="file_icon"><i class="idom_icon-2 idom_icon-2-download"></i></div>
          </div>
        </div>
        <div class="col-md-3 idom_feedback-main__item idom_feedback-main__item--submit mt-0 ">
          <div id="idom_js_form_main_1_captcha"></div>
          <input type="hidden" name="idom_js_form_main_1__form" value="Форма: Запрос сметы к проекту!"><input
              type="hidden" id="idom_feedback-main__name" name="name" value="<?= $rec['h1' . $region_flag] ?>"><input
              type="hidden" id="idom_feedback-main__id" name="ids" value="<?= $rec['id'] ?>"><input type="hidden"
                                                                                                    id="idom_feedback-main__url"
                                                                                                    name="url"
                                                                                                    value="/catalog/proekty-domov/<?= $rec['num_pr'] ?>"><input
              type="hidden" id="idom_feedback-main__image" name="image"
              value="/img/uploads/projects/original/<?= unserialize($rec['images'])[0] ?>"><input
              class="idom_feedback-main__button" style="width: 100% !important; max-width: none" type="submit"
              value="Отправить"></div>
      </div>
    </fieldset>
    <div class="idompk-iagree text-right">Нажимая кнопку «Отправить», я даю согласие на обработку моих персональных
      данных, в соответствии с Федеральным законом №152-ФЗ «О персональных данных».
    </div>
  </form>
</div>


<div
    class="idompk-modal-form idompk-modal-form--large idompk-modal-form idompk-modal-form--large idom_callback_formM idom_callback_form-1 idom_callback_form-ask-project"
    style="display: none"><i class="idom_icon idom_icon-close  idom_icon-close-thanks"></i><span
      class="idom_feedback-main__title">Вопрос по проекту</span>
  <form class="idom_js_form_ask-project" method="post" id="idom_js_form_ask-project" enctype="multipart/form-data">
    <fieldset>
      <div class="row idom_feedback-main__row">
        <div class="col-md-4 idom_feedback-main__item"><input class="idom_feedback-main__input"
                                                              name="idom_js_form_main_1__name" type="text"
                                                              placeholder="Ваше имя" required></div>
        <div class="col-md-4 idom_feedback-main__item"><input class="idom_feedback-main__input idom_phone"
                                                              name="idom_js_form_main_1__phone" type="text"
                                                              placeholder="Телефон" required></div>
        <div class="col-md-4 idom_feedback-main__item"><input class="idom_feedback-main__input"
                                                              name="idom_js_form_main_1__mail" type="text"
                                                              placeholder="E-mail"></div>
      </div>
      <div class="row idom_feedback-main__row">
        <div class="col-md-12 idom_feedback-main__item"><textarea class="idom_feedback-main__textarea"
                                                                  name="idom_js_form_main_1__message"
                                                                  placeholder="Ваше сообщение"></textarea></div>
      </div>
      <div class="row">
        <div class="col-md-12 idom_feedback-main__item idom_feedback-main__item--submit">
          <div id="idom_js_form_main_1_captcha"></div>
          <input type="hidden" name="idom_js_form_main_1__form" value="Форма: Задать вопрос по проекту!"><input
              type="hidden" id="idom_feedback-main__name" name="name" value="<?= $rec['h1' . $region_flag] ?>"><input
              type="hidden" id="idom_feedback-main__id" name="ids" value="<?= $rec['id'] ?>"><input type="hidden"
                                                                                                    id="idom_feedback-main__url"
                                                                                                    name="url"
                                                                                                    value="/catalog/proekty-domov/<?= $rec['num_pr'] ?>"><input
              type="hidden" id="idom_feedback-main__image" name="image"
              value="/img/uploads/projects/original/<?= unserialize($rec['images'])[0] ?>"><input
              class="idom_feedback-main__button" type="submit" value="Отправить"></div>
      </div>
    </fieldset>
    <div class="idompk-iagree">Нажимая кнопку «Отправить», я даю согласие на обработку моих персональных данных, в
      соответствии с Федеральным законом №152-ФЗ «О персональных данных».
    </div>
  </form>
</div>


<div
    class="idompk-modal-form idompk-modal-form--large idom_callback_formM idom_callback_form-1 idom_callback_form-ask-project-change"
    style="display: none"><i class="idom_icon idom_icon-close  idom_icon-close-thanks"></i><span
      class="idom_feedback-main__title">Запросить стоимость изменений проекта</span>
  <form class="idom_js_form_ask-project-change" method="post" id="idom_js_form_ask-project-change"
        enctype="multipart/form-data">
    <fieldset>
      <div class="row idom_feedback-main__row">
        <div class="col-md-4 idom_feedback-main__item"><input class="idom_feedback-main__input"
                                                              name="idom_js_form_main_1__name" type="text"
                                                              placeholder="Ваше имя" required></div>
        <div class="col-md-4 idom_feedback-main__item"><input class="idom_feedback-main__input idom_phone"
                                                              name="idom_js_form_main_1__phone" type="text"
                                                              placeholder="Телефон" required></div>
        <div class="col-md-4 idom_feedback-main__item">
          <div class="file"><input type="file" name="idom_js_form_main_1__file[]" data-placeholder="Прикрепите файл"
                                   multiple><span class="file_text">Прикрепите файл</span>
            <div class="file_icon"><i class="idom_icon-2 idom_icon-2-download"></i></div>
          </div>
        </div>
      </div>
      <div class="row idom_feedback-main__row">
        <div class="col-md-12 idom_feedback-main__item"><textarea class="idom_feedback-main__textarea"
                                                                  name="idom_js_form_main_1__message"
                                                                  placeholder="Ваш вопрос"></textarea></div>
      </div>
      <div class="row">
        <div class="col-md-12 idom_feedback-main__item idom_feedback-main__item--submit">
          <div id="idom_js_form_main_1_captcha"></div>
          <input type="hidden" name="idom_js_form_main_1__form" value="Форма: Задать вопрос по проекту!"><input
              type="hidden" id="idom_feedback-main__name" name="name" value="<?= $rec['h1' . $region_flag] ?>"><input
              type="hidden" id="idom_feedback-main__id" name="ids" value="<?= $rec['id'] ?>"><input type="hidden"
                                                                                                    id="idom_feedback-main__url"
                                                                                                    name="url"
                                                                                                    value="/catalog/proekty-domov/<?= $rec['num_pr'] ?>"><input
              type="hidden" id="idom_feedback-main__image" name="image"
              value="/img/uploads/projects/original/<?= unserialize($rec['images'])[0] ?>"><input
              class="idom_feedback-main__button" type="submit" value="Отправить"></div>
      </div>
    </fieldset>
    <div class="idompk-iagree">Нажимая кнопку «Отправить», я даю согласие на обработку моих персональных данных, в
      соответствии с Федеральным законом №152-ФЗ «О персональных данных».
    </div>
  </form>
</div>
