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

$this->title = 'Resultado Reporte 1 Presupuesto';

$this->params['breadcrumbs'][] = ['label' => 'Inicio', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Reportes Presupuesto', 'url' => ['reportes-presupuesto/reporte1']];
$this->params['breadcrumbs'][] = $this->title;

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

    <h1>Resultado Reporte</h1>

    <div>
        <?=            
            GridView::widget([
                'dataProvider' => $model,
                'columns' => require(__DIR__.'/_resultado-columns.php'),
                'panel' => [
                    'type' => 'default',
                    'heading' => '<span class="fa fa-balance-scale"></span> Reporte',
                    //'before' => '<em>Cantidades en Bs. sin IVA.</em>',
                    'after'=>'<div class="clearfix"></div>',
                ],
            ]);            
        ?>
    </div>

    <div class="btn-group">
        <?= Html::a($icons['volver'].' Volver', ['reportes-presupuesto/reporte1'], ['class' => 'btn btn-primary']) ?>        
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