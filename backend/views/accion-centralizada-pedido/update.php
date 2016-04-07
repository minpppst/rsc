<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProyectoPedido */
?>
<div class="accion-centralizada-pedido-update">

    <?= $this->render('_form', [
        'model' => $model,
        'materiales' => $materiales,
       // 'precios' => $precios
    ]) ?>

</div>
