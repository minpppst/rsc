<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProyectoAsignarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Accion Centralizada - Asignar Usuarios';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

//Iconos
$icons=[
    'asignar'=>'<span class="glyphicon glyphicon-transfer" aria-hidden="true"></span>',
    'usuario'=>'<span class="glyphicon glyphicon-user" aria-hidden="true"></span>',
    'accion_centralizada'=>'<span class="glyphicon glyphicon-tasks" aria-hidden="true"></span>',
];

?>
<div class="accion-centralizada-asignar-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'id'=>'crud-datatable',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pjax'=>true,
        'columns' => [
            [
                'class' => 'kartik\grid\CheckboxColumn',
                'width' => '20px',
            ],
            [
                'class' => 'kartik\grid\SerialColumn',
                'width' => '30px'
            ],

            //'id',
            'username',

            /*[
                'class' => '\kartik\grid\DataColumn',
                'width' => '50px',
                'attribute' => 'blocked_at',
                'label'=>'Estatus',
                'value' => function ($model) {
                    if ($model->blocked_at !== null) {
                        return Html::a(Yii::t('user', 'Inactivo'), ['/user/manager/toggle-block', 'id' => $model->id], [
                                    'class' => 'btn btn-xs btn-warning btn-block',
                                    'role' => 'modal-remote',
                                    'data-confirm' => false, 'data-method' => false, // for overide yii data api
                                    'data-request-method' => 'post',
                                    'data-confirm-title' => Yii::t('user', '¿Está seguro?'),
                                    'data-confirm-message' => Yii::t('user', '¿Está seguro que desea desactivar este usuario?'),
                        ]);
                    } else {
                        return Html::a(Yii::t('user', 'Activo'), ['/user/manager/toggle-block', 'id' => $model->id], [
                                    'class' => 'btn btn-xs btn-success btn-block',
                                    'role' => 'modal-remote',
                                    'data-confirm' => false, 'data-method' => false, // for overide yii data api
                                    'data-request-method' => 'post',
                                    'data-confirm-title' => Yii::t('user', '¿Está seguro?'),
                                    'data-confirm-message' => Yii::t('user', '¿Está seguro que desea activar este usuario?'),
                        ]);
                    }
                },
                'format' => 'raw',
            ],*/

            [
                'class' => 'kartik\grid\ActionColumn',
                'header' => 'Acciones',
                'vAlign' => 'middle',
                'buttons' => [
                    'asignar' => function($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-transfer" aria-hidden="true"></span> Asignar', 
                            ['asignar', 'usuario' => $model->id],
                            [
                                'class' => 'btn btn-primary',
                                'data-request-method' => 'post',
                                'data-pjax' => '0' //No usar metodo pjax
                            ]
                        );
                    },
                ],
                'template' => '{asignar}'
            ],
        ],
        'toolbar'=> [
            ['content'=>                
                Html::a('<i class="glyphicon glyphicon-repeat"></i> Recargar', [''],
                ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Recargar']).
                '{toggleData}'.
                '{export}'
            ],
        ],
        'striped' => true,
        'condensed' => true,
        'responsive' => true,
        'panel' => [
            'type' => 'default',
            'heading' => $icons['usuario'].' '.$icons['asignar'].' '.$icons['accion_centralizada'].' Asignar',
            'before' => '<em>Asignar usuarios a unidades ejecutoras y acciones específicas de Acciones Centralizadas.</em>'
        ]
    ]); ?>

</div>
<?php Modal::begin([
    "id"=>"ajaxCrubModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>