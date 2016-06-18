<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Es */
/* @var $form yii\widgets\ActiveForm */
DepDropAsset::register($this);
?>

<div class="es-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cuenta')->textInput(['placeholder' => 'Escriba un número entre 1 y 9']) ?>

    <?= $form->field($model, 'partida')->textInput(['placeholder' => 'Escriba un número entre 00 y 99']) ?>

    <?= $form->field($model, 'generica')->textInput(['placeholder' => 'Escriba un número entre 00 y 99']) ?>

    <?= $form->field($model, 'especifica')->textInput(['placeholder' => 'Escriba un número entre 00 y 99']) ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'estatus')->dropDownList([1=>'Activo',0=>'Inactivo'],['prompt'=>'Seleccione']) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>