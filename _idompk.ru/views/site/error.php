<?php

  Yii::$app->response->setStatusCode(404);
  $this->title = \app\models\T::t('Страница не найдена | Ошибка 404');
?>

<div class="container pb-5">
  <div class="bg-white py-5">
    <h1><?=\app\models\T::t('Страница не найдена')?></h1>
    <p><?=\app\models\T::t('Упс! Вы ищете страницу, которой никогда не было по данному адресу или она удалена с нашего сайта. Убедитесь в том, что вы вводите правильный адрес.')?></p>
    <p> <a href="/"><?=\app\models\T::t('Главная страница')?></a> | <a href="/catalog/proekty-domov"><?=\app\models\T::t('Каталог проектов домов')?></a></p>

    <h2><?=\app\models\T::t('Основные категории')?></h2>
    <div class="row mt-5">
      <div class="col-12 col-md-6 col-lg-4 mb-30">
        <div class="idom-vsekategorii__item">
          <a href="/catalog/proekty-domov/odnoehtazhnye-doma"><img class="idom-vsekategorii__item-image" alt="<?=\app\models\T::t('Проект одноэтажного дома')?>" src="/img/uploads/other/kategoriya-odnoehtazhnyj.jpg"></a>
          <div class="idom-vsekategorii__item-title"><a href="/catalog/proekty-domov/odnoehtazhnye-doma"><?=\app\models\T::t('Все одноэтажные')?></a></div>
          <ul class="idom-vsekategorii__item-list">
            <li><div class="idom-vsekategorii__item-link"><a href="/catalog/proekty-domov/odnoehtazhnye-iz-gazobetona"><?=\app\models\T::t('из газобетона')?></a></div></li>
            <li><div class="idom-vsekategorii__item-link"><a href="/catalog/proekty-domov/odnoehtazhnye-s-garazhom"><?=\app\models\T::t('с гаражом')?></a></div></li>
            <li><div class="idom-vsekategorii__item-link"><a href="/catalog/proekty-domov/odnoehtazhnye-doma-s-tremya-spalnyami"><?=\app\models\T::t('с 3 спальнями')?></a></div></li>
            <li><div class="idom-vsekategorii__item-link"><a href="/catalog/proekty-domov/proekty-odnoehtazhnyh-domov-do-150-kv-m"><?=\app\models\T::t('до 150 м2')?></a></div></li>
            <li><div class="idom-vsekategorii__item-link"><a href="/catalog/proekty-domov/proekty-odnoehtazhnyh-domov-9-na-9">9*9</a></div></li>
            <li><div class="idom-vsekategorii__item-link"><a href="/catalog/proekty-domov/proekty-odnoehtazhnyh-domov-10-na-10">10*10</a></div></li>
          </ul>
        </div>
      </div>
      <div class="col-12 col-md-6 col-lg-4 mb-30">
        <div class="idom-vsekategorii__item">
          <a href="/catalog/proekty-domov/s-mansardoj"><img class="idom-vsekategorii__item-image" alt="<?=\app\models\T::t('Проект дома с мансардой')?>" src="/img/uploads/other/kategoriya-mansardnyj.jpg"></a>
          <div class="idom-vsekategorii__item-title"><a href="/catalog/proekty-domov/s-mansardoj"><?=\app\models\T::t('Все с мансардой')?></a></div>
          <ul class="idom-vsekategorii__item-list">
            <li><div class="idom-vsekategorii__item-link"><a href="/catalog/proekty-domov/gazobeton-mansarda"><?=\app\models\T::t('из газобетона')?></a></div></li>
            <li><div class="idom-vsekategorii__item-link"><a href="/catalog/proekty-domov/doma-s-mansardoj-i-garazhom"><?=\app\models\T::t('с гаражом')?></a></div></li>
            <li><div class="idom-vsekategorii__item-link"><a href="/catalog/proekty-domov/proekty-domov-so-vtorym-svetom-i-mansardoj"><?=\app\models\T::t('со вторым светом')?></a></div></li>
            <li><div class="idom-vsekategorii__item-link"><a href="/catalog/proekty-domov/doma-do-150-kv-m-s-mansardoj"><?=\app\models\T::t('до 150 м2')?></a></div></li>
            <li><div class="idom-vsekategorii__item-link"><a href="/catalog/proekty-domov/s-mansardoj-do-200-kv-m"><?=\app\models\T::t('до 200 м2')?></a></div></li>
            <li><div class="idom-vsekategorii__item-link"><a href="/catalog/proekty-domov/doma-10-na-10-s-mansardoj">10*10</a></div></li>
          </ul>
        </div>
      </div>
      <div class="col-12 col-md-6 col-lg-4 mb-30">
        <div class="idom-vsekategorii__item">
          <a href="/catalog/proekty-domov/dvuhehtazhnye"><img class="idom-vsekategorii__item-image" alt="<?=\app\models\T::t('Проект двухэтажного дома')?>" src="/img/uploads/other/kategoriya-dvuhehtazhnyj.jpg"></a>
          <div class="idom-vsekategorii__item-title"><a href="/catalog/proekty-domov/dvuhehtazhnye"><?=\app\models\T::t('Все двухэтажные')?></a></div>
          <ul class="idom-vsekategorii__item-list">
            <li><div class="idom-vsekategorii__item-link"><a href="/catalog/proekty-domov/dvuhehtazhnye-iz-gazobetona"><?=\app\models\T::t('из газобетона')?></a></div></li>
            <li><div class="idom-vsekategorii__item-link"><a href="/catalog/proekty-domov/dvuhehtazhnye-s-garazhom"><?=\app\models\T::t('с гаражом')?></a></div></li>
            <li><div class="idom-vsekategorii__item-link"><a href="/catalog/proekty-domov/proekt-dvuhehtazhnyh-domov-s-cokolnym-ehtazhom"><?=\app\models\T::t('с цокольным этажом<')?>/a></div></li>
            <li><div class="idom-vsekategorii__item-link"><a href="/catalog/proekty-domov/dvuhehtazhnye-do-150"><?=\app\models\T::t('до 150 м2')?></a></div></li>
            <li><div class="idom-vsekategorii__item-link"><a href="/catalog/proekty-domov/10-na-10-dvuhehtazhnye">10*10</a></div></li>
            <li><div class="idom-vsekategorii__item-link"><a href="/catalog/proekty-domov/proekty-dvuhehtazhnyh-domov-12-na-12">12*12</a></div></li>
          </ul>
        </div>
      </div>

    </div>
  </div>
</div>