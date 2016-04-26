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
    'aprobado'=>'<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>',
    'no-aprobado'=>'<span class="glyphicon glyphicon-alert" aria-hidden="true"></span>',
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
$accionEspecifica = Yii::$app->controller->renderPartial('_accion-especifica',[
    'model' => $model,
]);

?>
<div class="proyecto-view">

    <h1>Proyecto #<?= Html::encode($this->title) ?></h1>

    <div class="container-fluid">
        <div class="pull-right" id="aprobar">
            <?php 
                if ($model->aprobado == 1) {
                    echo Html::a($icons['aprobado'].' Aprobado', ['aprobar', 'id' => $model->id], [
                                'class' => 'btn btn-success btn-block',
                                'role' => 'modal-remote',
                                'data-confirm' => false, 'data-method' => false, // for overide yii data api
                                'data-request-method' => 'post',
                                'data-confirm-title' => Yii::t('user', '¿Está seguro?'),
                                'data-confirm-message' => Yii::t('user', '¿Está seguro que desea marcar este proyecto como <b>"No Aprobado"</b>?'),
                    ]);
                } else {
                    echo Html::a($icons['no-aprobado'].' No Aprobado', ['aprobar', 'id' => $model->id], [
                                'class' => 'btn btn-warning btn-block',
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
    "options" => [
        "tabindex" => false //importante para Select2
    ]
])?>
<?php Modal::end(); ?>

<script>
    //Actualizar el monto en el hidden input al escribir
    window.onload = function(){
        jQuery("#proyecto-monto_proyecto-disp").on('keyup', function(){
            jQuery("#proyecto-monto_proyecto").val(jQuery(this).maskMoney('unmasked')[0]);
        });
    };
</script>