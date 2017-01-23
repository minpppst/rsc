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
         'listausuarios' => $listausuarios,
         'usuariomodel' => $usuariomodel,
         'ue' => $ue,
        'listaaccion_centralizada' => $listaaccion_centralizada,
        'modelAC' => $modelAC,
        'listaaccion_especifica' => $listaaccion_especifica,
        'lugares' => $lugares
    ]) ?>

</div>
