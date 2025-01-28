<?php
$ids = [];
if($_COOKIE['ids_cart'])
  $ids = json_decode($_COOKIE['ids_cart'],true);
$addet_cart = $ids[$rec['id']];

$text_ett = '';
if($rec['cokol'] && $rec['mansard'] ) {$text_ett = '+М+Ц';} else if($rec['mansard'] && $rec['pogreb']) {$text_ett = '+М+П';} else if($rec['cokol']) {$text_ett = '+Ц';} else if($rec['mansard']) {$text_ett = '+М';} else if($rec['pogreb']) {$text_ett = '+П';}

$text_garaj = '';
if($rec['garaj'] == 1) {$text_garaj = '(1 место)';} else if($rec['garaj'] == 2) {$text_garaj = '(2 места)';} else if($rec['garaj'] == 3) {$text_garaj = '(3 места)';} else if($rec['garaj'] == 4) {$text_garaj = '(4 места)';} else if($rec['garaj'] > 4) {$text_garaj = '(5+ мест)';} else {$text_garaj = 'нет';}

$count_izb = Yii::$app->session['izbrannoe'] ? unserialize(Yii::$app->session['izbrannoe']) : array();
// if(Yii::$app->session['izbrannoe']) {$count_izb = unserialize(Yii::$app->session['izbrannoe']);}
$class_izb = '';
if(in_array($rec['id'],$count_izb)) {$class_izb = ' active';}

$count_comparison = Yii::$app->session['comparison'] ? unserialize(Yii::$app->session['comparison']) : array();
// if(Yii::$app->session['comparison']) {$count_comparison = unserialize(Yii::$app->session['comparison']);}
$class_comparison = '';
if(in_array($rec['id'],$count_comparison)) {$class_comparison = ' active';}

$stype_pr = \app\models\StylePr::find()->where(['id'=>$rec['material']])->asArray()->one();
$filter_pr = \app\models\FilterItem::find()->where(['name'=>$stype_pr['name']])->asArray()->one();

  $pr_settings = \app\models\ProjSettings::find()->asArray()->one();
?>
<div class="idom_project-item">
  <?php if($rec['is_popular']) {?><i class="idom_icon idom_icon-star-full"></i><?php }?>
  <a href="/catalog/proekty-domov/<?=$rec['num_pr']?>" class="idom_project-item__image" target="_blank" title="<?=$rec['num_pr']?>">
    <picture>
      <source srcset="/img/uploads/projects/thumb/<?=unserialize($rec['images'])[0]?>" media="(max-width: 576px)">
      <source srcset="/img/uploads/projects/medium/<?=unserialize($rec['images'])[0]?>" media="(min-width: 1199px)">
      <img src="/img/uploads/projects/medium/<?=unserialize($rec['images'])[0]?>" />
    </picture>
  </a>
  <div class="idom_project-item__row">
    <div class="idom_project-item__col">
      <div class="idom_project-item_name"><?=$rec['num_pr']?></div>
      <div class="idom_project-item_area"><span><?=$rec['area']?></span>м<sup>2</sup></div>
      <div class="idom_project-item_size"><?=$rec['shirina_doma']?> х <?=$rec['dlina_doma']?></div>
    </div>
    <div class="idom_project-item__col">
      <div class="idom_project-item_price<?php if($rec['is_sale'] != 0) {?> idom_project-item_price--sale<?php }?>">
        <div class="idom_project-item_price-project">
          <span class="idom_project-item_price-project-number"><?=number_format($rec['price_pr']*$pr_settings['currencyIndex'],0,'.','.')?> <span class="font-weight-normal"><?=$pr_settings['currencySymbol']?></span></span>
          <?php if($rec['is_sale'] != 0) {
            $new_price = $rec['price_pr']-($rec['price_pr']*($rec['is_sale']/100));
            ?>
            <span class="idom_project-item_price-project-number--sale"><?=number_format($new_price*$pr_settings['currencyIndex'],0,'.','.')?> <span class="font-weight-normal"><?=$pr_settings['currencySymbol']?></span> <i><?=$rec['is_sale']?>%</i></span>
          <?php }?>
        </div>
        <div class="idom_project-item_price-building"><?php if ($rec['prcie_all']) { ?>&asymp;<?= number_format($rec['prcie_all']*$pr_settings['currencyIndex'], 0, '.', '.') ?> <span class="font-weight-normal"><?=$pr_settings['currencySymbol']?></span><?php } ?>&nbsp;</div>
      </div>
      <div class="idom_project-item_links">
        <span class="compare_add_btn<?=$class_izb?>" data-id="<?=$rec['id']?>"></span>
        <span class="comparison_add_btn<?=$class_comparison?>" data-id="<?=$rec['id']?>"></span>
      </div>
    </div>
  </div>
  <div class="idom_project-item_bottom">
    <div class="idom_project-item_bottom__inside">
      <div><i class="idom_icon-2 idom_icon-2-floor"></i>
        <span>
          <?php
          $text_ett = '';
          if($rec['cokol'] && $rec['mansard'])
            $text_ett = '+М+Ц';
          else if($rec['pogreb'] && $rec['mansard'])
            $text_ett = '+М+П';
          else if($rec['cokol'])
            $text_ett = '+Ц';
          else if($rec['mansard'])
            $text_ett = '+М';
          else if($rec['pogreb'])
            $text_ett = '+П';
          ?>
          <?=$rec['count_et'].''.$text_ett?>
        </span>
      </div>
      <div><i class="idom_icon-2 idom_icon-2-car"></i>
        <span>
          <?php
          $text_garaj = '';
          if($rec['garaj'] == 1) {$text_garaj = '1';} else if($rec['garaj'] == 2) {$text_garaj = '2';} else if($rec['garaj'] == 3) {$text_garaj = '3';} else if($rec['garaj'] == 4) {$text_garaj = '4';} else if($rec['garaj'] > 4) {$text_garaj = '5+';}
          if ($text_garaj == '') {
            $text_garaj = 'Нет';
          }
          echo $text_garaj;
          ?>
        </span>
      </div>
      <div><i class="idom_icon-2 idom_icon-2-bed"></i><span><?=$rec['spalen']?></span></div>
      <div><i class="idom_icon-2 idom_icon-2-wc"></i><span><?=$rec['zanuzel']?></span></div>
    </div>
  </div>
</div>