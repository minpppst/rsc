<?php
use \kartik\grid\GridView;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;
use kartik\select2\Select2;
\kartik\select2\Select2Asset::register($this);


/*$js = <<< 'JS'
$("#unique-pjax-id").on("pjax:complete", function() {
var $el = $("#unique-select2-id"), 
 ll=$("#unique-select2-id");
alert(ll.data);
    options = $el.data('pluginOptions'); // select2 plugin settings saved
 jQuery.when($el.select2(window[options])).done(initSelect2Loading('unique-select2-id'));
});
JS;
// Call the above js script in your view
$this->registerJs($js);
*/


/* @var $this yii\web\View */
/* @var $searchModel app\models\AcAcEspecSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Accion Centralizada Accion Especifica';
$this->params['breadcrumbs'][] = $this->title;
//Iconos
$icons=[
    'crear'=>'<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>',
    'editar'=>'<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>',
    'eliminar'=>'<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>',
];
CrudAsset::register($this);
?>
<div class="ac-ac-espec-index">


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
                    Html::a($icons['crear'].' Agregar', ['create','ac_centralizada' => $searchModel['id_ac_centr']],
                    ['role'=>'modal-remote','title'=> 'Crear Nueva  Accion Especifica','class'=>'btn btn-success']).
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
 <?php  $data = [
    "1" => "1"
            ];
    $filterwidget=\kartik\select2\Select2::widget([
        'name' => 'id_ue',
        'value' => '',
        'data' => $data,
        'options' => ['multiple' => true, 'placeholder' => 'Select states ...', 'id' => 'unique-select23-id']
    ]);
    ?>