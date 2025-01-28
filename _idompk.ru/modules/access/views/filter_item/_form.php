<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->registerCssFile('/base/vendor/summernote/summernote.css');
$this->registerCssFile('/base/vendor/summernote/summernote-bs3.css');
$this->registerCssFile('/base/vendor/codemirror/lib/codemirror.css');
$this->registerCssFile('/base/vendor/codemirror/theme/monokai.css');
$this->registerCssFile('/base/vendor/bootstrap-fileupload/bootstrap-fileupload.min.css');

$materials = \app\models\Materials::find()->orderBy(['position'=>SORT_ASC])->asArray()->all();
$MaterialsArray = \yii\helpers\ArrayHelper::map($materials,'id', 'name');

$styles = \app\models\StylePr::find()->orderBy(['position'=>SORT_ASC])->asArray()->all();
$StypeArray = \yii\helpers\ArrayHelper::map($styles,'id', 'name');

$dops = \app\models\DopPr::find()->orderBy(['position'=>SORT_ASC])->asArray()->all();

$dopsInfo = \app\models\DopInfo::find()->orderBy(['position'=>SORT_ASC])->asArray()->all();

$eth = ['1'=>'1 Этаж','10'=>'1 Этаж + Мансарда','2'=>'2 Этажа','20'=>'2 Этажа + Мансарда','3'=>'3 Этажа','30'=>'3 Этажа + Мансарда'];
$spalni = ['1'=>'1 Спальня','2'=>'2 Спальни','3'=>'3 Спальни','4'=>'4 Спальни','5'=>'Более 4'];
$zanuzel = ['1'=>'1','2'=>'2','3'=>'3','4'=>'4 ','5'=>' 4+'];
$erker = ['1'=>'1','2'=>'2+'];
$garaj = ['0'=>'0','1'=>'1','2'=>'2','3'=>'3+'];
$townhouse_s = ['1'=>'Дома и Коттеджи','2'=>'Таунхаусы','3'=>'Дуплексы','4'=>'Бани','5'=>'Гаражи', '6' => 'Многоквартирные'];

?>


<?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal','enctype' => 'multipart/form-data']]); ?>


  <div class="row">
    <div class="col-md-9">
      <section class="panel panel-primary">
        <header class="panel-heading">
          <h2 class="panel-title">Настройка контента страницы</h2>
          <p class="panel-subtitle">
            Пожалуйста укажите заголовок и другие настройки для посадочной страницы.
          </p>
          <?php foreach($model->errors as $err)
          { ?>
            <p class="panel-subtitle">
              <?php var_dump($err)?>
            </p>
          <?php } ?>
        </header>
        <div class="panel-body">
          <div class="row">
            <div class="col-md-7">
              <label class="control-label"><strong>Заголовок страницы</strong></label>
              <?=Html::activeInput('text',$model, 'name',['class'=>"form-control"]) ?>
            </div>
            <div class="col-md-5">
              <label class="control-label"><strong>Ссылка страницы (ЧПУ)</strong></label>
              <?=Html::activeInput('text',$model, 'url',['class'=>"form-control"]) ?>
            </div>
            <div class="col-md-6">
              <label class="control-label"><strong>Блок теста сверху страницы</strong></label>
              <?=Html::activeTextarea($model, 'text',['id'=>"text"]) ?>
              <script>
                CKEDITOR.replace( 'text', {
                  contentsCss: ['/css/bootstrap.min.css', '/css/textarea-custom.css', '/css/style-2.0.css'],
                  allowedContent: true
                });
              </script>
            </div>
            <div class="col-md-6">
              <label class="control-label"><strong>Блок теста снизу страницы</strong></label>
              <?=Html::activeTextarea($model, 'text2',['id'=>"text2"]) ?>
              <script>
                CKEDITOR.replace( 'text2', {
                  contentsCss: ['/css/bootstrap.min.css', '/css/textarea-custom.css', '/css/style-2.0.css'],
                  allowedContent: true
                });
              </script>
            </div>
            <div class="col-md-12">
              <hr/>
              <h4 class="highlight">SEO для проекта</h4>
              <label class="control-label"><strong>Title</strong></label>
              <?=Html::activeInput('text',$model, 'title',['class'=>"form-control"]) ?>
              <label class="control-label"><strong>Description</strong></label>
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
      <section class="panel panel-warning">
        <header class="panel-heading">
          <h2 class="panel-title">Фильтры для проектов</h2>
          <p class="panel-subtitle">
            Пожалуйста укажите фильтры для отображения.
          </p>
        </header>
        <div class="panel-body">

          <div class="well well-sm">
            <?= Html::activeCheckbox($model,'is_show'); ?>
            <br/>
            <?= Html::activeCheckbox($model,'is_show_filter'); ?>
              <br/>
              <?= Html::activeCheckbox($model,'is_show_page_project'); ?>
              <br/>
              <?= Html::activeCheckbox($model,'is_show_page_home'); ?>
<!--              <br/>-->
<!--              --><?//= Html::activeCheckbox($model,'cenoj'); ?>
          </div>

          <label class="control-label"><strong>Стоимость проектов</strong></label>
          <div class="well well-sm">
            <div class="row">
              <div class="col-md-6"><?=Html::activeInput('number',$model, 'st_pr_ot',['class'=>"form-control"]) ?></div>
              <div class="col-md-6"><?=Html::activeInput('number',$model, 'st_pr_do',['class'=>"form-control"]) ?></div>
            </div>
          </div>

          <label class="control-label"><strong>Стоимость строительства</strong></label>
          <div class="well well-sm">
            <div class="row">
              <div class="col-md-6"><?=Html::activeInput('number',$model, 'st_st_ot',['class'=>"form-control"]) ?></div>
              <div class="col-md-6"><?=Html::activeInput('number',$model, 'st_st_do',['class'=>"form-control"]) ?></div>
            </div>
          </div>

          <label class="control-label"><strong>Тип дома</strong></label>
          <div class="well well-sm">
            <?= Html::activeDropDownList($model,'townhouse_s', $townhouse_s, ['prompt'=>'','class'=>"form-control"]); ?>
          </div>

          <label class="control-label"><strong>Стили проектов</strong></label>
          <div class="well well-sm">
            <?= Html::activeDropDownList($model,'style_pr', $StypeArray, ['prompt'=>'','class'=>"form-control"]); ?>
          </div>

          <label class="control-label"><strong>Материал стен</strong></label>
          <div class="well well-sm">
            <?= Html::activeDropDownList($model,'material', $MaterialsArray, ['prompt'=>'','class'=>"form-control"]); ?>
          </div>

          <label class="control-label"><strong>Количество этажей</strong></label>
          <div class="well well-sm">
            <?= Html::activeDropDownList($model,'eta', $eth, ['prompt'=>'','class'=>"form-control",'multiple'=>true,'style="height:180px;"'=>true]); ?>
            <br/>
            <div class="row">
              <div class="col-md-6"><?=Html::activeCheckbox($model, 'cokol') ?></div>
              <div class="col-md-6"><?=Html::activeCheckbox($model, 'is_popular') ?></div>
              <div class="col-md-6"><?=Html::activeCheckbox($model, 'is_new') ?></div>
              <div class="col-md-6"><?=Html::activeCheckbox($model, 'pogreb') ?></div>
            </div>
          </div>

          <label class="control-label"><strong>Количество спален</strong></label>
          <div class="well well-sm">
            <?= Html::activeDropDownList($model,'spalni', $spalni, ['prompt'=>'','class'=>"form-control"]); ?>
          </div>

          <label class="control-label"><strong>Количество zanuzel</strong></label>
          <div class="well well-sm">
            <?= Html::activeDropDownList($model,'zanuzel', $zanuzel, ['prompt'=>'','class'=>"form-control"]); ?>
          </div>

          <label class="control-label"><strong>Количество garaj</strong></label>
          <div class="well well-sm">
            <?= Html::activeDropDownList($model,'garaj', $garaj, ['prompt'=>'','class'=>"form-control",'multiple'=>true,'style="height:180px;"'=>true]); ?>
          </div>

          <label class="control-label"><strong>Количество erker</strong></label>
          <div class="well well-sm">
            <?= Html::activeDropDownList($model,'erker', $erker, ['prompt'=>'','class'=>"form-control",'multiple'=>true,'style="height:180px;"'=>true]); ?>
          </div>

          <label class="control-label"><strong>Скидка</strong></label>
          <div class="well well-sm">
            <div class="row">
              <div class="col-md-6"><?=Html::activeInput('number',$model, 'sale_ot',['class'=>"form-control"]) ?></div>
              <div class="col-md-6"><?=Html::activeInput('number',$model, 'sale_do',['class'=>"form-control"]) ?></div>
            </div>
          </div>

          <label class="control-label"><strong>Площадь дома</strong></label>
          <div class="well well-sm">
            <div class="row">
              <div class="col-md-6"><?=Html::activeInput('number',$model, 'area_ot',['class'=>"form-control"]) ?></div>
              <div class="col-md-6"><?=Html::activeInput('number',$model, 'area_do',['class'=>"form-control"]) ?></div>
            </div>
          </div>

          <label class="control-label"><strong>Габариты дома (ширина)</strong></label>
          <div class="well well-sm">
            <div class="row">
              <div class="col-md-6"><?=Html::activeInput('number',$model, 'gb_s_ot',['class'=>"form-control"]) ?></div>
              <div class="col-md-6"><?=Html::activeInput('number',$model, 'gb_s_do',['class'=>"form-control"]) ?></div>
            </div>
          </div>

          <label class="control-label"><strong>Габариты дома (длинна)</strong></label>
          <div class="well well-sm">
            <div class="row">
              <div class="col-md-6"><?=Html::activeInput('number',$model, 'gb_d_ot',['class'=>"form-control"]) ?></div>
              <div class="col-md-6"><?=Html::activeInput('number',$model, 'gb_d_do',['class'=>"form-control"]) ?></div>
            </div>
          </div>

          <label class="control-label"><strong>Дополнительно</strong></label>
          <div class="well well-sm">
            <div class="row">
              <div class="col-md-12">
                <?php foreach ($dops as $rec)
                {
                  ?>
                  <div class="checkbox-custom checkbox-default mt-md col-md-6">
                    <input type="checkbox" name="dop[]" <?=in_array($rec['id'],$model->dop) ?'checked':''?> id="<?=$rec['id']?>" value="<?=$rec['id']?>">
                    <label for="<?=$rec['id']?>"><b><?=$rec['name']?></b></label>
                  </div>
                <?php } ?>
              </div>
            </div>
          </div>

          <label class="control-label"><strong>Дополнительно 2</strong></label>
          <div class="well well-sm">
            <div class="row">
              <div class="col-md-12">
                <?php foreach ($dopsInfo as $rec)
                {
                  ?>
                  <div class="checkbox-custom checkbox-default mt-md col-md-6">
                    <input type="checkbox" name="dopInfo[]" <?=in_array($rec['id'],$model->dopInfo) ?'checked':''?> id="<?=$rec['id']?>" value="<?=$rec['id']?>">
                    <label for="<?=$rec['id']?>"><b><?=$rec['name']?></b></label>
                  </div>
                <?php } ?>
              </div>
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
  </div>

<?php ActiveForm::end(); ?>

  <!-- Specific Page Vendor -->
<?php
$this->registerJsFile('/base/vendor/jquery-validation/jquery.validate.js');
$this->registerJsFile('/base/vendor/select2/js/select2.js');
$this->registerJsFile('/base/vendor/summernote/summernote.js');
$this->registerJsFile('/base/vendor/bootstrap-fileupload/bootstrap-fileupload.min.js');
$this->registerJsFile('/base/vendor/bootstrap-multiselect/bootstrap-multiselect.js');

$this->registerJsFile('/base/javascripts/forms/examples.advanced.form.js');

?>