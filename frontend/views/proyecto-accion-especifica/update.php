<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProyectoAccionEspecifica */
?>
<div class="proyecto-accion-especifica-update">

    <?= $this->render('_form', [
        'model' => $model,
        'unidadEjecutora' => $unidadEjecutora,
        'unidadMedida' => $unidadMedida,
        'fuenteFinanciamiento' => $fuenteFinanciamiento,
        'model2' => $model2,
        'id_estado' => $id_estado,
        'id_municipio' => $id_municipio,
        'id_parroquia' => $id_parroquia
    ]) ?>

</div>
