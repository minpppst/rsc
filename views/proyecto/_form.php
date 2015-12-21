<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Proyecto */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="proyecto-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'codigo_proyecto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'codigo_sne')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'estatus_proyecto')->dropDownList(ArrayHelper::map($estatus_proyecto,'id','estatus'),['prompt'=>'Seleccione']) ?>

    <?= $form->field($model, 'situacion_presupuestaria')->dropDownList(ArrayHelper::map($situacion_presupuestaria,'id','situacion'),['prompt'=>'Seleccione']) ?>

    <?= $form->field($model, 'monto_proyecto')->input('number') ?>

    <?= $form->field($model, 'descripcion')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'clasificacion_sector')->textInput() ?>

    <?= $form->field($model, 'sub_sector')->textInput() ?>

    <?= $form->field($model, 'plan_operativo')->textInput() ?>

    <?= $form->field($model, 'objetivo_estrategico')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
