<?php
use yii\helpers\Html;
use app\assets\AppAsset;
AppAsset::register($this);

$contacts_info = \app\models\Contacts::find()->asArray()->one();
$projects_count = \app\models\Projects::find()->count();
$projects_count_gz = \app\models\Projects::find()->where(['material' => 1, 'townhouse_s'=>1 ])->count();
$projects_count_kr = \app\models\Projects::find()->where(['material' => 2, 'townhouse_s'=>1 ])->count();
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html class="no-js" lang="<?= Yii::$app->language ?>" >
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
  <meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE">
  <link rel="shortcut icon" href="/favicon.svg" />
  <link rel="manifest" href="/manifest.json" crossorigin="use-credentials">
  <meta name="theme-color" content="#e2e7ed">

  <link href="/css/fonts.css" rel="stylesheet">
  <link href="/css/build.min.css?v=1" rel="stylesheet">
  <link href="/css/magnific-popup.css" rel="stylesheet">

  <title><?= Html::encode($this->title) ?></title>

<!--  <script src="/js/jquery-2.2.2.min.js"></script>-->
<!-- Yandex.Metrika counter --> <script type="text/javascript" > (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)}; m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)}) (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym"); ym(51131690, "init", { clickmap:true, trackLinks:true, accurateTrackBounce:true }); </script> <noscript><div><img src="https://mc.yandex.ru/watch/51131690" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->
  <?php $this->head() ?>
  <?= Html::csrfMetaTags() ?>

  <?php
  $a = \Yii::$app->request->getPathInfo();
  $b = Yii::$app->getRequest()->getQueryString();
  $c = strstr(strrev($b), '=',true);

  if (strrev($c)==1) {
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: https://idompk.ru/".str_replace('/index', "", $a));
    exit();
  } else {
    if (!\Yii::$app->params['isError']) {

      if(!empty($_GET['page']) && $_GET['page'] > 1) {
        ?>
        <meta name="robots" content="noindex,follow">
        <?php
      } else {
        ?>
        <meta name="robots" content="index,follow">
        <?php
      }

      if (strpos($a, 'index') !== false) {
          $addQS = '';

          if(!empty($_GET['page']) && $_GET['page'] > 1) {
            $addQS = '?page=' . $_GET['page'];
          } else {
          }

        $a = substr($a, 0, -6);

        \Yii::$app->view->registerLinkTag(['rel' => 'canonical', 'href' => 'https://' . $_SERVER['SERVER_NAME'] . '/' . $a.$addQS]);

        header("HTTP/1.1 301 Moved Permanently");
        header("Location: https://". $_SERVER['SERVER_NAME'] . "/" . $a.$addQS);
        exit();
      } else {
        if (\Yii::$app->request->url != '/') {
          if (\Yii::$app->request->url != '/?') {

              if (stripos(\Yii::$app->request->url, '/?') === 0) {
                \Yii::$app->view->registerLinkTag(['rel' => 'canonical', 'href' => 'https://' . $_SERVER['SERVER_NAME']]);
              } else {
                \Yii::$app->view->registerLinkTag(['rel' => 'canonical', 'href' => 'https://' . $_SERVER['SERVER_NAME'] . '/' . mb_strtolower(\yii\helpers\Url::to(\Yii::$app->request->getPathInfo()))]);
              }

          } else {
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: https://idompk.ru");
            exit();
          }
        } else {
          \Yii::$app->view->registerLinkTag(['rel' => 'canonical', 'href' => 'https://' . $_SERVER['SERVER_NAME']]);
        }
      }
    } else {
      \Yii::$app->view->registerLinkTag(['rel' => 'canonical', 'href' => 'https://' . $_SERVER['SERVER_NAME'] . '/404']);
    }
  }
  ?>

<!-- Yandex.RTB -->
<script>window.yaContextCb=window.yaContextCb||[]</script>
<script src="https://yandex.ru/ads/system/context.js" async></script>
<meta name="google-site-verification" content="2hOMKmXhOD9XGLXcdqetouZ7ecM4YbB_pFFtxkrW3wM" />
</head>
<?php $this->beginBody(); ?>

<body itemscope="" itemtype="http://schema.org/WebPage">

<?php
$NumCompare = 0;
$app_compare = Yii::$app->session->get('comparison') ? unserialize(Yii::$app->session->get('comparison')) : array();
foreach($app_compare as $record)
  $NumCompare++;
?>

<?php


$pr_settings = \app\models\ProjSettings::find()->one();
$contact_settings = \app\models\Contacts::find()->asArray()->one();

$date1 = new \DateTime('2016-12-09 10:20:10');
$date1 = $date1->format('Y-m-d H:i:s');
$date_s = new DateTime($date1);
$LastModified_unix =  $date_s->format('U'); // время последнего изменения страницы
$LastModified = gmdate("D, d M Y H:i:s \G\M\T", $LastModified_unix);
$IfModifiedSince = false;
if (isset($_ENV['HTTP_IF_MODIFIED_SINCE']))
  $IfModifiedSince = strtotime(substr($_ENV['HTTP_IF_MODIFIED_SINCE'], 5));
if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']))
  $IfModifiedSince = strtotime(substr($_SERVER['HTTP_IF_MODIFIED_SINCE'], 5));
if ($IfModifiedSince && $IfModifiedSince >= $LastModified_unix) {
  header($_SERVER['SERVER_PROTOCOL'] . ' 304 Not Modified');
  exit;
}
header('Last-Modified: '. $LastModified); ?>

<?php
$ids = [];
if($_COOKIE['ids_cart'])
  $ids = json_decode($_COOKIE['ids_cart'],true);

$itemH = [];
if($_COOKIE['itemH_box'])
  $itemH = json_decode($_COOKIE['itemH_box'],true);

/** @var \app\models\Countries[] $countries */
$countries = \app\models\Countries::find()->all();

$active_country = (isset($_COOKIE['country'])) ? $_COOKIE['country'] : 'RU';

foreach ($countries as $country)
{
    if($country->iso == $active_country)
    {
        $active_country = $country;
        break;
    }
}

/** @var \app\models\Cities[] $cities */
$cities = \app\models\Cities::find()->andWhere(['country_id' => $active_country->id])->all();

$active_city_id = (isset($_COOKIE['city'])) ? $_COOKIE['city'] : null;
$active_city = null;
foreach ($cities as $city)
{
    if($city->id == $active_city_id)
    {
        $active_city = $city;
        break;
    }
}

if(!$active_city)
    $active_city = $cities[0];
$all_cities = \app\models\Cities::find()->all();
list($settings_contacts_country, $settings_contacts_city) = \app\models\SettingsContacts::getGeoSettings();
?>

</body>
<div class="idompk-top-nav">
  <div class="idompk-top-nav__container container">
    <div class="idompk-top-nav__aside">
      <div class="iregion idompk-top-nav__iregion">
        <div class="iregion__items">
          <div class="iregion__item" style="display: none">
            <div class="iregion__item-title"><?=\app\models\T::t('Страна')?>:</div>
            <div class="iregion__item-options js-iregion-options is-active">
              <span class="iregion__item-current js-iregion-item-current js-iregion-country-title"><?php echo $active_country->name; ?></span>
              <div class="iregion__item-dropdown js-iregion-dropdown">
                <?php foreach ($countries as $country): ?>
                <span data-country="<?php echo $country->iso; ?>" class="iregion__item-option js-iregion-option<?php if($country->iso == $active_country->iso): ?> is-active<?php endif; ?>"><?php echo $country->name; ?></span>
                <?php endforeach; ?>
              </div>
            </div>
          </div>

          <div class="iregion__sep" style="display: none"></div>

          <div class="iregion__item">
            <div class="iregion__item-title">
              <img src="/img/icons/location-svgrepo-com.svg" alt="" />
            </div>
              <?php foreach ($countries as $country): $cities = $country->getCities(); ?>
            <div data-country="<?php echo $country->iso; ?>" class="iregion__item-options js-iregion-options<?php if($country->iso == $active_country->iso): ?> is-active<?php endif; ?>">
              <span data-country="<?php echo $country->iso; ?>" class="iregion__item-current js-iregion-item-current js-iregion-city-title"><?php if($country->iso == $active_country->iso) echo $active_city->name; else echo $cities[0]->name; ?></span>

              <div class="iregion__item-dropdown js-iregion-dropdown">
                  <?php foreach ($cities as $city): ?>
                <span data-city="<?php echo $city->id; ?>" class="iregion__item-option js-iregion-option<?php if(($country->iso == $active_country->iso && $city->id == $active_city->id) || ($country->iso != $active_country->iso && $city->id == $cities[0]->id)): ?> is-active<?php endif; ?>"><?php echo $city->name; ?></span>
                <?php endforeach; ?>
              </div>
            </div>
              <?php endforeach; ?>
          </div>
        </div>
      </div>

      <?php foreach ($all_cities as $city): $settings_city = $settings_contacts_city[$city->id]; ?>
        <div class="idom_header__time<?php if($city->id == $active_city->id): ?> is-active<?php endif; ?>" data-city="<?php echo $city->id; ?>">
          <span class="idom_header__phone-number idom_red" id="idompk-c_phone_3"><?=$settings_city['header_phone']?></span>
          <p style="display: none"><?=$settings_city['header_schedule']?></p>
          <a style="display: none" href="mailto:<?=$settings_city['header_email']?>"><?=$settings_city['header_email']?></a>
        </div>
      <?php endforeach; ?>

    </div>
    <div class="idompk-top-nav__items">
      <div><a class="idom_small-link text-color-green" href="https://api.whatsapp.com/send?phone=79952827078" target="_blank"><i class="idom_icon-2 idom_icon-2-whatsapp d-block d-lg-none"></i><span class="d-none d-lg-inline"><b>WhatsApp</b></span></a></div>
      <div><a class="idom_header__phone-block__callback-link text-color-blue" href="#"><i class="idom_icon-2 idom_icon-2-phone-in d-block d-lg-none"></i><span class="d-none d-lg-inline"><?=\app\models\T::t('Обратный звонок')?></span></a></div>
      <?php foreach (\app\models\SitePages::find()->where(['id'=>29])->all() as $page) { ?>
        <div class="idompk-top-nav__item">
          <a href="/<?=$page['link_url']?>" class="text-color-grey-3" title="<?=$page['link_title']?>"><?=$page['link_title']?></a>
        </div>
      <?php } ?>
    </div>


  </div>
</div>

<header class="idom_header">
  <div class="container">
    <div class="row idom-header__row">
      <div class="col-md-12 col-lg-2 col-xl-3 idom-header__logo">
        <button class="d-block d-lg-none navbar-toggler idom-mobile-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="idom_header__logo">
          <a href="/">
            <img src="/img/icons/logo.svg?mm=1" alt="<?=$contacts_info['c_company_name']?>" />
          </a>
        </div>
      </div>
      <div class="col-md-12 col-lg-2 col-xl-2" style="display: none">
          <?php foreach ($countries as $country): $settings_country = $settings_contacts_country[$country->id]; ?>
        <div class="idom_header__time<?php if($country->iso == $active_country->iso): ?> is-active<?php endif; ?>" data-country="<?php echo $country->iso; ?>">
          <span style="display: none" class="idom_header__phone-number idom_red" id="idompk-c_phone_1"><?=$settings_country['header_phone']; ?></span>
          <p style="display: none"><?=$settings_country['header_schedule']; ?></p>
          <a style="display: none" href="mailto:<?=$settings_country['header_email']; ?>"><?=$settings_country['header_email']; ?></a>
        </div>
          <?php endforeach; ?>
      </div>
      <div style="display: none">
          <?php foreach ($all_cities as $city): $settings_city = $settings_contacts_city[$city->id]; ?>
        <div class="idom_header__time<?php if($city->id == $active_city->id): ?> is-active<?php endif; ?>" data-city="<?php echo $city->id; ?>">
          <span class="idom_header__phone-number idom_red" id="idompk-c_phone_3"><?=$settings_city['header_phone']?></span>
          <p style="display: none"><?=$settings_city['header_schedule']?></p>
          <a style="display: none" href="mailto:<?=$settings_city['header_email']?>"><?=$settings_city['header_email']?></a>
        </div>
          <?php endforeach; ?>
      </div>
      <div class="col-md-12 col-lg-3 col-xl-2 idom-header__favs">
        <noindex>
          <div class="d-block d-lg-none idom-mobile-head-icons" rel="nofollow">
            <i id="jsOpenFinderMobile" class="idom_icon-2 idom_icon-2-search"></i>
            <a href="tel:<?=$contacts_info['c_phone_2']?>"><i class="idom_icon-2 idom_icon-2-phone-call"></i></a>
          </div>


        </noindex>
        <div class="idom_top-find">
          <form method="post" id="idom_top-find-form">
            <fieldset>
              <input id="idom_top-find-input" type="text" name="pr_num" value="<?=$_POST['pr_num']?>" placeholder="<?=\app\models\T::t('Введите номер проекта')?>"/>
              <i class="idom_icon-2 idom_icon-2-search"></i>
            </fieldset>
            <div id="idom_top-find-result"></div>
            <div id="idom_top-find-empty"></div>
          </form>
        </div>
        <div class="idom_header__links">
          <?php
          $count_izb = 0;
          if(Yii::$app->session['izbrannoe'])
            $count_izb = count(unserialize(Yii::$app->session['izbrannoe']));
          $count_comparison = 0;
          if(Yii::$app->session['comparison'])
            $count_comparison = count(unserialize(Yii::$app->session['comparison']));
          ?>
          <a class="idom_header__links-favorits<?=$count_izb!=0?' idom_header__links-favorits--active':''?>" href="/izbrannoe" rel="nofollow">
            <i class="idom_icon-favorite"></i>(<span class="span" id="count_izb"><?=$count_izb?></span>)
          </a>
          <a class="idom_header__links-compare<?=$count_comparison!=0?' idom_header__links-compare--active':''?>" rel="nofollow" href="/comparison">
            <i class="idom_icon-comparison"></i>(<span class="span" id="count_comparison"><?=$count_comparison?></span>)
          </a>
        </div>
      </div>
    </div>
  </div>
  <noindex>
  <div class="idompk-phones">
    <div class="idompk-phones__close"><i class="idom_icon-2 idom_icon-2-close"></i></div>
    <div class="iregion idompk-phones__iregion">
      <div class="iregion__items">
        <div class="iregion__item">
          <div class="iregion__item-title"><?=\app\models\T::t('Город')?>:</div>


          <?php foreach ($countries as $country): $cities = $country->getCities(); ?>
            <div data-country="<?php echo $country->iso; ?>" class="iregion__item-options js-iregion-options<?php if($country->iso == $active_country->iso): ?> is-active<?php endif; ?>">
              <span data-country="<?php echo $country->iso; ?>" class="iregion__item-current js-iregion-item-current js-iregion-city-title"><?php if($country->iso == $active_country->iso) echo $active_city->name; else echo $cities[0]->name; ?></span>

              <div class="iregion__item-dropdown js-iregion-dropdown">
                <?php foreach ($cities as $city): ?>
                  <span data-city="<?php echo $city->id; ?>" class="iregion__item-option js-iregion-option<?php if(($country->iso == $active_country->iso && $city->id == $active_city->id) || ($country->iso != $active_country->iso && $city->id == $cities[0]->id)): ?> is-active<?php endif; ?>"><?php echo $city->name; ?></span>
                <?php endforeach; ?>
              </div>
            </div>
          <?php endforeach; ?>
        </div>

        <div class="iregion__sep" style="background-color: transparent"></div>

        <div class="iregion__item">
          <a class="idom_small-link text-color-green" style="font-size: 14px;border-bottom: 1px dashed #89c355;line-height: 1;" href="https://api.whatsapp.com/send?phone=79952827078" target="_blank"><span><b>WhatsApp</b></span></a>
        </div>
      </div>
    </div>


    <?php foreach ($countries as $country): $settings_country = $settings_contacts_country[$country->id]; ?>
      <div class="idom_header__time<?php if($country->iso == $active_country->iso): ?> is-active<?php endif; ?>" data-country="<?php echo $country->iso; ?>">
        <span class="idom_header__phone-number idom_red" id="idompk-c_phone_1"><?=$settings_country['header_phone']; ?></span>
        <p><?=$settings_country['header_schedule']; ?></p>
        <a href="mailto:<?=$settings_country['header_email']; ?>"><?=$settings_country['header_email']; ?></a>
      </div>
    <?php endforeach; ?>

    <?php foreach ($all_cities as $city): $settings_city = $settings_contacts_city[$city->id]; ?>
      <div class="idom_header__time<?php if($city->id == $active_city->id): ?> is-active<?php endif; ?>" data-city="<?php echo $city->id; ?>">
        <span class="idom_header__phone-number idom_red" id="idompk-c_phone_3"><?=$settings_city['header_phone']?></span>
        <p><?=$settings_city['header_schedule']?></p>
        <a href="mailto:<?=$settings_city['header_email']?>"><?=$settings_city['header_email']?></a>
      </div>
    <?php endforeach; ?>

  </div>
  </noindex>
</header>

<div class="container">
  <div class="idom_navigation">
    <nav class="navbar navbar-expand-lg">
      <div class="collapse navbar-collapse" id="navbar">
        <div class="idompk-top-nav__items">
          <div class="idom_top-find2">
            <form method="post" id="idom_top-find-form2">
              <fieldset>
                <input id="idom_top-find-input2" type="text" name="pr_num" value="<?=$_POST['pr_num']?>" placeholder="<?=\app\models\T::t('Введите номер проекта')?>"/>
                <i class="idom_icon-2 idom_icon-2-search"></i>
              </fieldset>
              <div id="idom_top-find-result2"></div>
              <div id="idom_top-find-empty2"></div>
            </form>
          </div>
        </div>
        <ul class="navbar-nav">
          <li class="dropdown idom_navbar-item idom_navbar-item--first">
            <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split idom_toggler" id="dropdownMenuReference" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">Проекты домов <i></i></button>
            <a class="idom_navigation__item-link" href="/catalog/proekty-domov/reset_filer">Проекты домов <i></i></a>
            <div class="dropdown-menu idom_navigation__subnavigation" aria-labelledby="dropdownMenuButton">
              <div class="idom-dropdown-menu__inner">
                <div class="idom_navigation__subnavigation-header">
                  <div class="idom_navigation__subnavigation-header__left">
                    <a href="/catalog/proekty-domov"><?=\app\models\T::t('Все проекты')?></a>
                    <a href="/catalog/vse-kategorii"><?=\app\models\T::t('Категории')?></a>
                  </div>
                  <div class="idom_navigation__subnavigation-header__right">
                    <a href="/catalog/proekty-domov/new"><?=\app\models\T::t('Дома')?></a>
                    <a href="/catalog/proekty-domov/proekty-dupleksov-na-2-semi"><?=\app\models\T::t('Дуплексы')?></a>
                    <a href="/catalog/proekty-domov/bani"><?=\app\models\T::t('Бани')?></a>
                    <a href="/catalog/proekty-domov/garazhi"><?=\app\models\T::t('Гаражи')?></a>
                  </div>
                </div>
                <div class="idom_navigation__subnavigation-content">
                  <?php foreach (\app\models\FilterCat::find()->orderBy(['position'=>SORT_ASC])->asArray()->all() as $cat) {
                    if(\app\models\FilterItem::find()->where(['cat_id'=>$cat['id']])->count()==0)
                      continue;
                    ?>
                    <div class="idom_navigation__subnavigation-content__item">
                      <span class="b"><?=$cat['name']?></span>
                      <?php if($cat['id'] == 8) {?><a class="idom_link-price" href="/catalog/proekty-domov/s-cenoj-na-stroitelstvo"><span class="text-blue font-weight-bold"><?=\app\models\T::t('Все с ценой')?></span></a><?php } ?>
                      <ul>
                        <?php foreach (\app\models\FilterItem::find()->where(['cat_id'=>$cat['id']])->asArray()->all() as $item) {
                          if($item['is_show'])
                            continue;
                          ?>
                          <li><a href="/catalog/proekty-domov/<?=$item['url']?>"><?=$item['name']?></a></li>
                        <?php } ?>
                      </ul>
                    </div>
                  <?php } ?>
                </div>
              </div>
            </div>
          </li>
          <?php foreach (\app\models\SitePages::find()->where(['id'=>4])->all() as $page) { ?>
            <li class="nav-item idom_navbar-item"><a class="idom_navigation__item-link" href="/<?=$page['link_url']?>" title="<?=$page['link_title']?>"><?=$page['link_title']?></a></li>
          <?php } ?>
          <?php foreach (\app\models\SitePages::find()->where(['id'=>28])->all() as $page) { ?>
            <li class="nav-item idom_navbar-item"><a class="idom_navigation__item-link" href="/<?=$page['link_url']?>" title="<?=$page['link_title']?>"><?=$page['link_title']?></a></li>
          <?php } ?>
          <li class="nav-item idom_navbar-item"><a class="idom_navigation__item-link" href="/kalkulyator-stroitelstva-doma">Калькулятор</a></li>
          <li class="nav-item idom_navbar-item"><a class="idom_navigation__item-link" href="/baza-znanij">Помощь</a></li>
        </ul>
        <a class="idom-header-phone" href="tel:88007071066">8 800 707 10 66</a>
      </div>
    </nav>
  </div>
</div>

<div class="idom_wrapper"><?=$content?></div>

<?php

$a2 = Yii::$app->request->url;
$findme2 = '/contacts';

$pos2 = strpos($a2, $findme2);



if ($itemH && $pos2 === false) { ?>
<noindex>
<div class="container idom_history-view pt-5">
  <div class="h2"><?=\app\models\T::t('Последние просмотренные')?>:</div>
  <div class="row idom_more-list mb-5">
    <?php
    foreach (array_slice(array_reverse($itemH), 0, 3) as $pr_n) {
      foreach (\app\models\Projects::find()->where(['num_pr' => $pr_n])->asArray()->all() as $pr_area) {
        echo '<div class="col-md-6 col-lg-4">';
        echo $this->render('@app/modules/catalog/views/proekty-domov/block', ['rec' => $pr_area]);
        echo '</div>';
      }
    }
    ?>
  </div>
</div>
</noindex>
<?php } ?>



<footer class="idom_footer">
  <div class="idom_footer-top">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-3 col-lg-2">
          <a class="idom_footer-logo" href="/"><img src="/img/icons/logo-for-footer.svg?mm=1" width="153"></a>
          <div class="idom_footer-social-links">
            <?php if ($contacts_info['c_soc_vk']) {?><a class="idom_footer__social-link" rel="nofollow" href="<?=$contacts_info['c_soc_vk']?>" target="_blank"><i class="idom_icon idom_icon-vk"></i></a><?php } ?>
            <?php if ($contacts_info['c_soc_fb']) {?><a class="idom_footer__social-link" rel="nofollow" href="<?=$contacts_info['c_soc_fb']?>" target="_blank"><i class="idom_icon idom_icon-facebook"></i></a><?php } ?>
            <?php if ($contacts_info['c_soc_inst']) {?><a class="idom_footer__social-link" rel="nofollow" href="<?=$contacts_info['c_soc_inst']?>" target="_blank"><i class="idom_icon idom_icon-instagram"></i></a><?php } ?>
            <a class="idom_footer__social-link" rel="nofollow" href="https://www.youtube.com/channel/UCd-ey__h1obnisO0Hv9Ga8w" target="_blank"><i class="idom_icon idom_icon-youtube"></i></a>
          </div>
          <?php foreach (\app\models\SitePages::find()->where(['id'=>[3,5,28,29]])->all() as $page) { ?>
            <div class="idom_footer-link-new"><a href="/<?=$page['link_url']?>" title="<?=$page['link_title']?>"><?=$page['link_title']?></a></div>
          <?php } ?>
        </div>

        <div class="col-sm-12 col-md-9 col-lg-10 idom_footer-links">
          <?=$contacts_info['footer']?>
        </div>

      </div>
    </div>
  </div>
  <?php /* <div class="idom_footer-bottom">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-3 col-lg-2"><span class="idom-copy">&copy; <?php echo date("Y"); ?> «<?=$contacts_info['c_company_name']?>»</span></div>
        <div class="col-sm-12 col-md-9 col-lg-10">
          <?php foreach (\app\models\SitePages::find()->where(['id'=>30])->all() as $page) { ?>
            <a rel="nofollow" href="/<?=$page['link_url']?>" class="idom-link-policy" title="<?=$page['link_title']?>"><?=$page['link_title']?></a>
          <?php } ?>
        </div>
      </div>
    </div>
  </div> */ ?>
</footer>

 
<div class="idom_overlay loading-overlay-showing" id="idomOverlay" data-loading-overlay=""><div class="bounce-loader"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div></div>

<input id="js-projects_count" type="hidden" value="<?=$projects_count?>">
<input id="js-projects_count_gz" type="hidden" value="<?=$projects_count_gz?>">
<input id="js-projects_count_kr" type="hidden" value="<?=$projects_count_kr?>">



<script src="/js/build.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.9/datepicker.min.js"></script>
<script src="/js/jquery.ui.touch-punch.min.js"></script>
<script src="/js/jquery.magnific-popup.min.js"></script>
<script src="/js/slick.min.js"></script>
<script src="/js/sticky.min.js"></script>

<script src="/js/scripts.js?v=29"></script>

<script>

    <?php if(Yii::$app->session->hasFlash('status'))
    { ?>
    alert('<?=Yii::$app->session->getFlash('status')?>');
    <?php } ?>

</script>

<?php $this->endBody() ?>
<!-- Yandex.RTB R-A-2365726-8 -->
<script>
window.yaContextCb.push(()=>{
  Ya.Context.AdvManager.render({
    "blockId": "R-A-2365726-8",
    "type": "floorAd",
    "platform": "touch"
  })
})
</script>
</body>
</html>
<?php $this->endPage() ; ?>