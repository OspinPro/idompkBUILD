<?php

$this->registerCssFile('/base/vendor/select2/css/select2.css');
$this->registerCssFile('/base/vendor/select2-bootstrap-theme/select2-bootstrap.css');
$this->registerCssFile('/base/vendor/jquery-datatables-bs3/assets/css/datatables.css');

$title = 'Города';
$this->title = $title.' - Панель управления';
?>

<section role="main" class="content-body">
    <header class="page-header">
        <h2><?=$title?></h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="/access">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span><?=$title?></span></li>
            </ol>

            <span class="sidebar-right-toggle"></span>
        </div>
    </header>
    <!-- start: page -->
    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title pull-left pr-md"><?=$title?></h2>
            <a class="btn btn-primary btn-xs" href="<?=\yii\helpers\Url::toRoute(['/access/cities/create'])?>"><i class="fa fa-plus"></i>&nbsp;Добавить</a>
        </header>
        <div class="panel-body">
            <table class="table table-striped mb-none table-country" id="datatable-editable">
                <thead>
                <tr>
                    <th class="hidden-2">#</th>
                    <th>Страна</th>
                    <th>ISO</th>
                    <th>Название</th>
                    <th class="center">Действие</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach($models as $record)
                {
                    ?>
                    <tr class="gradeX" data-numline="<?=$record->id?>">
                        <td class="hidden-2"><?=$record->id?></td>
                        <td class="text-vertical"><?php echo $record->country->name; ?></td>
                        <td class="text-vertical"><?=$record->iso; ?></td>
                        <td class="text-vertical"><?=$record->name; ?></td>
                        <td class="actions">
                            <a href="<?=\yii\helpers\Url::toRoute(['/access/cities/update','id'=>$record->id])?>" class="on-default edit-row"><i class="fa fa-pencil"></i></a>
                            <a onclick="if(!confirm('Вы уверены?')) return false;" href="<?=\yii\helpers\Url::toRoute(['/access/cities/delete','id'=>$record->id])?>" class="on-default remove-row"><i class="fa fa-trash-o text-danger"></i></a>
                        </td>
                    </tr>
                <?php }?>
                </tbody>
            </table>
        </div>
    </section>
    <!-- end: page -->
</section>
<?php
$this->registerJsFile('/base/vendor/select2/js/select2.js');
$this->registerJsFile('/base/vendor/jquery-datatables/media/js/jquery.dataTables.js');
$this->registerJsFile('/base/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js');
$this->registerJsFile('/base/vendor/jquery-datatables-bs3/assets/js/datatables.js');

$this->registerJsFile('/base/javascripts/tables/examples.datatables.default.js');
$this->registerJsFile('/base/javascripts/tables/examples.datatables.row.with.details.js');
$this->registerJsFile('/base/javascripts/tables/examples.datatables.tabletools.js');


$this->registerJsFile('/base/vendor/magnific-popup/jquery.magnific-popup.js');
$this->registerJsFile('/base/javascripts/ui-elements/examples.lightbox.js');
?>