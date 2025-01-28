<?php
$this->title = \app\models\T::t('Избранное');
$this->registerMetaTag(['name' =>'description', 'content' =>\app\models\T::t('Избранное')]);
$this->registerMetaTag(['name' =>'keywords', 'content' =>\app\models\T::t('Избранное')]);

?>
<div class="idom_broadcrumbs">
  <div class="container">
    <ul class="px-5">
      <li><a href="/"><?=\app\models\T::t('Главная')?></a></a></li>
      <li><a href="/catalog/proekty-domov"><?=\app\models\T::t('Каталог проектов')?></a></a></li>
    </ul>
  </div>
</div>

<div class="container pb-5">
  <div class="bg-white idom_favorite-page p-5">
    <h1><?=\app\models\T::t('Список выбранных проектов')?></h1>

    <div class="idom_favorite-row">
      <?php
      foreach (unserialize(Yii::$app->session['izbrannoe']) as $id) {
        $rec = \app\models\Projects::find()->where(['id'=>$id])->asArray()->one();
        echo $this->render('@app/modules/catalog/views/proekty-domov/block',['rec'=>$rec]);
      } ?>
    </div>

  </div>
</div>
