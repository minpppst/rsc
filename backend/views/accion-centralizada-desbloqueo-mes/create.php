<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\AccionCentralizadaDesbloqueoMes */

$this->title = 'Create Accion Centralizada Desbloqueo Mes';
$this->params['breadcrumbs'][] = ['label' => 'Accion Centralizada Desbloqueo Mes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accion-centralizada-desbloqueo-mes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
