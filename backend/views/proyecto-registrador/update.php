<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProyectoRegistrador */

$this->title = 'Proyecto Registrador: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Proyecto', 'url' => ['proyecto/index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_proyecto, 'url' => ['proyecto/view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="proyecto-registrador-update">

    <?php if (!Yii::$app->request->isAjax){ ?>
    	<h1><?= Html::encode($this->title) ?></h1>
    <?php } ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
