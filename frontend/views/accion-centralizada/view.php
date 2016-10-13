<?php
use yii\helpers\Url;
use yii\helpers\Html;
use kartik\tabs\TabsX; //plugin
use yii\web\JsExpression;
use yii\bootstrap\Modal;
use yii\bootstrap\Button;
use yii\bootstrap\Alert;

//use yii\widgets\DetailView;
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
//Contenido de TABS
$datos_basicos = Yii::$app->controller->renderPartial('_acdatosbasicos', ['model'=> $model]);
$accionEspecifica = Yii::$app->controller->renderPartial('_accion_especifica_ac',[
    'model' => $model,
]);
$distribucionPresupuestaria = '<p>'.
    Html::a($icons['crear'].' Agregar', ['proyecto-alcance/create', 'proyecto' => $model->id], ['class' => 'btn btn-success']).
    '</p>'.
    '<div class="well">No hay datos.</div>'
;
?>

<div class="accion-centralizada-view">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <span><?= Html::encode("Acción Centralizada #".$this->title) ?></span>
        </div>
        <div class="panel-body">

            <!-- TABS -->
            <?= TabsX::widget([
                'options' => 
                [
                'class' => 'nav-justified',

                    'containerOptions' => ['id' => 'contenedorTabs'],
                ],
                'items' => 
                [
                    [
                        'label' => 'Datos Básicos',
                        'content' =>$datos_basicos,
                        'active' => true,
                    ],
                   
                    [
                        'label' => 'Acciones Especificas',
                        'content' => $accionEspecifica,
                    ],
                ],
                'pluginOptions' => 
                [
                    'enableCache' => false //Refrescar la pestaña
                ]
            ]);


            ?>  
        </div>
    </div>
  
    <div class="btn-group">
        <?= Html::a($icons['volver'].' Volver', ['accion-centralizada/index'], ['class' => 'btn btn-primary'])?>       
    </div>
</div>
   

<!-- Ventana modal -->
<?php Modal::begin([
    "id"=>"ajaxCrubModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>