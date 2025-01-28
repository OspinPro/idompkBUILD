<?php

$this->title = "Добавление этажности'";
?>
<section role="main" class="content-body">
    <header class="page-header">
        <h2><?=$this->title?></h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="/access">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><a href="/access/calc_floors">Этажность калькулятора</a></li>
                <li><span>Добавление этажности</span></li>
            </ol>

            <span class="sidebar-right-toggle"></span>
        </div>
    </header>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</section>
