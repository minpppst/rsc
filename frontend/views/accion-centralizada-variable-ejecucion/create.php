<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AccionCentralizadaVariableEjecucion */

$this->title = 'Accion Centralizada Variable Ejecución';
$this->params['breadcrumbs'][] = ['label' => 'Accion Centralizada Variable Asignadas', 'url' => ['variables']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accion-centralizada-variable-ejecucion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'model_programacion' => $model_programacion,
        'total' => $total,
        'desbloqueo' => $desbloqueo,
        'total_cargado' => $total_cargado,
    ]) ?>

</div>
