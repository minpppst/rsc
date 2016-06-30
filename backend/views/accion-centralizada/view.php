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
    'aprobado'=>'<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>',
    'no-aprobado'=>'<span class="glyphicon glyphicon-alert" aria-hidden="true"></span>',
    'distribucion'=>'<span class="fa fa-balance-scale" aria-hidden="true"></span>',
];
//Contenido de TABS
$datos_basicos = Yii::$app->controller->renderPartial('_acdatosbasicos', ['model'=> $model]);

$accionEspecifica = Yii::$app->controller->renderPartial('_accion_especifica_ac',[
    'model' => $model,
]);

?>


<div class="accion-centralizada-view">

   <h1><?= Html::encode("Acción Centralizada #".$this->title) ?></h1>

   <div class="container-fluid">

        <div class="pull-right" id="aprobar">
            <?= Html::a($icons['distribucion'].' Distribución Presupuestaria', ['distribucion', 'accion_centralizada' => $model->id], [
                'class' => 'btn btn-info navbar-btn'
            ]) ?>

            <?php 
                if ($model->aprobado == 1) {
                    echo Html::a($icons['aprobado'].' Aprobado', ['aprobar', 'id' => $model->id], [
                                'class' => 'btn btn-success navbar-btn',
                                'role' => 'modal-remote',
                                'data-confirm' => false, 'data-method' => false, // for overide yii data api
                                'data-request-method' => 'post',
                                'data-confirm-title' => Yii::t('user', '¿Está seguro?'),
                                'data-confirm-message' => Yii::t('user', '¿Está seguro que desea marcar este proyecto como <b>"No Aprobado"</b>?'),
                    ]);
                } else {
                    echo Html::a($icons['no-aprobado'].' No Aprobado', ['aprobar', 'id' => $model->id], [
                                'class' => 'btn btn-warning navbar-btn',
                                'role' => 'modal-remote',
                                'data-confirm' => false, 'data-method' => false, // for overide yii data api
                                'data-request-method' => 'post',
                                'data-confirm-title' => Yii::t('user', '¿Está seguro?'),
                                'data-confirm-message' => Yii::t('user', '¿Está seguro que desea marcar este proyecto como <b>"Aprobado"</b>?'),
                    ]);
                }
            ?>
        </div>
    </div>
    <br>
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
                 'content' => $accionEspecifica,
                 
              ],
           
            
        ],
         'pluginOptions' => [
            'enableCache' => false //Refrescar la pestaña
        ]
    ]);


  ?>  
  

    <div class="btn-group">
      <?= Html::a($icons['volver'].' Volver', ['accion-centralizada/index'], ['class' => 'btn btn-primary']) ?>       
    </div>


</div>
   
<!-- Ventana modal -->
<?php Modal::begin([
    "id"=>"ajaxCrubModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>