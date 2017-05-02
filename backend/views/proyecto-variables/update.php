<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ProyectoVariables */
$this->title = 'Proyecto Variables Editar';
$this->params['breadcrumbs'][] = ['label' => 'Proyecto Variables ', 'url' => ['proyecto-variables/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proyecto-variables-update">

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
