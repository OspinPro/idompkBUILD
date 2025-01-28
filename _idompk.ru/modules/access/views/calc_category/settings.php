<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
$this->title = "Натсройки калькулятора";
?>
<section role="main" class="content-body">
<div class="row">
    <div class="col-lg-12">
        <?php
        $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal']]); ?>
        <section class="panel">
            <header class="panel-heading">
                <h2 class="panel-title">Основные настройки</h2>
                <p class="panel-subtitle">
                    Цены за 1 кв метр
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
                        1 этаж
                    </label>
                    <div class="col-sm-8">
                        <input type="text"class="form-control" name="1_floor_price_kvm" value="<?php echo $config['1_floor_price_kvm']->value; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">
                        1.5 этажа
                    </label>
                    <div class="col-sm-8">
                        <input type="text"class="form-control" name="1_5_floor_price_kvm" value="<?php echo $config['1_5_floor_price_kvm']->value; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">
                        2 этажа
                    </label>
                    <div class="col-sm-8">
                        <input type="text"class="form-control" name="2_floor_price_kvm" value="<?php echo $config['2_floor_price_kvm']->value; ?>">
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
</section>