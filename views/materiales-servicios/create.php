<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MaterialesServicios */

?>
<div class="materiales-servicios-create">
    <?= $this->render('_form', [
        'model' => $model,
        'unidadMedida' => $unidadMedida,
        'presentacion' => $presentacion
    ]) ?>
</div>
