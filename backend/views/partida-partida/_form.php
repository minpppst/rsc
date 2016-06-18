<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Partida */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="partida-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cuenta')->input('number',['placeholder' => 'Ingrese un número entre 1 y 9', 'max' => 9, 'min' => 1]) ?>

    <?= $form->field($model, 'partida')->input('number',['placeholder' => 'Ingrese un número entre 00 y 99', 'maxlength' => true, 'minlength' => true, 'max' => 99, 'min' => 01]) ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'estatus')->dropDownList([1=>'Activo',0=>'Inactivo'],['prompt'=>'Seleccione']) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
