<?php

use bedezign\yii2\audit\Audit;
use yii\helpers\Html;
use yii\grid\GridView;
use bedezign\yii2\audit\models\AuditTrailSearch;
use bedezign\yii2\audit\models\AuditEntrySearch;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('audit', 'Entradas');
$this->params['breadcrumbs'][] = ['label' => Yii::t('audit', 'Configuracion'), 'url' => ['/site/configuracion']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="audit-entry-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' =>  $searchModel,
        'columns' => [
           // ['class' => 'yii\grid\ActionColumn', 'template' => '{view}'],
           // 'id',
            [
                'attribute' => 'user_id',
                'filter' => AuditEntrySearch::userFilter(),
                'label' => 'Usuarios',
                'class' => 'yii\grid\DataColumn',
                'value' => function ($data) {
                    return $data->obtener_nombre($data->user_id);
                },
                'format' => 'raw',
            ],
            'ip',
            
            [
                'class' => 'yii\grid\DataColumn',
                'attribute' => 'route',
                'label' => 'Lugar De Entrada',
                'filter' => AuditEntrySearch::routeFilter(),
                'format' => 'html',
                'value' => function ($data) {
                    return HTML::tag('span', '', [
                        'title' => \yii\helpers\Url::to([$data->route]),
                        'class' => 'glyphicon glyphicon-link'
                    ]) . ' ' . $data->route;
                },
            ],
            
            [
                'attribute' => 'trails',
                'label' => 'Accion BD',
                 'filter' => AuditTrailSearch::actionFilter(),
                'value' => function ($data) {
                    return $data->trails ? $data->trails[0]['action'] : '';
                },
                'contentOptions' => ['class' => 'text-right'],
            ],
           
            
            
            [
                'attribute' => 'created',
                'label' => 'Fecha',
                'options' => ['width' => '150px'],
            ],
        ],
    ]); ?>
</div>
