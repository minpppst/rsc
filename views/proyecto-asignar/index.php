<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProyectoAsignarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Asignar Usuarios';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="proyecto-asignar-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',

            [
                'class' => 'kartik\grid\ActionColumn',
                'header' => 'Acciones',
                'vAlign' => 'middle',
                'buttons' => [
                    'asignar' => function($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-transfer" aria-hidden="true"></span> Asignar', 
                            ['asignar', 'usuario' => $model->id],
                            [ 'class' => 'btn btn-success']
                        );
                    },
                ],
                'template' => '{asignar}'
            ],
        ],
    ]); ?>

</div>
