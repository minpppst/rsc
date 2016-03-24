<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use yii\jui\AutoComplete;
use yii\web\JsExpression;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Proyecto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proyecto-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- DATOS BASICOS -->
    <div class="panel panel-primary">
        <div class="panel-heading">
            <span>DATOS BÁSICOS</span>
        </div>
        <div class="panel-body">
            <?= $form->field($model, 'codigo_proyecto')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'codigo_sne')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'fecha_inicio')->widget(DatePicker::classname(), [
                'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                'value' => $model->fecha_inicio,
                'pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'yyyy-mm-dd',
                    'todayBtn' => true
                ]
            ]) ?>

            <?= $form->field($model, 'fecha_fin')->widget(DatePicker::classname(), [
                'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                'value' => $model->fecha_fin,
                'pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'yyyy-mm-dd',
                    'todayBtn' => true
                ]
            ]) ?>

            <?= $form->field($model, 'estatus_proyecto')->dropDownList(ArrayHelper::map($estatus_proyecto,'id','estatus'),['prompt'=>'Seleccione']) ?>

            <?= $form->field($model, 'situacion_presupuestaria')->dropDownList(ArrayHelper::map($situacion_presupuestaria,'id','situacion'),['prompt'=>'Seleccione']) ?>

            <?= $form->field($model, 'monto_proyecto', [
                'inputTemplate' => '<div class="input-group"><span class="input-group-addon">Bs.</span>{input}</div>',
            ])->input('number') ?>

            <?= $form->field($model, 'descripcion')->textarea(['rows' => 6]) ?>

            <div class="panel panel-info">
                <div class="panel-heading">
                    <span>Clasificación Sectorial</span>
                </div>
                <div class="panel-body">
                    <?= $form->field($model, 'sector')->dropDownList(ArrayHelper::map($sector,'id','sector'),['prompt'=>'Seleccione']) ?>

                    <?= $form->field($model, 'sub_sector')->dropDownList(ArrayHelper::map($sub_sector,'id','sub_sector'),['prompt'=>'Seleccione']) ?>
                </div>
            </div>

            <?= $form->field($model, 'plan_operativo')->dropDownList(ArrayHelper::map($plan_operativo,'id','plan_operativo'),['prompt'=>'Seleccione']) ?>
        </div>
    </div>

    <!-- VINCULACION CON LOS PLANES -->
    <div class="panel panel-primary">
        <div class="panel-heading">
            <span>VINCULACION CON LOS PLANES</span>
        </div>
        <div class="panel-body">
            <?= $form->field($model, 'objetivo_general')->hiddenInput() ?>

            <div class="form-group">
                <?= AutoComplete::widget([
                        'model' => $model,
                        'name' => 'general',
                        'options'=> [
                            'class' => 'form-control',
                            'placeholder' => 'Escriba para buscar',
                        ],
                        'clientOptions' => [                
                            'source' => $objetivo_general,
                            'autoFill' => true,
                            'select' => new JsExpression("function(event, ui) {
                                $('#proyecto-objetivo_general').val(ui.item.id);
                            }"),
                        ],
                    ])
                ?>
            </div>

            <?= $form->field($model, 'objetivo_estrategico_institucional')->textarea(['rows' => 6]) ?>
        </div>
    </div>

    <!-- LOCALIZACION DEL PROYECTO-->
    <div class="panel panel-primary">
        <div class="panel-heading">
            <span>LOCALIZACIÓN DEL PROYECTO</span>
        </div>
        <div class="panel-body">
             <?= $form->field($model, 'ambito')->dropDownList(ArrayHelper::map($ambito,'id','ambito'),['prompt'=>'Seleccione']) ?>
        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
