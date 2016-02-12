<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\tabs\TabsX; //plugin
use yii\bootstrap\Modal;


/* @var $this yii\web\View */
/* @var $model app\models\AccionCentralizada */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Accion Centralizadas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


//Iconos
$icons=[
    'crear'=>'<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>',
    'editar'=>'<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>',
    'eliminar'=>'<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>',
    'volver'=>'<span class="glyphicon glyphicon-triangle-left" aria-hidden="true"></span>',
];

$datos_basicos = Yii::$app->controller->renderPartial('_acdatosbasicos', ['model'=> $model]);

$distribucionPresupuestaria = '<div class="alert alert-warning">Debe agregar al menos una Acción Específica.</div>';
$fuenteFinanciamiento = 
    '<p>'.
    Html::a($icons['crear'].' Agregar', ['proyecto-fuente-financiamiento/create'], ['class' => 'btn btn-success']).
    '</p>'.
    '<div class="well">No hay datos.</div>'
;

?>
<div class="proyecto-view">

<div class="accion-centralizada-view">


   <h1><?= Html::encode("Acción Centralizada #".$this->title) ?></h1>



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
                'label' => 'Acciones Especificas',
                'linkOptions' => [
                    'data-url' => Url::to(['ac-ac-espec/index', 'ac_centralizada' => $model->id]),
                ],
            ],
            [
                'label' => 'U.E-Variable',
                'linkOptions' => [
                    'data-url' => Url::to(['ac-variable/index', 'ac_centralizada' => $model->id]),
                ],
            ],
            [
                'label' => 'Distribución Presupuestaria',
                'content' => $distribucionPresupuestaria,
                'linkOptions' => [
                    'data-url' => $model->id == null ? '' : Url::to(['proyecto-distribucion-presupuestaria/index', 'proyecto' => $model->id]),
                ],
            ],
            [
                'label' => 'Fuentes de Financiamiento',
                'content' => $fuenteFinanciamiento,
                'linkOptions' => [
                    'data-url' => '',
                ],
            ],
        ]
    ]) ?>

    <div class="btn-group">
        <?= Html::a($icons['volver'].' Volver', ['proyecto/index'], ['class' => 'btn btn-primary']) ?>        
    </div>

</div>


</div>
<!-- Ventana modal -->
<?php Modal::begin([
    "id"=>"ajaxCrubModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>