<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AccionCentralizadaVariableEjecucion */
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
