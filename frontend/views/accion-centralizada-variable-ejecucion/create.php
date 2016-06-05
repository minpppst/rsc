<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AccionCentralizadaVariableEjecucion */

$this->title = 'Create Accion Centralizada Variable Ejecucion';
$this->params['breadcrumbs'][] = ['label' => 'Accion Centralizada Variable Ejecucions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accion-centralizada-variable-ejecucion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
