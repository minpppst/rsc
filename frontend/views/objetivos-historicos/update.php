<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ObjetivosHistoricos */

$this->title = 'Update Objetivos Historicos: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Objetivos Historicos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="objetivos-historicos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
