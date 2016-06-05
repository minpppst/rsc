<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AccionCentralizadaVariableEjecucion */

$this->title = 'Update Accion Centralizada Variable Ejecucion: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Accion Centralizada Variable Ejecucions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="accion-centralizada-variable-ejecucion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
