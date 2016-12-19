<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ProyectoVariableEjecucion */

?>
<div class="proyecto-variable-ejecucion-create">
    <?= $this->render('_form', [
        'model' => $model,
        'model_programacion' => $model_programacion,
        'desbloqueo' => $desbloqueo,
        'total_cargado' => $total_cargado,
    ]) ?>
</div>
