<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AccionCentralizada */

$this->title = 'Modificar Accion Centralizada: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Accion Centralizadas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="accion-centralizada-Modificar">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
