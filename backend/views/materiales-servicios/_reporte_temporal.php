<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\bootstrap\Modal;
use yii\bootstrap\Button;
use yii\bootstrap\Alert;

use kartik\grid\GridView;


//Iconos
$icons=[
    'crear'=>'<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>',
    'editar'=>'<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>',
    'eliminar'=>'<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>',
    'volver'=>'<span class="glyphicon glyphicon-triangle-left" aria-hidden="true"></span>',
    'aprobado'=>'<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>',
    'no-aprobado'=>'<span class="glyphicon glyphicon-alert" aria-hidden="true"></span>',
];

?>
<div class="proyecto-view">

    <h3>Si Esta De Acuerdo Con el Resultado, presione el botón Editar</h3>

    <div>
        <?=            
            GridView::widget([
                'dataProvider' => $model->resultadoTemporal(),
                //'filterModel' => $searchModel,
                'columns' => 
                [
                    [
                        'class' => 'kartik\grid\SerialColumn',
                        'width' => '30px',
                    ],
                    [
                        'class'=>'\kartik\grid\DataColumn',
                        'attribute'=>'proyecto - accion',
                        'label' => 'Proyecto-Accion'
                    ],
                    [
                        'class'=>'\kartik\grid\DataColumn',
                        'attribute'=>'proyecto_accion',
                        'label' => 'Proyecto AC - Accion AC'
                    ],
                    [
                        'class'=>'\kartik\grid\DataColumn',
                        'attribute'=>'total',
                        
                    ],

                ],
                'panel' => [
                    'type' => 'default',
                    'heading' => 'Reporte',
                    //'before' => '<em>Cantidades en Bs. sin IVA.</em>',
                    'after'=>'<div class="clearfix"></div>',
                ],
            ]);            
        ?>
    </div>
</div>
