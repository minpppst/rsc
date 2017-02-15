<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use backend\models\ProyectoVariables;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\AccionCentralizadaVariableEjecucionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Proyecto Variables Asignadas';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="Proyecto-variable-ejecucion">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?= GridView::widget([
        'dataProvider' => $model,
        'filterModel' => $searchModel,
        'id'=> 'variables',
        'columns' => [
            [
             'class'=>'\kartik\grid\DataColumn',
             //'label'=>'Nombre De Variable',
             'attribute' => 'nombre_variable',
             'format' => 'raw',
             'value'=>function ($data) 
             {
                return $data['localizacion']==1 || $data['localizacion']==2 || $data['localizacion']==3 || $data['localizacion']==7 || $data['localizacion']==8
                    ?  
                        Html::a($data['nombre_variable'], ['proyecto-variable-ejecucion/create', 'id' =>$data['id'], 'id_localizacion' => $data['id_localizacion']]) 
                    : 
                        Html::a($data['nombre_variable'], ['proyecto-variable-ejecucion/localizacion', 'id' =>$data['id']]);
            },
            'filter' => false,
                'contentOptions' => 
                [
                    'style'=>'max-width: 350px;  word-wrap: break-word;
                    white-space: normal;'
                ],
            
            ],
        ],
        'panel' => 
        [
            'type' => 'default', 
            'heading' => '<i class="glyphicon glyphicon-calendar"></i> Variable Proyecto',
        ]
    ]); ?>
</div>
<div class="btn-group">
    <?= Html::a('<span class="glyphicon glyphicon-triangle-left" aria-hidden="true"></span> Volver', ['site/index'], ['class' => 'btn btn-primary']) ?>
</div>