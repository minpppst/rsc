<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AccionCentralizadaVariableEjecucion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="accion-centralizada-variable-ejecucion-form">

  
    <!-- TRIMESTRES -->
    <table class="table table-bordered table-condensed table-striped">
        <tbody>
             <tr class="warning">
                <td colspan="13" align='center'><label>PROGRAMACIÓN ESTIMADA</label></td>
            </tr>
            <tr class="warning">
                

            <td>
                <label class="control-label" for="form-group enero" style="position: relative;">Enero</label>
                <input type="text", id="enero", placeholder="0",  class="form-control",  style="max-width:80px;", readonly=readonly, value=<?= $model_programacion[0]['enero']; ?> />
            </td>
            <td>
                <label class="control-label" for="form-group febrero" style="position: relative;">Febrero</label>
                <input type="text", id="febrero", placeholder="0",  class="form-control",  style="max-width:80px;", readonly=readonly, value=<?= $model_programacion[0]['febrero']; ?> />
            </td>
            <td>
                <label class="control-label" for="form-group marzo" style="position: relative;">Marzo</label>
                <input type="text", id="marzo", placeholder="0",  class="form-control",  style="max-width:80px;", readonly=readonly, value=<?= $model_programacion[0]['marzo']; ?> />
            </td>
            <td>
                <label class="control-label" for="form-group abril" style="position: relative;">Abril</label>
                <input type="text", id="abril", placeholder="0",  class="form-control",  style="max-width:80px;", readonly=readonly, value=<?= $model_programacion[0]['abril']; ?> />
            </td>
            <td>
                <label class="control-label" for="form-group mayo" style="position: relative;">Mayo</label>
                <input type="text", id="mayo", placeholder="0",  class="form-control",  style="max-width:80px;", readonly=readonly, value=<?= $model_programacion[0]['mayo']; ?> />
            </td>
            <td>
                <label class="control-label" for="form-group junio" style="position: relative;">Junio</label>
                <input type="text", id="junio", placeholder="0",  class="form-control",  style="max-width:80px;", readonly=readonly, value=<?= $model_programacion[0]['junio']; ?> />
            </td>
            <td>
                <label class="control-label" for="form-group julio" style="position: relative;">Julio</label>
                <input type="text", id="julio", placeholder="0",  class="form-control",  style="max-width:80px;", readonly=readonly, value=<?= $model_programacion[0]['julio']; ?> />
            </td>
            <td>
                <label class="control-label" for="form-group agosto" style="position: relative;">Agosto</label>
                <input type="text", id="agosto", placeholder="0",  class="form-control",  style="max-width:80px;", readonly=readonly, value=<?= $model_programacion[0]['agosto']; ?> />
            </td>
            <td>
                <label class="control-label" for="form-group septiembre" style="position: relative;">Septiembre</label>
                <input type="text", id="septiembre", placeholder="0",  class="form-control",  style="max-width:80px;", readonly=readonly, value=<?= $model_programacion[0]['septiembre']; ?> />
            </td>
            <td>
                <label class="control-label" for="form-group ocubre" style="position: relative;">Octubre</label>
                <input type="text", id="octubre", placeholder="0",  class="form-control",  style="max-width:80px;", readonly=readonly, value=<?= $model_programacion[0]['octubre']; ?> />
            </td>
            <td>
                <label class="control-label" for="form-group noviembre" style="position: relative;">Noviembre</label>
                <input type="text", id="noviembre", placeholder="0",  class="form-control",  style="max-width:80px;", readonly=readonly, value=<?= $model_programacion[0]['noviembre']; ?> />
            </td>
            <td>
                <label class="control-label" for="form-group diciembre" style="position: relative;">Diciembre</label>
                <input type="text", id="diciembre", placeholder="0",  class="form-control",  style="max-width:80px;", readonly=readonly, value=<?= $model_programacion[0]['diciembre']; ?> />
            </td>


            <td>
                <label class="control-label" for="form-group diciembre" style="position: relative;">Total</label>
                <input type="text", id="total", placeholder="0",  class="form-control",  style="max-width:80px;", readonly=readonly, value=<?= $total; ?> />
            </td>
            </tr>
            
           
                
        </tbody>
        
    </table>


            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'id_programacion')->hiddenInput()->label(false) ?>

            <?= $form->field($model, 'id_usuario')->hiddenInput()->label(false) ?>

            
 <table class="table table-bordered table-condensed table-striped">
        <tbody>
            <tr class="warning">
                <td colspan="13" align='center'><label>EJECUCIÓN DE VARIABLE</label></td>
            </tr>
            <tr class="danger">
                
                <td><?= $form->field($model, 'enero')->input('text', ['style' => 'max-width:80px', 'placeholder' => '0', 'class'=>'form-control', 'readonly'=>($desbloqueo['0']==1 || isset($desbloqueo['1']) ) ? false : true])?></td>
                <td><?= $form->field($model, 'febrero')->input('text', ['style' => 'max-width:80px', 'placeholder' => '0', 'class'=>'form-control', 'readonly'=>($desbloqueo['0']==2 || isset($desbloqueo['2'])) ? false : true]) ?></td>   
                <td><?= $form->field($model, 'marzo')->input('text', ['style' => 'max-width:80px', 'placeholder' => '0', 'class'=>'form-control','readonly'=>($desbloqueo['0']==3 || isset($desbloqueo['3'])) ? false : true ]) ?></td>
                <td><?= $form->field($model, 'abril')->input('text', ['style' => 'max-width:80px', 'placeholder' => '0', 'class'=>'form-control', 'readonly'=>($desbloqueo['0']==4 || isset($desbloqueo['4'])) ? false : true]) ?></td>
                <td><?= $form->field($model, 'mayo')->input('text', ['style' => 'max-width:80px', 'placeholder' => '0', 'class'=>'form-control', 'readonly'=>($desbloqueo['0']==5 || isset($desbloqueo['5'])) ? false : true]) ?></td>
                <td><?= $form->field($model, 'junio')->input('text', ['style' => 'max-width:80px', 'placeholder' => '0', 'class'=>'form-control', 'readonly'=>($desbloqueo['0']==6 || isset($desbloqueo['6'])) ? false : true]) ?></td>
                <td><?= $form->field($model, 'julio')->input('text', ['style' => 'max-width:80px', 'placeholder' => '0', 'class'=>'form-control', 'readonly'=>($desbloqueo['0']==7 || isset($desbloqueo['7'])) ? false : true]) ?></td>
                <td><?= $form->field($model, 'agosto')->input('text', ['style' => 'max-width:80px', 'placeholder' => '0', 'class'=>'form-control', 'readonly'=>($desbloqueo['0']==8 || isset($desbloqueo['8'])) ? false : true]) ?></td>
                <td><?= $form->field($model, 'septiembre')->input('text', ['style' => 'max-width:80px', 'placeholder' => '0', 'class'=>'form-control', 'readonly'=>($desbloqueo['0']==9 || isset($desbloqueo['9'])) ? false : true]) ?></td>
                <td><?= $form->field($model, 'octubre')->input('text', ['style' => 'max-width:80px', 'placeholder' => '0', 'class'=>'form-control', 'readonly'=>($desbloqueo['0']==10 || isset($desbloqueo['10'])) ? false : true]) ?></td>
                <td><?= $form->field($model, 'noviembre')->input('text', ['style' => 'max-width:80px', 'placeholder' => '0', 'class'=>'form-control', 'readonly'=>($desbloqueo['0']==11 || isset($desbloqueo['11'])) ? false : true]) ?></td>
                <td><?= $form->field($model, 'diciembre')->input('text', ['style' => 'max-width:80px', 'placeholder' => '0', 'class'=>'form-control', 'readonly'=>($desbloqueo['0']==12 || isset($desbloqueo['12'])) ? false : true]) ?></td>
                 <td>
                <label class="control-label" for="form-group diciembre" style="position: relative;">Total</label>
                <input type="text", id="total1", placeholder="0",  class="form-control", value=<?php echo $total_cargado; ?>  style="max-width:80px;", readonly=readonly />
            </td>
            </tr>
            
        </tbody>
        
    </table>
    <!--Comienzan las observaciones por meses -->
            <?php  
                if($desbloqueo['0']==1 || isset($desbloqueo['1']))
                {
            ?>
                    <?= $form->field($model, 'observacion_enero')->textarea(['rows' => 3]) ?>
            <?php
                }
            ?>
            <?php  
                if($desbloqueo['0']==2 || isset($desbloqueo['2']))
                {
            ?>
                    <?= $form->field($model, 'observacion_febrero')->textarea(['rows' => 3]) ?>
            <?php
                }
            ?>
            <?php  
                if($desbloqueo['0']==3 || isset($desbloqueo['3']))
                {
            ?>
                    <?= $form->field($model, 'observacion_marzo')->textarea(['rows' => 3]) ?>
            <?php
                }
            ?>
            <?php  
                if($desbloqueo['0']==4 || isset($desbloqueo['4']))
                {
            ?>
                    <?= $form->field($model, 'observacion_abril')->textarea(['rows' => 3]) ?>
            <?php
                }
            ?>
            <?php  
                if($desbloqueo['0']==5 || isset($desbloqueo['5']))
                {
            ?>
                    <?= $form->field($model, 'observacion_mayo')->textarea(['rows' => 3]) ?>
            <?php
                }
            ?>
            <?php  
                if($desbloqueo['0']==6 || isset($desbloqueo['6']))
                {
            ?>
                    <?= $form->field($model, 'observacion_junio')->textarea(['rows' => 3]) ?>
            <?php
                }
            ?>
            <?php  
                if($desbloqueo['0']==7 || isset($desbloqueo['7']))
                {
            ?>
                    <?= $form->field($model, 'observacion_julio')->textarea(['rows' => 3]) ?>
            <?php
                }
            ?>
            <?php  
                if($desbloqueo['0']==8 || isset($desbloqueo['8']))
                {
            ?>
                    <?= $form->field($model, 'observacion_agosto')->textarea(['rows' => 3]) ?>
            <?php
                }
            ?>
            <?php  
                if($desbloqueo['0']==9 || isset($desbloqueo['9']))
                {
            ?>
                    <?= $form->field($model, 'observacion_septiembre')->textarea(['rows' => 3]) ?>
            <?php
                }
            ?>
            <?php  
                if($desbloqueo['0']==10 || isset($desbloqueo['10']))
                {
            ?>
                    <?= $form->field($model, 'observacion_octubre')->textarea(['rows' => 3]) ?>
            <?php
                }
            ?>
            <?php  
                if($desbloqueo['0']==11 || isset($desbloqueo['11']))
                {
            ?>
                    <?= $form->field($model, 'observacion_noviembre')->textarea(['rows' => 3]) ?>
            <?php
                }
            ?>
            <?php  
                if($desbloqueo['0']==12 || isset($desbloqueo['12']))
                {
            ?>
                    <?= $form->field($model, 'observacion_diciembre')->textarea(['rows' => 3]) ?>
            <?php
                }
            ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
