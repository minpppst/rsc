<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
//use yii\jui\DatePicker;
use kartik\date\DatePicker;
//use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\AccionCentralizada */
/* @var $form yii\widgets\ActiveForm */

$icons = [
    'volver'=>'<span class="glyphicon glyphicon-triangle-left" aria-hidden="true"></span>',
];
?>

<div class="accion-centralizada-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'codigo_accion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'codigo_accion_sne')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nombre_accion')->textInput(['maxlength' => true]) ?>
    
   
    <?php if ($model->fecha_inicio!='') {
                $model->fecha_inicio=date_format(date_create($model->fecha_inicio),'d/m/Y');
             } ?>
	<?= $form->field($model, 'fecha_inicio')->
	widget(
    DatePicker::className(), [
    
    'value'=> $model->fecha_inicio, 
    'readonly'=>'true',
    'language'=>'es',
    'options' => ['placeholder' => 'Select issue date ...'],
    'pluginOptions' => [
        'format' => 'dd/mm/yyyy',
        'todayHighlight' => true
    ]
        ]);?>

	 
    <?php if ($model->fecha_fin!='') {
                $model->fecha_fin=date_format(date_create($model->fecha_fin),'d/m/Y');
             } ?>
    <?= $form->field($model,'fecha_fin')->
    widget(
    DatePicker::className(),  [
    
    'value' =>$model->fecha_fin,
    'language'=>'es',
    'readonly'=>'true',
    'options' => ['placeholder' => 'Select issue date ...'],
    'pluginOptions' => [
        'format' => 'dd/mm/yyyy',
        'todayHighlight' => true
    ]
]);?>

      

    <?= $form->field($model, 'estatus')->dropDownList(['1' => 'Activo', '0' => 'Inactivo'],['prompt'=>'Select Option']); ?>

    
    <div class="form-group">
        <?= Html::a($icons['volver'].' Volver', ['accion-centralizada/index'], ['class' => 'btn btn-primary']) ?>
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Modificar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>