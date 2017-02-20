<?php

	/**
	 * Respuesta AJAX al recargar el contenedor
	 * de Acciones Especificas
	 */

	use common\models\ProyectoAccionEspecificaSearch;
	use yii\helpers\Html;
	use yii\helpers\StringHelper;
	use yii\widgets\Pjax;
	use yii\helpers\Url;
	use yii\bootstrap\Modal;
	use kartik\grid\GridView;
	use kartik\date\DatePicker;
	use johnitvn\ajaxcrud\CrudAsset; 
	use johnitvn\ajaxcrud\BulkButtonWidget;

	$searchModel = new ProyectoAccionEspecificaSearch(['id_proyecto'=>$model->id]);
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

    //Iconos
	$icons=[
	    'nuevo'=>'<span class="glyphicon glyphicon-file" aria-hidden="true"></span>',
	    'crear'=>'<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>',
	    'editar'=>'<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>',
	    'eliminar'=>'<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>',
	];

    echo GridView::widget([
	    'id'=>'especifica',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pjax' => true,
        'pjaxSettings' => [
            'options' => [
                'id' => 'especifica-pjax',
            ],
        ],
        'columns' => [
        	[
		        'class' => 'kartik\grid\CheckboxColumn',
		        'width' => '20px',

		    ],
		    [
		        'class' => 'kartik\grid\SerialColumn',
		        'width' => '30px',
		    ],
		    
		    [
		        'class'=>'\kartik\grid\DataColumn',
		        'attribute'=>'codigo_accion_especifica',
		        'label' => 'Código',
		        
		    ],
		    [
		        'class'=>'\kartik\grid\DataColumn',
		        'attribute'=>'nombre',
		        'contentOptions' => 
		        [
		        	'style'=>'max-width: 350px;  word-wrap: break-word;
		        	white-space: normal;'
		        ]
		    ],
		    [
		        'class'=>'\kartik\grid\DataColumn',
		        'attribute'=>'nombreUnidadEjecutora',
		        'contentOptions' => 
		        [
		        	'style'=>'max-width: 350px;  word-wrap: break-word;
		        	white-space: normal;'
		        ]
		    ],
		    /*
		    [
		        'class' => '\kartik\grid\DataColumn',
		        'width' => '50px',
		        'attribute' => 'nombreEstatus',
		        'value' => function ($model) {
		            if ($model->estatus == 1) {
		                return Html::a($model->nombreEstatus, ['proyecto-accion-especifica/toggle-activo', 'id' => $model->id], [
		                            'class' => 'btn btn-xs btn-success btn-block',
		                            'role' => 'modal-remote',
		                            'data-confirm' => false, 'data-method' => false, // for overide yii data api
		                            'data-request-method' => 'post',
		                            'data-confirm-title' => Yii::t('user', '¿Está seguro?'),
		                            'data-confirm-message' => Yii::t('user', '¿Está seguro que desea desactivar este elemento?'),
		                ]);
		            } else {
		                return Html::a($model->nombreEstatus, ['proyecto-accion-especifica/toggle-activo', 'id' => $model->id], [
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
		    */
		    [
		        'class' => 'kartik\grid\ActionColumn',
		        'visibleButtons' => 
		        [
		            'update' => function ($model, $key, $index) 
		            {
		                return Yii::$app->user->can('proyecto-accion-especifica/update', ['id' => $model->id]) ? true : false;
		                
		            },
		            'delete' => function ($model, $key, $index) 
		            {
		                return Yii::$app->user->can('proyecto-accion-especifica/delete', ['id' => $model->id]) ?  true : false;
		                
		            },

		        ],
		        'dropdown' => false,
		        'vAlign'=>'middle',
		        'urlCreator' => function($action, $model, $key, $index) { 
		                return Url::to(['proyecto-accion-especifica/'.$action,'id'=>$key]);
		        },
		        'viewOptions'=>['role'=>'modal-remote','title'=>'Ver','data-toggle'=>'tooltip'],
		        'updateOptions'=>['role'=>'modal-remote','title'=>'Editar', 'data-toggle'=>'tooltip'],
		        'deleteOptions'=>['role'=>'modal-remote','title'=>'Borrar', 
		                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
		                          'data-request-method'=>'post',
		                          'data-toggle'=>'tooltip',
		                          'data-confirm-title'=>'Are you sure?',
		                          'data-confirm-message'=>'Are you sure want to delete this item',
		                          'class' => 'text-danger'],
		    ],
		],
		'toolbar'=> [
            ['content'=>
                Html::a($icons['nuevo'].' Nuevo', ['proyecto-accion-especifica/create','proyecto'=>$searchModel->id_proyecto],
                ['role'=>'modal-remote','title'=> 'Crear Acción Específica','class'=>'btn btn-default']).
                '{toggleData}'.
                '{export}'
            ],
        ],
        'striped' => true,
        'condensed' => true,
        'responsive' => true, 
        'panel' => [
            'type' => 'info', 
            'heading' => '<i class="glyphicon glyphicon-list"></i> Acciones Específicas',
            'before'=>'<em>* Gestionar Acciones Específicas de este proyecto.</em>',
            'after'=>BulkButtonWidget::widget([
                        'buttons'=>Html::a('<i class="glyphicon glyphicon-trash"></i>&nbsp; Eliminar',
                            ["proyecto-accion-especifica/bulk-delete"] ,
                            [
                                "class"=>"btn btn-danger btn-xs",
                                'role'=>'modal-remote-bulk',
                                'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                'data-request-method'=>'post',
                                'data-confirm-title'=>'Are you sure?',
                                'data-confirm-message'=>'Are you sure want to delete this item'
                            ])/*.' '.
                            Html::a('<i class="glyphicon glyphicon-ban-circle"></i>&nbsp; Desactivar',
                            ["proyecto-accion-especifica/bulk-desactivar", 'id_proyecto' => $searchModel->id_proyecto] ,
                            [
                                "class"=>"btn btn-warning btn-xs",
                                'role'=>'modal-remote-bulk',
                                'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                'data-request-method'=>'post',
                                'data-confirm-title'=>'¿Está seguro?',
                                'data-confirm-message'=>'¿Está seguro que desea desactivar los elementos seleccionados?'
                            ]).' '.
                        Html::a('<i class="glyphicon glyphicon-ok-circle"></i>&nbsp; Activar',
                            ["proyecto-accion-especifica/bulk-activar", 'id_proyecto' =>$searchModel->id_proyecto] ,
                            [
                                "class"=>"btn btn-success btn-xs",
                                'role'=>'modal-remote-bulk',
                                'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                'data-request-method'=>'post',
                                'data-confirm-title'=>'¿Está seguro?',
                                'data-confirm-message'=>'¿Está seguro que desea activar los elementos seleccionados?'
                            ])*/,
                    ]).                        
                    '<div class="clearfix"></div>',
        ],
        
	]);
?>
