<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
$this->title = "Насторойки проектов";

$this->registerCssFile('/base/vendor/summernote/summernote.css');
$this->registerCssFile('/base/vendor/summernote/summernote-bs3.css');
$this->registerCssFile('/base/vendor/codemirror/lib/codemirror.css');
$this->registerCssFile('/base/vendor/codemirror/theme/monokai.css');
$this->registerCssFile('/base/vendor/bootstrap-fileupload/bootstrap-fileupload.min.css');


?>


  <section role="main" class="content-body">
    <header class="page-header">
      <h2>Насторойки проектов</h2>
      <div class="right-wrapper pull-right">
        <ol class="breadcrumbs">
          <li>
            <a href="/access">
              <i class="fa fa-home"></i>
            </a>
          </li>
          <li><a href="/access">Проекты</a></li>
          <li><span>Насторойки проектов</span></li>
        </ol>
        <span class="sidebar-right-toggle"></span>
      </div>
    </header>
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

              <div class="row">
                <div class="col-md-6">
                  <label class="control-label"><strong>Текст о подарке на странице проекта над фотогалереей</strong></label>
                  <?=Html::activeInput('text',$model, 'podsk',['class'=>"form-control"]) ?>
                </div>
                <div class="col-md-2">
                  <label class="control-label"><strong>Процент за кредит</strong></label>
                  <?=Html::activeInput('text',$model, 'procentAll',['class'=>"form-control"]) ?>
                </div>
                <div class="col-md-2">
                  <label class="control-label"><strong>Множитель для курса</strong></label>
                  <?=Html::activeInput('text',$model, 'currencyIndex',['class'=>"form-control"]) ?>
                </div>
                <div class="col-md-2">
                  <label class="control-label"><strong>Значек валюты (&#8381; / &#8372;)</strong></label>
                  <?=Html::activeInput('text',$model, 'currencySymbol',['class'=>"form-control"]) ?>
                </div>
              </div>

              <hr>

              <div class="tabs">
                <ul class="nav nav-tabs">
                  <li class="nav-item active"><a class="nav-link" href="#pane11" data-toggle="tab">ОПЛАТА И ДОСТАВКА</a></li>
                  <li class="nav-item"><a class="nav-link" href="#pane12" data-toggle="tab">ДОПОЛНИТЕЛЬНЫЕ УСЛУГИ</a></li>
                </ul>
                <div class="tab-content">
                  <div id="pane11" class="tab-pane active">
                    <?=Html::activeTextarea($model, 'panel_2',['rows'=>"10", 'id'=>'panel_2','cols'=>"125", 'style'=>'width:100%;height:400px;']) ?>
                    <script>
                      CKEDITOR.replace( 'panel_2', {
                        contentsCss: ['/css/bootstrap.min.css', '/css/textarea-custom.css', '/css/style-2.0.css'],
                        allowedContent: true
                      });
                    </script>
                  </div>
                  <div id="pane12" class="tab-pane">
                    <?=Html::activeTextarea($model, 'panel_3',['rows'=>"10", 'id'=>'panel_3','cols'=>"125", 'style'=>'width:100%;height:400px;']) ?>
                    <script>
                      CKEDITOR.replace( 'panel_3', {
                        contentsCss: ['/css/bootstrap.min.css', '/css/textarea-custom.css', '/css/style-2.0.css'],
                        allowedContent: true
                      });
                    </script>
                  </div>
                </div>
              </div>

              <div class="tabs">
                <ul class="nav nav-tabs">
                  <li class="nav-item active"><a class="nav-link" href="#pane21" data-toggle="tab">Настройки каталога проектов</a></li>
                  <li class="nav-item"><a class="nav-link" href="#pane22" data-toggle="tab">Настройки каталога проектов с ценами</a></li>
                </ul>
                <div class="tab-content">
                  <div id="pane21" class="tab-pane active">
                    <label class="control-label"><strong>Текст сверху страницы</strong></label>
                    <?=Html::activeTextarea($model, 'text',['rows'=>"10",'cols'=>"125",'id'=>'text']) ?>
                    <script>
                      CKEDITOR.replace( 'text', {
                        contentsCss: ['/css/bootstrap.min.css', '/css/textarea-custom.css', '/css/style-2.0.css'],
                        allowedContent: true
                      });
                    </script>
                    <label class="control-label"><strong>Текст снизу страницы</strong></label>
                    <?=Html::activeTextarea($model, 'text2',['rows'=>"10",'cols'=>"125",'id'=>'text2']) ?>
                    <script>
                      CKEDITOR.replace( 'text2', {
                        contentsCss: ['/css/bootstrap.min.css', '/css/textarea-custom.css', '/css/style-2.0.css'],
                        allowedContent: true
                      });
                    </script>
                    <hr/>
                    <h4 class="highlight">SEO</h4>
                    <label class="control-label"><strong>Title</strong></label>
                    <?=Html::activeInput('text',$model, 'title',['class'=>"form-control"]) ?>
                    <label class="control-label"><strong>Description</strong></label>
                    <?=Html::activeInput('text',$model, 'description',['class'=>"form-control"]) ?>
                  </div>
                  <div id="pane22" class="tab-pane">
                    <label class="control-label"><strong>Текст сверху страницы</strong></label>
                    <?=Html::activeTextarea($model, 'text_price',['rows'=>"10",'cols'=>"125",'id'=>'text_price']) ?>
                    <script>
                      CKEDITOR.replace( 'text_price', {
                        contentsCss: ['/css/bootstrap.min.css', '/css/textarea-custom.css', '/css/style-2.0.css'],
                        allowedContent: true
                      });
                    </script>
                    <label class="control-label"><strong>Текст снизу страницы</strong></label>
                    <?=Html::activeTextarea($model, 'text2_price',['rows'=>"10",'cols'=>"125",'id'=>'text2_price']) ?>
                    <script>
                      CKEDITOR.replace( 'text2_price', {
                        contentsCss: ['/css/bootstrap.min.css', '/css/textarea-custom.css', '/css/style-2.0.css'],
                        allowedContent: true
                      });
                    </script>
                    <hr/>
                    <h4 class="highlight">SEO</h4>
                    <label class="control-label"><strong>Title</strong></label>
                    <?=Html::activeInput('text',$model, 'title_s',['class'=>"form-control"]) ?>
                    <label class="control-label"><strong>Description</strong></label>
                    <?=Html::activeInput('text',$model, 'description_s',['class'=>"form-control"]) ?>
                  </div>
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
  </section>

<?php
$this->registerJsFile('/base/vendor/jquery-validation/jquery.validate.js');
$this->registerJsFile('/base/vendor/select2/js/select2.js');
$this->registerJsFile('/base/vendor/summernote/summernote.js');
$this->registerJsFile('/base/vendor/bootstrap-fileupload/bootstrap-fileupload.min.js');
$this->registerJsFile('/base/vendor/bootstrap-multiselect/bootstrap-multiselect.js');

$this->registerJsFile('/base/javascripts/forms/examples.advanced.form.js');

?>