<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
$this->title = "Главная страница - Настройки";
?>

  <section role="main" class="content-body">
    <header class="page-header">
      <h2>Главная страница - Настройки</h2>
      <div class="right-wrapper pull-right">
        <ol class="breadcrumbs">
          <li>
            <a href="/access">
              <i class="fa fa-home"></i>
            </a>
          </li>
          <li><span>Главная страница сайта</span></li>
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

            <div class="form-group">
              <label class="col-sm-3 control-label">
                Контент в верхней части страницы
              </label>
              <div class="col-sm-8">
                <?=Html::activeTextarea($model, 'text_1',['rows'=>"10",'cols'=>"125",'id'=>'text_1']) ?>
                <script>
                  CKEDITOR.replace( 'text_1', {
                    contentsCss: ['/css/bootstrap.min.css', '/css/textarea-custom.css', '/css/style-2.0.css', '/css/style-3.0.css'],
                    allowedContent: true
                  });
                </script>
              </div>
            </div>

              <div class="form-group">
                  <label class="col-sm-3 control-label">
                    Контент для блока с фильтром
                  </label>
                  <div class="col-sm-8">
                      <?=Html::activeTextarea($model, 'text_3',['rows'=>"10",'cols'=>"125",'id'=>'text_3']) ?>
                      <script>
                          CKEDITOR.replace( 'text_3', {
                              contentsCss: ['/css/bootstrap.min.css', '/css/textarea-custom.css', '/css/style-2.0.css'],
                              allowedContent: true
                          });
                      </script>
                  </div>
              </div>

            <div class="form-group">
              <label class="col-sm-3 control-label">
                Контент в нижней части страницы
              </label>
              <div class="col-sm-8">
                <?=Html::activeTextarea($model, 'text_2',['rows'=>"10",'cols'=>"125",'id'=>'text_2']) ?>
                <script>
                  CKEDITOR.replace( 'text_2', {
                    contentsCss: ['/css/bootstrap.min.css', '/css/textarea-custom.css', '/css/style-2.0.css'],
                    allowedContent: true
                  });
                </script>
              </div>
            </div>


            <div class="form-group">
              <label class="col-sm-3 control-label">
                <?= Html::activeLabel($model, 'title')?>
              </label>
              <div class="col-sm-8">
                <?=Html::activeInput('text',$model, 'title',['class'=>"form-control"]) ?>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">
                <?= Html::activeLabel($model, 'description')?>
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
  </section>