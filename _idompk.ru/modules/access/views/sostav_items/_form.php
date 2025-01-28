<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->registerCssFile('/base/vendor/summernote/summernote.css');
$this->registerCssFile('/base/vendor/summernote/summernote-bs3.css');
$this->registerCssFile('/base/vendor/codemirror/lib/codemirror.css');
$this->registerCssFile('/base/vendor/codemirror/theme/monokai.css');
$this->registerCssFile('/base/vendor/bootstrap-fileupload/bootstrap-fileupload.min.css');

?>

  <div class="row">
    <div class="col-lg-12">
      <?php
      $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal','enctype' => 'multipart/form-data']]); ?>
      <section class="panel">
        <header class="panel-heading">
          <h2 class="panel-title">Основные настройки</h2>
          <p class="panel-subtitle">
            Пожалуйста заполните все поля обозначеные красной звездочкой
          </p>
          <?php
          foreach($model->errors as $err)
          { ?>
            <p class="panel-subtitle">
              <?php var_dump($err)?>
            </p>
          <?php } ?>
        </header>
        <div class="panel-body">
          <div class="form-group">
            <label class="col-sm-3 control-label">
              <?= Html::activeLabel($model, 'name')?>
            </label>
            <div class="col-sm-8">
              <?=Html::activeInput('text',$model, 'name',['class'=>"form-control"]) ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">
              <?= Html::activeLabel($model, 'text')?>
            </label>
            <div class="col-sm-8">
              <?=Html::activeTextarea($model, 'text',['rows'=>"10", 'id'=>'text','cols'=>"125", 'style'=>'width:100%;height:400px;']) ?>
              <script>
                CKEDITOR.replace( 'text', {
                  contentsCss: ['/css/bootstrap.min.css', '/css/textarea-custom.css', '/css/style-2.0.css'],
                  allowedContent: true
                });
              </script>
            </div>
          </div>
        </div>
        <footer class="panel-footer">
          <div class="row">
            <div class="col-sm-9 col-sm-offset-3">
              <?= Html::submitButton("Сохранить", ['class' => 'btn btn-primary'])?>
              <a class="btn btn-default" href="/access">Отменить</a>
            </div>
          </div>
        </footer>
      </section>
      <?php ActiveForm::end(); ?>
    </div>
  </div>

  <!-- Specific Page Vendor -->
<?php
$this->registerJsFile('/base/vendor/jquery-validation/jquery.validate.js');
$this->registerJsFile('/base/vendor/select2/js/select2.js');
$this->registerJsFile('/base/vendor/summernote/summernote.js');
$this->registerJsFile('/base/vendor/bootstrap-fileupload/bootstrap-fileupload.min.js');
$this->registerJsFile('/base/vendor/bootstrap-multiselect/bootstrap-multiselect.js');

$this->registerJsFile('/base/javascripts/forms/examples.advanced.form.js');

?>