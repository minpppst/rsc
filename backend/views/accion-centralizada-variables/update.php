<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AccionCentralizadaVariables */

$this->title = 'Modificar Accion Centralizada Variables: #' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Accion Centralizada Variables', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="accion-centralizada-variables-update">

    <?= $this->render('_form', [
        'model' => $model,
         'precarga' => $precarga,
         'verificar' => $verificar,
         'verificar1' => $verificar1,
         'ue' => $ue,
        'accion_centralizada' => $accion_centralizada,
        'accionAC' => $accionAC,
        'accion_especifica' => $accion_especifica,
    ]) ?>

</div>
