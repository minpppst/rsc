<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\depdrop\DepDrop;
use kartik\depdrop\DepDropAsset;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
DepDropAsset::register($this);
/* @var $this yii\web\View */
/* @var $model backend\models\LocalizacionAccVariable */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="localizacion-acc-variable-form">

    <?php $form = ActiveForm::begin(); ?>

    
     <?= Html::activeHiddenInput($model, 'id_variable') ?>
     <?php


      /* Dependiendo del escenario */    
        switch ($model->scenario)
        {
            
            case 'Internacional':
                echo $form->field($model, 'id_pais')->dropDownList(ArrayHelper::map($pais,'id','nombre'),['prompt'=>'Seleccione'], ['disabled' => 'disabled']);
            break;

            case 'Nacional':
                echo $form->field($model, 'id_pais')->dropDownList(ArrayHelper::map($pais,'id','nombre'),['prompt'=>'Seleccione'], ['disabled' => 'disabled']);
            break;

            case 'Estadal':
                echo $form->field($model, 'id_pais')->dropDownList(ArrayHelper::map($pais,'id','nombre'),['prompt'=>'Seleccione', 'disabled' => true]);
                echo $form->field($model, 'id_estado')->dropDownList(ArrayHelper::map($estados,'id','nombre'),['prompt'=>'Seleccione']);
            break;

            case 'Municipal':
                echo $form->field($model, 'id_pais')->dropDownList(ArrayHelper::map($pais,'id','nombre'),['prompt'=>'Seleccione', 'disabled' => true]);
                
                echo $form->field($model, 'id_estado')->dropDownList(ArrayHelper::map($estados,'id','nombre'),['prompt'=>'Seleccione', 'id' => 'id_estado']);

                echo $form->field($model, 'id_municipio')->dropDownList(ArrayHelper::map($municipios,'id','nombre'),['prompt'=>'Seleccione', 'id' => 'id_municipio']);

            break;

            case 'Parroquial':
                
                echo $form->field($model, 'id_pais')->dropDownList(ArrayHelper::map($pais,'id','nombre'),['prompt'=>'Seleccione', 'disabled' => true]);

                echo $form->field($model, 'id_estado')->dropDownList(ArrayHelper::map($estados,'id','nombre'),['prompt'=>'Seleccione', 'id' => 'id_estado']);

                echo $form->field($model, 'id_municipio')->dropDownList(ArrayHelper::map($municipios,'id','nombre'),['prompt'=>'Seleccione', 'id' => 'id_municipio']);
                
                echo $form->field($model, 'id_parroquia')->dropDownList(ArrayHelper::map($parroquias,'id','nombre'),['prompt'=>'Seleccione', 'id' => 'id_parroquia']);
                
            break;

            default:
                echo $form->field($model, 'id_pais')->dropDownList(ArrayHelper::map($pais,'id','nombre'),['prompt'=>'Seleccione'], ['disabled' => 'disabled']);
            break;
        }
    ?>
    
<br>
    <div style='width: 550px'>
    <table class="table table-bordered table-condensed table-striped">
        <tbody>
            <tr class="warning">
                <td>
                <label>TRIM I</label></td>
            
                <td><?= $form->field($model1, 'enero')->input('number', ['style' => 'max-width:100px',  'placeholder' => '0', 'class' => 'trim1' ])->label('Enero', ['style' => 'display: block;']) ?></td>
            
                <td><?= $form->field($model1, 'febrero')->input('number', ['style' => 'max-width:100px', 'placeholder' => '0', 'class' => 'trim1' ])->label('Febrero', ['style' => 'display: block;']) ?></td>

                <td><?= $form->field($model1, 'marzo')->input('number', ['style' => 'max-width:100px', 'placeholder' => '0', 'class' => 'trim1' ])->label('Marzo', ['style' => 'display: block;']) ?></td>

                <td><label>Total</label><br><input type="text" id="total1" size="5" placeholder="0" readonly ></td>
            </tr> 
            <tr class="info">
                <td><label>TRIM II</label></td>

                <td><?= $form->field($model1, 'abril')->input('number', ['style' => 'max-width:100px', 'placeholder' => '0', 'class' => 'trim2'])->label('Abril', ['style' => 'display: block;']) ?></td>                           

                <td><?= $form->field($model1, 'mayo')->input('number', ['style' => 'max-width:100px', 'placeholder' => '0', 'class' => 'trim2'])->label('Mayo', ['style' => 'display: block;']) ?></td>

                <td><?= $form->field($model1, 'junio')->input('number', ['style' => 'max-width:100px', 'placeholder' => '0', 'class' => 'trim2'])->label('Junio', ['style' => 'display: block;']) ?></td>

                <td><label>Total</label><br><input type="text" id="total2" size="5" placeholder="0" readonly ></td>
            </tr>
            <tr class="danger">
                <td><label>TRIM III</label></td> 

                <td><?= $form->field($model1, 'julio')->input('number', ['style' => 'max-width:100px', 'placeholder' => '0', 'class' => 'trim3'])->label('Julio', ['style' => 'display: block;']) ?></td>

                <td><?= $form->field($model1, 'agosto')->input('number', ['style' => 'max-width:100px', 'placeholder' => '0', 'class' => 'trim3'])->label('Agosto', ['style' => 'display: block;']) ?></td>

                <td><?= $form->field($model1, 'septiembre')->input('number', ['style' => 'max-width:100px', 'placeholder' => '0', 'class' => 'trim3'])->label('Septiembre', ['style' => 'display: block;']) ?></td>

                <td><label>Total</label><br><input type="text" id="total3" size="5" placeholder="0" readonly></td>
            </tr>
            <tr class="success">
                <td><label>TRIM IV</label></td>

                <td><?= $form->field($model1, 'octubre')->input('number', ['style' => 'max-width:100px', 'placeholder' => '0', 'class' => 'trim4' ])->label('Octubre', ['style' => 'display: block;']) ?></td>

                <td><?= $form->field($model1, 'noviembre')->input('number', ['style' => 'max-width:100px', 'placeholder' => '0', 'class' => 'trim4' ])->label('Noviembre', ['style' => 'display: block;']) ?></td>

                <td><?= $form->field($model1, 'diciembre')->input('number', ['style' => 'max-width:100px', 'placeholder' => '0', 'class' => 'trim4' ])->label('Diciembre', ['style' => 'display: block;']) ?></td>

                <td><label>Total</label><br><input type="text" id="total4" size="5" placeholder="0" readonly></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><label>Total</label><br><input type="text" id="total" size="5" placeholder="0" readonly></td>
        </tbody>
        
    </table>
</div>

    <?php if (!Yii::$app->request->isAjax){ ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>


<script type="text/javascript">
    jQuery(document).ready(function()
    {
        //llenar campo precio
        initTotal();
        
        //TRIM I
        $('.trim1').on('change', function(){
            initTotal();
        });
        //TRIM II
        $('.trim2').on('change', function(){
            initTotal();
        });
        //TRIM III
        $('.trim3').on('change', function(){
            initTotal();
        });
        //TRIM IV
        $('.trim4').on('change', function(){
            initTotal();
        });

        //TOTAL
        $('.trim1, .trim2, .trim3, .trim4').on('keyup', function()
        {
            initTotal();
        });
        
        function trim1()
        {
            $('#total1').val(
            (Number($('#accioncentralizadavariableprogramacion-enero').val()) ? parseInt($('#accioncentralizadavariableprogramacion-enero').val()) : 0)+
            (Number($('#accioncentralizadavariableprogramacion-febrero').val()) ? parseInt($('#accioncentralizadavariableprogramacion-febrero').val()) : 0)+
            (Number($('#accioncentralizadavariableprogramacion-marzo').val()) ? parseInt($('#accioncentralizadavariableprogramacion-marzo').val()) : 0)
            );
        }

        //TRIM II
          function trim2()
        {
            $('#total2').val(
            (Number($('#accioncentralizadavariableprogramacion-abril').val()) ? parseInt($('#accioncentralizadavariableprogramacion-abril').val()) : 0)+
            (Number($('#accioncentralizadavariableprogramacion-mayo').val())  ? parseInt($('#accioncentralizadavariableprogramacion-mayo').val()) : 0)+
            (Number($('#accioncentralizadavariableprogramacion-junio').val()) ? parseInt($('#accioncentralizadavariableprogramacion-junio').val()) : 0)
            );
        }

        //TRIM III
        function trim3()
        {
            $('#total3').val(
            (Number($('#accioncentralizadavariableprogramacion-julio').val()) ? parseInt($('#accioncentralizadavariableprogramacion-julio').val()) : 0)+
            (Number($('#accioncentralizadavariableprogramacion-agosto').val()) ? parseInt($('#accioncentralizadavariableprogramacion-agosto').val()) : 0)+
            (Number($('#accioncentralizadavariableprogramacion-septiembre').val()) ? parseInt($('#accioncentralizadavariableprogramacion-septiembre').val()) : 0)
            );
        }

        //TRIM IV
        function trim4()
        {
            $('#total4').val(
            (Number($('#accioncentralizadavariableprogramacion-octubre').val()) ? parseInt($('#accioncentralizadavariableprogramacion-octubre').val()) : 0)+
            (Number($('#accioncentralizadavariableprogramacion-noviembre').val()) ? parseInt($('#accioncentralizadavariableprogramacion-noviembre').val()) : 0)+
            (Number($('#accioncentralizadavariableprogramacion-diciembre').val()) ? parseInt($('#accioncentralizadavariableprogramacion-diciembre').val()) : 0)
            );
        }

        function initTotal()
        {
            trim1();
            trim2();
            trim3();
            trim4();

            $('#total').val(
                parseInt($('#total1').val())+
                parseInt($('#total2').val())+
                parseInt($('#total3').val())+
                parseInt($('#total4').val())
            );

        }

    });
</script>
<?php
$this->registerJs(
   
    /* Listas desplegables dependientes */
      '$("document").ready(function(){
        //GE
          $("#id_municipio").depdrop({
            depends: ["id_estado"],
            initialize : true,
            initDepends:["id_estado"],
            url: "'.Url::to(["proyecto-variable-localizacion/estadomunicipios"]).'"
        });
        $("#id_parroquia").depdrop({
            depends: ["id_municipio"],
            initialize : true,
            initDepends:["id_municipio"],
            url: "'.Url::to(["/proyecto-variable-localizacion/municipiosparroquias"]).'"
        });
        
        });
        '
);
?>