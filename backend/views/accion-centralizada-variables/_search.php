<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AccionCentralizadaVariablesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="accion-centralizada-variables-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nombre_variable') ?>

    <?= $form->field($model, 'unidad_medida') ?>

    <?= $form->field($model, 'localizacion') ?>

    <?= $form->field($model, 'definicion') ?>

    <?php // echo $form->field($model, 'base_calculo') ?>

    <?php // echo $form->field($model, 'fuente_informacion') ?>

    <?php // echo $form->field($model, 'responsable') ?>

    <?php // echo $form->field($model, 'meta_programada_variable') ?>

    <?php // echo $form->field($model, 'unidad_ejecutora') ?>

    <?php // echo $form->field($model, 'acc_accion_especifica') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
