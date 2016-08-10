<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\UePartidaEntidad */
$this->title = 'Modificar Partida Unidad-Ejecutora';

$this->params['breadcrumbs'][] = ['label' => 'UePartidasEntidas', 'url' => ['ue-partida-entidad/index']];
$this->params['breadcrumbs'][] = 'Modificar Partida Unidad-Ejecutora';
?>
<div class="proyecto-update">

    <br>

<div class="ue-partida-entidad-update">

    <?= $this->render('_form', [
        'model' => $model,
        'ue' => $ue,
        'tipo_entidad' => $tipo_entidad,
        'precarga_proyecto' => $precarga_proyecto,
        'precarga_acc' => $precarga_acc,
    ]) ?>

</div>
