<?php
  $this->registerCssFile('/base/vendor/select2/css/select2.css');
  $this->registerCssFile('/base/vendor/jquery-datatables-bs3/assets/css/datatables.css');

  $title = 'Помощь';
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
      <div class="pull-right">
        <a class="mb-xs mr-xs btn btn-primary btn-xs" href="/access/baza_znanij_category">Разделы</a>
      </div>
      <h2 class="panel-title pull-left pr-md"><?=$title?></h2>

      <a class="btn btn-primary btn-xs" href="<?=\yii\helpers\Url::toRoute(['/access/baza_znanij_articles/create'])?>"><i class="fa fa-plus"></i>&nbsp;Добавить</a>

      <br/>
    </header>
    <div class="panel-body">
      <table class="table table-striped mb-none table-country" id="datatable-editable">
        <thead>
        <tr>
          <th>ID</th>
          <th>Название</th>
          <th>Раздел</th>
          <th>ЧПУ</th>
          <th>Дата изменения</th>
          <th class="center">Действие</th>
        </tr>
        </thead>
        <tbody>
        <?php
          foreach($models as $record)
          {
            $parentItem = \app\models\BazaZnanijCategory::find()->where(['id'=>$record['category_id']])->asArray()->one();
            ?>
            <tr class="gradeX" data-numline="<?=$record['id']?>">
              <td class="text-vertical"><?=$record['id']?></td>
              <td class="text-vertical"><?=$record['link_title']?></td>
              <td class="text-vertical"><?=$parentItem['name']?></td>
              <td class="text-vertical"><?=$record['link_url']?></td>
              <td class="text-vertical"><?=$record['date_update']?></td>
              <td class="actions">
                <a href="//<?=$_SERVER['SERVER_NAME']?>/baza-znanij/<?=$record['link_url']?>" class="on-default text-info" target="_blank"><i class="fa fa-eye"></i></a>
                <a href="<?=\yii\helpers\Url::toRoute(['/access/baza_znanij_articles/update','id'=>$record['id']])?>" class="on-default edit-row"><i class="fa fa-pencil"></i></a>
                <a href="#" class="on-default remove-row text-danger"><i class="fa fa-trash-o"></i></a>
              </td>
            </tr>
          <?php } ?>
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
            { "sWidth": "3%"},
            { "sWidth": "25%", "bSortable": false},
            { "sWidth": "20%", "bSortable": true},
            { "sWidth": "30%", "bSortable": false},
            { "sWidth": "10%", "bSortable": true},
            { "sWidth": "12%", "bSortable": false, "sClass": "center" }
          ],
          "aaSorting": [[ 0, "desc" ]],
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
                      url: "/access/baza_znanij_articles/delete",
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