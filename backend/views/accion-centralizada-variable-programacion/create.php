<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\AccionCentralizadaVariableProgramacion */

$this->title = 'Create Accion Centralizada Variable Programacion';
$this->params['breadcrumbs'][] = ['label' => 'Accion Centralizada Variable Programacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accion-centralizada-variable-programacion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
