<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\AccionCentralizadaVariableEjecucionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Accion Centralizada Variable Ejecucions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accion-centralizada-variable-ejecucion-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Accion Centralizada Variable Ejecucion', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_programacion',
            'id_usuario',
            'fecha',
            'enero',
            // 'febrero',
            // 'marzo',
            // 'abril',
            // 'mayo',
            // 'junio',
            // 'julio',
            // 'agosto',
            // 'septiembre',
            // 'octubre',
            // 'noviembre',
            // 'diciembre',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
