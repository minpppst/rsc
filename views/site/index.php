<?php

/* @var $this yii\web\View */

$this->title = 'Registro, Segumiento y Control';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>¡Bienvenido <?= Yii::$app->user->identity->username ?>!</h1>
        <p>Resumen de actividades</p>
    </div>

    <div class="body-content">
    	<?= Yii::$app->controller->renderPartial('_sysadmin') ?>
    </div>
</div>
