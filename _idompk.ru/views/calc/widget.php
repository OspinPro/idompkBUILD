<?php

  $prices = \app\models\CalcPrices::getGeoPrices();
  $this->registerJsFile('/js/calculator.js');
  $pr_settings = \app\models\ProjSettings::find()->asArray()->one();
?>

<script>
  const calc_prices = {
    <?php foreach ($prices as $param => $price): ?>
    '<?php echo $param; ?>': <?php echo $price; ?>,
    <?php endforeach; ?>
  };
</script>

<div class="">
  <div class="idompk-complex-calc">
    <h2 class="idompk-complex-calc__header" id="link2">Калькулятор индивидуального проектирования дома</h2>
    <div class="idompk-complex-calc__main">
      <div class="idompk-complex-calc__inputs">
        <div class="idompk-complex-calc__input-item">
          <div class="idompk-complex-calc__input-header"><?=\app\models\T::t('Полезная площадь дома')?></div>
          <div class="idompk-complex-calc__input-body">
            <input type="text" value="150" class="commonSq idompk-complex-calc__input-control" />
            <div class="idompk-complex-calc__input-text"><span>кв. м.</span></div>
          </div>
        </div>
        <div class="idompk-complex-calc__input-item">
          <div class="idompk-complex-calc__input-header"><?=\app\models\T::t('Площадь террасы, крыльца и балкона')?></div>
          <div class="idompk-complex-calc__input-body">
            <input type="text" value="0" class="terraceSq idompk-complex-calc__input-control" />
            <div class="idompk-complex-calc__input-text">
              <span>х</span><span>0,3</span><span>=</span><span><b class="calcMnozh">0</b></span><span>кв. м.</span>
            </div>
          </div>
        </div>
      </div>
      <div class="idompk-complex-calc__body">
        <div class="idompk-complex-calc__controls">
          <div class="idompk-complex-calc__buttons-group">
            <div class="idompk-complex-calc__buttons-header"><?=\app\models\T::t('Архитектурно-строительная документация')?></div>
            <div class="idompk-complex-calc__buttons row">
              <div class="col-lg-auto">
                <a href="#" class="calcSelectDoc docEsciz idompk-complex-calc__button js-complex-calc-button is-active px-3"><?=\app\models\T::t('Эскизный проект')?></a>
              </div>
              <div class="col-lg-auto">
                <a href="#" class="calcSelectDoc docArch idompk-complex-calc__button js-complex-calc-button px-3"><?=\app\models\T::t('Архитектурный раздел')?></a>
              </div>
              <div class="col-lg-auto">
                <a href="#" class="calcSelectDoc docConst idompk-complex-calc__button js-complex-calc-button px-3"><?=\app\models\T::t('Конструктивный раздел')?></a>
              </div>
            </div>
          </div>
          <div class="idompk-complex-calc__buttons-group">
            <div class="idompk-complex-calc__buttons-header"><?=\app\models\T::t('Инженерные сети')?></div>
            <div class="idompk-complex-calc__buttons row">
              <div class="col-lg-auto">
                <a href="#" class="calcSelectNetworks nwWater idompk-complex-calc__button js-complex-calc-button px-3"><?=\app\models\T::t('Вода и Канализация')?></a>
              </div>
              <div class="col-lg-auto">
                <a href="#" class="calcSelectNetworks nwHeating idompk-complex-calc__button js-complex-calc-button px-3"><?=\app\models\T::t('Отопление и Вентиляция')?></a>
              </div>
              <div class="col-lg-auto">
                <a href="#" class="calcSelectNetworks nwElectro idompk-complex-calc__button js-complex-calc-button px-3"><?=\app\models\T::t('Электрооборудование')?></a>
              </div>
            </div>
          </div>
          <div class="idompk-complex-calc__buttons-group">
            <div class="idompk-complex-calc__buttons-header text-green"><?=\app\models\T::t('Дополнительные услуги')?></div>
            <div class="idompk-complex-calc__buttons row">
              <div class="col-lg-auto">
                <a href="#" class="calcSelectFree fr3dVision idompk-complex-calc__button idompk-complex-calc__button--green js-complex-calc-button px-3"><?=\app\models\T::t('3D визуализация')?></a>
              </div>
              <div class="col-lg-auto">
                <a href="#" class="calcSelectFree frInteractive3d idompk-complex-calc__button idompk-complex-calc__button--green js-complex-calc-button px-3">Закладные</a>
              </div>
              <div class="col-lg-auto">
                <a href="#" class="calcSelectFree frCalcMatireal idompk-complex-calc__button idompk-complex-calc__button--green js-complex-calc-button px-3">Слаботочные сети</a>
              </div>
            </div>
          </div>
        </div>
        <div class="idompk-complex-calc__output">
          <div class="idompk-complex-calc__output-header"><?=\app\models\T::t('Итоговая стоимость')?>:</div>
          <div class="idompk-complex-calc__output-price"><span class="clacItog idompk-complex-calc__output-value"></span> <?=$pr_settings['currencySymbol']?></div>
          <div class="idompk-complex-calc__output-text">
            <p><?=\app\models\T::t('Срок подготовки архитектурно-строительной документации от 20 до 25 рабочих дней. Инженерные сети – индивидуально.')?></p>
          </div>
          <div class="idompk-complex-calc__output-button">
            <a href="#" class="idompk-complex-calc__output-button-link"><?=\app\models\T::t('Заказать')?></a>
          </div>
          <div class="idompk-complex-calc__output-link">
            <a class="idom_link" href="/kalkulyator-stroitelstva-doma"><?=\app\models\T::t('Рассчитать строительство')?><i class="idom_icon-2 idom_icon-2-arrow-left"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>