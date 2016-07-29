<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AccionCentralizadaVariableEjecucion */

$this->title = 'Accion Centralizada Variable Ejecución';

if($model->idProgramacion->idLocalizacion->idVariable->localizacion==1){
$this->params['breadcrumbs'][] = ['label' => 'Accion Centralizadas Variables Asignadas', 'url' => ['variables']];
$this->params['breadcrumbs'][] = ['label' => 'Variables Por Región', 'url' => ['localizacion', 'id' => $model->idProgramacion->idLocalizacion->id_variable]];

}else{
$this->params['breadcrumbs'][] = ['label' => 'Accion Centralizada Variables Asignadas', 'url' => ['variables']];
}

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
