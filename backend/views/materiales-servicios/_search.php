<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MaterialesServiciosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="materiales-servicios-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_se') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'unidad_medida') ?>

    <?= $form->field($model, 'presentacion') ?>

    <?php // echo $form->field($model, 'precio') ?>

    <?php // echo $form->field($model, 'iva') ?>

    <?php // echo $form->field($model, 'estatus') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
