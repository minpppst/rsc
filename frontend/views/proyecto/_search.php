<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProyectoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proyecto-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'codigo_proyecto') ?>

    <?= $form->field($model, 'codigo_sne') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'estatus_proyecto') ?>

    <?php // echo $form->field($model, 'situacion_presupuestaria') ?>

    <?php // echo $form->field($model, 'monto_proyecto') ?>

    <?php // echo $form->field($model, 'descripcion') ?>

    <?php // echo $form->field($model, 'clasificacion_sector') ?>

    <?php // echo $form->field($model, 'sub_sector') ?>

    <?php // echo $form->field($model, 'plan_operativo') ?>

    <?php // echo $form->field($model, 'objetivo_estrategico') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
