<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ProyectoVariableLocalizacion */
?>
<div class="proyecto-variable-localizacion-view">
    <table align="center" width="500" border="0">
        <tr>
            <td align="center">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        [
                            'attribute' => 'id_pais',
                            'label' => 'Pais',
                            'value' => $model->idPais->nombre,
                        ],
                        [
                            'attribute' => 'id_estado',
                            'label' => 'Estado',
                            'value' => isset($model->idEstado->nombre) ? $model->idEstado->nombre : 'No Aplica',
                        ],
                        [
                            'attribute' => 'id_municipio',
                            'label' => 'Municipio',
                            'value' => isset($model->idMunicipio->nombre) ? $model->idMunicipio->nombre : 'No Aplica',
                        ],
                        [
                            'attribute' => 'id_parroquia',
                            'label' => 'Parroquia',
                            'value' => isset($model->idParroquia->nombre) ? $model->idParroquia->nombre: 'No Aplica',
                        ],
                        
                    ],
                ]) ?>
            </td>
        </tr>
        <tr>
            <td>
                <?= DetailView::widget([
                    'model' => $model1,
                    'attributes' => 
                    [
                        'trimestre1',
                        'trimestre2',
                        'trimestre3',
                        'trimestre4',
                        'totalTrimestre',
                    ],
                ]) ?>
            </td>
        </tr>
    </table>

</div>
