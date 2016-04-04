<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProyectoPedido */
?>
<div class="proyecto-pedido-update">

    <?= $this->render('_form', [
        'model' => $model,
        'materiales' => $materiales
    ]) ?>

</div>
