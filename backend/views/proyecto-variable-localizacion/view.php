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
                            'value' => $model->idEstado->nombre,
                        ],
                        [
                            'attribute' => 'id_municipio',
                            'label' => 'Municipio',
                            'value' => $model->idMunicipio->nombre,
                        ],
                        [
                            'attribute' => 'id_parroquia',
                            'label' => 'Parroquia',
                            'value' => $model->idParroquia->nombre,
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
