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
            Пожалуйста заполните все поля
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
              Название
            </label>
            <div class="col-sm-8">
              <?=Html::activeInput('text',$model, 'name',['class'=>"form-control"]) ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">
              Координаты <br/><small><a href="https://yandex.ru/map-constructor/location-tool/" target="_blank">получить координаты</a></small>
            </label>
            <div class="col-sm-8">
              <?=Html::activeInput('text',$model, 'coordinates',['class'=>"form-control"]) ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">
              Регион
            </label>
            <div class="col-sm-8">
              <?=Html::activeDropDownList($model, 'region',[
                '1' => 'Московская область',
                '2' => 'Ленинградская область'
              ],['class'=>"form-control"]) ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Изображения для объекта</label>
            <div class="col-sm-8">
              <div class="row" style="max-width: 200px;">
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
                    <a class="image-popup-no-margins" href="/img/uploads/map/original/<?=$img?>"><img class="img_form" src="/img/uploads/map/thumb/<?=$img?>"></a>
                  </div>
                <?php }?>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">
              Видео для объекта <br/><small class="text-danger">embed ссылки на youtube/vimeo</small>
            </label>
            <div class="col-sm-8">
              <?=Html::activeInput('text',$model, 'video',['class'=>"form-control"]) ?>
            </div>
          </div>

        </div>
        <footer class="panel-footer">
          <div class="row">
            <div class="col-sm-9 col-sm-offset-3">
              <?= Html::submitButton("Сохранить", ['class' => 'btn btn-primary'])?>
              <a class="btn btn-default" href="/access/map_item">Отменить</a>
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