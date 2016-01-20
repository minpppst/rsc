<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProyectoAccionEspecificaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Proyecto Accion Especificas';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>
<div class="proyecto-accion-especifica-index">
    <?=GridView::widget([
        'id'=>'especifica',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pjax'=>true,
        'pjaxSettings' => [
            'options' => [
                'id' => 'especifica-pjax',
            ],
        ],
        'columns' => require(__DIR__.'/_columns.php'),
        'toolbar'=> [
            ['content'=>
                Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create','proyecto'=>$searchModel->id_proyecto],
                ['role'=>'modal-remote','title'=> 'Create new Proyecto Accion Especificas','class'=>'btn btn-default']).
                Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['proyecto/view', 'id' => $searchModel->id_proyecto],
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
            'heading' => '<i class="glyphicon glyphicon-list"></i> Proyecto Accion Especificas listing',
            'before'=>'<em>* Resize table columns just like a spreadsheet by dragging the column edges.</em>',
            'after'=>BulkButtonWidget::widget([
                        'buttons'=>Html::a('<i class="glyphicon glyphicon-trash"></i>&nbsp; Delete All',
                            ["bulk-delete"] ,
                            [
                                "class"=>"btn btn-danger btn-xs",
                                'role'=>'modal-remote-bulk',
                                'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                'data-request-method'=>'post',
                                'data-confirm-title'=>'Are you sure?',
                                'data-confirm-message'=>'Are you sure want to delete this item'
                            ]),
                    ]).                        
                    '<div class="clearfix"></div>',
        ]
    ])?>
</div>