<?php

$this->registerCssFile('/base/vendor/select2/css/select2.css');
$this->registerCssFile('/base/vendor/select2-bootstrap-theme/select2-bootstrap.css');
$this->registerCssFile('/base/vendor/jquery-datatables-bs3/assets/css/datatables.css');

$title = "Материалы";
$this->title = $title." - Панель управления";
?>
<!-- Specific Page Vendor CSS -->
<?php
//\yii\widgets\Pjax::begin();
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
            <h2 class="panel-title pull-left mr-md"><?=$title?></h2>
            <button id="addToTable" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i>&nbsp;Добавить</button>
        </header>
        <div class="panel-body">
            <table class="table table-striped mb-none table-city" id="datatable-editable">
                <thead>
                <tr>
                    <th class="hidden-2">#</th>
                    <th>Номер</th>
                    <th>Название</th>
                    <th>Действие</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach(\app\models\Materials::find()->asArray()->all() as $country)
                {?>
                    <tr class="gradeA" data-numline="<?=$country['id']?>">
                        <td class="hidden-2"><?=$country['position']?></td>
                        <td class="actions"><input class="form-control sort_inp pull-left pr-md input-sm" style="width:40%;" type="text" value="<?=$country['position']?>" /> <a class="btn btn-primary btn-sm sort_link_hide ml-md" href="#">Сохранить</a></td>
                        <td class="text-vertical"><?=$country['name']?></td>
                        <td class="actions">
                            <a href="#" class="hidden on-editing save-row"><i class="fa fa-save"></i></a>
                            <a href="#" class="hidden on-editing cancel-row"><i class="fa fa-times"></i></a>
                            <a href="#" class="on-default edit-row"><i class="fa fa-pencil"></i></a>
                            <a href="<?=\yii\helpers\Url::toRoute(['/access/materials/up','id'=>$country['id']])?>" class="on-default sortup-row"><i class="fa fa-arrow-up"></i></a>
                            <a href="<?=\yii\helpers\Url::toRoute(['/access/materials/down','id'=>$country['id']])?>" class="on-default sortdown-row"><i class="fa fa-arrow-down"></i></a>
                            <a href="#" class="on-default remove-row"><i class="fa fa-trash-o"></i></a>
                        </td>
                    </tr>
              <?php }?>

                </tbody>
            </table>
        </div>
    </section>

    <!-- Specific Page Vendor -->
    <?php
    $this->registerJsFile('/base/vendor/select2/js/select2.js');
    $this->registerJsFile('/base/vendor/jquery-datatables/media/js/jquery.dataTables.js');
    $this->registerJsFile('/base/vendor/jquery-datatables-bs3/assets/js/datatables.js');
    ?>
    <!-- end: page -->
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
                        { "sWidth": "0%"},
                        { "sWidth": "15%", "bVisible": true, "bSortable": false },
                        { "sWidth": "70%", "bSortable": false },
                        { "sWidth": "15%", "bSortable": false, "sClass": "center" }
                    ],
                    "aaSorting": [[ 0, "asc" ]],
					//stateSave: true,
                    "language": {"url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Russian.json"}
                });

                window.dt = this.datatable;

                return this;
            },

            events: function() {
                var _self = this;

                this.$table
                    .on('click', 'a.save-row', function( e ) {
                        e.preventDefault();

                        _self.rowSave( $(this).closest( 'tr' ) );	
						
                    })
                    .on('click', 'a.cancel-row', function( e ) {
                        e.preventDefault();

                        _self.rowCancel( $(this).closest( 'tr' ) );
                    })
                    .on('click', 'a.edit-row', function( e ) {
                        e.preventDefault();

                        _self.rowEdit( $(this).closest( 'tr' ) );
                    })
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
                                            url: "/access/materials/delete",
                                            data:  {
                                                id: $row.data("numline"),
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
            rowAdd: function() {
                this.$addButton.attr({ 'disabled': 'disabled' });

                var actions,
                    data,
                    $row;

                actions = [
                    '<a href="#" class="hidden on-editing save-row"><i class="fa fa-save"></i></a>',
                    '<a href="#" class="hidden on-editing cancel-row"><i class="fa fa-times"></i></a>'
                ].join(' ');

                data = this.datatable.row.add([ '0', '', '', actions ]);
                $row = this.datatable.row( data[0] ).nodes().to$();

                $row
                    .addClass( 'adding' )
                    .find( 'td:last' )
                    .addClass( 'actions' );

                $row
                    .find( 'td:eq( 1 )' )
                    .addClass( 'actions' );
              $row
                .find( 'td:eq( 0 )' )
                .addClass( 'hidden-2' );

                this.rowEdit( $row );

                this.datatable.order([0,'asc']).draw(); // always show fields
            },

            rowCancel: function( $row ) {
                var _self = this,
                    $actions,
                    i,
                    data;

                if ( $row.hasClass('adding') ) {
                    this.rowRemove( $row );
                } else {

                    data = this.datatable.row( $row.get(0) ).data();
				
				/*	if (!data) {
						alert(areltAddNullText);
						return;
					}*/
                    this.datatable.row( $row.get(0) ).data( data );

                    $actions = $row.find('td.actions');
                    if ( $actions.get(0) ) {
                        this.rowSetActionsDefault( $row );
                    }

                    this.datatable.draw();
                }
            },

            rowEdit: function( $row ) {
                var _self = this,
                    data;

                data = this.datatable.row( $row.get(0) ).data();

                $row.children( 'td' ).each(function( i ) {
                    var $this = $( this );

                    if ( $this.hasClass('actions') ) {
                        _self.rowSetActionsEditing( $row );
                    } else  if (i == 0) {
                        $this.html(data[i]);
					} else {
                        $this.html( '<input type="text" class="form-control input-block" value="' + data[i] + '"/>' );
                    }
                });
            },

            rowSave: function( $row ) {
                var _self     = this,
                    $actions,
                    values    = [];

                if ( $row.hasClass( 'adding' ) ) {
                    this.$addButton.removeAttr( 'disabled' );
                    $row.removeClass( 'adding' );
                }
				
			/*	if (!values[1]) {
					alert(areltAddNullText);
					return;
				}*/

                values = $row.find('td').map(function() {
                    var $this = $(this);

                    if ( $this.hasClass('actions') ) {
                        _self.rowSetActionsDefault( $row );
                        return _self.datatable.cell( this ).data();
                    } else {
                        return $.trim( $this.find('input').val() );						
                    }
                });
				
				
				var attr = $row.attr("data-numline");
				var at1 = null;
				if (typeof attr !== typeof undefined && attr !== false) {
					values[0] = $row.find("td").text();
                    $.ajax({
                        type: "POST",
                        dataType: 'json',
                        url: "/access/materials/update",
                        data:  {
                            name: values[2],
                            id: $row.data("numline"),
                            _csrf: '<?=Yii::$app->request->getCsrfToken()?>'
                        },
                        success: function(data,status) {
                            if(data.status=="error")
                                alert("Произошла ошибка, обновите страницу, и повторите");
                            else
                            {
                                new PNotify({
                                    title: "Успешно!",
                                    text: "Запись успешно изменена!",
                                    type: 'success'
                                });
                            }
                        }
                    });
				} else {
                    $.ajax({
                        type: "POST",
                        async: false,
                        dataType: 'json',
                        url: "/access/materials/create",
                        data:  {
                            name: values[2],
                            _csrf: '<?=Yii::$app->request->getCsrfToken()?>'
                        },
                        success: function(data,status) {
                            if(data.status!="error")
                            {
                                $row.attr("data-numline",data.id);
                                values[0] = data.pos;
                                /*values[1] = [
                                    '<input class="form-control sort_inp" type="text" value="1" />'
                                ];*/
								values[5] = [
									'<a href="#" class="hidden on-editing save-row"><i class="fa fa-save"></i></a>',
									'<a href="#" class="hidden on-editing cancel-row"><i class="fa fa-times"></i></a>',
									'<a href="#" class="on-default edit-row"><i class="fa fa-pencil"></i></a>',
									'<a href="/access/materials/up?id='+data.id+'" class="on-default sortup-row"><i class="fa fa-arrow-up"></i></a>',
									'<a href="/access/materials/down?id='+data.id+'" class="on-default sortdown-row"><i class="fa fa-arrow-down"></i></a>',
									'<a href="#" class="on-default remove-row"><i class="fa fa-trash-o"></i></a>'
								].join(' ');

                                new PNotify({
                                    title: "Успешно!",
                                    text: "Запись успешно добавлена!",
                                    type: 'success'
                                });

                                location.reload();
                            }
                            else
                                alert("Произошла ошибка, обновите страницу, и повторите")
                        }
                    });
				}
				
				
				this.datatable.row( $row.get(0)).data( values );

                $actions = $row.find('td.actions');
                if ( $actions.get(0) ) {
                    this.rowSetActionsDefault( $row );
                }

                this.datatable.order([0,'asc']).draw();
            },

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

    $(document).on("click focus touchstart", ".sort_inp", function(){
        $(".sort_link_hide").show();
    });

    $(document).on("click touchstart", ".sort_link_hide", function(e){
        e.preventDefault();

        var sortArray = new Array();
        var sortArray2 = new Array();

        $("table.table tbody tr").each(function(index, element) {
            sortArray.push($(this).data("numline"));
            sortArray2.push($(this).find(".sort_inp").val());
        });

        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "/access/materials/reposition",
            data:  {
                mass: sortArray,
                mass2: sortArray2,
                _csrf: '<?=Yii::$app->request->getCsrfToken()?>'
            },
            success: function(data,status) {
                if(data.status=="error")
                    alert("Перепроверьте введенные символы");
                else
                {
                    location.reload();
                }
            }
        });
    });
</script>