<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProyectoResponsableAdministrativo */

$this->title = 'Proyecto Responsable Administrativo: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Proyecto Responsable Administrativo', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="proyecto-responsable-administrativo-update">

    <?php if (!Yii::$app->request->isAjax){ ?>
    	<h1><?= Html::encode($this->title) ?></h1>
    <?php } ?>

    <?= $this->render('_form', [
        'model' => $model,
        'unidadEjecutora' => $unidadEjecutora,
    ]) ?>

</div>
