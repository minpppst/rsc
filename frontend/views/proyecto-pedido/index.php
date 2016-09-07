<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProyectoPedidoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Proyecto - Requerimientos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proyecto-pedido-index">

    <h1><?= Html::encode($this->title) ?></h1>
    
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

            //Proyecto
            [
                'class'=>'\kartik\grid\DataColumn',
                'attribute'=>'proyectoEspecifica.nombreProyecto',
                'value' => function($model){
                    return StringHelper::truncateWords($model->proyectoEspecifica->nombreProyecto,15);
                }
            ],
            //Acción específica
            'nombreEspecifica',

            //Acciones
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
            'heading' => '<i class="glyphicon glyphicon-shopping-cart"></i> Proyecto - Requerimientos',
            'before'=>'<em><b>'.$usuario->username.'</b> - Seleccione la acción específica para el pedido.</em>',
            'after'=>'<div class="clearfix"></div>',
        ]
    ]); ?>

</div>
