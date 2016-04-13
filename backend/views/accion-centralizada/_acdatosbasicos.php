<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
//use yii\widgets\DetailView;
use yii\bootstrap\Modal;
use yii\bootstrap\Button;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;
use yii\widgets\Pjax;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AccionCentralizada */
//estatus
$array = [
    ['id' => '0', 'estatus' => 'Inactivo'],
    ['id' => '1', 'estatus' => 'Activo'],
];
//Iconos
$icons=[
    'crear'=>'<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>',
    'editar'=>'<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>',
    'eliminar'=>'<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>',
    'recargar' => '<span class="glyphicon glyphicon-repeat"></span>'
];

CrudAsset::register($this);
?>
<div class="accion-centralizada-view">

    
    <!--<p>
    <?= Html::a($icons['editar'].' Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    <?= Html::a($icons['eliminar'].' Eliminar', ['delete', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => '¿Está seguro que desea eliminar la Accion Centralizada? (Todos los datos asociados serán eliminados)',
            'method' => 'post',
        ],
    ]) ?>
</p>-->


    <?= DetailView::widget([
        'model' => $model,
        'mode' => 'view',
        'fadeDelay' => 0,
        'bordered' => true,
        'striped' => true,
        'condensed' => true,
        'responsive' => true,
        
        'attributes' => [
            'id',
            'codigo_accion',
            'codigo_accion_sne',
            'nombre_accion',
            [
            'label' =>'Fecha Inicio',
            'attribute' => 'fecha_inicio',
            'value'=> $model->fecha_inicio=date_format(date_create($model->fecha_inicio),'d/m/Y'),
            'type' => DetailView::INPUT_DATE,
                'options' => [
                    'style' => 'width:47%'
                ],
                'widgetOptions' => [
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'dd/mm/yyyy'
                    ]
                ],

            ],
            [
            'label'=>'Fecha Fin',
            'attribute' => 'fecha_fin',
            'value'=> $model->fecha_fin=date_format(date_create($model->fecha_fin),'d/m/Y'),
             'type' => DetailView::INPUT_DATE,
                'options' => [
                    'style' => 'width:47%'
                ],
                'widgetOptions' => [
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'dd/mm/yyyy'
                    ]
                ],
            ],
            [
                'label' => 'Estatus',
                 'attribute' => 'estatus',
                'value' => $model->nombreestatus,
                'type' => DetailView::INPUT_SELECT2,
                'widgetOptions' => [
                    'data' => ArrayHelper::map($array, 'id', 'estatus'),
                    'options' => ['placeholder' => 'Seleccione'],
                    'pluginOptions' => ['allowClear'=>true, 'width'=>'50%'],
                ]
            ],
            
        ],
        'panel' => [
                'type' => 'primary', 
                'heading' => '<i class="fa fa-list"></i> Datos Básicos',
            ],
    ]) ?>

</div>
