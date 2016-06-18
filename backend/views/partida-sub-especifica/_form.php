<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Se */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="se-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cuenta')->textInput(['placeholder' => 'Ingrese un número entre 1 y 9']) ?>

    <?= $form->field($model, 'partida')->textInput(['placeholder' => 'Ingrese un número entre 00 y 99']) ?>

    <?= $form->field($model, 'generica')->textInput(['placeholder' => 'Ingrese un número entre 00 y 99']) ?>

    <?= $form->field($model, 'especifica')->textInput(['placeholder' => 'Ingrese un número entre 00 y 99']) ?>

    <?= $form->field($model, 'subespecifica')->textInput(['placeholder' => 'Ingrese un número entre 00 y 99']) ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'estatus')->dropdownList([1=>'Activo',0=>'Inactivo'],['prompt'=>'Seleccione']) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>