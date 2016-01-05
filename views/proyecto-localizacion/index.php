<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\bootstrap\Button;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProyectoLocalizacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Proyecto Localización';
$this->params['breadcrumbs'][] = ['label' => 'Proyectos', 'url' => ['/proyecto/index']];
$this->params['breadcrumbs'][] = ['label' => $searchModel->id_proyecto, 'url' => ['/proyecto/update','id'=>$searchModel->id_proyecto]];
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

$icons = [
    'siguiente'=>'<span class="glyphicon glyphicon-step-forward" aria-hidden="true"></span>',
];

?>
<div class="proyecto-localizacion-index">
    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=>'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax'=>true,
            'columns' => require(__DIR__.'/_columns.php'),
            'toolbar'=> [
                ['content'=>
                    Html::a('<i class="glyphicon glyphicon-plus">Agregar</i>', ['create', 'proyecto' => $searchModel->id_proyecto, 'ambito' => $ambito],
                    ['role'=>'modal-remote','title'=> 'Create new Proyecto Localizacions','class'=>'btn btn-default']).
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
                'heading' => '<i class="glyphicon glyphicon-list"></i> Proyecto Localización listing',
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
</div>
<?php Modal::begin([
    "id"=>"ajaxCrubModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>

<?= Html::a($icons['siguiente'].' Siguiente',['proyecto-responsable/create','proyecto'=>$searchModel->id_proyecto],[
    'class' => 'btn btn-primary',
]) ?>
