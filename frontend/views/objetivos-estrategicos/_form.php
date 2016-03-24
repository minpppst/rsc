<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ObjetivosEstrategicos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="objetivos-estrategicos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'objetivo_estrategico')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'objetivo_nacional')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
