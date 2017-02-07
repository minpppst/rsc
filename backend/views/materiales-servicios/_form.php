<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use yii\web\JsExpression;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;

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
    
    <!--<?= $form->field($model, 'cuenta')->widget(Select2::classname(), [
        'data' => ArrayHelper::map($sub_especifica, 'cuenta', 'value'),
        'options' => ['placeholder' => 'Escriba para buscar', 'id' => 'partida_cuenta'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) 
    ?>-->
    <?php 
        echo $form->field($model, 'cuentapartida')->widget(DepDrop::classname(), 
            [
                'type'=>DepDrop::TYPE_SELECT2,
                'data' => ArrayHelper::map($sub_especifica, 'partida', 'nombre'),
                'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
                'options' => ['id'=>'nro_partida', 'prompt' => 'Seleccione una cuenta partida'],
                'pluginOptions'=>
                [
                    'depends'=>['partida_cuenta'],
                    'loadingText' => 'Cargando partidas ...',
                    'placeholder' => 'Seleccione una partida...',
                    'url' => Url::to(['partida_partida'])
                ]
            ]);
    ?>

    <!--<?= $form->field($model, 'generica')->widget(Select2::classname(), [
        'data' => ArrayHelper::map($sub_especifica, 'generica', 'value'),
        'options' => ['placeholder' => 'Escriba para buscar'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <?= $form->field($model, 'especifica')->widget(Select2::classname(), [
        'data' => ArrayHelper::map($sub_especifica, 'especifica', 'value'),
        'options' => ['placeholder' => 'Escriba para buscar'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <?= $form->field($model, 'subespecifica')->widget(Select2::classname(), [
        'data' => ArrayHelper::map($sub_especifica, 'subespecifica', 'value'),
        'options' => ['placeholder' => 'Escriba para buscar'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>-->

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

    <?php if (!Yii::$app->request->isAjax){ ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>
