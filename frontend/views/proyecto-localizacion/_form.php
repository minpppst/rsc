<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\depdrop\DepDrop;
//use kartik\depdrop\DepDropExtAsset;
//DepDrop::register($this);
//DepDropExtAsset::register($this);

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
                echo $form->field($model, 'id_pais')->dropDownList(ArrayHelper::map($paises,'id','nombre'),['prompt'=>'Seleccione', 'disabled' => true]); 
                break;

            case 'Nacional':
                echo $form->field($model, 'id_pais')->dropDownList(ArrayHelper::map($paises,'id','nombre'),['prompt'=>'Seleccione', 'disabled' =>'true']);
                break;

            case 'Estadal':
                echo $form->field($model, 'id_pais')->dropDownList(ArrayHelper::map($paises,'id','nombre'),['prompt'=>'Seleccione', 'disabled' => true]);
                echo $form->field($model, 'id_estado')->dropDownList(ArrayHelper::map($estados,'id','nombre'),['prompt'=>'Seleccione']);
                break;

            case 'Municipal':
                echo $form->field($model, 'id_pais')->dropDownList(ArrayHelper::map($paises,'id','nombre'),['prompt'=>'Seleccione', 'disabled' => true] );
                echo $form->field($model, 'id_estado')->dropDownList(ArrayHelper::map($estados,'id','nombre'),['prompt'=>'Seleccione', 'id' => 'estado_id']);
                
                echo $form->field($model, 'id_municipio')->widget(DepDrop::classname(), [
                    'type'=>DepDrop::TYPE_SELECT2,
                    'data' => ArrayHelper::map($model->MunicipiosEstados($model->id_estado),'id', 'name'),
                    'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
                    'options' => ['id'=>'id_municipio', 'prompt' => 'Seleccione un Estado'],
                    'pluginOptions'=>[
                        'depends'=>['estado_id'],
                        'loadingText' => 'Cargando Municipios ...',
                        'placeholder' => 'Seleccione un Municipio...',
                        'url' => Url::to(['/proyecto-localizacion/municipios'])
                     ]
                 ]);
                break;

            case 'Parroquial':
                echo $form->field($model, 'id_pais')->dropDownList(ArrayHelper::map($paises,'id','nombre'),['prompt'=>'Seleccione', 'disabled' => true]);
                echo $form->field($model, 'id_estado')->dropDownList(ArrayHelper::map($estados,'id','nombre'),['prompt'=>'Seleccione', 'id' => 'estado_id']);
                echo $form->field($model, 'id_municipio')->widget(DepDrop::classname(), [
                    'type'=>DepDrop::TYPE_SELECT2,
                    'data' => ArrayHelper::map($model->MunicipiosEstados($model->id_estado),'id', 'name'),
                    'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
                    'options' => ['id'=>'id_municipio', 'prompt' => 'Seleccione un Estado'],
                    'pluginOptions'=>[
                        'depends'=>['estado_id'],
                        'loadingText' => 'Cargando Municipios ...',
                        'placeholder' => 'Seleccione un Municipio...',
                        'url' => Url::to(['/proyecto-localizacion/municipios'])
                     ]
                 ]);
                echo $form->field($model, 'id_parroquia')->widget(DepDrop::classname(), [
                    'type'=>DepDrop::TYPE_SELECT2,
                    'data' => ArrayHelper::map($model->ParroquiasMunicipios($model->id_municipio), 'id', 'name'),
                    'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
                    'options' => ['id'=>'id_parroquia', 'prompt' => 'Seleccione una parroquia'],
                    'pluginOptions'=>[
                        'depends'=>['id_municipio'],
                        'loadingText' => 'Cargando Parroquias ...',
                        'placeholder' => 'Seleccione una Parroquia...',
                        'url' => Url::to(['/proyecto-localizacion/parroquias'])
                     ]
                 ]);
                break;

            default:
                echo $form->field($model, 'id_pais')->dropDownList(ArrayHelper::map($paises,'id','nombre'),['prompt'=>'Seleccione', 'disabled' => true]); 
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
