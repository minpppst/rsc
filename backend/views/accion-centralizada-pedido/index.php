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

            
            [
            'label' => 'Nombre Accion Central',
            'attribute' => 'nombrecentral',

            ],

            [
            'label' => 'Codigo Accion Central',
            'attribute' => 'codigocentral',
            ],

            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'nombreaccion',
                'label' => 'Acción Específica'
            ],
            [
            'label' => 'Nombre Unidad Ejecutora',
            'attribute' => 'nombreunidadejecutora',            
            ],
            [
                'class' => 'kartik\grid\ActionColumn',
                'header' => 'Acciones',
                'vAlign' => 'middle',
                'buttons' => [
                    'asignar' => function($url, $model) {
                        return Html::a('<i class="fa fa-shopping-basket"></i> Pedidos', 
                            ['pedido', 'ue' => $model->id_ue],
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
