<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;


$this->title = 'Proyecto - Requerimientos';
$this->params['breadcrumbs'][] = ['label' => 'Requerimientos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);


//Iconos
$icons=[   
    'nuevo'=>'<span class="glyphicon glyphicon-file" aria-hidden="true"></span>',
    'editar'=>'<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>',
    'eliminar'=>'<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>',
    'volver'=>'<span class="glyphicon glyphicon-triangle-left" aria-hidden="true"></span>',
];

?>

<div class="proyecto-pedido-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=>'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax'=>true,
            'columns' => require(__DIR__.'/_columns.php'),            
            'toolbar'=> [
                ['content'=>
                    \Yii::$app->authManager->getAssignment('sysadmin',\Yii::$app->user->id) == null ?
                    	Html::a('<i class="glyphicon glyphicon-file"></i> Nuevo', ['create', 'asignar' => $asignado->id],
                        ['role'=>'modal-remote','title'=> 'Requerimiento Nuevo','class'=>'btn btn-default']).
                        Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['pedido', 'asignado' => $asignado->id],
                        ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Reset Grid']).
                        '{toggleData}'.
                        '{export}' : ''
                ],
            ],          
            'striped' => true,
            'condensed' => true,
            'responsive' => true,          
            'panel' => [
                'type' => 'default', 
                'heading' => '<h4><i class="glyphicon glyphicon-shopping-cart"></i> Requerimientos</h4>',
                'before'=>'<em><b><span class="glyphicon glyphicon-user"></span> '.$asignado->nombreUsuario.'</b> - <span class="glyphicon glyphicon-briefcase"></span> '.$asignado->proyectoEspecifica->nombreUnidadEjecutora.'<br>Total : '.$asignado->totalUnidad.'</em>',
                'after'=>BulkButtonWidget::widget([
                            'buttons'=>Html::a('<i class="glyphicon glyphicon-trash"></i>&nbsp; Eliminar',
                                ["bulk-delete"] ,
                                [
                                    "class"=>"btn btn-danger btn-xs",
                                    'role'=>'modal-remote-bulk',
                                    'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                    'data-request-method'=>'post',
                                    'data-confirm-title'=>'Are you sure?',
                                    'data-confirm-message'=>'Are you sure want to delete this item'
                                ])
                        ]).                    
                        '<div class="clearfix"></div>',
            ]
        ])?>
    </div>
</div>
<?php Modal::begin([
    'options' => [
        'tabindex' => false // importante para select2
    ],
    "id"=>"ajaxCrubModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>

<div class="btn-group">
    <?= Html::a($icons['volver'].' Volver', ['index'], ['class' => 'btn btn-primary']) ?>        
</div>