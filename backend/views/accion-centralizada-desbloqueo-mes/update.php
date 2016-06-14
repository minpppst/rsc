<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AccionCentralizadaDesbloqueoMes */

$this->title = 'Update Accion Centralizada Desbloqueo Mes: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Accion Centralizada Desbloqueo Mes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="accion-centralizada-desbloqueo-mes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
