<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\web\JsExpression;
use yii\bootstrap\Modal;

?>

<?php if($model == null): ?> <!-- No existe -->

    <div class="page-header">
      <h4><?= $nombre ?></h4>
    </div>
    
    <div class="well">

        <?= Html::a($icons['crear'].' Nuevo', [$url.'/create', 'id_variable' => $variable], [
            'class' => 'btn btn-default',
            'role'=>'modal-remote',
            'title'=> 'Nuevo',
        ]) ?>

    </div>

<?php else: ?> <!-- Existe -->
    <h4>
        <div class="btn-group-sm" role="group" aria-label="...">

            <div class="page-header">
              <h4><?= $nombre ?></h4>
            </div>

            <?php
                //Botones para la ventana modal de eliminar
                $cancelar = '<button type=\'button\' class=\'btn btn-default pull-left\' data-dismiss=\'modal\'>Cancelar</button>';
                //$aceptar = '<a href=\''.Url::to([$url.'/delete', 'id' => $model->id]).'\' class=\'btn btn-primary\' data-method=\'post\' role=\'modal\'>Aceptar</button>';
                $aceptar = '<a class=\'btn btn-primary\' href=\''.Url::to([$url.'/delete2', 'id' => $model->id]).'\'  title=\'Aceptar\' role=\'modal-remote\' \'data-method\'=\'post\' >Aceptar</a>';
                
                //$aceptar = '<a class="btn btn-primary" href="/rsc/backend/web/index.php?r=proyecto-variable-responsable%2Fupdate&amp;id=6" title="Editar" role="modal-remote"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Editar</a>';
            ?>
            <!-- Botones -->
            <?= Html::a($icons['editar'].' Editar', [$url.'/update', 'id' => $model->id], [
                'class' => 'btn btn-primary',
                'role'=>'modal-remote',
                'title'=> 'Editar',
            ]) ?>
            <?= Html::button($icons['eliminar'].' Eliminar', [
                'class' => 'btn btn-danger',
                'title'=> 'Eliminar',
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