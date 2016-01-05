<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

?>

<?php if($model == null): ?> <!-- No existe -->

    <h4><span class="label label-default"><?= $nombre ?></span></h4>
    <div class="well well-sm">No hay datos.</div>
    <?= Html::a($icons['crear'].' Agregar', [$url.'/create-alt', 'proyecto' => $proyecto], ['class' => 'btn btn-primary']) ?>

<?php else: ?> <!-- Existe -->
    <h4>
        <div class="btn-group-sm" role="group" aria-label="...">
            <span class="label label-default"><?= $nombre ?></span>
            <?= Html::a($icons['editar'], [$url.'/update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a($icons['eliminar'], [$url.'/delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </div>
    </h4>
    <?= DetailView::widget([
            'model' => $model,
            'attributes' => $atributos
    ]) ?>
<?php endif; ?>