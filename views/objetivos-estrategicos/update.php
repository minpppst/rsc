<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ObjetivosEstrategicos */

$this->title = 'Update Objetivos Estrategicos: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Objetivos Estrategicos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="objetivos-estrategicos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
