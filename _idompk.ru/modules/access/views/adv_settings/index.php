<?php
  use yii\widgets\ActiveForm;
  use yii\helpers\Html;
  $this->title = "Насторойки рекламы";
?>

<section role="main" class="content-body">
  <header class="page-header">
    <h2>Насторойки рекламы</h2>
    <div class="right-wrapper pull-right">
      <ol class="breadcrumbs">
        <li>
          <a href="/access">
            <i class="fa fa-home"></i>
          </a>
        </li>
        <li><a href="/">Главная</a></li>
        <li><span>Насторойки рекламы</span></li>
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
            <div class="col-md-12">
              <label class="control-label"><strong>Посадочные страницы (верх)</strong></label>
              <?=Html::activeTextarea($model, 'filter_top_banner',['rows'=>"10", 'id'=>'filter_top_banner','cols'=>"125", 'style'=>'width:100%;height:400px;']) ?>
              <script>
                CKEDITOR.replace( 'filter_top_banner', {
                  contentsCss: ['/css/bootstrap.min.css', '/css/textarea-custom.css', '/css/style-2.0.css'],
                  allowedContent: true
                });
              </script>
            </div>
            <div class="col-md-12">
              <label class="control-label"><strong>Посадочные страницы (низ)</strong></label>
              <?=Html::activeTextarea($model, 'filter_bottom_banner',['rows'=>"10", 'id'=>'filter_bottom_banner','cols'=>"125", 'style'=>'width:100%;height:400px;']) ?>
              <script>
                CKEDITOR.replace( 'filter_bottom_banner', {
                  contentsCss: ['/css/bootstrap.min.css', '/css/textarea-custom.css', '/css/style-2.0.css'],
                  allowedContent: true
                });
              </script>
            </div>
            <div class="col-md-12">
              <hr>
              <label class="control-label"><strong>Карточка проекта</strong></label>
              <?=Html::activeTextarea($model, 'card_banner',['rows'=>"10", 'id'=>'card_banner','cols'=>"125", 'style'=>'width:100%;height:400px;']) ?>
              <script>
                CKEDITOR.replace( 'card_banner', {
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
</section>