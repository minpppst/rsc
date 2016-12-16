<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\ProyectoVariableResponsable */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proyecto-variable-responsable-form">

    <div class="panel panel-primary">
    
        <div class="panel-heading">
             <span>Responsable De Variable</span>
        </div>
        
        <div class="panel-body">

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'cedula')->textInput() ?>

            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'telefono')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'oficina')->dropDownList(ArrayHelper::map($modeluej,'id','nombre'),['prompt' => 'Seleccione']); ?>

            <?= $form->field($model, 'id_variable')->hiddenInput()->label(false) ?>

        	<?php if (!Yii::$app->request->isAjax){ ?>
        	  	<div class="form-group">
        	        <?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Modificar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        	    </div>
        	<?php } ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
    
</div>
