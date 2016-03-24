<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProyectoAccionEspecificaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proyecto-accion-especifica-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_proyecto') ?>

    <?= $form->field($model, 'codigo_accion_especifica') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'id_unidad_ejecutora') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
