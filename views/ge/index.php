<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Partidas Generales';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ge-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ge', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_partida',
            'codigo_ge',
            'nombre_ge',
            'estatus',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
