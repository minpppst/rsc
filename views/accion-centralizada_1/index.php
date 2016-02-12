<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AccionCentralizadaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Accion Centralizadas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accion-centralizada-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Accion Centralizada', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'codigo_accion',
            'codigo_accion_sne',
            'nombre_accion',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
