<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AccionCentralizadaPedidoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Accion Centralizada - Requerimientos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accion-centralizada-pedido-index">

    <h1><?= Html::encode($this->title) ?></h1>
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
                'attribute' => 'accionCentralizada',
                'label' => 'Nombre Acción Específica',
                'contentOptions' => 
                [
                    'style'=>'max-width: 350px;  word-wrap: break-word;
                    white-space: normal;'
                ]
            ],
            [
                'attribute' => 'nombreAe',
                'label' => 'Nombre Acción Específica',
                'contentOptions' => 
                [
                    'style'=>'max-width: 350px;  word-wrap: break-word;
                    white-space: normal;'
                ]
            ],

            [
                'attribute' => 'nombreUe',
                'label' => 'Nombre Unidad Ejecutora',
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
                        return Html::a('<i class="glyphicon glyphicon-shopping-cart"></i> Solicitar', 
                            ['pedido', 'asignado' => $model->id],
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
            'type' => 'warning', 
            'heading' => '<i class="glyphicon glyphicon-shopping-cart"></i> Accion Centralizada - Requerimiento',
            'before'=>'<em><b>'.$usuario->username.'</b> - Seleccione la acción específica para el Requerimiento.</em>',
            'after'=>'<div class="clearfix"></div>',
        ]
    ]); ?>

</div>
