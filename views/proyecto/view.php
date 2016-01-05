<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ListView;

use app\models\EstatusProyecto;
use app\models\SituacionPresupuestaria;
use app\models\Sector;
use app\models\SubSector;
use app\models\PlanOperativo;
use app\models\ObjetivosHistoricos;
use app\models\ObjetivosNacionales;
use app\models\ObjetivosEstrategicos;
use app\models\ObjetivosGenerales;
use app\models\Ambito;

/* @var $this yii\web\View */
/* @var $model app\models\Proyecto */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Proyectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$icons=[
    'crear'=>'<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>',
    'editar'=>'<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>',
    'eliminar'=>'<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>',
];

?>
<div class="proyecto-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <!-- BOTONES -->
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <!-- TABS -->
    <ul class="nav nav-tabs nav-justified">
        <li role="tabs" class="active"><a href="#">Datos Básicos</a></li>
        <li role="tabs"><a href="#">Alcance e Impacto</a></li>
        <li role="tabs"><a href="#">Acciones Específicas</a></li>
        <li role="tabs"><a href="#">Distribución Presupuestaria</a></li>
        <li role="tabs"><a href="#">Fuentes de Financiamiento</a></li>
    </ul>

    
    <!-- Widget con los datos -->
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'codigo_proyecto',
            'codigo_sne',
            'nombre',
            [
                'label' => 'Estatus del Proyecto',
                'value' => $model->nombreEstatus,
            ],
            [
                'label' => 'Situación Presupuestaria',
                'value' => SituacionPresupuestaria::find()->where(['id'=>$model->situacion_presupuestaria])->one()->situacion,
            ],
            'monto_proyecto',
            'descripcion:ntext',
            [
                'label' => 'Sector',
                'value' => Sector::find()->where(['id'=>$model->sector])->one()->sector,
            ],
            [
                'label' => 'Sub-sector',
                'value' => SubSector::find()->where(['id'=>$model->sub_sector])->one()->sub_sector,
            ],
            [
                'label' => 'Plan Operativo',
                'value' => PlanOperativo::find()->where(['id'=>$model->plan_operativo])->one()->plan_operativo,
            ],
            [
                'label' => 'Objetivo Historico',
                'value' => $historico->objetivo_historico,
            ],
            [
                'label' => 'Objetivo Nacional',
                'value' => $nacional->objetivo_nacional,
            ], 
            [
                'label' => 'Objetivo Estratégico',
                'value' => $estrategico->objetivo_estrategico,
            ],            
            [
                'label' => 'Objetivo General',
                'value' => ObjetivosGenerales::find()->where(['id'=>$model->objetivo_general])->one()->objetivo_general,
            ],            
            'objetivo_estrategico_institucional',
            [
                'label' => 'Ámbito',
                'value' => Ambito::find()->where(['id'=>$model->ambito])->one()->ambito,
            ]
        ],
    ]) ?>

    <!-- LOCALIZACION -->
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">Localización</h3>
        </div>
        <div class="panel-body">
            <?= ListView::widget([
                'dataProvider' => $localizacion,
                'itemView' => '_localizacion'
            ]) ?>
        </div>
    </div>  

    <!-- RESPONSABLES -->
    <div class="panel panel-info" >
        <div class="panel-heading">
            <h3 class="panel-title">Responsables</h3>
        </div>
        <div class="panel-body">

            <!-- Responsable -->            
            <?= Yii::$app->controller->renderPartial('_responsable', [
                'model' => $model->responsable,
                'url' => 'proyecto-responsable',
                'proyecto' => $model->id, 
                'icons' => $icons,
                'nombre' => 'Responsable',
                'atributos' => [
                    'nombre',
                    'cedula',
                    'email',
                    'telefono'
                ]
            ]) ?>

            <!-- Responsable Administrativo -->
            <?= Yii::$app->controller->renderPartial('_responsable', [
                'model' => $model->responsableAdministrativo,
                'url' => 'proyecto-responsable-administrativo',
                'proyecto' => $model->id, 
                'icons' => $icons,
                'nombre' => 'Responsable Administrativo',
                'atributos' => [
                    'nombre',
                    'cedula',
                    'email',
                    'telefono',
                    'unidad_administradora'
                ]
            ]) ?>

            <!-- Responsable Tecnico -->
            <?= Yii::$app->controller->renderPartial('_responsable', [
                'model' => $model->responsableTecnico,
                'url' => 'proyecto-responsable-tecnico',
                'proyecto' => $model->id, 
                'icons' => $icons,
                'nombre' => 'Responsable Técnico',
                'atributos' => [
                    'nombre',
                    'cedula',
                    'email',
                    'telefono',
                    'unidad_tecnica'
                ]
            ]) ?>

            <!-- Registrador -->
            <?= Yii::$app->controller->renderPartial('_responsable', [
                'model' => $model->registrador,
                'url' => 'proyecto-registrador',
                'proyecto' => $model->id, 
                'icons' => $icons,
                'nombre' => 'Registrador',
                'atributos' => [
                    'nombre',
                    'cedula',
                    'email',
                    'telefono',
                ]
            ]) ?>

        </div>
    </div>

</div>
