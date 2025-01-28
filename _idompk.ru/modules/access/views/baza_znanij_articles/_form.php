<?php
  use yii\helpers\Html;
  use yii\widgets\ActiveForm;

  $parents = \yii\helpers\ArrayHelper::map(\app\models\BazaZnanijCategory::find()->orderBy(['position'=>SORT_ASC])->all(), 'id', 'name');

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
                <?=$err?>
              </p>
            <?php } ?>
        </header>
        <div class="panel-body">
          <div class="form-group">
            <label class="col-sm-3 control-label">
              Раздел
            </label>
            <div class="col-sm-8">
              <?=Html::activeDropDownList($model, 'category_id', $parents, ['class'=>"form-control", 'prompt' => 'Не выбрано']) ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">
              Превью для карточки в списке
            </label>
            <div class="col-sm-8">
              <?php if($model->img_preview) {?><img style="max-width: 150px;" src="/img/uploads/other/medium/<?=unserialize($model->img_preview)[0]?>"><?php }?>
              <div class="fileupload fileupload-new" data-provides="fileupload">
                <div class="input-append">
                  <div class="uneditable-input">
                    <i class="fa fa-file fileupload-exists"></i>
                    <span class="fileupload-preview"></span>
                  </div>
                  <span class="btn btn-default btn-file">
                    <span class="fileupload-exists">Заменить</span>
                    <span class="fileupload-new"><?=$model->img_preview ? 'Заменить файл' : 'Загрузить файл'?></span>
                    <?= Html::activeFileInput($model, 'img_preview')?>
                  </span>
                  <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Удалить</a>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">
              Текст ссылки на страницу <span class="text-danger">*</span>
            </label>
            <div class="col-sm-8">
              <?=Html::activeInput('text',$model, 'link_title',['class'=>"form-control", 'required'=>'required']) ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">
              Текст хлебной крошки на странице
            </label>
            <div class="col-sm-8">
              <?=Html::activeInput('text',$model, 'crumbs_title',['class'=>"form-control"]) ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">
              ЧПУ ссылки на страницу <span class="text-danger">*</span>
            </label>
            <div class="col-sm-8">
              <?=Html::activeInput('text',$model, 'link_url',['class'=>"form-control", 'required'=>'required']) ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">
              Контент страницы <span class="text-danger">*</span>
            </label>
            <div class="col-sm-8">
              <?=Html::activeTextarea($model, 'content',['rows'=>"10",'cols'=>"125",'id'=>'content']) ?>
              <script>
                CKEDITOR.replace( 'content', {
                  contentsCss: ['/css/bootstrap.min.css', '/css/textarea-custom.css', '/css/style-2.0.css', '/css/style-3.0.css'],
                  allowedContent: true
                });
              </script>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">
              Title
            </label>
            <div class="col-sm-8">
              <?=Html::activeInput('text',$model, 'title',['class'=>"form-control"]) ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">
              Description
            </label>
            <div class="col-sm-8">
              <?=Html::activeInput('text',$model, 'description',['class'=>"form-control"]) ?>
            </div>
          </div>
        </div>
        <footer class="panel-footer">
          <div class="row">
            <div class="col-sm-9 col-sm-offset-3">
              <?= Html::submitButton("Сохранить", ['class' => 'btn btn-primary'])?>
              <a class="btn btn-default" href="/access/baza_znanij_articles">Отменить</a>
            </div>
          </div>
        </footer>
      </section>
      <?php ActiveForm::end(); ?>
    </div>
  </div>

<?php
  $this->registerJsFile('/base/vendor/bootstrap-fileupload/bootstrap-fileupload.min.js');
?>