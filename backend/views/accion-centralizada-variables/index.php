<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AccionCentralizadaVariablesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Accion Centralizada Variables';
$this->params['breadcrumbs'][] = $this->title;
//Iconos
$icons=[
    'crear'=>'<span class="glyphicon glyphicon-file" aria-hidden="true"></span>',
    'importar'=>'<span class="glyphicon glyphicon-import" aria-hidden="true"></span>',
    'volver'=>'<span class="glyphicon glyphicon-triangle-left" aria-hidden="true"></span>',
];
?>
<div class="accion-centralizada-variables-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nombre_variable:ntext',
            'unidad_medida',
            'localizacion',
            'definicion:ntext',
            // 'base_calculo:ntext',
            // 'fuente_informacion:ntext',
            // 'responsable',
            // 'meta_programada_variable',
            // 'unidad_ejecutora',
            // 'acc_accion_especifica',

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'toolbar'=> [
            [ 
                'content'=>                  
                    Html::a($icons['crear'].' Nuevo', ['create'], ['class' => 'btn btn-default']).
                    '{toggleData}'.
                    '{export}'
                    
            ],
        ],
        'panel' => [
            'type' => 'default', 
            'heading' => '<i class="glyphicon glyphicon-folder-open"></i> Acciones Centralizadas Variables',
            'before'=>'<em>* Resize table columns just like a spreadsheet by dragging the column edges.</em>',
            'after'=>BulkButtonWidget::widget([
                'buttons'=>
                    Html::a('<i class="glyphicon glyphicon-trash"></i>&nbsp; Eliminar',
                    ["bulk-delete"] ,
                    [
                        "class"=>"btn btn-danger btn-xs",
                        'role'=>'modal-remote-bulk',
                        'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                        'data-request-method'=>'post',
                        'data-confirm-title'=>'¿Está seguro?',
                        'data-confirm-message'=>'¿Está seguro que desea eliminar los elementos seleccionados?'
                    ]),/*' '.
                    Html::a('<i class="glyphicon glyphicon-ban-circle"></i>&nbsp; Desactivar',
                        ["bulk-estatusdesactivo"] ,
                        [
                            "class"=>"btn btn-warning btn-xs",
                            'role'=>'modal-remote-bulk',
                            'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                            'data-request-method'=>'post',
                            'data-confirm-title'=>'¿Está seguro?',
                            'data-confirm-message'=>'¿Está seguro que desea desactivar los elementos seleccionados?'
                        ]).' '.
                    Html::a('<i class="glyphicon glyphicon-ok-circle"></i>&nbsp; Activar',
                        ["bulk-estatusactivo"] ,
                        [
                            "class"=>"btn btn-success btn-xs",
                            'role'=>'modal-remote-bulk',
                            'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                            'data-request-method'=>'post',
                            'data-confirm-title'=>'¿Está seguro?',
                            'data-confirm-message'=>'¿Está seguro que desea activar los elementos seleccionados?'
                        ]),*/
                    ]).                       
                    '<div class="clearfix"></div>',
            ]
    ]); ?>
</div>
