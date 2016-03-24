<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\MaterialesServicios */

?>
<div class="materiales-servicios-create">
    <?= $this->render('_form', [
        'model' => $model,
        'unidad_medida' => $unidad_medida,
        'presentacion' => $presentacion,
        'sub_especfica' => $sub_especfica
    ]) ?>
</div>
