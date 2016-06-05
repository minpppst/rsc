<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\AccionCentralizadaVariableEjecucionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="accion-centralizada-variable-ejecucion-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_programacion') ?>

    <?= $form->field($model, 'id_usuario') ?>

    <?= $form->field($model, 'fecha') ?>

    <?= $form->field($model, 'enero') ?>

    <?php // echo $form->field($model, 'febrero') ?>

    <?php // echo $form->field($model, 'marzo') ?>

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
