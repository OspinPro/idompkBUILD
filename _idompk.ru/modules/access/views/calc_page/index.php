<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
$this->title = "Калькулятор - Настройки";
?>

<section role="main" class="content-body">
    <header class="page-header">
        <h2>Калькулятор</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="/access">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Строительная компания</span></li>
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
                  <label class="control-label"><strong>Содержание страницы</strong></label>
                  <?=Html::activeTextarea($model, 'content',['rows'=>"10",'cols'=>"125",'id'=>'text_1']) ?>
                  <script>
                    CKEDITOR.replace( 'text_1', {
                      contentsCss: ['/css/bootstrap.min.css', '/css/textarea-custom.css', '/css/style-2.0.css'],
                      allowedContent: true
                    });
                  </script>
                  <hr/>
                    <label class="control-label"><strong>Содержание страницы 2</strong></label>
                    <?=Html::activeTextarea($model, 'text2',['rows'=>"10",'cols'=>"125",'id'=>'text_2']) ?>
                    <script>
                        CKEDITOR.replace( 'text_2', {
                            contentsCss: ['/css/bootstrap.min.css', '/css/textarea-custom.css', '/css/style-2.0.css'],
                            allowedContent: true
                        });
                    </script>
                    <hr/>
                    <label class="control-label"><strong>SH для цоколя</strong></label>
                    <?=Html::activeInput('text',$model, 'sh_cokol',['class'=>"form-control"]) ?>
                  <h4 class="highlight">SEO</h4>
                  <label class="control-label"><strong>Title</strong></label>
                  <?=Html::activeInput('text',$model, 'title',['class'=>"form-control"]) ?>
                  <label class="control-label"><strong>Meta Description</strong></label>
                  <?=Html::activeInput('text',$model, 'meta_description',['class'=>"form-control"]) ?>
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