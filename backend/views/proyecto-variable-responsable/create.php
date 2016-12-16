<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ProyectoVariableResponsable */
$this->title = 'Crear Responsable De Variable';
$this->params['breadcrumbs'][] = ['label' => 'Proyecto Variable '.$model->id_variable, 'url' => ['/proyecto-variables/view', 'id' => $model->id_variable]];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="proyecto-variable-responsable-create">
    <?= $this->render('_form', [
        'model' => $model,
        'modeluej' => $modeluej,

    ]) ?>
</div>
