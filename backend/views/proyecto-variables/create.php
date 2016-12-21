<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ProyectoVariables */

?>
<div class="proyecto-variables-create">
    <?= $this->render('_form', [
        'model' => $model,
        'proyecto' => $proyecto,
        'proyectoac' => $proyectoac,
        'listproyecto' => $listproyecto,
        'modeluser' => $modeluser,
        'ue' => $ue,
        'impacto' => $impacto,
        'lugares' => $lugares,
        'listausuariosaccion' => $listausuariosaccion,
    ]) ?>
</div>
