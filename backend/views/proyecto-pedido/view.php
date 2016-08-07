<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;
use johnitvn\ajaxcrud\CrudAsset; 

/* @var $this yii\web\View */
/* @var $model app\models\ProyectoPedido */

CrudAsset::register($this);
?>
<div class="proyecto-pedido-view">
    <div class="panel panel-default">
        <div class="panel-body">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'nombreMaterial',
                    'precioBolivar',
                    'trimestre1',
                    'trimestre2',
                    'trimestre3',
                    'trimestre4',
                    'totalTrimestre',
                    'subTotal',
                    'iva',
                    'total',
                    'fecha_creacion',
                    'nombreUsuario',
                    'nombreEstatus',
                ],
            ]) ?>
        </div>
    </div>

    <?php if (!Yii::$app->request->isAjax): ?>
        <div class="btn-group">
            <?= Html::a('<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Editar',
                ['proyecto-pedido/update', 'id' => $model->id],
                [
                    "class"=>"btn btn-primary",
                    'role'=>'modal-remote',
                    'title' => 'Editar',
                    'data-toggle'=>'tooltip'
                ]) ?>        
        </div>
    <?php endif; ?>
</div>
<?php Modal::begin([
    "id"=>"ajaxCrubModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>