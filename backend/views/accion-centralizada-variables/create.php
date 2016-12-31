<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AccionCentralizadaVariables */

$this->title = 'Crear Variables';
$this->params['breadcrumbs'][] = ['label' => 'Accion Centralizada Variables', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accion-centralizada-variables-create">

    <?= $this->render('_form', [
        'model' => $model,
        'listaaccion_centralizada' => $listaaccion_centralizada,
        'listaaccion_especifica' => $listaaccion_especifica,
        'modelAC' => $modelAC,
        'usuariomodel' => $usuariomodel,
        'ue' => $ue,
        'lugares' => $lugares
    ]) ?>

</div>
