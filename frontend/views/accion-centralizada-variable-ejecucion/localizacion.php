<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\web\Url;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\AccionCentralizadaVariableEjecucionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Accion Centralizada Variables Localizacion Regional';
$this->params['breadcrumbs'][] = ['label' => 'Accion Centralizadas Variables Asignadas', 'url' => ['variables']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accion-centralizada-variable-ejecucion-variable">

    <h1><?= Html::encode($this->title) ?></h1>
   

    
    <?php Pjax::begin(); ?>    
    <?= GridView::widget([
        'dataProvider' => $model,
       // 'filterModel' => $searchModel,
        'columns' => [
           
            [
             'attribute'=>'nombre',
             
              'contentOptions'=>['style'=>'word-wrap:break-word; width:220px;'],

             'format' => 'raw',
             
             ],
             [
             'attribute' => 'nombre_estado',
             'label'=>'Estado',
              'contentOptions'=>['style'=>'word-wrap:break-word; width:220px;'],

             'format' => 'raw',
             'value'=>function ($data) {
                    
                return Html::a($data['nombre_estados'], ['accion-centralizada-variable-ejecucion/create', 'id' =>$data['id_variable'], 'id_localizacion' => $data['id']]);
                        
                       
                 },
             ],
            
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
