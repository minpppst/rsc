<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Proyecto */

$this->title = 'Update Proyecto: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Proyectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="proyecto-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'estatus_proyecto' => $estatus_proyecto,
        'situacion_presupuestaria' => $situacion_presupuestaria,
        'sector' => $sector,
        'sub_sector' => $sub_sector,
        'plan_operativo' => $plan_operativo,
        'objetivo_general' => $objetivo_general,
        'ambito' =>$ambito
    ]) ?>

</div>
