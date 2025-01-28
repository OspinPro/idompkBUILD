<?php

$this->title = "Изменение элемента";
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
                <li><a href="/access/calc_item?category_id=<?php echo $category_id; ?>"><?php echo $category->name; ?></a></li>
                <li><span>Изменение элемента</span></li>
            </ol>
            <span class="sidebar-right-toggle"></span>
        </div>
    </header>

    <?= $this->render('_form', [
        'model' => $model,
        'category' => $category,
        'category_id' => $category_id
    ]) ?>
</section>