<?php

$this->title = "Добавление города";
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
                <li><a href="/access/cities">Города</a></li>
                <li><span>Добавление города</span></li>
            </ol>

            <span class="sidebar-right-toggle"></span>
        </div>
    </header>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</section>
