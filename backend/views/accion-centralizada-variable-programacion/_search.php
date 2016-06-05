<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AccionCentralizadaVariableProgramacionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="accion-centralizada-variable-programacion-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_localizacion') ?>

    <?= $form->field($model, 'enero') ?>

    <?= $form->field($model, 'febrero') ?>

    <?= $form->field($model, 'marzo') ?>

    <?php // echo $form->field($model, 'abril') ?>

    <?php // echo $form->field($model, 'mayo') ?>

    <?php // echo $form->field($model, 'junio') ?>

    <?php // echo $form->field($model, 'julio') ?>

    <?php // echo $form->field($model, 'agosto') ?>

    <?php // echo $form->field($model, 'septiembre') ?>

    <?php // echo $form->field($model, 'octubre') ?>

    <?php // echo $form->field($model, 'noviembre') ?>

    <?php // echo $form->field($model, 'diciembre') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
