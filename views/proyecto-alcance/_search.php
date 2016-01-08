<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProyectoAlcanceSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proyecto-alcance-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_proyecto') ?>

    <?= $form->field($model, 'enunciado_problema') ?>

    <?= $form->field($model, 'poblacion_afectada') ?>

    <?= $form->field($model, 'indicador_situacion') ?>

    <?php // echo $form->field($model, 'formula_indicador') ?>

    <?php // echo $form->field($model, 'fuente_indicador') ?>

    <?php // echo $form->field($model, 'fecha_indicador_inicial') ?>

    <?php // echo $form->field($model, 'enunciado_situacion_deseada') ?>

    <?php // echo $form->field($model, 'poblacion_objetivo') ?>

    <?php // echo $form->field($model, 'indicador_situacion_deseada') ?>

    <?php // echo $form->field($model, 'resultado_esperado') ?>

    <?php // echo $form->field($model, 'unidad_medida') ?>

    <?php // echo $form->field($model, 'meta_proyecto') ?>

    <?php // echo $form->field($model, 'benficiarios_femeninos') ?>

    <?php // echo $form->field($model, 'beneficiarios_masculinos') ?>

    <?php // echo $form->field($model, 'denominacion_beneficiario') ?>

    <?php // echo $form->field($model, 'total_empleos_directos_femeninos') ?>

    <?php // echo $form->field($model, 'total_empleos_directos_masculino') ?>

    <?php // echo $form->field($model, 'empleos_directos_nuevos_femeninos') ?>

    <?php // echo $form->field($model, 'empleos_directos_nuevos_masculino') ?>

    <?php // echo $form->field($model, 'empleos_directos_sostenidos_femeninos') ?>

    <?php // echo $form->field($model, 'empleos_directos_sostenidos_masculino') ?>

    <?php // echo $form->field($model, 'requiere_accion_no_financiera') ?>

    <?php // echo $form->field($model, 'especifique_con_cual') ?>

    <?php // echo $form->field($model, 'requiere_nombre_institucion') ?>

    <?php // echo $form->field($model, 'requiere_nombre_instancia') ?>

    <?php // echo $form->field($model, 'requiere_mencione_acciones') ?>

    <?php // echo $form->field($model, 'contribuye_complementa') ?>

    <?php // echo $form->field($model, 'especifique_complementa_cual') ?>

    <?php // echo $form->field($model, 'contribuye_nombre_institucion') ?>

    <?php // echo $form->field($model, 'contribuye_nombre_instancia') ?>

    <?php // echo $form->field($model, 'contribuye_mencione_acciones') ?>

    <?php // echo $form->field($model, 'vinculado_otro') ?>

    <?php // echo $form->field($model, 'vinculado_especifique') ?>

    <?php // echo $form->field($model, 'vinculado_nombre_institucion') ?>

    <?php // echo $form->field($model, 'vinculado_nombre_instancia') ?>

    <?php // echo $form->field($model, 'vinculado_nombre_proyecto') ?>

    <?php // echo $form->field($model, 'vinculado_medida') ?>

    <?php // echo $form->field($model, 'obstaculos') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
