<?php

  /* @var $this \yii\web\View */
  /* @var $content string */

  use yii\helpers\Html;
  use app\models\T;

?>
<?php $this->beginPage() ?>
  <!DOCTYPE html>
  <html class="fixed sidebar-light sidebar-left-collapsed" lang="<?= Yii::$app->language ?>">
  <head>
    <meta name="robots" content="noindex, nofollow" />
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <!-- Web Fonts  -->
    <link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="/base/vendor/bootstrap/css/bootstrap.css" />

    <link rel="stylesheet" href="/base/vendor/font-awesome/css/font-awesome.css" />
    <link rel="stylesheet" href="/base/vendor/magnific-popup/magnific-popup.css" />
    <link rel="stylesheet" href="/base/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css" />

    <link rel="stylesheet" href="/base/vendor/jquery-ui/jquery-ui.css" />
    <link rel="stylesheet" href="/base/vendor/jquery-ui/jquery-ui.theme.css" />
    <link rel="stylesheet" href="/base/vendor/select2/css/select2.css" />
    <link rel="stylesheet" href="/base/vendor/select2-bootstrap-theme/select2-bootstrap.css" />
    <!-- Theme CSS -->
    <link rel="stylesheet" href="/base/stylesheets/theme.css" />
    <!-- Skin CSS -->
    <link rel="stylesheet" href="/base/stylesheets/skins/default.css" />
    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="/base/stylesheets/theme-custom.css">
    <link rel="stylesheet" href="/base/vendor/pnotify/pnotify.custom.css" />
    <!-- Head Libs -->
    <script src="/base/vendor/jquery/jquery.js"></script>
    <script src="/base/vendor/modernizr/modernizr.js"></script>
    <script src="/base/vendor/jquery-cookie/jquery-cookie.js"></script>

    <script src="/base/vendor/ckeditor/ckeditor.js"></script>

  </head>
  <body>
  <section class="body">
    <!-- start: header -->
    <?php if (!\Yii::$app->user->isGuest)
      { ?>
    <header class="header">
      <div class="logo-container">
        <a class="logo" href="/access">
          <img height="35" alt="Панель управления" src="/img/icons/logo.svg">
        </a>
        <div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
          <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
        </div>
      </div>

      <!-- start: search & user box -->
      <div class="header-right">

        <div id="userbox" class="userbox">
          <a href="#" data-toggle="dropdown">
            <figure class="profile-picture">
              <img src="/img/icons/user.png" alt="Панель управления" class="img-circle" data-lock-picture="/img/icons/user.png" />
            </figure>
            <div class="profile-info" data-lock-name="><?=\Yii::$app->user->identity->email?>" data-lock-email="">
              <span class="name"><?=\Yii::$app->user->identity->email?></span>
            </div>
            <i class="fa custom-caret"></i>
          </a>

          <div class="dropdown-menu">
            <ul class="list-unstyled">
              <li class="divider"></li>
              <li>
                <a role="menuitem" tabindex="-1" href="/" target="_blank"><i class="fa fa-globe"></i>Перейти на сайт</a>
              </li>
              <li>
                <a role="menuitem" tabindex="-1" href="/access/users/index?id=<?=Yii::$app->user->id?>"><i class="fa fa-user"></i>Мой профиль</a>
              </li>
              <li>
                <a role="menuitem" tabindex="-1" href="/access/login/logout"><i class="fa fa-power-off"></i>Выход</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!-- end: search & user box -->
    </header>
    <!-- end: header -->
    <div class="inner-wrapper">
      <!-- start: sidebar -->
      <aside id="sidebar-left" class="sidebar-left">

        <div class="sidebar-header">
          <div class="sidebar-title">
            Навигация
          </div>
          <div class="sidebar-toggle d-none d-md-block" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
            <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
          </div>
        </div>
        <?php
          $usr_role = Yii::$app->user->identity->role;
        ?>
        <div class="nano">
          <div class="nano-content">
            <nav id="menu" class="nav-main" role="navigation">
              <ul class="nav nav-main">
                <li <?=Yii::$app->controller->id=='projects' ? 'class="nav-active"' : ''?>>
                  <a href="/access/projects">
                    <i aria-hidden="true" class="fa fa-cubes"></i>
                    <span>Проекты</span>
                  </a>
                </li>
                <li <?=Yii::$app->controller->id=='filter_pr' ? 'class="nav-active"' : ''?>>
                  <a href="/access/filter_pr">
                    <i aria-hidden="true" class="fa fa-file-powerpoint-o"></i>
                    <span>Посадочные страницы</span>
                  </a>
                </li>
                <li <?=Yii::$app->controller->id=='site_pages' ? 'class="nav-active"' : ''?>>
                  <a href="/access/site_pages">
                    <i aria-hidden="true" class="fa fa-sticky-note"></i>
                    <span>Статические страницы сайта</span>
                  </a>
                </li>
                <li class="nav-parent <?=(Yii::$app->controller->id=='baza_znanij_articles' || Yii::$app->controller->id=='baza_znanij_category') ? 'nav-active nav-expanded' : ''?>">
                  <a>
                    <i aria-hidden="true" class="fa fa-info-circle"></i>
                    <span>Помощь</span>
                  </a>
                  <ul class="nav nav-children">
                    <li <?=Yii::$app->controller->id=='baza_znanij_articles' ? 'class="nav-active"' : ''?>><a href="/access/baza_znanij_articles">Статьи</a></li>
                    <li <?=Yii::$app->controller->id=='baza_znanij_category' ? 'class="nav-active"' : ''?>><a href="/access/baza_znanij_category">Разделы</a></li>
                  </ul>
                </li>
                <li <?=Yii::$app->controller->id=='map_item' ? 'class="nav-active"' : ''?>>
                  <a href="/access/map_item">
                    <i aria-hidden="true" class="fa fa-map-marker"></i>
                    <span>Карта объектов</span>
                  </a>
                </li>
                <li <?=Yii::$app->controller->id=='calc_category' ? 'class="nav-active"' : ''?>>
                  <a href="/access/calc_category">
                    <i aria-hidden="true" class="fa fa-calculator"></i>
                    <span>Калькулятор</span>
                  </a>
                </li>
                <li class="nav-parent">
                  <a>
                    <i aria-hidden="true" class="fa fa-list"></i>
                    <span>Настройки сайта</span>
                  </a>
                  <ul class="nav nav-children">
                    <li class="nav-parent">
                      <a>
                        <span>Главная страница</span>
                      </a>
                      <ul class="nav nav-children" style="">
                        <li>
                          <a href="/access/home_page">
                            Основные настройки
                          </a>
                        </li>
                        <li>
                          <a href="/access/home_page_item">
                            Блок популярные категории
                          </a>
                        </li>
                        <li>
                          <a href="/access/home_page_category">
                            Группы популярные категории
                          </a>
                        </li>
                      </ul>
                    </li>
                    <li>
                      <a href="/access/adv_settings">
                        Рекламные блоки
                      </a>
                    </li>
                    <li><a href="/access/settings_contacts">Контакты</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </aside>
      <!-- end: sidebar -->
      <?php } ?>

      <?php $this->beginBody() ?>

      <?= $content ?>

  </section>
  <div id="dialog" class="modal-block mfp-hide">
    <section class="panel">
      <header class="panel-heading">
        <h2 class="panel-title">Вы уверены?</h2>
      </header>
      <div class="panel-body">
        <div class="modal-wrapper">
          <div class="modal-text">
            <p>Вы уверены, что хотите удалить эту строку? После подтверждения, запись будет удалена навсегда без возможности восстановления! Если не уверены в том, что хотите ее удалить, отправьте ее в архив.</p>
          </div>
        </div>
      </div>
      <footer class="panel-footer">
        <div class="row">
          <div class="col-md-12 text-right">
            <button id="dialogConfirm" class="btn btn-primary">Подтвердить</button>
            <button id="dialogCancel" class="btn btn-default">Отмена</button>
          </div>
        </div>
      </footer>
    </section>
  </div>
  <!-- Vendor -->

  <?php
    $this->registerJsFile('/base/vendor/jquery-browser-mobile/jquery.browser.mobile.js');
    $this->registerJsFile('/base/vendor/bootstrap/js/bootstrap.js');
    $this->registerJsFile('/base/vendor/nanoscroller/nanoscroller.js');
    $this->registerJsFile('/base/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js');
    $this->registerJsFile('/base/vendor/magnific-popup/jquery.magnific-popup.js');
    $this->registerJsFile('/base/vendor/jquery-placeholder/jquery-placeholder.js');

    $this->registerJsFile('/base/vendor/pnotify/pnotify.custom.js');

    $this->registerJsFile('/base/javascripts/theme.js');

    $this->registerJsFile('/base/javascripts/theme.custom.js');

    $this->registerJsFile('/base/javascripts/theme.init.js'); ?>
  <?php $this->endBody() ?>
  </body>
  </html>
<?php $this->endPage();
  if(Yii::$app->session->hasFlash('status'))
  { ?>
    <script>
      $( document ).ready(function() {
        'use strict';

        new PNotify({
          title: "Успешно!",
          text: "<?=Yii::$app->session->getFlash('status')?>",
          type: 'success'
        });
      }).apply(this, [jQuery]);
    </script>
  <?php }
?>