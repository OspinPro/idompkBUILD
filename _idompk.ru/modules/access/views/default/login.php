<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = "Авторизация";
?>
<section class="body-sign">
  <div class="center-sign">
    <a class="logo pull-left" href="/">
      <img height="40" alt="Admin" src="/img/icons/logo.svg">
    </a>
    <div class="panel panel-sign">
      <div class="panel-title-sign mt-xl text-right">
        <?php /*?><h2 class="title text-uppercase text-weight-bold m-none" style="background-color:#fff;"><a href="#">Українська</a></h2>
                <h2 class="title text-uppercase text-weight-bold m-none" style="background-color:#fff;"><a href="#">English</a></h2><?php */?>
        <h2 class="title text-uppercase text-weight-bold m-none"><i class="fa fa-star mr-xs"></i>Вход</h2>
      </div>
      <div class="panel-body">
        <?php $form = ActiveForm::begin(); ?>
        <div class="form-group mb-lg">
          <label>Логин</label>
          <div class="input-group input-group-icon">
            <input name="LoginForm[email]" type="text" class="form-control input-lg" />
            <span class="input-group-addon">
                                <span class="icon icon-lg">
                                    <i class="fa fa-user"></i>
                                </span>
                            </span>
          </div>
        </div>
        <div class="form-group mb-lg">
          <div class="clearfix">
            <label class="pull-left">Пароль</label>
          </div>
          <div class="input-group input-group-icon">
            <input name="LoginForm[password]" type="password" class="form-control input-lg" />
            <span class="input-group-addon">
                                <span class="icon icon-lg">
                                    <i class="fa fa-lock"></i>
                                </span>
                            </span>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <div class="checkbox-custom checkbox-default">
              <input id="RememberMe" name="LoginForm[rememberMe]" type="checkbox" value="1" checked/>
              <label for="RememberMe">Запомнить меня</label>
            </div>
          </div>
          <div class="col-sm-12 text-right">
            <button type="submit" name="login-button" class="btn btn-primary hidden-xs">Вход</button>
            <button type="submit" name="login-button" class="btn btn-primary btn-block btn-lg visible-xs mt-lg">Вход</button>
          </div>
        </div>
        <?php ActiveForm::end(); ?>
      </div>
    </div>

    <p class="text-center text-muted mt-md mb-md">&copy; Copyright. Все права защищены.</p>
  </div>
</section>