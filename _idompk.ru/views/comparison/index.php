<?php
$this->title = \app\models\T::t('Сравнение');
$this->registerMetaTag(['name' =>'description', 'content' =>\app\models\T::t('Сравнение')]);
$this->registerMetaTag(['name' =>'keywords', 'content' =>\app\models\T::t('Сравнение')]);
  $pr_settings = \app\models\ProjSettings::find()->asArray()->one();

?>
<div class="idom_broadcrumbs">
  <div class="container">
    <ul class="px-5">
      <li><a href="/"><?=\app\models\T::t('Главная')?></a></li>
      <li><a href="/catalog/proekty-domov"><?=\app\models\T::t('Каталог проектов')?></a></li>
    </ul>
  </div>
</div>

<div class="container pb-5">
  <div class="bg-white p-5">
    <h1><?=\app\models\T::t('Сравнение проектов')?></h1>
    <div class="idom_comparison__wrapper">
      <div class="idom_comparison">
        <?php foreach(unserialize(Yii::$app->session->get('comparison')) as $rec) {
        $projects = \app\models\Projects::findOne($rec);
        if(!$projects)
          continue;
        $project = \app\models\Projects::find()->where(['id'=>$rec])->all();
        $new_price = $project[0]['price_pr']-($project[0]['price_pr']*($project[0]['is_sale']/100));

        $count_izb = '';
        if(Yii::$app->session['izbrannoe']) {$count_izb = unserialize(Yii::$app->session['izbrannoe']);}
        $class_izb = '';
        if(in_array($project[0]['id'],$count_izb)) {$class_izb = ' active';}

        $count_comparison = '';
        if(Yii::$app->session['comparison']) {$count_comparison = unserialize(Yii::$app->session['comparison']);}
        $class_comparison = '';
        if(in_array($project[0]['id'],$count_comparison)) {$class_comparison = ' active';}
        ?>
        <div class="idom_comparison__item">
          <div class="idom_comparison__item-header">
            <a class="link-project" href="/catalog/proekty-domov/<?=$project[0]['num_pr']?>" target="_blank"><b><?=$project[0]['num_pr']?></b></a>
            <a class="add_to_cart_n" href="#to-card" data-id="<?=$rec['id']?>" data-num="<?=$project[0]['num_pr']?>" data-price="<?=number_format($project[0]['price_pr'],0,'.','.');?>"><?=$addet_cart?'В корзине':'Купить проект'?></a>
            <a href="#to-favorite" class="compare_add_btn<?=$class_izb;?>" data-id="<?=$project[0]['id']?>"></a>
            <a href="#to-comparison" class="comparison_add_btn<?=$class_comparison;?>" data-id="<?=$project[0]['id']?>"></a>
          </div>
          <div class="mb-4">
            <div class="fotorama-item">
              <?php foreach (unserialize($project[0]['images']) as $img) { ?>
                <a href="/img/uploads/projects/original/<?=$img?>"><img src="/img/uploads/projects/thumb/<?=$img?>" alt="<?=$project[0]['h1'].' '.$project[0]['num_pr']?>"></a>
              <?php } ?>
            </div>
          </div>
          <div class="idom_c_line idom_c_line--first mb-4">
            <div class="idom_c_name"><?=\app\models\T::t('Стоимость')?>:</div>
            <div class="idom_c_value"><b><?=number_format($new_price*$pr_settings['currencyIndex'],0,'.','.')?> <?=$pr_settings['currencySymbol']?></b></div>
          </div>
          <div class="idom_c_line">
            <div class="idom_c_name"><?=\app\models\T::t('Общая площадь дома')?>:</div>
            <div class="idom_c_value"><?=$project[0]['area']?> м<sup>2</sup></div>
          </div>
          <div class="idom_c_line">
            <div class="idom_c_name"><?=\app\models\T::t('Площадь террас, и балконов')?>:</div>
            <div class="idom_c_value"><?=$project[0]['area_tb']?> м<sup>2</sup></div>
          </div>
          <div class="idom_c_line">
            <div class="idom_c_name"><?=\app\models\T::t('Габариты (Ширина х Глубина)')?>:</div>
            <div class="idom_c_value"><?=$project[0]['shirina_doma']?> х <?=$project[0]['dlina_doma']?></div>
          </div>
          <div class="idom_c_line">
            <div class="idom_c_name"><?=\app\models\T::t('Количество этажей')?>:</div>
            <div class="idom_c_value"><?=$project[0]['count_et']?></div>
          </div>
          <div class="idom_c_line">
            <div class="idom_c_name"><?=\app\models\T::t('Количество спален')?>:</div>
            <div class="idom_c_value"><?=$project[0]['spalen']?></div>
          </div>
          <div class="idom_c_line mb-4">
            <div class="idom_c_name"><?=\app\models\T::t('Количество санузлов')?>:</div>
            <div class="idom_c_value"><?=$project[0]['zanuzel']?></div>
          </div>
          <div class="idom_c_line">
            <div class="idom_c_name"><?=\app\models\T::t('Фундамент')?>:</div>
            <div class="idom_c_value"><?=$project[0]['fundament']?></div>
          </div>
          <div class="idom_c_line">
            <div class="idom_c_name"><?=\app\models\T::t('Материал стен')?>:</div>
            <div class="idom_c_value"><?=$project[0]['desc_material']?></div>
          </div>
          <div class="idom_c_line">
            <div class="idom_c_name"><?=\app\models\T::t('Перекрытия')?>:</div>
            <div class="idom_c_value"><?=$project[0]['perekrytija']?></div>
          </div>
          <div class="idom_c_line">
            <div class="idom_c_name"><?=\app\models\T::t('Тип крыши')?>:</div>
            <div class="idom_c_value"><?=$project[0]['krysha']?></div>
          </div>
          <div class="idom_c_line">
            <div class="idom_c_name"><?=\app\models\T::t('Кровельный материал')?>:</div>
            <div class="idom_c_value"><?=$project[0]['krovlja']?></div>
          </div>
          <div class="idom_c_line">
            <div class="idom_c_name"><?=\app\models\T::t('Наружная отделка')?>:</div>
            <div class="idom_c_value"><?=$project[0]['fasad']?></div>
          </div>
          <div class="idom_c_line mb-4">
            <div class="idom_c_name"><?=\app\models\T::t('Архитектурный стиль')?>:</div>
            <div class="idom_c_value">
              <?php
              $stype_pr = \app\models\StylePr::find()->where(['id'=>$project[0]['style_pr']])->asArray()->one();
              echo $stype_pr['name'];
              ?>
            </div>
          </div>
          <div class="idom_bottom mb-4">
            <div><b><?=\app\models\T::t('Дом содержит')?>:</b></div>
            <?php
            $text_garaj = '';
            if($project[0]['garaj'] == 1) {$text_garaj = 'Гараж (1 место)';} else if($project[0]['garaj'] == 2) {$text_garaj = 'Гараж (2 места)';} else if($project[0]['garaj'] == 3) {$text_garaj = 'Гараж (3 места)';} else if($project[0]['garaj'] == 4) {$text_garaj = 'Гараж (4 места)';} else if($project[0]['garaj'] > 4) {$text_garaj = 'Гараж (5+ мест)';}
            if ($text_garaj) {?>
              <span><?=$text_garaj;?></span>
            <?php }
            $text_erker = '';
            if($project[0]['erker'] == 1) {$text_erker = 'Эркер (1 шт.)';} else if($project[0]['erker'] == 2) {$text_erker = 'Эркер (2 шт.)';} else if($project[0]['erker'] == 3) {$text_erker = 'Эркер (3 шт.)';} else if($project[0]['erker'] == 4) {$text_erker = 'Эркер (4 шт.)';} else if($rec['erker'] > 4) {$text_erker = 'Эркер (5+ шт.)';}
            if ($text_erker) {?>
              <span><?=$text_erker;?></span>
            <?php }
            $dop_rs = explode(',',$project[0]['dop']);
            foreach (\app\models\DopPr::find()->orderBy(['position'=>SORT_ASC])->asArray()->all() as $dop) { ?>
              <?=in_array('-'.$dop['id'].'-',$dop_rs)?'<span>'.$dop['name'].'</span>':null?>
            <?php } ?>
          </div>
          <div>
            <div class="idom-plan-title mb-3"><?=\app\models\T::t('Планировочные решения')?></div>
            <div class="idom-comperison-plans-box">
              <?php foreach (unserialize($project[0]['images_plan']) as $img_plan) { ?>
                <div class="mb-2">
                  <div class="fotorama-one">
                    <a href="/img/uploads/projects/original/<?=$img_plan?>"><img src="/img/uploads/projects/thumb/<?=$img_plan?>" alt="<?=$project[0]['h1'].' '.$project[0]['num_pr']?>"></a>
                  </div>
                </div>
              <?php } ?>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
  </div>
</div>