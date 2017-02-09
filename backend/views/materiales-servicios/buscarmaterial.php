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
            'columns' => 
                        [
                            
                            [
                                'class' => 'kartik\grid\SerialColumn',
                                'width' => '30px',
                            ],
                            [
                                'class'=>'\kartik\grid\DataColumn',
                                'attribute'=>'nombre',
                                'contentOptions' => 
                                [
                                    'style'=>'width: 350px;  word-wrap: break-word;
                                    white-space: normal;'
                                ]
                            ],
                            [
                                'class' => 'kartik\grid\ActionColumn',
                                'dropdown' => false,
                                'vAlign'=>'middle',
                                'urlCreator' => function($action, $model, $key, $index) { 
                                        return Url::to([$action,'id'=>$key]);
                                },
                                'template' => '{view} {change}',
                                'viewOptions'=>['role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip'],
                                'buttons' => 
                                [
                                    'change' => function ($url, $model, $key) 
                                    {
                                        return Html::a('<span class="glyphicon glyphicon-retweet"></span>', 
                                            ['cambiarprecio', 'id' => $model->id], 

                                            [
                                                'tittle' => 'Cambio De Precio(Base y Requerimientos)',
                                                'role'=>'modal-remote',
                                            ]);

                                    },
                                ],
                            ],
                        ],

            'toolbar'=> [
                ['content'=>
                    Html::a('<i class="glyphicon glyphicon-file"></i> Nuevo', ['create'],
                    ['role'=>'modal-remote','title'=> 'Create new Materiales Servicios','class'=>'btn btn-default']).
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
                'heading' => '<i class="glyphicon glyphicon-list"></i> Materiales Servicios listing',
                'before'=>'<em>* Resize table columns just like a spreadsheet by dragging the column edges.</em>',
                'after'=>
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
