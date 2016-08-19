<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\ProyectoAlcance */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="proyecto-alcance-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= Html::activeHiddenInput($model, 'id_proyecto') ?>

    <?= $form->field($model, 'enunciado_problema')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'poblacion_afectada')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'indicador_situacion')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'formula_indicador')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'fuente_indicador')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha_indicador_inicial')->widget(DatePicker::classname(), [
                'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                'pluginOptions' => [
                'autoclose'=>true,
                'format' => 'dd/mm/yyyy',
                'todayBtn' => true
                ],
                'options' => ['readonly' => true]
            ]) ?>

    <?= $form->field($model, 'enunciado_situacion_deseada')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'poblacion_objetivo')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'indicador_situacion_deseada')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'resultado_esperado')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'unidad_medida')->dropDownList(ArrayHelper::map($unidadMedida, 'id', 'unidad_medida'), ['prompt' => 'Seleccione']) ?>

    <?= $form->field($model, 'meta_proyecto')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'benficiarios_femeninos')->textInput() ?>

    <?= $form->field($model, 'beneficiarios_masculinos')->textInput() ?>

    <?= $form->field($model, 'denominacion_beneficiario')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'total_empleos_directos_femeninos')->textInput() ?>

    <?= $form->field($model, 'total_empleos_directos_masculino')->textInput() ?>

    <?= $form->field($model, 'empleos_directos_nuevos_femeninos')->textInput() ?>

    <?= $form->field($model, 'empleos_directos_nuevos_masculino')->textInput() ?>

    <?= $form->field($model, 'empleos_directos_sostenidos_femeninos')->textInput() ?>

    <?= $form->field($model, 'empleos_directos_sostenidos_masculino')->textInput() ?>

    <!-- divs para el manejo de los campos ocultos -->
    <div id='1accion_no_financiera'>

    <?= $form->field($model, 'requiere_accion_no_financiera')->dropDownList([false => 'No', true => 'Si'],['prompt' => 'Seleccione',
        
                            ]) ?>

        </div>
    
    <div id='1especifique_con_cual'>
    <?= $form->field($model, 'especifique_con_cual')->dropDownList(ArrayHelper::map($instanciaInstitucion, 'id', 'tipo'), ['prompt' => 'Seleccione']) ?>
        </div>
    <div id='1requiere_nombre_institucion'>
    <?= $form->field($model, 'requiere_nombre_institucion')->textInput(['maxlength' => true]) ?>
        </div>
    <div id='1requiere_nombre_instancia'>
    <?= $form->field($model, 'requiere_nombre_instancia')->textInput(['maxlength' => true]) ?>
        </div>
        <div id='1requiere_mencione_acciones'>
    <?= $form->field($model, 'requiere_mencione_acciones')->textarea(['rows' => 6]) ?>
        </div>

    <div id='2contribuye_complementa'>        
    <?= $form->field($model, 'contribuye_complementa')->dropDownList([false => 'No', true => 'Si'],['prompt' => 'Seleccione']) ?>
        </div>
        <div id='2especifique_complementa_cual'>        
    <?= $form->field($model, 'especifique_complementa_cual')->dropDownList(ArrayHelper::map($instanciaInstitucion, 'id', 'tipo'), ['prompt' => 'Seleccione']) ?>
            </div>
            <div id='2contribuye_nombre_institucion'>        
    <?= $form->field($model, 'contribuye_nombre_institucion')->textInput(['maxlength' => true]) ?>
                </div>
                <div id='2contribuye_nombre_instancia'>        
    <?= $form->field($model, 'contribuye_nombre_instancia')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div id='2contribuye_mencione_acciones'>
    <?= $form->field($model, 'contribuye_mencione_acciones')->textarea(['rows' => 6]) ?>
                        </div>
    

            <div id='3vinculo_otro'>
    <?= $form->field($model, 'vinculado_otro')->dropDownList([false => 'No', true => 'Si'],['prompt' => 'Seleccione']) ?>
        </div>
        <div id='3vinculado_especifique'>
    <?= $form->field($model, 'vinculado_especifique')->dropDownList(ArrayHelper::map($instanciaInstitucion, 'id', 'tipo'), ['prompt' => 'Seleccione']) ?>
            </div>
        <div id='3vinculado_nombre_institucion'>
    <?= $form->field($model, 'vinculado_nombre_institucion')->textInput(['maxlength' => true]) ?>
                </div>
        <div id='3vinculado_nombre_instancia'>
    <?= $form->field($model, 'vinculado_nombre_instancia')->textInput(['maxlength' => true]) ?>
                </div>
        <div id='3vinculado_nombre_proyecto'>
    <?= $form->field($model, 'vinculado_nombre_proyecto')->textarea(['rows' => 6]) ?>
            </div>
        <div id='3vinculado_medida'>
    <?= $form->field($model, 'vinculado_medida')->textarea(['rows' => 6]) ?>
            </div>
    <?= $form->field($model, 'obstaculos')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>


    <!-- fin de los divs de campos ocultos -->

    <?php ActiveForm::end(); ?>

</div>
