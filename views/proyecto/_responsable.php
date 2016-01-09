<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\web\JsExpression;
use yii\bootstrap\Modal;

?>

<?php if($model == null): ?> <!-- No existe -->

    <h4><span class="label label-default"><?= $nombre ?></span></h4>
    <div class="well well-sm">No hay datos.</div>
    <?= Html::a($icons['crear'].' Agregar', [$url.'/create-alt', 'proyecto' => $proyecto], ['class' => 'btn btn-primary']) ?>

<?php else: ?> <!-- Existe -->
    <h4>
        <div class="btn-group-sm" role="group" aria-label="...">
            <span class="label label-default"><?= $nombre ?></span>
            <?php
                //Botones para la ventana modal
                $cancelar = '<button type=\'button\' class=\'btn btn-default pull-left\' data-dismiss=\'modal\'>Cancelar</button>';
                $aceptar = '<a href=\''.Url::to([$url.'/delete', 'id' => $model->id]).'\' class=\'btn btn-primary\' data-method=\'post\'>Aceptar</button>';
            ?>
            <!-- Botones -->
            <?= Html::a($icons['editar'], [$url.'/update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::button($icons['eliminar'], [
                'class' => 'btn btn-danger',
                'onclick' => new JsExpression('
                    $(".modal-header").html("<h4 class=\'modal-title\'>Eliminar '.$nombre.'</h4>");
                    $(".modal-body").html("¿Está seguro que desea eliminar este elemento?");
                    $(".modal-footer").html("'.$cancelar.$aceptar.'");
                    $("#ajaxCrubModal").modal("show");
                '),
            ]) ?>            
        </div>
    </h4>
    <?= DetailView::widget([
            'model' => $model,
            'attributes' => $atributos
    ]) ?>
<?php endif; ?>