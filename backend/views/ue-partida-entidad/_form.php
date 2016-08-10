<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model backend\models\UePartidaEntidad */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="container-fluid">
<div class="ue-partida-entidad-form">

    <?php 
    $form = ActiveForm::begin(); ?>


<div class="form-group">
<div class="panel panel-primary">
        <div class="panel-heading">
          <span>Modificar Partida Unidades-Ejecutora</span>
        </div>
        <div class="panel-body">
 <table class="table table-bordered table-condensed table-striped" >
        <tbody>
        <tr >
        <td colspan="2" align="center"><label>Cuenta</label></td>
        <td align="center"><label>Unidad Ejecutora Proyecto</label></td>
        <td align="center" ><label>Unidad Ejecutora ACC</label></td>
        </tr>
    <tr >
        <td valign="top" align="center">
           
            <?= $form->field($model, 'cuenta')->textInput(['maxlength' => '1', 'style'=>'margin-right: -40px; width:50px; text-align:center', "readonly" => true ])->label(false) ?>
            
           
        </td>
        <td valign="top" align="center">
           
            <?= $form->field($model, 'partida')->textInput(['maxlength' => '1', 'style'=>'width:50px; margin-left:-5px;', "readonly" => true ])->label(false) ?>
           
        </td>
    
        <td align="center">
            <div>
            <?php  
            // Multiple select without model 

            if(empty($precarga_proyecto))
            $precarga_proyecto="";
            echo $filterwidget=\kartik\select2\Select2::widget([
            'name' => 'ue_proyecto',
            'value' => $precarga_proyecto,
            'data' => $ue,
            'options' => ['multiple' => true, 'placeholder' => 'Seleccione la Unidad Ejecutora ...', 'id' => 'unique-select2-id_proyecto'],
            'pluginOptions' => [
            'width' => '250px',

            ],
            ]); 

  
            ?>
            </div>
        </td>

        <td align="center">
            <div>
            <?php  
            // Multiple select without model 
            if(empty($precarga_acc))
            $precarga_acc="";
            echo $filterwidget=\kartik\select2\Select2::widget([
            'name' => 'ue_acc',
            'value' => $precarga_acc,
            'data' => $ue,
            'options' => ['multiple' => true, 'placeholder' => 'Seleccione la Unidad Ejecutora ...', 'id' => 'unique-select2-id_acc'],
            'pluginOptions' => [
            'width' => '250px',
            ],
            ]);
            ?>
            </div>
        </td>
    
</tr>
</tbody>
</table>
</div>
</div>
<?php if (!Yii::$app->request->isAjax){ ?>
            <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
            <?php }
             ?>
</div>
    <?php ActiveForm::end(); ?>
    
</div>
</div>
