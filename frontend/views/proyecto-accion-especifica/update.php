<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProyectoAccionEspecifica */
?>
<div class="proyecto-accion-especifica-update">

    <?= $this->render('_form', [
        'model' => $model,
        'unidadEjecutora' => $unidadEjecutora,
        'unidadMedida' => $unidadMedida
    ]) ?>

</div>
