<?php

//use yii\widgets\DetailView;
use kartik\detail\DetailView;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model app\models\ProyectoAccionEspecifica */
?>
<div class="proyecto-accion-especifica-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            
            
            [
                'class'=>'\kartik\grid\DataColumn',
                'attribute'=>'codigo_accion_especifica',
                'label' => 'Código',
            ],
            'nombre:ntext',
            'nombreUnidadMedida',
            'meta',
            'ponderacion',
            'nombreUnidadEjecutora',
            [
                'label' => $model->getAttributeLabel('fecha_inicio'),
                'value' => \Yii::$app->formatter->asDate($model->fecha_inicio)

            ],
            [
                'label' => $model->getAttributeLabel('fecha_fin'),
                'value' => \Yii::$app->formatter->asDate($model->fecha_fin)

            ],

            [
                'label' => 'Ambito',
                'value' => $model->idAmbito->ambito
            ],

        ],
    ]) ?>

</div>
<div class="panel panel-info" id="localizacion" >
    <div class="panel-heading">
        <h3 class="panel-title"><i class="glyphicon glyphicon-map-marker"></i> Localización</h3>
    </div>
    <div class="panel-body">
        <?= GridView::widget([
            'id' => 'crud-datatable', //IMPORTANTE
            'dataProvider'=>$localizaciones,
            'filterModel' => $search,
            'pjax'=>true,
            'columns' => [
            [
                'class'=>'\kartik\grid\DataColumn',
                'attribute'=>'nombrePais',
                'label' => 'País'
            ],
            [
                'class'=>'\kartik\grid\DataColumn',
                'attribute'=>'nombreEstado',
                'label' => 'Estado'
            ],
            [
                'class'=>'\kartik\grid\DataColumn',
                'attribute'=>'nombreMunicipio',
                'label' => 'Municipio',
            ],
            [
                'class'=>'\kartik\grid\DataColumn',
                'attribute'=>'nombreParroquia',
                'label' => 'Parroquia',
            ],
            [
                'class' => 'kartik\grid\ActionColumn',
                'dropdown' => false,
                'vAlign'=>'middle',
                'urlCreator' => function($action, $model, $key, $index) { 
                        return Url::to([$action,'id'=>$key]);
                },

                'template' => ' {prg} ',
                'buttons' => 
                [
                    'prg' => function($action, $model, $index)
                    {
                        return 
                            isset($model->idAeMeta->id)
                            ?
                            Html::a('<span class="glyphicon glyphicon-calendar" style="color:green"></span>', 
                            Url::to(['proyecto-ae-meta/update', 'idLocalizacion' => $index]),
                            [
                                'role'=>'modal-remote',
                                'title'=>'Modificar Programación De La Meta',
                                'data-toggle'=>'tooltip'
                            ]
                            )
                            :
                            Html::a('<span class="glyphicon glyphicon-calendar"></span>', 
                            Url::to(['proyecto-ae-meta/create', 'idLocalizacion' => $index]),
                            [
                                'role'=>'modal-remote',
                                'title'=>'Crear Programación De La Meta',
                                'data-toggle'=>'tooltip'
                            ]
                            )
                    ;}
                ]
            ],
            ],
            'striped' => true,
            'condensed' => true,
            'responsive' => true,          
            
        ]) ?>          
    </div>