<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->registerCssFile('/base/vendor/summernote/summernote.css');
$this->registerCssFile('/base/vendor/summernote/summernote-bs3.css');
$this->registerCssFile('/base/vendor/codemirror/lib/codemirror.css');
$this->registerCssFile('/base/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css');
$this->registerCssFile('/base/vendor/codemirror/theme/monokai.css');
$this->registerCssFile('/base/vendor/bootstrap-fileupload/bootstrap-fileupload.min.css');


$materials = \app\models\Materials::find()->orderBy(['position'=>SORT_ASC])->asArray()->all();
$MaterialsArray = \yii\helpers\ArrayHelper::map($materials,'id', 'name');

$priority = \app\models\Priority::find()->orderBy(['position'=>SORT_ASC])->asArray()->all();
$PriorityArray = \yii\helpers\ArrayHelper::map($priority,'id', 'name');

$sostav = \app\models\SostavItem::find()->orderBy(['id'=>SORT_ASC])->asArray()->all();
$SostavArray = \yii\helpers\ArrayHelper::map($sostav,'id', 'name');

$buildsSteps = \app\models\BuildsSteps::find()->orderBy(['position'=>SORT_ASC])->asArray()->all();
$BuildsStepsArray = \yii\helpers\ArrayHelper::map($buildsSteps,'id', 'name');

$buildsSubSteps = \app\models\BuildsSubSteps::find()->orderBy(['position'=>SORT_ASC])->asArray()->all();
$BuildsSubStepsArray = \yii\helpers\ArrayHelper::map($buildsSubSteps,'id', 'name');

$styles = \app\models\StylePr::find()->orderBy(['position'=>SORT_ASC])->asArray()->all();
$StypeArray = \yii\helpers\ArrayHelper::map($styles,'id', 'name');

$dops = \app\models\DopPr::find()->orderBy(['position'=>SORT_ASC])->asArray()->all();

$dopInfo = \app\models\DopInfo::find()->orderBy(['position'=>SORT_ASC])->asArray()->all();
$townhouse_s = ['1'=>'Дома и Коттеджи','2'=>'Таунхаусы','3'=>'Дуплексы','4'=>'Бани','5'=>'Гаражи', '6' => 'Многоквартирные'];

?>
<style>
  .form-control-sm, .input-group-sm > .form-control, .input-group-sm > .input-group-addon, .input-group-sm > .input-group-btn > .btn {
    padding: 0.25rem 0.5rem;
    font-size: 0.875rem;
    line-height: 1.5;
    border-radius: 0.2rem;
    height: auto;
  }
</style>
<div class="row">
  <div class="col-lg-12">
    <?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal','enctype' => 'multipart/form-data']]); ?>

    <?php foreach($model->errors as $err)
    { ?>
      <p class="panel-subtitle">
        <?php var_dump($err)?>
      </p>
    <?php } ?>
    <div class="row">
      <div class="col-md-9">
        <section class="panel panel-primary">
          <header class="panel-heading">
            <h2 class="panel-title">Настройка проекта</h2>
            <p class="panel-subtitle">
              Пожалуйста укажите основные характеристики для проекта.
            </p>
          </header>
          <div class="panel-body">
            <div class="row">
              <div class="col-md-12">
                <label class="control-label"><b>Заголовок H1</b></label>
                <?=Html::activeInput('text',$model, 'h1',['class'=>"form-control",'max-length'=>'20']) ?>
              </div>
              <div class="col-md-6">
                <div class="row">
                  <div class="col-md-6">

                    <div class="switch switch-sm switch-primary">
                      <label><b>Публиковать на главной</b></label>
                      <?=Html::activeCheckbox($model, 'is_home', ['data-plugin-ios-switch'=>'', 'label' => null]) ?>
                    </div>
                  </div>
                  <div class="col-md-6">
                      <div class="switch switch-sm switch-primary">
                          <label><b>Показать в слайдере</b></label>
                          <?=Html::activeCheckbox($model, 'is_slider', ['data-plugin-ios-switch'=>'', 'label' => null]) ?>
                      </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label class="control-label"><b>Основной номер</b></label>
                    <?=Html::activeInput('text',$model, 'num_pr',['class'=>"form-control",'required'=>'']) ?>
                  </div>
                  <div class="col-md-6">
                    <label class="control-label"><b>Служебный номер</b></label>
                    <?=Html::activeInput('text',$model, 'original_num_pr',['class'=>"form-control",'required'=>'']) ?>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <label class="control-label"><b>Тип дома</b></label>
                    <?= Html::activeDropDownList($model,'townhouse_s', $townhouse_s, ['class'=>"form-control"]); ?>
                  </div>
                  <div class="col-md-4">
                    <label class="control-label"><b>Тип материала</b></label>
                    <?= Html::activeDropDownList($model,'material', $MaterialsArray, ['prompt'=>'Отсутсвует','class'=>"form-control"]); ?>
                  </div>
                  <div class="col-md-4">
                    <label class="control-label"><b>Стиль проекта</b></label>
                    <?= Html::activeDropDownList($model,'style_pr', $StypeArray, ['prompt'=>'Отсутсвует','class'=>"form-control"]); ?>
                  </div>
                </div>
                <Br/>
                <div class="row">
                  <div class="col-md-6">
                    <label class="control-label"><b>Приоритет</b></label>
                    <?= Html::activeDropDownList($model,'priority', $PriorityArray, ['prompt'=>'Отсутсвует','class'=>"form-control"]); ?>
                  </div>
                  <div class="col-md-6">
                    <label class="control-label"><b>Состав</b></label>
                    <?= Html::activeDropDownList($model,'sostav', $SostavArray, ['prompt'=>'Отсутсвует','class'=>"form-control"]); ?>
                  </div>
                  <div class="col-md-3">
                    <div class="switch switch-sm switch-primary">
                      <label><b>Новинка</b></label>
                      <?=Html::activeCheckbox($model, 'is_new', ['data-plugin-ios-switch'=>'', 'label' => null]) ?>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="switch switch-sm switch-primary">
                      <label><b>Популярный</b></label>
                      <?=Html::activeCheckbox($model, 'is_popular', ['data-plugin-ios-switch'=>'', 'label' => null]) ?>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="switch switch-sm switch-primary">
                      <label><b>В наличии</b></label>
                      <?=Html::activeCheckbox($model, 'is_have', ['data-plugin-ios-switch'=>'', 'label' => null]) ?>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="switch switch-sm switch-primary">
                      <label><b>Зеркало</b></label>
                      <?=Html::activeCheckbox($model, 'is_zerkal', ['data-plugin-ios-switch'=>'', 'label' => null]) ?>
                    </div>
                  </div>
                </div>
                <Br/>
                <label class="control-label"><b>Дополнительная информация <span class="text-danger">(!)</span></b></label>
                <?=Html::activeTextarea($model, 'dop_info',['class'=>"form-control",'cols'=>'5','rows'=>'5']) ?>
                  <Br/> <Br/>

              </div>

              <div class="col-md-6">
                <label class="control-label"><b>Стоимость проекта</b></label>
                <?=Html::activeInput('text',$model, 'price_pr',['class'=>"form-control"]) ?>
                <?php if ($model->is_sale) { ?>
                  <label class="control-label"><b>Скидка для проекта в %</b></label>
                  <?=Html::activeInput('number',$model, 'is_sale',['class'=>"form-control", 'max'=>"100", 'min'=>"0" ,'required'=>'']) ?>
                <?php } else {?>
                  <label class="control-label"><b>Скидка для проекта в %</b></label>
                  <?=Html::activeInput('number',$model, 'is_sale',['class'=>"form-control",'value'=>'0', 'max'=>"100", 'min'=>"0" ,'required'=>'']) ?>
                <?php }?>
                <label class="control-label"><b>Разделы проекта</b></label>
                <?=Html::activeInput('text',$model, 'razd_pr',['class'=>"form-control"]) ?>

                <label class="control-label"><b>Паспорт проекта</b> (цена)</label>
                <?=Html::activeInput('text',$model, 'prcie_ps',['class'=>"form-control"]) ?>
                <label class="control-label"><b>Копия проекта</b> (цена)</label>
                <?=Html::activeInput('text',$model, 'price_copy',['class'=>"form-control"]) ?>
                <label class="control-label"><b>PDF копия проекта</b> (цена)</label>
                <?=Html::activeInput('text',$model, 'price_pdf',['class'=>"form-control"]) ?>
                <label class="control-label"><b>Привязка к участку</b> (цена)</label>
                <?=Html::activeInput('text',$model, 'price_uchastok',['class'=>"form-control"]) ?>
                <label class="control-label"><b>Инженерные сети</b> (цена)</label>
                <div class="row">
                  <div class="col-md-8">
                    <?=Html::activeInput('text',$model, 'price_enginer',['class'=>"form-control"]) ?>
                  </div>
                  <div class="col-md-4">
                    <?=Html::activeInput('text',$model, 'ovk',['class'=>"form-control"]) ?>
                  </div>
                </div>
              </div>

              <div class="col-md-12">
                <hr/>
                <div class="row">
                  <div class="col-md-6">


                    <label class="control-label"><b>Изображения для дизайна проекта</b></label>
                    <div class="row">
                      <label class="col-md-12 control-label">
                        <div class="alert alert-info inline-block">
                          <small>
                            формат - <b>jpg, png, gif</b><br>
                            не более <b>10 Mb</b>
                          </small>
                        </div>
                      </label>
                    </div>
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                      <div class="input-append">
                        <div class="uneditable-input">
                          <i class="fa fa-file fileupload-exists"></i>
                          <span class="fileupload-preview"></span>
                        </div>
                        <span class="btn btn-default btn-file">
                                            <span class="fileupload-exists">Заменить</span>
                                            <span class="fileupload-new"><?=$model->images ? 'Заменить файлы' : 'Загрузить несколько файлов (CTR)'?></span>
                            <?= Html::activeFileInput($model, 'images[]',['multiple' => true])?>
                                        </span>
                        <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Удалить</a>
                      </div>
                    </div>
                    <div class="many_imgs pt-lg" data-plugin-lightbox data-plugin-options='{"delegate": "a", "type": "image", "gallery": {"enabled": true}}'>
                      <?php
                      foreach(unserialize($model->images) as $img)
                      {?>
                        <div>
                          <a class="image-popup-no-margins" href="/img/uploads/projects/original/<?=$img?>"><img class="img_form" src="/img/uploads/projects/thumb/<?=$img?>"></a>
                        </div>
                      <?php }?>
                    </div>


                      <div class="form-group2">
                          <label class="control-label"><b>Изображения для слайдера</b></label>
                          <div class="col-sm-12">
                              <div class="row">
                                  <label class="col-md-12 control-label">
                                      <div class="alert alert-info inline-block">
                                          <small>
                                              формат - <b>jpg, png, gif</b><br>
                                              не более <b>10 Mb</b>
                                          </small>
                                      </div>
                                  </label>
                              </div>
                              <div class="fileupload fileupload-new" data-provides="fileupload">
                                  <div class="input-append">
                                      <div class="uneditable-input">
                                          <i class="fa fa-file fileupload-exists"></i>
                                          <span class="fileupload-preview"></span>
                                      </div>
                                      <span class="btn btn-default btn-file">
													<span class="fileupload-exists">Заменить</span>
													<span class="fileupload-new"><?=$model->image_slider ? 'Заменить файл' : 'Загрузить'?></span>
                    <?= Html::activeFileInput($model, 'image_slider',['multiple' => false])?>
												</span>
                                      <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Удалить</a>
                                  </div>
                              </div>
                              <?php if(!empty($model->image_slider)): ?>
                              <div class="row">
                                  <div class="col-md-3 pt-lg">
                                      <img src="/img/uploads/projects/thumb/<?=$model->image_slider?>">
                                  </div>
                              </div>
                              <?php endif; ?>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-6">


                    <label class="control-label"><b>Изображения для планировок проекта</b></label>
                    <div class="row">
                      <label class="col-md-12 control-label">
                        <div class="alert alert-info inline-block">
                          <small>
                            формат - <b>jpg, png, gif</b><br>
                            не более <b>10 Mb</b>
                          </small>
                        </div>
                      </label>
                    </div>
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                      <div class="input-append">
                        <div class="uneditable-input">
                          <i class="fa fa-file fileupload-exists"></i>
                          <span class="fileupload-preview"></span>
                        </div>
                        <span class="btn btn-default btn-file">
                                            <span class="fileupload-exists">Заменить</span>
                                            <span class="fileupload-new"><?=$model->images_plan ? 'Заменить файлы' : 'Загрузить несколько файлов (CTR)'?></span>
                            <?= Html::activeFileInput($model, 'images_plan[]',['multiple' => true])?>
                                        </span>
                        <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Удалить</a>
                      </div>
                    </div>
                    <div class="many_imgs pt-lg" data-plugin-lightbox data-plugin-options='{"delegate": "a", "type": "image", "gallery": {"enabled": true}}'>
                      <?php
                      foreach(unserialize($model->images_plan) as $img_p)
                      {?>
                        <div>
                          <a class="image-popup-no-margins" href="/img/uploads/projects/original/<?=$img_p?>"><img class="img_form" src="/img/uploads/projects/thumb/<?=$img_p?>"></a>
                        </div>
                      <?php }?>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-12">
                <hr/>
                <h4 class="highlight">Характеристики проекта:</h4>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">

                <div class="row">
                  <div class="col-md-6">
                    <label class="control-label"><b>Общая площадь</b> (м<sup>2</sup>)</label>
                    <?=Html::activeInput('text',$model, 'area',['class'=>"form-control"]) ?>
                  </div>
                  <div class="col-md-6">
                    <label class="control-label"><b>Площадь терасс и балконов</b> (м<sup>2</sup>)</label>
                    <?=Html::activeInput('text',$model, 'area_tb',['class'=>"form-control"]) ?>
                  </div>
                </div>


                <div class="row">
                  <div class="col-md-6">
                    <label class="control-label"><b>Ширина</b> (м)</label>
                    <?=Html::activeInput('text',$model, 'shirina_doma',['class'=>"form-control",'placeholder'=>'Ширина']) ?></div>
                  <div class="col-md-6">
                    <label class="control-label"><b>Глубина </b> (м)</label>
                    <?=Html::activeInput('text',$model, 'dlina_doma',['class'=>"form-control",'placeholder'=>'Длина']) ?></div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <label class="control-label"><b>Этажность</b></label>
                    <?=Html::activeInput('text',$model, 'count_et',['class'=>"form-control"]) ?>
                  </div>
                  <div class="col-md-6 pt-xs">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="switch switch-sm switch-primary">
                          <label><b>Цоколь</b></label>
                          <?=Html::activeCheckbox($model, 'cokol', ['data-plugin-ios-switch'=>'', 'label' => null]) ?>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="switch switch-sm switch-primary">
                          <label><b>Мансарда</b></label>
                          <?=Html::activeCheckbox($model, 'mansard', ['data-plugin-ios-switch'=>'', 'label' => null]) ?>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="switch switch-sm switch-primary">
                          <label><b>Погреб</b></label>
                          <?=Html::activeCheckbox($model, 'pogreb', ['data-plugin-ios-switch'=>'', 'label' => null]) ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-3">
                    <label class="control-label"><b>Спальни</b> (кол-во)</label>
                    <?=Html::activeInput('text',$model, 'spalen',['class'=>"form-control"]) ?>
                  </div>
                  <div class="col-md-3">
                    <label class="control-label"><b>Санузлы</b> (кол-во)</label>
                    <?=Html::activeInput('text',$model, 'zanuzel',['class'=>"form-control"]) ?>
                  </div>
                  <div class="col-md-3">
                    <?php if ($model->garaj) { ?>
                      <label class="control-label"><b>Гараж</b> (кол-во мест)</label>
                      <?=Html::activeInput('text',$model, 'garaj',['class'=>"form-control"]) ?>
                    <?php } else {?>
                      <label class="control-label"><b>Гараж</b> (кол-во мест)</label>
                      <?=Html::activeInput('text',$model, 'garaj',['class'=>"form-control",'value'=>'0']) ?>
                    <?php }?>
                  </div>
                  <div class="col-md-3">
                    <?php if ($model->erker) { ?>
                      <label class="control-label"><b>Эркер</b> (кол-во)</label>
                      <?=Html::activeInput('text',$model, 'erker',['class'=>"form-control"]) ?>
                    <?php } else {?>
                      <label class="control-label"><b>Эркер</b> (кол-во)</label>
                      <?=Html::activeInput('text',$model, 'erker',['class'=>"form-control",'value'=>'0']) ?>
                    <?php } ?>
                  </div>
                </div>


                <label class="control-label"><b>Фундамент</b></label>
                <?=Html::activeInput('text',$model, 'fundament',['class'=>"form-control"]) ?>

                <label class="control-label"><b>Материал стен</b></label>
                <?=Html::activeInput('text',$model, 'desc_material',['class'=>"form-control"]) ?>

                <label class="control-label"><b>Перекрытия</b></label>
                <?=Html::activeInput('text',$model, 'perekrytija',['class'=>"form-control"]) ?>

                <label class="control-label"><b>Крыша</b></label>
                <?=Html::activeInput('text',$model, 'krysha',['class'=>"form-control"]) ?>

                <label class="control-label"><b>Кровля</b></label>
                <?=Html::activeInput('text',$model, 'krovlja',['class'=>"form-control"]) ?>

                <label class="control-label"><b>Фасад</b></label>
                <?=Html::activeInput('text',$model, 'fasad',['class'=>"form-control"]) ?>
              </div>
              <div class="col-md-3 pt-lg mt-md">
                <?php foreach ($dops as $rec)
                { ?>
                  <div class="checkbox-custom checkbox-default mb-md">
                    <input type="checkbox" name="dop_pr[]" <?=in_array('-'.$rec['id'].'-',$model->dop) ?'checked':''?> id="p-<?=$rec['id']?>-" value="-<?=$rec['id']?>-">
                    <label for="p-<?=$rec['id']?>-"><b><?=$rec['name']?></b></label>
                  </div>
                <?php } ?>
              </div>
              <div class="col-md-3 pt-lg mt-md">
                <?php foreach ($dopInfo as $rec)
                { ?>
                  <div class="checkbox-custom checkbox-default mb-md">
                    <input type="checkbox" name="dop_info[]" <?=in_array('-'.$rec['id'].'-',$model->dopInfo) ?'checked':''?> id="i-<?=$rec['id']?>-" value="-<?=$rec['id']?>-">
                    <label for="i-<?=$rec['id']?>-"><b><?=$rec['name']?></b></label>
                  </div>
                <?php } ?>
              </div>
              <div class="col-md-12">
                <hr/>
                <h4 class="highlight">SEO для проекта</h4>
                <label class="control-label"><b>Title</b></label>
                <?=Html::activeInput('text',$model, 'title',['class'=>"form-control"]) ?>
                <label class="control-label"><b>Description</b></label>
                <?=Html::activeInput('text',$model, 'description',['class'=>"form-control"]) ?>
              </div>
            </div>
          </div>
          <footer class="panel-footer">
            <section class="panel">
              <div class="pl-sm">
                <div class="row">
                  <div class="col-sm-12">
                    <?= Html::submitButton($model->isNewRecord ?  "Создать" : "Сохранить", ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
                    <a class="btn btn-default" href="/access">Отменить</a>
                  </div>
                </div>
              </div>
            </section>
          </footer>
        </section>
      </div>
      <div class="col-md-3">
        <section class="panel panel-info">
          <header class="panel-heading">
            <h2 class="panel-title">Стоимость строительства</h2>
            <p class="panel-subtitle">
              Пожалуйста укажите конфигурации на строительство.
            </p>
          </header>
          <div class="panel-body">
            <div class="row">
              <div class="col-md-12 mb-sm">
                <label class="control-label"><b>Общая стоимость</b></label>
                <?=Html::activeInput('text',$model, 'prcie_all',['class'=>"form-control", 'readonly'=>"readonly"]) ?>
              </div>
              <div class="col-md-12">
                <?=Html::activeTextarea($model, 'build_info',['class'=>"form-control",'cols'=>'5','rows'=>'3', 'placeholder'=>"Подробнее о стоимости строительства"]) ?>
              </div>
            </div>
            <hr/>
            <h4 class="highlight">Конфигурация на строительство:</h4>
            <div id="listCalcs">
              <?php

              $a = 1;
              foreach ($model->builds as $key=>$others_id)
              {


                ?>

                <div class="well" style="position: relative">
                  <span style="position: absolute;left: 0;top: 0;background: #5bc0de;line-height: 1;padding: 0 5px;color: #fff;">#<?=$a?></span>
                  <div class="row">
                    <div class="col-md-12 mb-sm countSteps"><select id="projects-builds-step-<?=$a?>" class="form-control" name="Projects[builds][step-<?=$a?>][]">
                        <option value="">Выбрать этап</option>
                        <?php

                        $sel = $others_id[0];
                        foreach ($buildsSteps as $itt0) {
                          $tes = '';
                          if ($itt0['id'] == $sel) {
                            $tes= 'selected="selected"';
                          }
                          echo ("<option $tes value=".$itt0['id'].">".$itt0['name']."</option>");
                        } ?>
                      </select></div>
                    <?php
                    ($others_id[0]==$itt0['id'])?'selected':'';

                    $gg = count(json_decode(json_encode($others_id), true))-1;


                    for ($i = 1; $i <= $gg; ++$i) {
                      $subSteps = json_decode(json_encode($others_id[$i]), true);


                      ?>
                      <div class="col-md-6 mb-sm countSubSteps">
                        <a class="btn btn-xs btn-danger jsRemoveSubSteps" href="#removeSubSteps">Удалить подэтап</a>
                        <select id="projects-builds-step-<?=$a?>-<?=$i?>" class="form-control" name="Projects[builds][step-<?=$a?>][<?=$i?>][]">
                          <option value="">Выбрать подэтап</option>
                          <?php

                          $sel1 = $subSteps[0];
                          foreach ($buildsSubSteps as $itt) {

                            $tes1 = '';
                            if ($itt['id'] == $sel1) {
                              $tes1= 'selected="selected"';
                            }

                            echo ("<option $tes1 value=".$itt['id'].">".$itt['name']."</option>");
                          } ?>
                        </select>
                        <input type="text" id="projects-builds-step-<?=$a?>-<?=$i?>-price1" class="form-control" name="Projects[builds][step-<?=$a?>][<?=$i?>][price1][]" placeholder="Работа" value="<?=$subSteps['price1'][0]?>">
                        <input type="text" id="projects-builds-step-<?=$a?>-<?=$i?>-price2" class="form-control" name="Projects[builds][step-<?=$a?>][<?=$i?>][price2][]" placeholder="Материалы" value="<?=$subSteps['price2'][0]?>">
                      </div>

                      <?php

                    }

                    ?>

                    <a class="btn btn-xs btn-info jsAddSubSteps" href="#addSubSteps">Добавить подэтап</a>
                  </div>

                  <a class="btn btn-sm btn-danger jsRemoveSteps" href="#removeSteps">Удалить этап</a>
                </div>

                <?php

                $a++;
                ?>

              <?php } ?>

              <a id="jsAddSteps" class="btn btn-sm btn-info" href="#addSteps">Добавить этап</a>



            </div>
          </div>
          <footer class="panel-footer">
            <section class="panel">
              <div class="pl-sm">
                <div class="row">
                  <div class="col-sm-12">
                    <?= Html::submitButton($model->isNewRecord ?  "Создать" : "Сохранить", ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
                    <a class="btn btn-default" href="/access">Отменить</a>
                  </div>
                </div>
              </div>
            </section>
          </footer>
        </section>
      </div>
    </div>




    <?php ActiveForm::end(); ?>
  </div>
</div>

<!-- Specific Page Vendor -->
<?php
$this->registerJsFile('/base/vendor/jquery-validation/jquery.validate.js');
$this->registerJsFile('/base/vendor/select2/js/select2.js');
$this->registerJsFile('/base/vendor/summernote/summernote.js');
$this->registerJsFile('/base/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js');
$this->registerJsFile('/base/vendor/bootstrap-fileupload/bootstrap-fileupload.min.js');
$this->registerJsFile('/base/vendor/bootstrap-multiselect/bootstrap-multiselect.js');

$this->registerJsFile('/base/javascripts/forms/examples.advanced.form.js');

?>

<script src="/base/vendor/ios7-switch/ios7-switch.js"></script>

<script>
    $(document).on("keyup click", "#projects-fundament2_first_price", function(){
        $("#projects-price_vznos").attr("value", $("#projects-fundament2_first_price").val());
    });

    $(document).ready(function(){
        setTimeout(function(){
            var allsum = 0;

            $(".well").each(function(){
                $(this).find('.countSubSteps:first input.form-control').each(function(){
                    allsum += ($(this).val() != 0) ? parseFloat($(this).val()) : 0;
                });
            });

            $("#projects-prcie_all").attr("value", allsum);
        },1000);
    });


    $(document).on('click keyup','.countSubSteps input.form-control',function(e) {

            var allsum = 0;

            $(".well").each(function(){
                $(this).find('.countSubSteps:first input.form-control').each(function(){
                    allsum += ($(this).val() != 0) ? parseFloat($(this).val()) : 0;
                });
            });

            $("#projects-prcie_all").attr("value", allsum);


    });


    $(document).on('click','.jsAddSubSteps',function(e){
        e.preventDefault()
        var countSteps = $(this).parents('.well').index()+1;
        var countSubSteps = $(this).closest('.row').find('.countSubSteps').length + 1;
        $(this).before('<div class="col-md-6 mb-sm countSubSteps"><a class="btn btn-xs btn-danger jsRemoveSubSteps" href="#removeSubSteps">Удалить подэтап</a><select id="projects-builds-step-'+countSteps+'-'+countSubSteps+'" class="form-control" name="Projects[builds][step-'+countSteps+']['+countSubSteps+'][]"><option value="">Выбрать подэтап</option><?php foreach ($buildsSubSteps as $itt) { echo ("<option value=".$itt['id'].">".$itt['name']."</option>"); } ?></select><input type="text" id="projects-builds-step-'+countSteps+'-'+countSubSteps+'-price1" class="form-control" name="Projects[builds][step-'+countSteps+']['+countSubSteps+'][price1][]" placeholder="Работа"><input type="text" id="projects-builds-step-'+countSteps+'-'+countSubSteps+'-price2" class="form-control" name="Projects[builds][step-'+countSteps+']['+countSubSteps+'][price2][]" placeholder="Материалы"></div>');
    });


    $(document).on('click','.jsRemoveSubSteps',function(e){
        e.preventDefault()
        $(this).parents('.countSubSteps').remove();

        setTimeout(function(){
            var allsum = 0;

            $(".well").each(function(){
                $(this).find('.countSubSteps:first input.form-control').each(function(){
                    allsum += ($(this).val() != 0) ? parseFloat($(this).val()) : 0;
                });
            });

            $("#projects-prcie_all").attr("value", allsum);
        },300);
    });



    $(document).on('click','#jsAddSteps',function(e){
        e.preventDefault()
        var countSteps = $(this).parents('#listCalcs').find('.well').length + 1;

        $(this).before('<div class="well" style="position: relative"><span style="position: absolute;left: 0;top: 0;background: #5bc0de;line-height: 1;padding: 0 5px;color: #fff;">#'+countSteps+'</span><div class="row"><div class="col-md-12 mb-sm"><select id="projects-builds-step-'+countSteps+'" class="form-control" name="Projects[builds][step-'+countSteps+'][]"><option value="">Выбрать этап</option><?php foreach ($buildsSteps as $itt0) { echo ("<option value=".$itt0['id'].">".$itt0['name']."</option>"); } ?></select></div><div class="col-md-6 mb-sm countSubSteps"><a class="btn btn-xs btn-danger jsRemoveSubSteps" href="#removeSubSteps">Удалить подэтап</a><select id="projects-builds-step-'+countSteps+'-1" class="form-control" name="Projects[builds][step-'+countSteps+'][1][]"><option value="">Выбрать подэтап</option><?php foreach ($buildsSubSteps as $itt) { echo ("<option value=".$itt['id'].">".$itt['name']."</option>"); } ?></select><input type="text" id="projects-builds-step-'+countSteps+'-1-price1" class="form-control" name="Projects[builds][step-'+countSteps+'][1][price1][]" placeholder="Работа"><input type="text" id="projects-builds-step-'+countSteps+'-1-price2" class="form-control" name="Projects[builds][step-'+countSteps+'][1][price2][]" placeholder="Материалы"></div><a class="btn btn-xs btn-info jsAddSubSteps" href="#addSubSteps">Добавить подэтап</a></div><a class="btn btn-sm btn-danger jsRemoveSteps" href="#removeSteps">Удалить этап</a></div>');
    });



    $(document).on('click','.jsRemoveSteps',function(e){
        e.preventDefault()
        $(this).parents('.well').remove();

        setTimeout(function(){
            var allsum = 0;

            $(".well").each(function(){
                $(this).find('.countSubSteps:first input.form-control').each(function(){
                    allsum += ($(this).val() != 0) ? parseFloat($(this).val()) : 0;
                });
            });

            $("#projects-prcie_all").attr("value", allsum);
        },300);
    });
</script>