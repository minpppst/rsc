<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\MaterialesServicios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="materiales-servicios-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_se')->textInput() ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'unidad_medida')->dropDownList(ArrayHelper::map($unidadMedida,'id','unidad_medida'),['prompt'=>'Seleccione']) ?>

    <?= $form->field($model, 'presentacion')->dropDownList(ArrayHelper::map($presentacion,'id','nombre'),['prompt'=>'Seleccione']) ?>

    <?= $form->field($model, 'precio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'iva')->textInput() ?>

    <?= $form->field($model, 'estatus')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
