<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

use app\models\Ambito;

/* @var $this yii\web\View */
/* @var $model app\models\ProyectoLocalizacion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proyecto-localizacion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= Html::activeHiddenInput($model, 'id_proyecto') ?>

    <?php

        /* Dependiendo del escenario */    
        switch ($model->scenario)
        {
            case 'Internacional':
                echo $form->field($model, 'id_pais')->dropDownList(ArrayHelper::map($paises,'id','nombre'),['prompt'=>'Seleccione']); 
                break;
            case 'Nacional':
                echo $form->field($model, 'id_pais')->dropDownList(ArrayHelper::map($paises,'id','nombre'),['prompt'=>'Seleccione', 'disabled' =>'true' ]);
                break;
            case 'Estadal':
                echo $form->field($model, 'id_pais')->dropDownList(ArrayHelper::map($paises,'id','nombre'),['prompt'=>'Seleccione']);
                echo $form->field($model, 'id_estado')->dropDownList(ArrayHelper::map($estados,'id','nombre'),['prompt'=>'Seleccione']);
                break;
            case 'Municipal':
                echo $form->field($model, 'id_pais')->dropDownList(ArrayHelper::map($paises,'id','nombre'),['prompt'=>'Seleccione']);
                echo $form->field($model, 'id_estado')->dropDownList(ArrayHelper::map($estados,'id','nombre'),['prompt'=>'Seleccione']);
                echo $form->field($model, 'id_municipio')->dropDownList(ArrayHelper::map($municipios,'id','nombre'),['prompt'=>'Seleccione']);
                break;
            case 'Parroquial':
                echo $form->field($model, 'id_pais')->dropDownList(ArrayHelper::map($paises,'id','nombre'),['prompt'=>'Seleccione']);
                echo $form->field($model, 'id_estado')->dropDownList(ArrayHelper::map($estados,'id','nombre'),['prompt'=>'Seleccione']);
                echo $form->field($model, 'id_municipio')->dropDownList(ArrayHelper::map($municipios,'id','nombre'),['prompt'=>'Seleccione']);
                echo $form->field($model, 'id_parroquia')->dropDownList(ArrayHelper::map($parroquias,'id','nombre'),['prompt'=>'Seleccione']);
                break;
            default:
                echo $form->field($model, 'id_pais')->dropDownList(ArrayHelper::map($paises,'id','nombre'),['prompt'=>'Seleccione']); 
                break;
        }
    ?>
  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
