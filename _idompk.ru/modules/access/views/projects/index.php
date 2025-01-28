<?php
use app\models\T;

$this->registerCssFile('/base/vendor/select2/css/select2.css');
$this->registerCssFile('/base/vendor/select2-bootstrap-theme/select2-bootstrap.css');
$this->registerCssFile('/base/vendor/jquery-datatables-bs3/assets/css/datatables.css');

$title = 'Проекты';
$this->title = $title.' - Панель управления';

$usr_role = Yii::$app->user->identity->role;
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
            <div class="pull-right">
                  <a class="mb-xs mr-xs btn btn-primary btn-xs" href="/access/modifications">Модификации</a>
              <a class="mb-xs mr-xs btn btn-primary btn-xs" href="/access/sostav_items">Составы</a>
              <a class="mb-xs mr-xs btn btn-primary btn-xs" href="/access/priority">Приоритеты</a>
              <a class="mb-xs mr-xs btn btn-primary btn-xs" href="/access/dop_info">Характеристики</a>
                <a class="mb-xs mr-xs btn btn-primary btn-xs" href="/access/dop_pr">Дополнительные параметры</a>
                <a class="mb-xs mr-xs btn btn-primary btn-xs" href="/access/style_pr">Стили проектов</a>
                <a class="mb-xs mr-xs btn btn-primary btn-xs" href="/access/materials">Типы материалов</a>
                <a class="mb-xs mr-xs btn btn-primary btn-xs" href="/access/builds_steps">Этапы</a>
                <a class="mb-xs mr-xs btn btn-primary btn-xs" href="/access/builds_sub_steps">Подэтапы</a>

                <a class="mb-xs mr-xs btn btn-primary btn-xs" href="/access/pr_settings"><i class="fa fa-cog"></i> Настройки</a>
            </div>
            <h2 class="panel-title pull-left pr-md"><?=$title?></h2>

            <a class="btn btn-primary btn-xs" href="<?=\yii\helpers\Url::toRoute(['/access/projects/create'])?>"><i class="fa fa-plus"></i>&nbsp;Добавить</a>

          <br/>
        </header>
        <div class="panel-body">
            <table class="table table-striped mb-none table-country" id="datatable-editable">
                <thead>
                <tr>
                    <th class="hidden-2">#</th>
                    <th>Номер проекта</th>
                  <th>Приоритет</th>
                    <th>Изображение</th>
                  <th>Цена строительства</th>
                  <th>Просмотры в МСК</th>
                  <th>Опубликован на главной</th>
                    <th class="center">Действие</th>
                </tr>
                </thead>
                <tbody>

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
<script>
    (function($) {

        'use strict';

        var EditableTable = {

            options: {
                addButton: '#addToTable',
                table: '#datatable-editable',
                dialog: {
                    wrapper: '#dialog',
                    cancelButton: '#dialogCancel',
                    confirmButton: '#dialogConfirm',
                }
            },

            initialize: function() {
                this
                    .setVars()
                    .build()
                    .events();
            },

            setVars: function() {
                this.$table				= $( this.options.table );
                this.$addButton			= $( this.options.addButton );

                // dialog
                this.dialog				= {};
                this.dialog.$wrapper	= $( this.options.dialog.wrapper );
                this.dialog.$cancel		= $( this.options.dialog.cancelButton );
                this.dialog.$confirm	= $( this.options.dialog.confirmButton );

                return this;
            },

            build: function() {
                this.datatable = this.$table.DataTable({
                    aoColumns: [
                        { "sWidth": "3%","searchable": false},
                        { "sWidth": "12%", "bSortable": true},
                      { "sWidth": "18%", "bSortable": true,"searchable": false},
						            { "sWidth": "18%", "bSortable": false,"searchable": false},
                        { "sWidth": "12%", "bSortable": true,"searchable": false},
                        { "sWidth": "12%", "bSortable": true,"searchable": false},
                        { "sWidth": "13%", "bSortable": true,"searchable": false},
                        { "sWidth": "12%", "bSortable": false, "sClass": "center","searchable": false }
                    ],
                  "processing": true,
                  "serverSide": true,
                  "ajax": {
                      url: "/access/projects/load",
                    complete: function() {
                      $("#datatable-editable_wrapper tbody tr td:first-child").addClass("hidden-2");
                      $("#datatable-editable_wrapper tbody tr td:last-child").addClass("actions");

                      $('.image-popup-no-margins').magnificPopup({
                        type: 'image',
                        closeOnContentClick: true,
                        closeBtnInside: false,
                        fixedContentPos: true,
                        mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
                        image: {
                          verticalFit: true
                        },
                        zoom: {
                          enabled: true,
                          duration: 300 // don't foget to change the duration also in CSS
                        }
                      });
                    }
                  },
                    "aaSorting": [[ 0, "desc"]],
					//stateSave: true,
                    "language": {"url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Russian.json"}
                });

                window.dt = this.datatable;

                return this;
            },

            events: function() {
                var _self = this;

                this.$table
                    .on( 'click', 'a.remove-row', function( e ) {
                        e.preventDefault();

                        var $row = $(this).closest( 'tr' );

                        $.magnificPopup.open({
                            items: {
                                src: _self.options.dialog.wrapper,
                                type: 'inline'
                            },
                            preloader: false,
                            modal: true,
                            callbacks: {
                                change: function() {
                                    _self.dialog.$confirm.on( 'click', function( e ) {
                                        e.preventDefault();

                                        _self.rowRemove( $row );
                                        // remove line server
                                        $.ajax({
                                            type: "POST",
                                            dataType: 'json',
                                            url: "/access/projects/delete",
                                            data:  {
                                                id: $row.find("td").eq(0).text(),
                                                _csrf: '<?=Yii::$app->request->getCsrfToken()?>'
                                            },
                                            success: function(data,status) {
                                                if(data.status=="error")
                                                    alert("Произошла ошибка, обновите страницу, и повторите");
                                                else
                                                {
                                                    new PNotify({
                                                        title: "Успешно!",
                                                        text: "Запись успешно удалена!",
                                                        type: 'success'
                                                    });
                                                }
                                            }
                                        });

                                        $.magnificPopup.close();
                                    });
                                },
                                close: function() {
                                    _self.dialog.$confirm.off( 'click' );
                                }
                            }
                        });
                    });

                this.$addButton.on( 'click', function(e) {
                    e.preventDefault();

                    _self.rowAdd();
                });

                this.dialog.$cancel.on( 'click', function( e ) {
                    e.preventDefault();
                    $.magnificPopup.close();
                });

                return this;
            },
            // ==========================================================================================
            // ROW FUNCTIONS
            // ==========================================================================================
            rowRemove: function( $row ) {
                if ( $row.hasClass('adding') ) {
                    this.$addButton.removeAttr( 'disabled' );
                }

                this.datatable.row( $row.get(0) ).remove().draw();
            },

            rowSetActionsEditing: function( $row ) {
                $row.find( '.on-editing' ).removeClass( 'hidden' );
                $row.find( '.on-default' ).addClass( 'hidden' );
            },

            rowSetActionsDefault: function( $row ) {
                $row.find( '.on-editing' ).addClass( 'hidden' );
                $row.find( '.on-default' ).removeClass( 'hidden' );
            }
        };

        $(function() {
            EditableTable.initialize();
        });


    }).apply(this, [jQuery]);

</script>

