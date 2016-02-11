<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ObjetivosHistoricosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Objetivos Históricos';
$this->params['breadcrumbs'][] = ['label' => 'Configuración', 'url' => ['site/configuracion']];
$this->params['breadcrumbs'][] = $this->title;

//Iconos
$icons=[
    'crear'=>'<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>',
    'editar'=>'<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>',
    'eliminar'=>'<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>',
    'volver'=>'<span class="glyphicon glyphicon-triangle-left" aria-hidden="true"></span>',
];

?>
<div class="objetivos-historicos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a($icons['crear'].' Crear Objetivos Historicos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'objetivo_historico:ntext',

            //['class' => 'yii\grid\ActionColumn'],

            [
                'class' => 'kartik\grid\ActionColumn',
                'dropdown' => false,
                'vAlign'=>'middle',
                'urlCreator' => function($action, $model, $key, $index) { 
                        return Url::to([$action,'id'=>$key]);
                },
                'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete', 
                                  'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                  'data-request-method'=>'post',
                                  'data-toggle'=>'tooltip',
                                  'data-confirm-title'=>'Are you sure?',
                                  'data-confirm-message'=>'Are you sure want to delete this item',
                                  'class' => 'text-danger'], 
            ],
        ],
    ]); ?>

</div>
<div class="btn-group">
    <?= Html::a($icons['volver'].' Volver', ['/site/configuracion'], ['class' => 'btn btn-primary']) ?>        
</div>