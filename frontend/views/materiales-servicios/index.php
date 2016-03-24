<?php

use yii\helpers\Html;
use kartik\grid\GridView;
//use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MaterialesServiciosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Materiales y Servicios';
$this->params['breadcrumbs'][] = ['label' => 'Configuración', 'url' => ['site/configuracion']];
$this->params['breadcrumbs'][] = $this->title;

//Iconos
$icons=[
    'nuevo'=>'<span class="glyphicon glyphicon-file" aria-hidden="true"></span>',
    'crear'=>'<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>',
    'editar'=>'<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>',
    'eliminar'=>'<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>',
    'volver'=>'<span class="glyphicon glyphicon-triangle-left" aria-hidden="true"></span>',
    'material'=>'<span class="glyphicon glyphicon-cutlery" aria-hidden="true"></span>',
];
?>
<div class="materiales-servicios-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pjax' => true,
        'columns' => [
            [
                'class' => 'kartik\grid\CheckboxColumn',
                'width' => '20px',
            ],
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            //'codigoSubEspecifica',
            'nombre',
            'unidad_medida',
            'nombrePresentacion',
            // 'precio',
            // 'iva',
            //'estatus',
            [
                'class' => '\kartik\grid\DataColumn',
                'width' => '50px',
                'attribute' => 'nombreEstatus',
                'value' => function ($model) {
                    if ($model->estatus == 1) {
                        return Html::a($model->nombreEstatus, ['toggle-activo', 'id' => $model->id], [
                                    'class' => 'btn btn-xs btn-success btn-block',
                                    'role' => 'modal-remote',
                                    'data-confirm' => false, 'data-method' => false, // for overide yii data api
                                    'data-request-method' => 'post',
                                    'data-confirm-title' => Yii::t('user', '¿Está seguro?'),
                                    'data-confirm-message' => Yii::t('user', '¿Está seguro que desea desactivar este elemento?'),
                        ]);
                    } else {
                        return Html::a($model->nombreEstatus, ['toggle-activo', 'id' => $model->id], [
                                    'class' => 'btn btn-xs btn-warning btn-block',
                                    'role' => 'modal-remote',
                                    'data-confirm' => false, 'data-method' => false, // for overide yii data api
                                    'data-request-method' => 'post',
                                    'data-confirm-title' => Yii::t('user', '¿Está seguro?'),
                                    'data-confirm-message' => Yii::t('user', '¿Está seguro que desea activar este elemento?'),
                        ]);
                    }
                },
                'format' => 'raw'
            ],

            [
                'class' => 'kartik\grid\ActionColumn',
                'header' => 'Acciones',
                'vAlign'=>'middle',
            ],
        ],
        'panel' => [
            'type' => 'primary',
            'heading' => $icons['material'].' Materiales y Servicios',
            'before' => '<em>Escriba en las casillas para filtrar.</em>',
        ],
        'toolbar' => [
            [
                'content' => 
                    Html::a($icons['nuevo'].' Nuevo', ['create'], ['class' => 'btn btn-default']).
                    Html::a('<i class="glyphicon glyphicon-repeat"></i> Recargar', [''],
                    ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Reset Grid']).
                    '{toggleData}'.
                    '{export}'
            ]
        ]
    ]); ?>

</div>
<div class="btn-group">
    <?= Html::a($icons['volver'].' Volver', ['site/configuracion'], ['class' => 'btn btn-primary']) ?>        
</div>