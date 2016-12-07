<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use yii\jui\AutoComplete;
use yii\web\JsExpression;
use kartik\date\DatePicker;
use kartik\money\MaskMoney;

/* @var $this yii\web\View */
/* @var $model app\models\Proyecto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proyecto-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <!-- DATOS BASICOS -->
    <div class="panel panel-primary">
        <div class="panel-heading">
            <span>DATOS BÁSICOS</span>
        </div>
        <div class="panel-body">
            <?= $form->field($model, 'codigo_proyecto')->textInput(['maxlength' => true]); ?>

            <?= $form->field($model, 'nombre')->textarea(['rows' => 6]); ?>

            <?= $form->field($model, 'descripcion_proyecto')->textarea(['rows' => 6]); ?>

            <?= $form->field($model, 'fecha_inicio')->widget(DatePicker::classname(), [
                'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                'pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'dd/mm/yyyy',
                    'todayBtn' => true
                ],
                'options' => ['readonly' => true]
            ]); ?>

            <?= $form->field($model, 'fecha_fin')->widget(DatePicker::classname(), [
                'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                'pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'dd/mm/yyyy',
                    'todayBtn' => true
                ],
                'options' => ['readonly' => true]
            ]); ?>

            <?= $form->field($model, 'estatus_proyecto')->dropDownList(ArrayHelper::map($estatus_proyecto,'id','estatus'),['prompt'=>'Seleccione']); ?>

            <?= $form->field($model, 'situacion_presupuestaria')->dropDownList(ArrayHelper::map($situacion_presupuestaria,'id','situacion'),['prompt'=>'Seleccione']); ?>

            <?= $form->field($model, 'proyecto_plurianual')->dropDownList([1=> 'Si', 0=> 'No'],['prompt'=>'Seleccione']); ?>

            <!--<?= $form->field($model, 'monto_proyecto_actual')->widget(MaskMoney::classname(), [                
                'pluginOptions' => [
                    'prefix' => 'Bs. ',
                    'allowZero' => false,
                    'allowNegative' => false,
                ]
            ]); ?>-->

            
            <?= $form->field($model, 'monto_proyecto_anio_anteriores')->widget(MaskMoney::classname(), [                
                'pluginOptions' => [
                    'prefix' => 'Bs. ',
                    'allowZero' => false,
                    'allowNegative' => false,
                ]
            ]); ?>

            <?= $form->field($model, 'monto_total_proyecto_proximo_anios')->widget(MaskMoney::classname(), [                
                'pluginOptions' => [
                    'prefix' => 'Bs. ',
                    'allowZero' => false,
                    'allowNegative' => false,
                ]
            ]); ?>

            

            <?= $form->field($model, 'monto_financiar')->widget(MaskMoney::classname(), [                
                'pluginOptions' => [
                    'prefix' => 'Bs. ',
                    'allowZero' => true,
                    'allowNegative' => false,
                ]
            ]); ?>

            <div class="panel panel-info">
                <div class="panel-heading">
                    <span>Clasificación Sectorial</span>
                </div>
                <div class="panel-body">
                    <?= $form->field($model, 'sector')->dropDownList(ArrayHelper::map($sector,'id','sector'),['prompt'=>'Seleccione']); ?>

                    <?= $form->field($model, 'sub_sector')->dropDownList(ArrayHelper::map($sub_sector,'id','sub_sector'),['prompt'=>'Seleccione']); ?>
                </div>
            </div>

            <?= $form->field($model, 'plan_operativo')->dropDownList(ArrayHelper::map($plan_operativo,'id','plan_operativo'),['prompt'=>'Seleccione']); ?>
        </div>
    </div>

    <!-- VINCULACION CON LOS PLANES -->
    <div class="panel panel-primary">
        <div class="panel-heading">
            <span>Plan Nacional de Desarrollo Económico y Social (PNDES)</span>
        </div>
        <div class="panel-body">
            <?= $form->field($model, 'objetivo_general')->hiddenInput(); ?>

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

            <?= $form->field($model, 'politicas_ministeriales')->textarea(['rows' => 6]); ?>
        </div>
    </div>

    <!-- LOCALIZACION DEL PROYECTO-->
    <div class="panel panel-primary">
        <div class="panel-heading">
            <span>LOCALIZACIÓN DEL PROYECTO</span>
        </div>
        <div class="panel-body">
             <?= $form->field($model, 'ambito')->dropDownList(ArrayHelper::map($ambito,'id','ambito'),['prompt'=>'Seleccione']); ?>
        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '<span class="glyphicon glyphicon-ok"></span> Crear' : '<span class="glyphicon glyphicon-save"></span> Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
    //Actualizar el monto en el hidden input al escribir
    window.onload = function(){
        jQuery("#proyecto-monto_proyecto-actual-disp").on('keyup', function(){
            jQuery("#proyecto-monto_proyecto_actual").val(jQuery(this).maskMoney('unmasked')[0]);
        });
        jQuery("#proyecto-monto_proyecto-disp").on('keyup', function(){
            jQuery("#proyecto-monto_proyecto").val(jQuery(this).maskMoney('unmasked')[0]);
        });
        jQuery("#proyecto-monto_proyecto-anio-anteriores-disp").on('keyup', function(){
            jQuery("#proyecto-monto_proyecto_anio_anteriores").val(jQuery(this).maskMoney('unmasked')[0]);
        });
        jQuery("#proyecto-monto_proyecto-proximo-anios-disp").on('keyup', function(){
            jQuery("#proyecto-monto_proyecto_proximo_anios").val(jQuery(this).maskMoney('unmasked')[0]);
        });
        jQuery("#proyecto-monto_financiar-disp").on('keyup', function(){
            jQuery("#proyecto-monto_financiar").val(jQuery(this).maskMoney('unmasked')[0]);
        });
    };
</script>