<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProyectoPedidoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Proyecto - Pedidos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proyecto-pedido-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'striped' => true,
        'condensed' => true,
        'responsive' => true,
        'pjax' => true,
        'toolbar'=> [
            ['content'=>                
                Html::a('<i class="glyphicon glyphicon-repeat"></i>', [''],
                ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Reset Grid']).
                '{toggleData}'
            ],
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'codigoProyecto',
            [
                'attribute' => 'nombreProyecto',
                'value' => function($model){
                    return StringHelper::truncateWords($model->nombreProyecto,10);
                }
            ],
            'codigo_accion_especifica',
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'nombre',
                'label' => 'Acción Específica'
            ],
            'nombreUnidadEjecutora',            

            [
                'class' => 'kartik\grid\ActionColumn',
                'header' => 'Acciones',
                'vAlign' => 'middle',
                'buttons' => [
                    'asignar' => function($url, $model) {
                        return Html::a('<i class="glyphicon glyphicon-shopping-cart"></i> Pedidos', 
                            ['pedido', 'proyectoEspecifica' => $model->id],
                            [
                                'class' => 'btn btn-primary',
                                'data-request-method' => 'post',
                                'data-pjax' => '0' //No usar metodo pjax
                            ]
                        );
                    },
                ],
                'template' => '{asignar}'
            ],
        ],
        'panel' => [
            'type' => 'default', 
            'heading' => '<h4><i class="glyphicon glyphicon-shopping-cart"></i> Proyecto - Pedidos </h4>',
            'before'=>'<em>Seleccione la acción específica para el pedido.</em>',
            'after'=>'<div class="clearfix"></div>',
        ]
    ]); ?>

</div>
