<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\AutoComplete;

/* @var $this yii\web\View */
/* @var $model app\models\MaterialesServicios */
/* @var $form yii\widgets\ActiveForm */

//Iconos
$icons=[
    'nuevo'=>'<span class="glyphicon glyphicon-file" aria-hidden="true"></span>',
    'editar'=>'<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>',
    'eliminar'=>'<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>',
    'volver'=>'<span class="glyphicon glyphicon-triangle-left" aria-hidden="true"></span>',
];

?>

<div class="materiales-servicios-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_se')->hiddenInput() ?>

    <div class="form-group">
        <?= AutoComplete::widget([
            'model' => $model,
            'name' => 'country',
            'clientOptions' => [
                'source' => $partida_se,
            ],
            'options' => [
                'class' => 'form-control',
                'placeholder' => 'Escriba para buscar'
            ]
        ]) ?>
    </div>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'unidad_medida')->textInput() ?>

    <?= $form->field($model, 'presentacion')->textInput() ?>

    <?= $form->field($model, 'precio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'iva')->textInput() ?>

    <?= $form->field($model, 'estatus')->textInput() ?>

    <div class="form-group">
        <?= Html::a($icons['volver'].' Volver', ['/materiales-servicios/index'], ['class' => 'btn btn-primary']) ?>        
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>