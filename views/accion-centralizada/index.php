<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\bootstrap\Modal;

use johnitvn\ajaxcrud\CrudAsset;
/* @var $this yii\web\View */
/* @var $searchModel app\models\AccionCentralizadaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Accion Centralizadas';
$this->params['breadcrumbs'][] = $this->title;
//Iconos
$icons=[
    'crear'=>'<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>',
];
CrudAsset::register($this);
?>
<div class="accion-centralizada-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    
        <p>
        <?= Html::a($icons['crear'].' Crear Accion Centralizada', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
        
    
<div id="ajaxCrudDatatable">
    <?= GridView::widget([
        'id'=>'crud-datatable',
         'pjax'=>true,
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            'id',
            'codigo_accion',
            'codigo_accion_sne',
            'nombre_accion',

            ['class' => 'kartik\grid\ActionColumn',
            'dropdown' => false,
                    'vAlign'=>'middle',
                    'urlCreator' => function($action, $model, $key, $index) { 
                            return Url::to([$action,'id'=>$key]);
                    },
             'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete', 
                                      'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                      'data-request-method'=>'post',
                                      'data-toggle'=>'tooltip',
                                      'data-confirm-title'=>'Are you sure?',
                                      'data-confirm-message'=>'Are you sure want to delete this item',
                                      'class' => 'text-danger'], 
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
