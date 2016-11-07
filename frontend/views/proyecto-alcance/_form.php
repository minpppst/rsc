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
    <div class="panel panel-primary">
        <div class="panel-heading">
            <span>DATOS GENERALES</span>
        </div>

        <div class="panel-body">
            <?= Html::activeHiddenInput($model, 'id_proyecto') ?>

            <?= $form->field($model, 'relacion_instituciones')->textarea(['rows' => 6]) ?>

            <?= $form->field($model, 'empleos_directos_nuevos_femeninos')->textInput() ?>

            <?= $form->field($model, 'empleos_directos_nuevos_masculino')->textInput() ?>

            <?= $form->field($model, 'empleos_directos_sostenidos_femeninos')->textInput() ?>

            <?= $form->field($model, 'empleos_directos_sostenidos_masculino')->textInput() ?>

            <?= $form->field($model, 'beneficiarios_masculinos')->textInput() ?>

            <?= $form->field($model, 'beneficiarios_femeninos')->textInput() ?>
            
            <?= $form->field($model, 'beneficiarios')->textInput() ?>

            <?= $form->field($model, 'objetivo_estrategico_institucional')->textarea(['rows' => 6]) ?>

            <?= $form->field($model, 'objetivo_especifico_proyecto')->textarea(['rows' => 6]) ?>

            <?= $form->field($model, 'causas_criticas_proyecto')->textarea(['rows' => 6]) ?>
            <?= $form->field($model, 'problemas_aborda_proyecto')->textarea(['rows' => 6]) ?>
            <?= $form->field($model, 'consecuencias_problema')->textarea(['rows' => 6]) ?>
            <?= $form->field($model, 'justificacion_proyecto')->textarea(['rows' => 6]) ?>
            <?= $form->field($model, 'alcance_proyecto')->textarea(['rows' => 6]) ?>
            <?= $form->field($model, 'descripcion_situacion_actual')->textarea(['rows' => 6]) ?>
            <?= $form->field($model, 'formula_indicador')->textarea(['rows' => 6]) ?>
            <?= $form->field($model, 'fuente_indicador')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'fecha_ultima_data')->widget(DatePicker::classname(), [
                'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                'pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'dd/mm/yyyy',
                    'todayBtn' => true
                ],
                'options' => ['readonly' => true]
            ]); ?>
            <?= $form->field($model, 'situacion_objetivo')->textarea(['rows' => 6]) ?>
            <?= $form->field($model, 'meta_proyecto')->textInput() ?>
            <?= $form->field($model, 'tiempo_impacto')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'servicio_bien')->textarea(['rows' => 6]) ?>
            <?= $form->field($model, 'unidad_medida')->dropDownList(ArrayHelper::map($unidadMedida, 'id', 'unidad_medida'), ['prompt' => 'Seleccione']) ?>
            <!-- Impacto Ambiental-->
            <div class="panel panel-info">
                <div class="panel-heading">
                    <span>Impacto Ambiental</span>
                </div>
                <div class="panel-body">
                    <?= $form->field($model, 'tipo_impacto')->dropDownList(ArrayHelper::map($tipoImpacto, 'id', 'descripcion'), ['prompt' => 'Seleccione']) ?>
                    <?= $form->field($model, 'cualitativa_efectos')->textarea(['rows' => 6]) ?>
                    <?= $form->field($model, 'importancia')->textarea(['rows' => 6]) ?>
                    <?= $form->field($model, 'mitigar_impacto_ambiental')->textarea(['rows' => 6]) ?>
                    <?= $form->field($model, 'balance_servicio_energetico')->textarea(['rows' => 6]) ?>
                    <?= $form->field($model, 'programacion_anual_consumidor')->textarea(['rows' => 6]) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>


    <!-- fin de los divs de campos ocultos -->

    <?php ActiveForm::end(); ?>

</div>
