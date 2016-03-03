<?php

use yii\helpers\Url;
use yii\helpers\Html;
use kartik\tabs\TabsX; //plugin
use yii\web\JsExpression;
use yii\bootstrap\Modal;
use yii\bootstrap\Button;
use yii\bootstrap\Alert;

/* @var $this yii\web\View */
/* @var $model app\models\Proyecto */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Proyectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

//Iconos
$icons=[
    'crear'=>'<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>',
    'editar'=>'<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>',
    'eliminar'=>'<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>',
    'volver'=>'<span class="glyphicon glyphicon-triangle-left" aria-hidden="true"></span>',
];

//Contenido de TABS
$datos_basicos = Yii::$app->controller->renderPartial('_datos-basicos',[
    'model' => $model,
    'estrategico' => $estrategico,
    'nacional' => $nacional,
    'historico' => $historico,
    'localizacion' => $localizacion,
]);
$alcanceImpacto = 
    '<p>'.
    Html::a($icons['crear'].' Agregar', ['proyecto-alcance/create', 'proyecto' => $model->id], ['class' => 'btn btn-success']).
    '</p>'.
    '<div class="well">No hay datos.</div>'
;
$distribucionPresupuestaria = '<div class="alert alert-warning">Debe agregar al menos una Acción Específica.</div>';
$fuenteFinanciamiento = 
    '<p>'.
    Html::a($icons['crear'].' Agregar', ['proyecto-fuente-financiamiento/create', 'proyecto' => $model->id], ['class' => 'btn btn-success']).
    '</p>'.
    '<div class="well">No hay datos.</div>'
;
$accionEspecifica = Yii::$app->controller->renderPartial('_accion-especifica',[
    'model' => $model,
]);

?>
<div class="proyecto-view">

    <h1>Proyecto #<?= Html::encode($this->title) ?></h1>

    <!-- TABS -->
    <?= TabsX::widget([
        'options' => [
            'class' => 'nav-justified',
            'containerOptions' => ['id' => 'contenedorTabs'],
        ],
        'items' => [
            [
                'label' => 'Datos Básicos',
                'content' =>$datos_basicos,
                'active' => true,
            ],
            [
                'label' => 'Alcance e Impacto',
                'content' => $alcanceImpacto,
                'linkOptions' => [
                    'data-url' => $model->alcance == null ? '' : Url::to(['proyecto-alcance/view', 'id' => $model->alcance->id]),
                ],
            ],
            [
                'label' => 'Acciones Específicas',
                'content' => $accionEspecifica,
                'linkOptions' => [
                    'data-url' => Url::to(['proyecto-accion-especifica/index', 'proyecto' => $model->id])
                ]
            ],
            [
                'label' => 'Distribución Presupuestaria',
                'content' => $distribucionPresupuestaria,
                'linkOptions' => [
                    'data-url' => $model->accionesEspecificas == null ? '' : Url::to(['proyecto-distribucion-presupuestaria/index', 'proyecto' => $model->id]),
                ],
            ],
            [
                'label' => 'Fuentes de Financiamiento',
                'content' => $fuenteFinanciamiento,
                'linkOptions' => [
                    'data-url' => '',
                ],
            ],
        ],
        'pluginOptions' => [
            'enableCache' => false //Refrescar la pestaña
        ]
    ]) ?>

    <div class="btn-group">
        <?= Html::a($icons['volver'].' Volver', ['proyecto/index'], ['class' => 'btn btn-primary']) ?>        
    </div>

</div>

<!-- Ventana modal -->
<?php Modal::begin([
    "id"=>"ajaxCrubModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>