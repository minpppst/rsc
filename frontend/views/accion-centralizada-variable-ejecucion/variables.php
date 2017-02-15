<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
//use yii\web\Url;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\AccionCentralizadaVariableEjecucionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Accion Centralizada Variables Asignadas';
$this->params['breadcrumbs'][] = $this->title;
$icons=[
  'volver'=>'<span class="glyphicon glyphicon-triangle-left" aria-hidden="true"></span>',
];
?>
<div class="accion-centralizada-variable-ejecucion-variable">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= GridView::widget([
        'dataProvider' => $model,
        'columns' => 
        [
            [
                'label'=>'Nombre De Variable',
                'format' => 'raw',
                'value'=>function ($data) 
                {
                    return $data['localizacion']==1 || $data['localizacion']==2 || $data['localizacion']==3 || $data['localizacion']==7 || $data['localizacion']==8
                        ?  Html::a($data['nombre'], ['accion-centralizada-variable-ejecucion/create', 'id' =>$data['id'], 'id_localizacion' => $data['id_localizacion']]) 
                        : Html::a($data['nombre'], ['accion-centralizada-variable-ejecucion/localizacion', 'id' =>$data['id']]);
                },
                'contentOptions' => 
                [
                    'style'=>'max-width: 350px;  word-wrap: break-word;
                    white-space: normal;'
                ]
            ],
        ],
        'panel' => 
        [
            'type' => 'default', 
            'heading' => '<i class="fa fa-calendar-o"></i> Variable Acción Centralizada',
        ],
    
    ]); ?>
</div>
<div class="btn-group">
    <?= Html::a($icons['volver'].' Volver', ['variables'], ['class' => 'btn btn-primary']) ?>        
</div>
