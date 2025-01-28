<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
$this->title = "Контакты";
?>

<section role="main" class="content-body">
  <header class="page-header">
    <h2>Контакты</h2>
    <div class="right-wrapper pull-right">
      <ol class="breadcrumbs">
        <li>
          <a href="/access">
            <i class="fa fa-home"></i>
          </a>
        </li>
        <li><a href="/access">Главная</a></li>
        <li><span>Контакты</span></li>
      </ol>
      <span class="sidebar-right-toggle"></span>
    </div>
  </header>
  <?php
  $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal','enctype' => 'multipart/form-data']]); ?>
  <div class="row">
    <div class="col-lg-8">
      <section class="panel panel-dark">
        <header class="panel-heading">
          <h2 class="panel-title">Ссылки в подвале сайта</h2>
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
            <div class="col-sm-12">
              <?=Html::activeTextarea($model, 'footer',['rows'=>"10",'cols'=>"125",'id'=>'footer']) ?>
              <script>
                CKEDITOR.replace( 'footer', {
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
    </div>
    <div class="col-lg-4">
      <section class="panel panel-warning">
        <header class="panel-heading">
          <h2 class="panel-title">Настройки данных компании</h2>
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
            <label class="col-sm-4 control-label">
              <?= Html::activeLabel($model, 'c_company_name')?>
            </label>
            <div class="col-sm-8">
              <?=Html::activeInput('text',$model, 'c_company_name',['class'=>"form-control"]) ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">
              <?= Html::activeLabel($model, 'c_company_slogan')?>
            </label>
            <div class="col-sm-8">
              <?=Html::activeTextarea($model, 'c_company_slogan',['rows'=>"10",'cols'=>"125",'class'=>'form-control']) ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">
              <?= Html::activeLabel($model, 'c_adress')?>
            </label>
            <div class="col-sm-8">
              <?=Html::activeInput('text',$model, 'c_adress',['class'=>"form-control"]) ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">
              <?= Html::activeLabel($model, 'c_company_coordinate')?>
            </label>
            <div class="col-sm-8">
              <?=Html::activeInput('text',$model, 'c_company_coordinate',['class'=>"form-control"]) ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">
              <?= Html::activeLabel($model, 'c_work_time')?>
            </label>
            <div class="col-sm-8">
              <?=Html::activeInput('text',$model, 'c_work_time',['class'=>"form-control"]) ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">
              <?= Html::activeLabel($model, 'c_phone_1')?>
            </label>
            <div class="col-sm-8">
              <?=Html::activeInput('text',$model, 'c_phone_1',['class'=>"form-control"]) ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">
              <?= Html::activeLabel($model, 'c_phone_2')?>
            </label>
            <div class="col-sm-8">
              <?=Html::activeInput('text',$model, 'c_phone_2',['class'=>"form-control"]) ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">
              <?= Html::activeLabel($model, 'c_email')?>
            </label>
            <div class="col-sm-8">
              <?=Html::activeInput('text',$model, 'c_email',['class'=>"form-control"]) ?>
            </div>
          </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">
                    <?= Html::activeLabel($model, 'c_common_address')?>
                </label>
                <div class="col-sm-8">
                    <?=Html::activeInput('text',$model, 'c_common_address',['class'=>"form-control"]) ?>
                </div>
            </div>
        </div>
        <footer class="panel-footer">
          <div class="row">
            <div class="col-sm-8 col-sm-offset-4">
              <?= Html::submitButton("Сохранить", ['class' => 'btn btn-primary'])?>
              <a class="btn btn-default" href="/access">Отменить</a>
            </div>
          </div>
        </footer>
      </section>
      <section class="panel panel-info">
        <header class="panel-heading">
          <h2 class="panel-title">Социальные сети компании</h2>
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
            <label class="col-sm-4 control-label">
              <?= Html::activeLabel($model, 'c_soc_vk')?>
            </label>
            <div class="col-sm-8">
              <?=Html::activeInput('text',$model, 'c_soc_vk',['class'=>"form-control"]) ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">
              <?= Html::activeLabel($model, 'c_soc_fb')?>
            </label>
            <div class="col-sm-8">
              <?=Html::activeInput('text',$model, 'c_soc_fb',['class'=>"form-control"]) ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">
              <?= Html::activeLabel($model, 'c_soc_inst')?>
            </label>
            <div class="col-sm-8">
              <?=Html::activeInput('text',$model, 'c_soc_inst',['class'=>"form-control"]) ?>
            </div>
          </div>
        </div>
        <footer class="panel-footer">
          <div class="row">
            <div class="col-sm-8 col-sm-offset-4">
              <?= Html::submitButton("Сохранить", ['class' => 'btn btn-primary'])?>
              <a class="btn btn-default" href="/access">Отменить</a>
            </div>
          </div>
        </footer>
      </section>
    </div>
  </div>
  <?php ActiveForm::end(); ?>
</section>
