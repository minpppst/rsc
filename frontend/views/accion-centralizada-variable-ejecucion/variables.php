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

?>
<div class="accion-centralizada-variable-ejecucion-variable">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    
    
    <?= GridView::widget([
        'dataProvider' => $model,
        
        'columns' => [
            
            [
             'label'=>'Nombre',
              'contentOptions'=>['style'=>'word-wrap:break-word; width:220px;'],

             'format' => 'raw',
             'value'=>function ($data) {
             return $data['localizacion']==0 ?  Html::a($data['nombre'], ['accion-centralizada-variable-ejecucion/create', 'id' =>$data['id'], 'id_localizacion' => $data['id_localizacion']]) : Html::a($data['nombre'], ['accion-centralizada-variable-ejecucion/localizacion', 'id' =>$data['id']]);
            
                        
                      },
             ],
            
        ],
    ]); ?>
</div>
