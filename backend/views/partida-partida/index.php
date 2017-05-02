<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PartidaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Partidas';

//Iconos
$icons=[
    'volver'=>'<span class="glyphicon glyphicon-triangle-left" aria-hidden="true"></span>',
];

CrudAsset::register($this);

?>
<div class="partida-index">
    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=>'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax'=>true,
            'columns' => require(__DIR__.'/_columns.php'),
            'toolbar'=> [
                ['content'=>
                    Html::a('<span class="glyphicon glyphicon-file"></span> Nuevo', ['create'],
                    ['role'=>'modal-remote','title'=> 'Crear Partida','class'=>'btn btn-default']).
                    Html::a('<i class="glyphicon glyphicon-repeat"></i> Recargar', [''],
                    ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Reset Grid']).
                    '{toggleData}'.
                    '{export}'
                ],
            ],          
            'striped' => true,
            'condensed' => true,
            'responsive' => true,          
            'panel' => [
                'type' => 'primary', 
                'heading' => '<i class="glyphicon glyphicon-list-alt"></i> Partidas',
                /*'after'=>BulkButtonWidget::widget([
                            'buttons'=>
                                Html::a('<i class="glyphicon glyphicon-trash"></i>&nbsp; Borrar',
                                ["bulk-delete"] ,
                                [
                                    "class"=>"btn btn-danger btn-xs",
                                    'role'=>'modal-remote-bulk',
                                    'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                    'data-request-method'=>'post',
                                    'data-confirm-title'=>'¿Está seguro?',
                                    'data-confirm-message'=>'¿Está seguro que desea eliminar los elementos seleccionados?'
                                ]),.' '.
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
                        ]).                        
                        '<div class="clearfix"></div>',*/
            ]
        ])?>
    </div>
</div>
<?php Modal::begin([
    "id"=>"ajaxCrubModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>
