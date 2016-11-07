<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProyectoAccionEspecifica */

?>
<div class="proyecto-accion-especifica-create">
    <?= $this->render('_form', [
        'model' => $model,
        'unidadEjecutora' => $unidadEjecutora,
        'unidadMedida' => $unidadMedida,
        'fuenteFinanciamiento' => $fuenteFinanciamiento,
        'ambito' => $ambito,
        'model2' => $model2,
        //'paises' => $paises,
        //'estados' => $estados,
        //'parroquia' => $parroquia,
        //'municipios' => $municipios
    ]) ?>
</div>
