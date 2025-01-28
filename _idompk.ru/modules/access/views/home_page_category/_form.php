<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->registerCssFile('/base/vendor/summernote/summernote.css');
$this->registerCssFile('/base/vendor/summernote/summernote-bs3.css');
$this->registerCssFile('/base/vendor/codemirror/lib/codemirror.css');
$this->registerCssFile('/base/vendor/codemirror/theme/monokai.css');
$this->registerCssFile('/base/vendor/bootstrap-fileupload/bootstrap-fileupload.min.css');
$urls = \app\models\FilterItem::find()->orderBy(['name'=>SORT_ASC])->asArray()->all();
$UrlsArray = \yii\helpers\ArrayHelper::map($urls,'id', 'name');
?>
  <script src="/js/tinymce/tinymce.min.js"></script>
  <script>tinymce.init({
      selector: '.textarea',
      height: 300,
      theme: 'modern',
      plugins: [
        'advlist autolink lists link image charmap print preview hr anchor pagebreak',
        'searchreplace wordcount visualblocks visualchars code fullscreen',
        'insertdatetime media nonbreaking save table contextmenu directionality',
        'emoticons template paste moxiecut'
      ],
      toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
      toolbar2: 'print preview media | forecolor backcolor emoticons | code',
      image_advtab: true,
      content_css: [
      ]
    });</script>
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
              <?=$err?>
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
              <?= Html::activeLabel($model, 'url')?>
            </label>
            <div class="col-sm-8">
              <?= Html::activeDropDownList($model,'url', $UrlsArray, ['class'=>"form-control"]); ?>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label">
              Изображение
            </label>
            <div class="col-sm-8">
              <div class="row">
                <label class="col-md-3 control-label">
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
													<span class="fileupload-new"><?=$model->image ? 'Заменить файл' : 'Загрузить'?></span>
                    <?= Html::activeFileInput($model, 'image',['multiple' => false])?>
												</span>
                  <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Удалить</a>
                </div>
              </div>
                <?php if(!empty($model->image)): ?>
              <div class="row">
                <div class="col-md-3 pt-lg">
                    <img src="/img/uploads/other/thumb/<?=$model->image?>">
                </div>
              </div>
                <?php endif; ?>
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