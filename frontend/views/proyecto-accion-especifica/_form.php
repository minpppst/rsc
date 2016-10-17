<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\ProyectoAccionEspecifica */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="proyecto-accion-especifica-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= Html::activeHiddenInput($model, 'id_proyecto'); ?>

    <?= $form->field($model, 'codigo_accion_especifica')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'nombre')->textarea(['rows' => 6]); ?>

    <?= $form->field($model, 'unidad_medida')->dropDownList(ArrayHelper::map($unidadMedida, 'id', 'unidad_medida'), ['prompt' => 'Seleccione']); ?>

    <?= $form->field($model, 'meta')->textInput(['readonly' => true]); ?>    

    <?= $form->field($model, 'ponderacion')->input('number', [
        'min' => $model->minPonderacion, 
        'max' => $model->maxPonderacion, 
        'step' => 0.1
    ]); ?>

    <?= $form->field($model, 'bien_servicio')->textarea(['rows' => 6]); ?>

    <?= $form->field($model, 'id_unidad_ejecutora')->dropDownList(ArrayHelper::map($unidadEjecutora,'id','nombre'),['prompt' => 'Seleccione']); ?>

    <?= $form->field($model, 'fecha_inicio')->widget(DatePicker::classname(), [
        'type' => DatePicker::TYPE_COMPONENT_PREPEND,
        'value' => $model->fecha_inicio,
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'yyyy-mm-dd',
            'todayBtn' => true
        ],
        'options' => ['readonly' => true]
    ]); ?>

    <?= $form->field($model, 'fecha_fin')->widget(DatePicker::classname(), [
        'type' => DatePicker::TYPE_COMPONENT_PREPEND,
        'value' => $model->fecha_fin,
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'yyyy-mm-dd',
            'todayBtn' => true
        ],
        'options' => ['readonly' => true]
    ]); ?>
  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']); ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>

<script>
$(document).ready(function(){
    //Evitar input del usuario por teclado en campo ponderacion
    $('#proyectoaccionespecifica-ponderacion').keypress(function(key) {
        $(this).next().text('Utilice los botones o flechas.');
        $('.field-proyectoaccionespecifica-ponderacion').addClass('has-error');
        return false;
    });
});
</script>