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
                'attribute'=>'user_origin',
                'label' => 'Usuario Origen',
                'value' => isset($model->idUserOrigin) ? $model->idUserOrigin->username : '',
            ],
            [
                'class'=>'\kartik\grid\DataColumn',
                'attribute'=>'user_id',
                'label' => 'Usuario Destino',
                'value' => isset($model->idUser) ? $model->idUser->username : '',
                
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
                'value' => $model->key=='observacion' ? $model->ImgObservacion : null,
                'format' => $model->key=='observacion' ? ['image',['width'=>'480','height'=>'200',]] : 'TEXT',
                
            ],
            [
                'class'=>'\kartik\grid\DataColumn',
                'attribute'=>'created_at',
                'value' => $model->created_at ? date('d/m/Y h:i',strtotime($model->created_at)) : '',
            ],

        ],
    ]) ?>

</div>
