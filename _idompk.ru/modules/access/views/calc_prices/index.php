<?php

  use yii\helpers\Html;
  use yii\widgets\ActiveForm;

  $this->registerCssFile('/base/vendor/summernote/summernote.css');
  $this->registerCssFile('/base/vendor/summernote/summernote-bs3.css');
  $this->registerCssFile('/base/vendor/codemirror/lib/codemirror.css');
  $this->registerCssFile('/base/vendor/codemirror/theme/monokai.css');
  $this->registerCssFile('/base/vendor/bootstrap-fileupload/bootstrap-fileupload.min.css');


?>
  <section role="main" class="content-body">
  <header class="page-header">
    <h2>Настройки виджета калькулятора</h2>
    <div class="right-wrapper pull-right">
      <ol class="breadcrumbs">
        <li>
          <a href="/access">
            <i class="fa fa-home"></i>
          </a>
        </li>
        <li><span>Настройки виджета калькулятора</span></li>
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
          <h2 class="panel-title">Настройки цен для виджета калькулятора</h2>
          <p class="panel-subtitle">

          </p>
        </header>
        <div class="panel-body">

          <?php
  foreach ($model as $m){?>
            <div class="form-group">
              <label class="col-sm-3 control-label">
                <?= $m->name; ?>
              </label>
              <div class="col-sm-8">
                <?php echo str_replace('CalcPrices', 'CalcPrices['.$m->param.']', Html::activeInput('text',$m, 'price',['class'=>"form-control"])); ?>
              </div>
            </div>
          <?php
  }?>
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
  </section>

  <!-- Specific Page Vendor -->
<?php
  $this->registerJsFile('/base/vendor/jquery-validation/jquery.validate.js');
  $this->registerJsFile('/base/vendor/select2/js/select2.js');
  $this->registerJsFile('/base/vendor/summernote/summernote.js');
  $this->registerJsFile('/base/vendor/bootstrap-fileupload/bootstrap-fileupload.min.js');
  $this->registerJsFile('/base/vendor/bootstrap-multiselect/bootstrap-multiselect.js');

  $this->registerJsFile('/base/javascripts/forms/examples.advanced.form.js');

?>