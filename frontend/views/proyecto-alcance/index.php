<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProyectoAlcanceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Proyecto Alcances';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proyecto-alcance-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Proyecto Alcance', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_proyecto',
            'enunciado_problema:ntext',
            'poblacion_afectada:ntext',
            'indicador_situacion:ntext',
            // 'formula_indicador:ntext',
            // 'fuente_indicador',
            // 'fecha_indicador_inicial',
            // 'enunciado_situacion_deseada:ntext',
            // 'poblacion_objetivo:ntext',
            // 'indicador_situacion_deseada:ntext',
            // 'resultado_esperado:ntext',
            // 'unidad_medida',
            // 'meta_proyecto:ntext',
            // 'benficiarios_femeninos',
            // 'beneficiarios_masculinos',
            // 'denominacion_beneficiario',
            // 'total_empleos_directos_femeninos',
            // 'total_empleos_directos_masculino',
            // 'empleos_directos_nuevos_femeninos',
            // 'empleos_directos_nuevos_masculino',
            // 'empleos_directos_sostenidos_femeninos',
            // 'empleos_directos_sostenidos_masculino',
            // 'requiere_accion_no_financiera',
            // 'especifique_con_cual',
            // 'requiere_nombre_institucion',
            // 'requiere_nombre_instancia',
            // 'requiere_mencione_acciones:ntext',
            // 'contribuye_complementa',
            // 'especifique_complementa_cual',
            // 'contribuye_nombre_institucion',
            // 'contribuye_nombre_instancia',
            // 'contribuye_mencione_acciones:ntext',
            // 'vinculado_otro',
            // 'vinculado_especifique',
            // 'vinculado_nombre_institucion',
            // 'vinculado_nombre_instancia',
            // 'vinculado_nombre_proyecto:ntext',
            // 'vinculado_medida:ntext',
            // 'obstaculos:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
