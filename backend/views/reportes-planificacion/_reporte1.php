<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\depdrop\DepDrop;
use kartik\depdrop\DepDropAsset;

DepDropAsset::register($this);
?>
<?php $form = ActiveForm::begin(); ?>
<div class="panel panel-info" >
    <div class="panel-heading">
        <h3 class="panel-title"><i class="glyphicon glyphicon-list-alt"></i> Filtro Acciones - Proyectos</h3>
    </div>

    <div class="panel-body">

        <div class="proyecto-variable-usuarios-form">

            <table class="table table-bordered table-condensed table-striped">
                <tbody>
                    <tr class="danger">
                        <td style="width: 50%;">
                            <label class="control-label">    Acción Centralizada   </label>
                        </td>
                        <td style="width: 50%;">
                            <label class="control-label">    Proyectos    </label>
                        </td>
                    </tr>
                    <tr class="default">
                        <td style="width: 50%;">
                            <?= Html::dropDownList('accion_centralizada','accion_centralizada',ArrayHelper::map($accion_centralizada,'id','nombre_accion'), ['class' => 'form-control', 'id' => 'accion_centralizada'])?>
                        </td>
                        <td style="width: 50%;">
                            <?= Html::dropDownList('proyectos','proyectos',ArrayHelper::map($proyectos,'id','nombre'), ['class' => 'form-control', 'id' => 'proyectos'])?>
                        </td>
                    </tr>
                     <tr class="danger">
                        <td style="width: 50%;">
                            <label class="control-label">    Acción Centralizada Acciones Específicas   </label>
                        </td>
                        <td style="width: 50%;">
                            <label class="control-label">    Proyectos Acciones Específicas   </label>
                        </td>
                    </tr>
                    <tr class="default">
                        <td style="width: 50%;">
                            <?= Html::dropDownList('acc_especifica','acc_especifica',[],
                            ['prompt' => 'Seleccione Acción Central', 'class' => 'form-control', 'id' => 'acc_especifica']
                            )?>
                        </td>
                        <td style="width: 50%;">
                            <?= Html::dropDownList('proyectos_especifica','proyectos_especifica',[], ['prompt' => 'Seleccione Proyecto','class' => 'form-control', 'id' => 'proyectos_especifica'])?>
                        </td>
                    </tr>

                </tbody>
            </table>
            
        </div>
    </div>
</div>
<div class="panel panel-info" >
    <div class="panel-heading">
        <h3 class="panel-title"><i class="glyphicon glyphicon-list-alt"></i> Filtro Variable - Unidad Ejecutora</h3>
    </div>

    <div class="panel-body">

        <div class="proyecto-variable-usuarios-form">

            <table class="table table-bordered table-condensed table-striped">
                <tbody>
                    <tr class="danger">
                        <td style="width: 50%;">
                            <label class="control-label">    Variables Central  </label>
                        </td>
                        <td style="width: 50%;">
                            <label class="control-label">    Variables Proyecto    </label>
                        </td>
                    </tr>
                    <tr class="default">
                        <td style="width: 50%;">
                            <?= Html::dropDownList('variablescentral','variablescentral',ArrayHelper::map($variablescentral,'id','nombre_variable'), ['class' => 'form-control', 'id' => 'variablescentral'])?>
                        </td>
                        <td style="width: 50%;">
                            <?= Html::dropDownList('variablesproyecto','variablesproyecto',ArrayHelper::map($variablesproyecto,'id','nombre_variable'), ['class' => 'form-control', 'id' => 'variablesproyecto'])?>
                        </td>
                    </tr>
                    <tr class="default">
                        <td style="width: 50%;">
                            
                        </td>
                        <td style="width: 50%;">Agrupar Variables
                            <?= Html::checkbox('agruparvariables','', ['selected' => true,  'id' => 'agruparvariables', 'title' => 'Agrupa las variables que esten separadas por estados', 'style' => 'height:20; width: 20px;']) ?>
                        </td>
                    </tr>
                    <tr class="danger">
                        <td style="width: 50%;">
                            <label class="control-label">    Unidades Ejecutoras    </label>
                        </td>
                        <td style="width: 50%;">
                            <label class="control-label">    Meses   </label>
                        </td>
                    </tr>
                    <tr class="default">
                        <td style="width: 50%;">
                            <?= Html::dropDownList('unidadessejecutoras','unidadessejecutoras',ArrayHelper::map($unidadesejecutoras,'id','nombre'), ['class' => 'form-control', 'id' => 'ue'])?>
                        </td>
                        <td style="width: 50%;">
                            <?= Html::dropDownList('meses','meses',ArrayHelper::map($meses,'id','nombre'), ['class' => 'form-control', 'id' => 'meses'])?>
                        </td>
                    </tr>


                </tbody>
            </table>
            
        </div>
    </div>
</div>

<div class="form-group">
    <?= Html::submitButton('Generar', ['class' => 'btn btn-primary']) ?>
</div>
<?php ActiveForm::end(); ?>
<script type="text/javascript">

    /* Listas desplegables dependientes */
    <?php
    $this->registerJs('$(document).ready(function()
    {
        //especifica accion
        $("#acc_especifica").depdrop({
            depends: ["accion_centralizada"],
            placedholder: ["Seleccione"],
            url: "'.Url::to(['accespecifica']).'"
        });

        $("#proyectos_especifica").depdrop({
            depends: ["proyectos"],
            url: "'.Url::to(['proyectoespecifica']).'"

        });
    });');
?>
</script>
