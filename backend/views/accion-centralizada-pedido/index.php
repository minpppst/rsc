<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AccionCentralizadaPedidoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Accion Centralizada - Pedidos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="Accion Centralizada-pedido-index">

    
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'striped' => true,
        'condensed' => true,
        'responsive' => true,
        'pjax' => true,
        'toolbar'=> [
            ['content'=>                
                Html::a('<i class="glyphicon glyphicon-repeat"></i> Recargar', [''],
                ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Reset Grid']).
                '{toggleData}'
            ],
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            
            [
            'label' => 'Accion Central',
            'attribute' => 'nombre_central',
            'value' => 'nombrecentral',
            'contentOptions' => 
            [
            'style'=>'max-width: 350px;  word-wrap: break-word;
            white-space: normal;'
            ]
            ],

            [
                
            'attribute' => 'nombre_acc',
            'value' => 'nombreaccion',
            'label' => 'Acción Específica',
            'contentOptions' => 
            [
            'style'=>'max-width: 350px;  word-wrap: break-word;
            white-space: normal;'
            ]
            ],
            [
            'attribute' => 'nombre_ue',
            'label' => 'Unidad Ejecutora',
            'value' => 'nombreunidadejecutora',            
            'contentOptions' => 
            [
            'style'=>'max-width: 350px;  word-wrap: break-word;
            white-space: normal;'
            ]
            ],
            [
                'class' => 'kartik\grid\ActionColumn',
                'header' => 'Acciones',
                'vAlign' => 'middle',
                'buttons' => [
                    'asignar' => function($url, $model) {
                        return Html::a('<i class="fa fa-shopping-basket"></i> Pedidos', 
                            ['pedido', 'ue' => $model->id_ue, 'acc' => $model->id_ac_esp],
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
            'heading' => '<h4><i class="fa fa-shopping-basket"></i> Accion Centralizada - Pedidos </h4>',
            'before'=>'<em>Seleccione la acción específica para el pedido.</em>',
            'after'=>'<div class="clearfix"></div>',
        ]
    ]); ?>

</div>
