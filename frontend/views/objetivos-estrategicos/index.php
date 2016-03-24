<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ObjetivosEstrategicosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Objetivos Estrategicos';
$this->params['breadcrumbs'][] = ['label' => 'Configuración', 'url' => ['site/configuracion']];
$this->params['breadcrumbs'][] = $this->title;

//Iconos
$icons=[
    'nuevo'=>'<span class="glyphicon glyphicon-file" aria-hidden="true"></span>',
    'editar'=>'<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>',
    'eliminar'=>'<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>',
    'volver'=>'<span class="glyphicon glyphicon-triangle-left" aria-hidden="true"></span>',
];
?>
<div class="objetivos-estrategicos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a($icons['nuevo'].' Crear Objetivo Estrategico', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'objetivo_estrategico:ntext',
            'objetivo_nacional',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
<div class="btn-group">
    <?= Html::a($icons['volver'].' Volver', ['/site/configuracion'], ['class' => 'btn btn-primary']) ?>        
</div>