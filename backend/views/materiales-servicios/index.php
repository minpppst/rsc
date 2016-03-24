<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel common\models\MaterialesServiciosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Materiales Servicios';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>
<div class="materiales-servicios-index">
    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=>'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax'=>true,
            'columns' => require(__DIR__.'/_columns.php'),
            'toolbar'=> [
                ['content'=>
                    Html::a('<i class="glyphicon glyphicon-file"></i> Nuevo', ['create'],
                    ['role'=>'modal-remote','title'=> 'Create new Materiales Servicios','class'=>'btn btn-default']).
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', [''],
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
                'heading' => '<i class="glyphicon glyphicon-list"></i> Materiales Servicios listing',
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
                                ]).' '.
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
                        '<div class="clearfix"></div>',
            ]
        ])?>
    </div>
</div>
<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "footer"=>"",// always need it for jquery plugin
    "options" => [
        "tabindex" => false //importante para Select2
    ]
])?>
<?php Modal::end(); ?>
