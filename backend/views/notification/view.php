<?php

use yii\widgets\DetailView;
use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Notification */
?>
<div class="notification-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'key',
                'label' => 'Tipo'
            ],
            [
                'class'=>'\kartik\grid\DataColumn',
                'attribute'=>'key_id',
                'label' => 'Resumen',
                'value' => $model->resumen,
                
            ],
            [
                'class'=>'\kartik\grid\DataColumn',
                'attribute'=>'seen',
                'label' => 'Visto',
                'value' => $model->seen==1 ? 'Visto' : 'No visto',
            ],
            [   'class'=>'\kartik\grid\DataColumn',
                'attribute' => 'id',
                'label' => 'IMG',
                'value' => $model->key=='observacion' ? $model->ImgObservacion : '',
                'format' => ['image',['width'=>'480','height'=>'200',]],
                
            ],
            [
                'class'=>'\kartik\grid\DataColumn',
                'attribute'=>'created_at',
                'value' => $model->created_at ? date('d/m/Y h:i',strtotime($model->created_at)) : '',
            ],

        ],
    ]) ?>

</div>
