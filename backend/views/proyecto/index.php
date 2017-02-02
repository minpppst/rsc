<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset;
use johnitvn\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProyectoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Proyectos';
$this->params['breadcrumbs'][] = $this->title;

//Iconos
$icons=[
    'crear'=>'<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>',
    'nuevo'=>'<span class="glyphicon glyphicon-file" aria-hidden="true"></span>',
    'proyecto'=>'<span class="glyphicon glyphicon-folder-close" aria-hidden="true"></span>',
];

CrudAsset::register($this);
?>
<div class="proyecto-index">

    <div id="ajaxCrudDatatable">
        <?= GridView::widget([
            'id' => 'crud-datatable',
            'pjax'=>true,
            'columns' => require(__DIR__.'/_columns.php'),
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,            
            'panel' => [
                'type' => 'default',
                'heading' => $icons['proyecto'].' Proyectos',
                'before' => '<em>Escriba en las casillas para filtrar.</em>',
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
                        ])
                        .' '.
                        Html::a('<i class="glyphicon glyphicon-ban-circle"></i>&nbsp; Desactivar',
                            ["bulk-desactivar"] ,
                            [
                                "class"=>"btn btn-warning btn-xs",
                                'role'=>'modal-remote-bulk',
                                'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                'data-request-method'=>'post',
                                'data-confirm-title'=>'¿Está seguro?',
                                'data-confirm-message'=>'¿Está seguro que desea desactivar los elementos seleccionados?'
                            ]).' '.
                        Html::a('<i class="glyphicon glyphicon-ok-circle"></i>&nbsp; Activar',
                            ["bulk-activar"] ,
                            [
                                "class"=>"btn btn-success btn-xs",
                                'role'=>'modal-remote-bulk',
                                'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                'data-request-method'=>'post',
                                'data-confirm-title'=>'¿Está seguro?',
                                'data-confirm-message'=>'¿Está seguro que desea activar los elementos seleccionados?'
                            ]),
                ]).'<div class="clearfix"></div>',
            ],
            'toolbar'=> [
                ['content'=>
                    /*
                    (\Yii::$app->user->can('proyecto/create')? Html::a($icons['nuevo'].' Nuevo', ['create'], 
                    ['class' => 'btn btn-default']) : '').
                    */                    
                    Html::a('<i class="glyphicon glyphicon-repeat"></i> Recargar', [''],
                    ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Reset Grid']).
                    '{toggleData}'.
                    '{export}'
                ],
            ],            
        ]); ?>
    </div>

</div>

<!-- Ventana modal -->
<?php Modal::begin([
    "id"=>"ajaxCrubModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>
