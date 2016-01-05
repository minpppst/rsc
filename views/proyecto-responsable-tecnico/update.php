<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProyectoResponsableTecnico */

$this->title = 'Update Proyecto Responsable Tecnico: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Proyecto Responsable Tecnicos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="proyecto-responsable-tecnico-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
