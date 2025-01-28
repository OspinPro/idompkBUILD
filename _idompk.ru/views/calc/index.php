<?php
/** @var array $stages */
/** @var \app\models\CalcFloors[] $floors */
$page = \app\models\CalcPage::find()->asArray()->one();

$this->title = $page['title'];
$this->registerMetaTag(['name' =>'description', 'content' =>$page['meta_description']]);
  $pr_settings = \app\models\ProjSettings::find()->asArray()->one();

?>


<div class="idom_broadcrumbs">
  <div class="container">
    <ul itemscope="" itemtype="http://schema.org/BreadcrumbList">
      <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
        <a itemprop="item" href="/"><span itemprop="name"><?=$_SERVER['HTTP_HOST']?></span></a>
        <meta itemprop="position" content="1" />
      </li>
      <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
        <span itemprop="name"><?=\app\models\T::t('Калькулятор')?></span>
        <meta itemprop="position" content="2" />
      </li>
    </ul>
  </div>
</div>

<div class="page-calc">
  <div class="page-calc__container container">
    <?php echo $page['content']; ?>
    <div class="calc-price d-none">
      <div class="calc-price__row">
        <div class="calc-price__title"><?=\app\models\T::t('Ориентировочная стоимость строительства')?></div>
        <div class="calc-price__value d-none">
          <span class="calc-price__value-sum calcSum">7.345.000</span> <span class="calc-price__value-currency"><?=$pr_settings['currencySymbol']?></span>
        </div>
      </div>
    </div>
    <div class="calc-price__value-fixed">
      <span class="calc-price__value-sum calcSum">7.345.000</span> <span class="calc-price__value-currency"><?=$pr_settings['currencySymbol']?></span>
    </div>
    <!-- calc-price -->

    <div class="idompk-calc">
      <div class="idompk-calc__row">
        <div class="idompk-calc__header"><?=\app\models\T::t('Этажность')?></div>
        <div class="idompk-calc__items row">
            <?php foreach ($floors as $floor): $active=''; if($floor->id == 2) $active=' is-active'; ?>
          <div class="idompk-calc__items-col col-12 col-xl-auto">
            <a href="#" class="idompk-calc__item floorCalcItem<?php echo $active; ?>"
               data-id="<?php echo $floor->id; ?>"
               data-fl="<?php echo $floor->fl; ?>"
               data-sh="<?php echo $floor->sh; ?>"><?php echo $floor->name; ?></a>
          </div>
            <?php endforeach; ?>
          <div class="idompk-calc__items-col col-12 col-xl-auto">
            <div class="idompk-calc__plus">+</div>
          </div>
          <div class="idompk-calc__items-col col-12 col-xl-auto">
            <a href="#" class="idompk-calc__item idompk-calc__item--supper cokolFloor" data-sh="<?php echo $page['sh_cokol']; ?>"><?=\app\models\T::t('Цокольный этаж')?></a>
          </div>
        </div>
      </div>
      <div class="idompk-calc__row">
        <div class="idompk-calc__header"><?=\app\models\T::t('Площадь дома')?>, м<sup>2</sup></div>
        <div class="idompk-calc__range">
          <div class="idompk-calc__range-input">
            <input id="calcSquare" type="text" value="150" class="idompk-calc__range-input-control" />
          </div>
          <div class="idompk-calc__range-control"></div>
        </div>
      </div>

        <div class="idompk-calc__row cokolS" style="display: none;">
            <div class="idompk-calc__header"><?=\app\models\T::t('Площадь цоколя')?>, м<sup>2</sup></div>
            <div class="idompk-calc__range">
                <div class="idompk-calc__range-input">
                    <input id="calcCokolSquare" type="text" value="150" class="idompk-calc_cokol__range-input-control" />
                </div>
                <div class="idompk-calc_cokol__range-control"></div>
            </div>
        </div>
    </div>
    <!-- idompk-calc -->
<style>
    .calcStage {
        display: none;
    }
</style>
      <script>
          $(document).ready(function () {
              initCalc();
              $('.floorCalcItem').click(function () {
                    setTimeout('initCalc();', 100);
              });
              $('.cokolFloor').click(function () {
                  setTimeout('initCalc();', 100);
              });
              $('.calcItem').click(function() {
                  setTimeout('calculateSum();', 100);
              });
              $('.nav-link').click(function() {
                  $($(this).attr('href')).find('.calcItem[data-j=0]').click();
                  setTimeout('calculateSum();', 200);
              });
              $('#calcSquare').keyup(function () {
                  initCokolSp();
                  calculateSum();
              });
              $('#calcCokolSquare').keyup(function () {
                  calculateSum();
              });

            // Калькулятор конструктор
            $(document).on('click', '.idompk-calc-addons__image', function(event){
              event.preventDefault();

              $(this).closest('.tab-content').find('.idompk-calc-addons__image').removeClass('is-active');
              // $(this).closest('.idompk-calc-addons').find('.idompk-calc-addons__col').removeClass('col-md-12');
              // $(this).closest('.idompk-calc-addons__col').addClass('col-md-12');
              $(this).addClass('is-active');

              $(this).closest('.idompk-calc-addons').find('.col-md-12').html($(this).closest('.idompk-calc-addons__item').clone());
              // $(this).closest('.idompk-calc-addons__col').remove();

              calculateSum();
            });
          });

          function initCokolSp() {
              let fl = $('.floorCalcItem.is-active').data('fl');
              let maxCokol = Math.floor(Number($('#calcSquare').val())/Number(fl));
              let currentCSp = Number($('#calcCokolSquare').val());
              if(currentCSp > maxCokol)
                $('#calcCokolSquare').val(maxCokol);
              $( ".idompk-calc_cokol__range-control" ).slider( "option", "max",  maxCokol);
              $( ".idompk-calc_cokol__range-control" ).slider( "option", "value", Number($('#calcCokolSquare').val()) );
          }

          function initCalc()
          {
              let floor_id = $('.floorCalcItem.is-active').data('id');
              let is_cokol = $('.cokolFloor').is('.is-active');
              $('.calcStage').hide();
              $('.calcStage[data-floor='+floor_id+']').show();
              if(is_cokol)
              {
                  $('.calcStage[data-fundament]').hide();
                  $('.calcStage[data-cokol]').show();
                  $('.cokolS').show();
              } else {
                  $('.calcStage[data-cokol]').hide();
                  $('.cokolS').hide();
              }
              setTimeout( () => {initCokolSp();}, 1000);
              calculateSum();
          }

          function calculateSum()
          {
              let is_cokol = $('.cokolFloor').is('.is-active');
              let items = $('.calcStage:visible .tab-pane:visible .calcItem.is-active');
              let floor = $('.floorCalcItem.is-active');
              let floor_sh = Number(floor.data('sh'));
              let sp = Number($('#calcSquare').val());
              let sp_cokol = Number($('#calcCokolSquare').val());
              let sh_cokol = Number($('.cokolFloor').data('sh'));
              let sum = 0;

              items.each(function( index ) {
                    if(is_cokol && $(this).closest('.calcStage').is('[data-cokol=1]'))
                        sum += Number($(this).data('price'))*(sp_cokol/sh_cokol);
                    else
                        sum += Number($(this).data('price'))*(sp/floor_sh);
              });

              var formatter = new Intl.NumberFormat('de-DE', {
                  style: 'decimal',
                  maximumFractionDigits: 0
              });

              $('.calcSum').html(formatter.format(sum));

              $('.calc-price__catalog-link').hide();
              if(sum <= 4000000)
                  $('.link_calc_d4').show();
              else if(sum <= 6000000)
                  $('.link_calc_d6').show();
              else if(sum <= 8000000)
                  $('.link_calc_d8').show();
              else if(sum <= 10000000)
                  $('.link_calc_d10').show();
              else if(sum > 10000000)
                  $('.link_calc_do').show();
          }
      </script>
    <div class="idom_builds_calc idom_builds_calc--calc">
      <div>
        <?php foreach ($stages as $stage): ?>
          <div class="calcStage" data-floor="<?php echo $stage['parent']->floor_id; ?>"<?php if($stage['parent']->is_fundament): ?> data-fundament="1"<?php endif; ?><?php if($stage['parent']->is_cokol): ?> data-cokol="1"<?php endif; ?>>
            <div class="idom_builds_calc__item-title"><?php echo $stage['parent']->name; ?></div>

            <div class="idom_builds_calc__item">
              <ul class="nav nav-tabs" role="tablist">
                <?php
                  /** @var \app\models\CalcCategories $childStage */
                  $i=0; foreach ($stage['childs'] as $childStage): $active =''; if($i==0) $active=" active"; ?>
                  <li class="nav-item"><a class="nav-link<?php echo $active; ?>" data-toggle="tab" href="#tab-<?php echo $childStage->id; ?>" role="tab" aria-controls="include" aria-selected="true">
                      <?php echo $childStage->name; ?>
                    </a></li>
                  <?php $i++;endforeach; ?>
              </ul>
              <div class="tab-content">
                <?php
                  /** @var \app\models\CalcCategories $childStage */
                  $i=0; foreach ($stage['childs'] as $childStage): $active =''; if($i==0) $active=" active"; ?>
                  <div class="tab-pane<?php echo $active; ?>" id="tab-<?php echo $childStage->id; ?>" role="tabpanel">
                    <div class="idompk-calc-addons-wrapper">
                      <div class="idompk-calc-addons row">
                        <?php
                          /** @var \app\models\CalcItems[] $items */
                          $items = \app\models\CalcItems::getByCategory($childStage->id);?>

                      <div class="idompk-calc-addons__col col-md-12">
                        <div class="idompk-calc-addons__item">
                          <a href="#" class="idompk-calc-addons__image is-active calcItem" data-j="0" data-floor="<?php echo $stage['parent']->floor_id; ?>" data-stage="<?php echo $childStage->parent_id; ?>" data-price="<?php echo $items[0]->price_kvm; ?>">
                            <img src="img/uploads/other/original/<?php echo unserialize($items[0]->img)[0]; ?>" />
                            <span class="idompk-calc-addons__title"><?php echo $items[0]->name; ?></span>
                          </a>
                        </div>
                      </div>

                      <?php
                        if (count($items)>1) {
                          $j=0; foreach ($items as $item): $active =''; if($j==0) $active=" is-active";?>
                          <div class="idompk-calc-addons__col">
                            <div class="idompk-calc-addons__item">
                              <a href="#" class="idompk-calc-addons__image<?php echo $active; ?> calcItem" data-j="<?php echo $j; ?>" data-floor="<?php echo $stage['parent']->floor_id; ?>" data-stage="<?php echo $childStage->parent_id; ?>" data-price="<?php echo $item->price_kvm; ?>">
                                <img src="img/uploads/other/original/<?php echo unserialize($item->img)[0]; ?>" />
                                <span class="idompk-calc-addons__title"><?php echo $item->name; ?></span>
                              </a>
                            </div>
                          </div>
                          <?php $j++; endforeach;
                        }
                          ?>
                      </div>
                    </div>
                    <?php if(count($items) > 5): ?>
                      <div class="idompk-calc-addons-spoiler">
                        <a href="#" class="idompk-calc-addons-spoiler__link" data-show="+" data-hide="-">
                          <span data-show="больше материалов" data-hide="свернуть"></span>
                        </a>
                      </div>
                    <?php endif; ?>
                  </div>
                  <?php $i++; endforeach; ?>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
      <div class="jsSticky0">
        <div class="jsSticky">
          <div class="calc-finally-info">
            <a class="calc-finally-info__link-reset" href="/kalkulyator-stroitelstva-doma">Сбросить</a>
            <div class="calc-finally-info__title">Ориентировочная стоимость:</div>
            <div class="calc-finally-info__value">
              <span class="calc-price__value-sum calcSum">7.345.000</span> <span class="calc-price__value-currency"><?=$pr_settings['currencySymbol']?></span>
            </div>
            <div class="calc-finally-info__date"><?=$page['text_date']?></div>
            <a class="calc-finally-info__link" href="/proektirovanie-domov">Заказать проект дома</a>
          </div>
          <div style="padding: 40px 0 0 0;">
            <!-- Yandex.RTB R-A-2365726-2 -->
            <div id="yandex_rtb_R-A-2365726-2"></div>
            <script>
            window.yaContextCb.push(()=>{
              Ya.Context.AdvManager.render({
                "blockId": "R-A-2365726-2",
                "renderTo": "yandex_rtb_R-A-2365726-2"
              })
            })
            </script>
          </div>
        </div>
      </div>
    </div>

    <div class="calc-price" style="border: none; height: 0; margin: 0">
      <div class="calc-price__row d-none">
        <div class="calc-price__title d-none"><?=\app\models\T::t('Ориентировочная стоимость строительства')?></div>
        <div class="calc-price__value d-none">
          <span class="calc-price__value-sum calcSum">7.345.000</span> <span class="calc-price__value-currency"><?=$pr_settings['currencySymbol']?></span>
        </div>
        <div class="calc-price__catalog d-none">
            <a href="/catalog/proekty-domov/s-cenoj-stroitelstva-do-4-millionov" class="calc-price__catalog-link link_calc_d4" style="display: none;">Все дома до 4 млн в нашем каталоге</a>
            <a href="/catalog/proekty-domov/s-cenoj-stroitelstva-ot-4-do-6-millionov" class="calc-price__catalog-link link_calc_d6" style="display: none;">Все дома от 4 до 6 млн в нашем каталоге</a>
            <a href="/catalog/proekty-domov/s-cenoj-stroitelstva-ot-6-do-8-millionov" class="calc-price__catalog-link link_calc_d8" style="display: none;">Все дома от 6 до 8 млн в нашем каталоге</a>
            <a href="/catalog/proekty-domov/s-cenoj-stroitelstva-ot-8-do-10-millionov" class="calc-price__catalog-link link_calc_d10" style="display: none;">Все дома от 8 до 10 млн в нашем каталоге</a>
            <a href="/catalog/proekty-domov/s-cenoj-stroitelstva-ot-10-do-15-millionov" class="calc-price__catalog-link link_calc_do" style="display: none;">Все дома свыше 10 млн в нашем каталоге</a>
        </div>
      </div>
      <div class="calc-price__row" style="border: none">
        <div class="calc-price__content">
          <div class="calc-price__content-text">

          </div>
          <div class="calc-price__order d-none">
            <a href="#" class="calc-price__order-button"><?=\app\models\T::t('Заказать')?></a>
          </div>
          <div class="calc-price__link d-none">
            <a href="/proektirovanie-domov"><?=\app\models\T::t('или просчитайте его проектирование')?></a>
          </div>
        </div>
      </div>
    </div>

    <div class="page-calc__text">
      <?php echo $page['text2']; ?>
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
    containerSelector: '.idom_builds_calc--calc',
    innerWrapperSelector: '.jsSticky'
  });

  setInterval(function(){
    stickySidebar.updateSticky();
  },1000);
</script>