<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;
use yii\bootstrap\Button;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $model app\models\AccionCentralizada */
//Iconos
$icons=[
    'crear'=>'<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>',
    'editar'=>'<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>',
    'eliminar'=>'<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>',
    'recargar' => '<span class="glyphicon glyphicon-repeat"></span>'
];

CrudAsset::register($this);
?>
<div class="accion-centralizada-view">

    
    <p>
    <?= Html::a($icons['editar'].' Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    <?= Html::a($icons['eliminar'].' Eliminar', ['delete', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => '¿Está seguro que desea eliminar la Accion Centralizada? (Todos los datos asociados serán eliminados)',
            'method' => 'post',
        ],
    ]) ?>
</p>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'codigo_accion',
            'codigo_accion_sne',
            'nombre_accion',
        ],
    ]) ?>

</div>
