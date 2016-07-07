<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\bootstrap\Modal;
use yii\bootstrap\Button;
use yii\bootstrap\Alert;

use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Proyecto */

$this->params['breadcrumbs'][] = ['label' => 'Proyectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['proyecto/view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Distribución Presupuestaria';

//Iconos
$icons=[
    'crear'=>'<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>',
    'editar'=>'<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>',
    'eliminar'=>'<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>',
    'volver'=>'<span class="glyphicon glyphicon-triangle-left" aria-hidden="true"></span>',
    'aprobado'=>'<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>',
    'no-aprobado'=>'<span class="glyphicon glyphicon-alert" aria-hidden="true"></span>',
];
//print_r($columnas); exit();


?>
<div class="accion-centralizada-view">

    <h1>Distribución Presupuestaria Acción Centralizada #<?= Html::encode($model->id) ?></h1>

    <div>
        <?=            
            GridView::widget([
                
                'dataProvider' => $model->distribucionPresupuestaria(),
                //'filterModel' => $searchModel,
                'columns' => $model->cabeceras(),
                   
                
                'panel' => [
                    'type' => 'default',
                    'heading' => '<span class="fa fa-balance-scale"></span> Distribución Presupuestaria',
                    'before' => '<em>Cantidades en Bs. sin IVA.</em>',
                    'after'=>'<div class="clearfix"></div>',
                ],
            ]);            
        ?>
    </div>

    <div class="btn-group">
        <?= Html::a($icons['volver'].' Volver', ['accion-centralizada/view', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>        
    </div>

</div>

<!-- Ventana modal -->
<?php Modal::begin([
    "id"=>"ajaxCrubModal",
    "footer"=>"",// always need it for jquery plugin
    "options" => [
        "tabindex" => false //importante para Select2
    ]
])?>
<?php Modal::end(); ?>