<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProyectoAsignar */

?>
<div class="accion-centralizada-asignar-create">
    <?= $this->render('_form', [
        'model' => $model,
        'ue' => $ue,
        'accion_centralizada' => $accion_centralizada,
        'accion_especifica' => $accion_especifica,
    ]) ?>
</div>
