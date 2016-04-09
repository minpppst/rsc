<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProyectoResponsableTecnico */

$this->title = 'Responsable Tecnico';
$this->params['breadcrumbs'][] = ['label' => 'Proyectos', 'url' => ['proyecto/index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_proyecto, 'url' => ['proyecto/view', 'id' => $model->id_proyecto]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proyecto-responsable-tecnico-create">

    <?php if (!Yii::$app->request->isAjax){ ?>
    	<h1><?= Html::encode($this->title) ?></h1>
    <?php } ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
