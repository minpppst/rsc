<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProyectoResponsableTecnicoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proyecto-responsable-tecnico-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'cedula') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'telefono') ?>

    <?php // echo $form->field($model, 'unidad_tecnica') ?>

    <?php // echo $form->field($model, 'id_proyecto') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
