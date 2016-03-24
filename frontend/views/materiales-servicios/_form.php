<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use yii\jui\AutoComplete;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model app\models\MaterialesServicios */
/* @var $form yii\widgets\ActiveForm */

//Iconos
$icons=[
    'nuevo'=>'<span class="glyphicon glyphicon-file" aria-hidden="true"></span>',
    'crear'=>'<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>',
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
                'name' => 'subEspecifica',
                'options'=> [
                    'class' => 'form-control',
                    'placeholder' => 'Escriba para buscar',
                ],
                'clientOptions' => [                
                    'source' => $sub_especfica,
                    'autoFill' => true,
                    'select' => new JsExpression("function(event, ui) {
                        $('#materialesservicios-id_se').val(ui.item.id);
                    }"),
                ],
            ])
        ?>
    </div>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'unidad_medida')->dropDownList(
        ArrayHelper::map($unidad_medida,'id','unidad_medida'), 
        ['prompt' => 'Seleccione']
    ) ?>

    <?= $form->field($model, 'presentacion')->dropDownList(
        ArrayHelper::map($presentacion,'id','nombre'),
        ['prompt' => 'Seleccione']
    ) ?>

    <?= $form->field($model, 'precio', [
        'inputTemplate' => '<div class="input-group"><span class="input-group-addon">Bs.</span>{input}</div>',
    ])->input('number') ?>

    <?= $form->field($model, 'iva', [
        'inputTemplate' => '<div class="input-group">{input}<span class="input-group-addon">%</span></div>',
    ])->input('number') ?>

    <?= $form->field($model, 'estatus')->dropDownList([1=>'Activo',0=>'Inactivo'],['prompt'=>'Seleccione']) ?>

    <div class="form-group">
        <?= Html::a($icons['volver'].' Volver', $model->isNewRecord ? ['materiales-servicios/index'] : ['materiales-servicios/view', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
