<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProyectoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Proyectos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proyecto-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Proyecto', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'codigo_proyecto',
            'codigo_sne',
            'nombre',
            'estatus_proyecto',
            // 'situacion_presupuestaria',
            // 'monto_proyecto',
            // 'descripcion:ntext',
            // 'clasificacion_sector',
            // 'sub_sector',
            // 'plan_operativo',
            // 'objetivo_estrategico',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
