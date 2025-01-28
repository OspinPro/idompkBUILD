<?php
  use yii\helpers\Html;
  use yii\widgets\ActiveForm;

  $parents = \yii\helpers\ArrayHelper::map(\app\models\SitePages::find()->orFilterWhere(['!=','id',$model['id']])->andWhere(['parent_id'=>null])->all(), 'id', 'link_title');

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
              Страница родитель <br/><small>(если нужно вложеность для крошек)</small>
            </label>
            <div class="col-sm-8">
              <?=Html::activeDropDownList($model, 'parent_id', $parents, ['class'=>"form-control", 'prompt' => 'Не выбрано']) ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">
              Тип страницы <br/><small>(для страницы родителя, если есть страницы дети)</small>
            </label>
            <div class="col-sm-8">
              <?=Html::activeDropDownList($model, 'page_type',[
                '0' => 'Обычная страница',
                '1' => 'Страница карточками',
                '2' => 'Страница списком'
              ],['class'=>"form-control",'options' => [
                '0' => ['selected' => true]
              ]]) ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">
              Превью для карточки в списке<br/><small>(для страницы родителя, если есть страницы дети)</small>
            </label>
            <div class="col-sm-8">
              <?php if($model->preview_image) {?><img style="max-width: 150px;" src="/img/uploads/other/medium/<?=unserialize($model->preview_image)[0]?>"><?php }?>
              <div class="fileupload fileupload-new" data-provides="fileupload">
                <div class="input-append">
                  <div class="uneditable-input">
                    <i class="fa fa-file fileupload-exists"></i>
                    <span class="fileupload-preview"></span>
                  </div>
                  <span class="btn btn-default btn-file">
                    <span class="fileupload-exists">Заменить</span>
                    <span class="fileupload-new"><?=$model->preview_image ? 'Заменить файл' : 'Загрузить файл'?></span>
                    <?= Html::activeFileInput($model, 'preview_image')?>
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
              ЧПУ ссылки на страницу <br/><small>(если нужно вложеность указываем полный урл)</small> <span class="text-danger">*</span>
            </label>
            <div class="col-sm-8">
              <?=Html::activeInput('text',$model, 'link_url',['class'=>"form-control", 'required'=>'required']) ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">
              Контент страницы
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
              <a class="btn btn-default" href="/access">Отменить</a>
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