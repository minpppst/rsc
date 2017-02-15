<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;


$this->title = 'Proyecto Requerimiento';
$this->params['breadcrumbs'][] = ['label' => 'Requerimiento', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);


//Iconos
$icons=[   
    'nuevo'=>'<span class="glyphicon glyphicon-file" aria-hidden="true"></span>',
    'editar'=>'<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>',
    'eliminar'=>'<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>',
    'volver'=>'<span class="glyphicon glyphicon-triangle-left" aria-hidden="true"></span>',
    'aprobado'=>'<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>',
    'no-aprobado'=>'<span class="glyphicon glyphicon-alert" aria-hidden="true"></span>',
];
echo $pe->aprobado;
echo $pe->id;
?>

<div class="proyecto-pedido-index">

    <!-- APROBAR/DESAPROBAR PEDIDOS -->
    <?php if($dataProvider->count > 0): ?>
        <div class="container-fluid" id="aprobado">

            <div class="pull-right">
            <?php if($pe->aprobado == 0): ?>
            
                <?= Html::a($icons['no-aprobado'].' No Aprobado', ['aprobar', 'proyectoEspecifica' => $pe->id], [
                            'class' => 'btn btn-warning navbar-btn',
                            'role' => 'modal-remote',
                            'data-confirm' => false, 'data-method' => false, // for overide yii data api
                            'data-request-method' => 'post',
                            'data-confirm-title' => Yii::t('user', '¿Está seguro?'),
                            'data-confirm-message' => Yii::t('user', '¿Está seguro que desea marcar este proyecto como <b>"Aprobado"</b>?'),
                ]); ?>

            <?php else: ?>

                <?= Html::a($icons['aprobado'].' Aprobado', ['aprobar', 'proyectoEspecifica' => $pe->id], [
                            'class' => 'btn btn-success navbar-btn',
                            'role' => 'modal-remote',
                            'data-confirm' => false, 'data-method' => false, // for overide yii data api
                            'data-request-method' => 'post',
                            'data-confirm-title' => Yii::t('user', '¿Está seguro?'),
                            'data-confirm-message' => Yii::t('user', '¿Está seguro que desea marcar este proyecto como <b>"No Aprobado"</b>?'),
                ]); ?>

            <?php endif; ?>
                
            </div>
        </div>
    <?php endif; ?>
    
    <!-- LISTA DE PEDIDOS -->
    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=>'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax'=>true,
            'columns' => require(__DIR__.'/_columns.php'),            
            'toolbar'=> [
                ['content'=>
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['pedido', 'ue' => $ue->id],
                    ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Reset Grid']).
                    '{toggleData}'.
                    '{export}'
                ],
            ],          
            'striped' => true,
            'condensed' => true,
            'responsive' => true,          
            'panel' => [
                'type' => 'default', 
                'heading' => '<h4><i class="glyphicon glyphicon-shopping-cart"></i> Requerimientos</h4>',
                'before'=>'<em><span class="glyphicon glyphicon-briefcase"></span> '.$ue->nombre.'</em>',
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