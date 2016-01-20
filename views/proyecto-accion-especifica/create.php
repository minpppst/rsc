<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProyectoAccionEspecifica */

?>
<div class="proyecto-accion-especifica-create">
    <?= $this->render('_form', [
        'model' => $model,
        'unidadEjecutora' => $unidadEjecutora,
    ]) ?>
</div>
