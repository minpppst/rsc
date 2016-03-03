<?php

	use app\models\ProyectoAccionEspecificaSearch;
	use yii\helpers\Html;
	use yii\widgets\Pjax;
	use yii\helpers\Url;
	use yii\bootstrap\Modal;
	use kartik\grid\GridView;
	use johnitvn\ajaxcrud\CrudAsset; 
	use johnitvn\ajaxcrud\BulkButtonWidget;

	$searchModel = new ProyectoAccionEspecificaSearch(['id_proyecto'=>$model->id]);
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

	Pjax::begin();
    echo GridView::widget([
	    'id'=>'especifica',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pjax' => true,
        'panel' => [
        	'type' => 'primary',
        	'heading' => 'Lista de Acciones Específicas'
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
		        // [
		        // 'class'=>'\kartik\grid\DataColumn',
		        // 'attribute'=>'id',
		    // ],
		    /*
		    [
		        'class'=>'\kartik\grid\DataColumn',
		        'attribute'=>'id_proyecto',
		    ],*/
		    [
		        'class'=>'\kartik\grid\DataColumn',
		        'attribute'=>'codigo_accion_especifica',
		    ],
		    [
		        'class'=>'\kartik\grid\DataColumn',
		        'attribute'=>'nombre',
		    ],
		    [
		        'class'=>'\kartik\grid\DataColumn',
		        'attribute'=>'nombreUnidadEjecutora',
		    ],
		    [
		        'class' => 'kartik\grid\ActionColumn',
		        'dropdown' => false,
		        'vAlign'=>'middle',
		        'urlCreator' => function($action, $model, $key, $index) { 
		                return Url::to(['proyecto-accion-especifica/'.$action,'id'=>$key]);
		        },
		        'viewOptions'=>['role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip'],
		        'updateOptions'=>['role'=>'modal-remote','title'=>'Update', 'data-toggle'=>'tooltip'],
		        'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete', 
		                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
		                          'data-request-method'=>'post',
		                          'data-toggle'=>'tooltip',
		                          'data-confirm-title'=>'Are you sure?',
		                          'data-confirm-message'=>'Are you sure want to delete this item',
		                          'class' => 'text-danger'], 
		    ],
		]
	]);
    Pjax::end();
?>