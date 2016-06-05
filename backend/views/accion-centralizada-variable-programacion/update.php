<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AccionCentralizadaVariableProgramacion */

$this->title = 'Update Accion Centralizada Variable Programacion: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Accion Centralizada Variable Programacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="accion-centralizada-variable-programacion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
