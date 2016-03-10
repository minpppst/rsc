<?php

use yii\helpers\Html;
use kartik\grid\GridView;


/* @var $this yii\web\View */
/* @var $searchModel app\models\ProyectoPedidoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Proyecto - Pedidos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proyecto-pedido-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'striped' => true,
        'condensed' => true,
        'responsive' => true,
        'pjax' => true,
        'toolbar'=> [
            ['content'=>                
                Html::a('<i class="glyphicon glyphicon-repeat"></i>', [''],
                ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Reset Grid']).
                '{toggleData}'.
                '{export}'
            ],
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_proyecto',
            'codigo_accion_especifica',
            'nombre',
            'nombreUnidadEjecutora',            

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Acciones'
            ],
        ],
        'panel' => [
            'type' => 'warning', 
            'heading' => '<i class="glyphicon glyphicon-shopping-cart"></i> Proyecto - Pedidos',
            'before'=>'<em>Seleccione la acción específica para el pedido.</em>',
            'after'=>'<div class="clearfix"></div>',
        ]
    ]); ?>

</div>
