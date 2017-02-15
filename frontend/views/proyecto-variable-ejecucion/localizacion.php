<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\web\Url;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\AccionCentralizadaVariableEjecucionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Variables Por Región';
$this->params['breadcrumbs'][] = ['label' => 'Accion Centralizadas Variables Asignadas', 'url' => ['variables']];
$this->params['breadcrumbs'][] = $this->title;
$icons=[
  'volver'=>'<span class="glyphicon glyphicon-triangle-left" aria-hidden="true"></span>',
];
?>
<div class="Proyecto-variable-ejecucion">

    <h1><?= Html::encode($this->title) ?></h1>
   

    
    <?php Pjax::begin(); ?>    
    <?= GridView::widget([
        'dataProvider' => $model,
       // 'filterModel' => $searchModel,
        'columns' => [
           
            [
                'attribute'=>'nombre',
             
                'contentOptions' => 
                    [
                    'style'=>'max-width: 250px;  word-wrap: break-word;
                    white-space: normal;'
                    ],

                'format' => 'raw',
             
             ],
             [
                 'attribute' => 'nombre_estado',
                 'label'=>'Estado',
                  'contentOptions'=>['style'=>'word-wrap:break-word; width:220px;'],

                 'format' => 'raw',
                 'value'=>function ($data) 
                 {
                    return Html::a($data['nombre_estados'], ['proyecto-variable-ejecucion/create', 'id' =>$data['id_variable'], 'id_localizacion' => $data['id']]);
                },
             ],
             [
                'attribute' => 'nombre_municipio',
                'label'=>'Municipio',
                'contentOptions'=>['style'=>'word-wrap:break-word; width:220px;'],

                'format' => 'raw',
                'value'=>function ($data) 
                {
                        
                    return Html::a($data['nombre_municipio'], ['proyecto-variable-ejecucion/create', 'id' =>$data['id_variable'], 'id_localizacion' => $data['id']]);
                },
             ],
             [
                 'attribute' => 'nombre_parroquia',
                 'label'=>'Parroquia',
                  'contentOptions'=>['style'=>'word-wrap:break-word; width:220px;'],

                 'format' => 'raw',
                 'value'=>function ($data) 
                {
                    return Html::a($data['nombre_parroquia'], ['proyecto-variable-ejecucion/create', 'id' =>$data['id_variable'], 'id_localizacion' => $data['id']]);
                            
                },
             ],

            
        ],
        'panel' => 
        [
            'type' => 'default', 
            'heading' => '<i class="glyphicon glyphicon-calendar"></i> Variable Proyecto',
        ]
        
    ]); ?>
<?php Pjax::end(); ?></div>
<div class="btn-group">
    <?= Html::a($icons['volver'].' Volver', ['variables'], ['class' => 'btn btn-primary']) ?>        
</div>