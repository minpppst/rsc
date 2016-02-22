<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProyectoPedidoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Proyecto Pedidos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proyecto-pedido-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Proyecto Pedido', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_material',
            'enero',
            'febrero',
            'marzo',
            // 'abril',
            // 'mayo',
            // 'junio',
            // 'julio',
            // 'agosto',
            // 'septiembre',
            // 'octubre',
            // 'noviembre',
            // 'diciembre',
            // 'precio',
            // 'fecha_creacion',
            // 'id_usuario',
            // 'id_accion_especifica',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
