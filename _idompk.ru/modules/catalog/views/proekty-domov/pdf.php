<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title><?=$rec['h1']?> <?=$rec['num_pr']?></title>

</head>
<body>
<style>
  body {
    line-height: 1;
    font-size: 100%;
    font-family:Arial, Helvetica, sans-serif;
  }
  .container {
    width: 100%;
    font-family:Arial, Helvetica, sans-serif;
    margin:0 auto 30px;
  }
  .col {
    display:inline-block;
    vertical-align:top;
    max-width: 30%;
    float: left;
    padding-right: 30px;
  }
  .green {
    color: #00b05a
  }
  .red {
    color: #ee4b2e
  }
  .strong {
    font-weight:bold;
  }
  td {
    padding:0 10px 0 0;
    font-size: 12px;
    vertical-align: top;
  }
</style>


<div class="container">

  <div class="container" style="padding: 20px 10px 0;">
    <div class="col" style="width: 30%; margin-right: 40px; padding-top: 12px;"><img src="./img/icons/pdf-logo-new.jpg" width="150" alt="IdomPK" /></div>
    <div class="col" style="font-weight: bold; line-height: 11px; width: 25%; padding-top: 0px; font-size: 10px;"><p class="">8 800 707 10 66<br>hello@idompk.ru</p></div>
    <div class="col" style="width:30%; padding-top: 2px; font-size: 8.5px;"><p class=""><b style="font-size: 10px;">www.idompk.ru</b><br/><span class="regular"><?php echo $contacts['c_common_address']; ?></span></p></div>
  </div>

  <h1 style="font-weight: bold; font-size: 16px; margin: 0px 0px 17px;"><?=$rec['h1']?> <span class="blue"><?=$rec['num_pr']?></span></h1>
  <img src="./img/uploads/projects/medium/<?=unserialize($rec['images'])[0]?>" alt="" style="max-width:100%; max-height:450px; margin-bottom: 30px;border: 1px solid #000; padding: 7px;">

  <div style="font-size: 14px;"><strong>Стоимость проекта: <span class="green"><?=number_format($rec['price_pr'],0,'.','.')?></span></strong></div>
  <div style="padding: 20px 45px 0px 0px; font-size: 11.5px;"><strong>Стоимость строительства:</strong>
    <?php
    if($rec['prcie_all'])
    { ?>
      <?=number_format($rec['prcie_all'],0,'.','.')?>
    <?php } else { ?>
      К сожалению данный дом не просчитан. Для получения бесплатной сметы на строительство отправьте ваше сообщение
      на адрес электронной почты hello@idompk.ru
    <?php } ?>

  </div>

  <?php
  if($rec['price_vznos'])
  { ?>
    <div style="font-size: 11.5px; margin-bottom: 26px;"><strong>Первый взнос: <span class="green"><?=number_format($rec['price_vznos'],0,'.','.')?> </span></strong></div>
  <?php } ?>


  <br/>
  <br/>
  <div class="house_detail_tabs_content tab-content" style="border:none;">
    <div class="tab-pane fade in active" id="house_characteristics">
      <div class="row">
        <table width="100%">
          <tr>
            <td width="100%">
              <div class="col_xs col-xs-8" style="font-size: 10px;  float: left; width: 100%; padding-top: 4px; line-height: 10px;">
                <h4 style="font-size: 14px; margin: 0px 0px 12px;">Характеристики дома:</h4><br/>
                <table width="100%">
                  <tbody>
                  <tr>
                    <td style="width: 45%;"><span class="strong">Общая площадь:</span></td>
                    <td><?=$rec['area']?> м<sup>2</sup></td>
                  </tr>
                  <tr>
                    <td><span class="strong">Террасы и балконы:</span></td>
                    <td><?=$rec['area_tb']?> м<sup>2</sup></td>
                  </tr>
                  <tr>
                    <td><span class="strong">Габариты дома (Ширина х Глубина):</span></td>
                    <td><?=$rec['shirina_doma']?> x <?=$rec['dlina_doma']?> м</td>
                  </tr>
                  <tr>
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
                    <td><span class="strong">Этажность:</span></td>
                    <td><?=$rec['count_et'].''.$text_ett?></td>
                  </tr>
                  <tr>
                    <td><span class="strong">Количество спален:</span></td>
                    <td><?=$rec['spalen']?></td>
                  </tr>
                  <tr>
                    <td><span class="strong">Количество санузлов:</span></td>
                    <td><?=$rec['zanuzel']?></td>
                  </tr>
                  <tr>
                    <td><span class="strong">Фундамент:</span></td>
                    <td><?=$rec['fundament']?></td>
                  </tr>
                  <tr>
                    <td><span class="strong">Материал стен:</span></td>
                    <td><?=$rec['desc_material']?></td>
                  </tr>
                  <tr>
                    <td><span class="strong">Перекрытия:</span></td>
                    <td><?=$rec['perekrytija']?></td>
                  </tr>
                  <tr>
                    <td><span class="strong">Тип крыши:</span></td>
                    <td><?=$rec['krysha']?></td>
                  </tr>
                  <tr>
                    <td><span class="strong">Кровельный материал:</span></td>
                    <td><?=$rec['krovlja']?></td>
                  </tr>
                  <tr>
                    <td><span class="strong">Наружная отделка:</span></td>
                    <td><?=$rec['fasad']?></td>
                  </tr>
                  <tr>
                    <td><span class="strong">Архитектурный стиль:</span></td>
                    <td>
                      <?php
                      $stype_pr = \app\models\StylePr::find()->where(['id'=>$rec['style_pr']])->asArray()->one();
                      $filter_pr = \app\models\FilterItem::find()->where(['name'=>$stype_pr['name']])->asArray()->one();
                      ?>
                      <?=$filter_pr['name']?>
                    </td>
                  </tr>
                  <tr>
                    <td><span class="strong">Дом содержит:</span></td>
                    <td>
                      <?php
                      $text_garaj = '';
                      if($rec['garaj'] == 1) {$text_garaj = 'Гараж (1 место)';} else if($rec['garaj'] == 2) {$text_garaj = 'Гараж (2 места)';} else if($rec['garaj'] == 3) {$text_garaj = 'Гараж (3 места)';} else if($rec['garaj'] == 4) {$text_garaj = 'Гараж (4 места)';} else if($rec['garaj'] > 4) {$text_garaj = 'Гараж (5+ мест)';}
                      if ($text_garaj) {?>
                        <span><?=$text_garaj;?>,</span>
                      <?php }
                      $text_erker = '';
                      if($rec['erker'] == 1) {$text_erker = 'Эркер (1 шт.)';} else if($rec['erker'] == 2) {$text_erker = 'Эркер (2 шт.)';} else if($rec['erker'] == 3) {$text_erker = 'Эркер (3 шт.)';} else if($rec['erker'] == 4) {$text_erker = 'Эркер (4 шт.)';} else if($rec['erker'] > 4) {$text_erker = 'Эркер (5+ шт.)';}
                      if ($text_erker) {?>
                        <span><?=$text_erker;?>,</span>
                      <?php }
                      $dop_rs = explode(',',$rec['dop']);
                      foreach (\app\models\DopPr::find()->orderBy(['position'=>SORT_ASC])->asArray()->all() as $dop) { ?>
                        <?=in_array('-'.$dop['id'].'-',$dop_rs)?'<span>'.$dop['name'].'</span>,':null?>
                      <?php } ?>
                    </td>
                  <tr>
                    <td><span class="strong">Разделы проекта:</span></td>
                    <td><?=$rec['razd_pr']?></td>
                  </tr>
                  </tr>
                  </tbody>
                </table>
              </div>
            </td>
          </tr>
        </table>



      </div>
    </div>

  </div>
</div>
<div style="page-break-after:always;"></div>


<div class="container">
  <h4 style="font-size: 14px; margin: 0px 0px 12px;">Визуализация дома:</h4>
  <?php foreach (unserialize($rec['images']) as $img) { ?>
    <img src="./img/uploads/projects/original/<?=$img?>" alt="" style="width:100%;border: 1px solid #000; padding: 7px; margin-bottom: 20px;">
  <?php } ?>
</div>

<div style="page-break-after:always;"></div>

<div class="container">
  <h4 style="font-size: 14px; margin: 0px 0px 12px;">Планировка дома:</h4>
  <?php foreach (unserialize($rec['images_plan']) as $img_plan) { ?>
    <img src="./img/uploads/projects/original/<?=$img_plan?>" alt="" style="width:100%;border: 1px solid #000; padding: 7px; margin-bottom: 20px;">
  <?php } ?>
</div>

</body>
</html>