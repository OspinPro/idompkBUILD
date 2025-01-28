<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->registerCssFile('/base/vendor/summernote/summernote.css');
$this->registerCssFile('/base/vendor/summernote/summernote-bs3.css');
$this->registerCssFile('/base/vendor/codemirror/lib/codemirror.css');
$this->registerCssFile('/base/vendor/codemirror/theme/monokai.css');
$this->registerCssFile('/base/vendor/bootstrap-fileupload/bootstrap-fileupload.min.css');
$tree_categories = \app\models\CalcCategories::getTree();
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
                    Родитель
                </label>
                <div class="col-sm-8">
                    <select name="CalcItems[category_id]">
                    <?php foreach ($tree_categories as $cat): ?>
                        <optgroup label="<?php echo $cat['parent']->name; ?>">
                             <?php foreach ($cat['childs'] as $chi): ?>
                                <option value="<?php echo $chi->id; ?>"<?php if($chi->id == $category_id || $chi->id == $model->category_id) echo ' selected'; ?>><?php echo $chi->name; ?></option>
                             <?php endforeach; ?>
                        </optgroup>
                    <?php endforeach; ?>
                    </select>
                </div>
            </div>
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
                    Цена 
                </label>
                <div class="col-sm-8">
                    <?=Html::activeInput('text',$model, 'price_kvm',['class'=>"form-control"]) ?>
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
													<span class="fileupload-new"><?=$model->img ? 'Заменить файл' : 'Загрузить'?></span>
                    <?= Html::activeFileInput($model, 'img',['multiple' => false])?>
												</span>
                            <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Удалить</a>
                        </div>
                    </div>
                    <?php if(!empty($model->img)): ?>
                        <div class="row">
                            <div class="col-md-3 pt-lg">
                                <img src="/img/uploads/other/thumb/<?=unserialize($model->img)[0]?>">
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

              <div class="form-group">
            <label class="col-sm-3 control-label">
              Позиция
            </label>
            <div class="col-sm-8">
              <?=Html::activeInput('text',$model, 'position',['class'=>"form-control"]) ?>
            </div>
          </div>

        </div>
        <footer class="panel-footer">
          <div class="row">
            <div class="col-sm-9 col-sm-offset-3">
              <?= Html::submitButton("Сохранить", ['class' => 'btn btn-primary'])?>
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