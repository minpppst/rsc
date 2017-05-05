<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\bootstrap\ActiveForm;
use yii\web\JsExpression;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use kartik\depdrop\DepDropAsset;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\AccionCentralizadaPedido */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="accion-centralizada-pedido-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="form-group field-accioncentralizadapedido-id_material">

        <label class="control-label" for="accioncentralizadapedido-id_material">Material</label>

        <?= Select2::widget([
            'model' => $model,
            'theme' => Select2::THEME_KRAJEE,
            'name' => 'material',
            'attribute' => 'id_material',
            'data' => ArrayHelper::map($materiales,'id','nombre'),
            'options' => [
                'placeholder' => 'Escriba para buscar un material o servicio',
                'id'=>'material'
            ],
            'pluginOptions' => [
                'allowClear' => true
            ],
            'addon' => [
                'prepend' => [
                    'content' => '<span class="glyphicon glyphicon-cutlery"></span>'
                ]
            ]
        ])?>
        <p class="help-block help-block-error"></p>

    </div>

    <?= $form->field($model, 'precio', [
        'inputTemplate' => '<div class="input-group"><span class="input-group-addon">Bs.</span>{input}</div>',
    ])->input('number', ['maxlength' => true, 'placeholder' => '0', 'readonly' => true]) ?>

    <?= $form->field($model, 'iva', [
        'inputTemplate' => '<div class="input-group"><span class="input-group-addon">%.</span>{input}</div>',
    ])->input('number', ['maxlength' => true, 'placeholder' => '0', 'readonly' => true]) ?>

    <?= Html::hiddenInput('iva_precio', '', ['id' => 'iva_precio']) ?>

    <!-- TRIMESTRES -->
    <table class="table table-bordered table-condensed table-striped">
        <tbody>
            <tr class="warning">
                <td><label>TRIM I</label></td>

                <td><?= $form->field($model, 'enero')->input('number', ['style' => 'max-width:100px', 'placeholder' => '0', 'class' => 'trim1 form-control']) ?></td>

                <td><?= $form->field($model, 'febrero')->input('number', ['style' => 'max-width:100px', 'placeholder' => '0', 'class' => 'trim1 form-control']) ?></td>

                <td><?= $form->field($model, 'marzo')->input('number', ['style' => 'max-width:100px', 'placeholder' => '0', 'class' => 'trim1 form-control']) ?></td>

                <td><label>Total</label><input type="text" id="total1" class="form-control" size="5" placeholder="0" readonly></td>
            </tr>
            <tr class="info">
                <td><label>TRIM II</label></td>

                <td><?= $form->field($model, 'abril')->input('number', ['style' => 'max-width:100px', 'placeholder' => '0', 'class' => 'trim2 form-control']) ?></td>                           

                <td><?= $form->field($model, 'mayo')->input('number', ['style' => 'max-width:100px', 'placeholder' => '0', 'class' => 'trim2 form-control']) ?></td>

                <td><?= $form->field($model, 'junio')->input('number', ['style' => 'max-width:100px', 'placeholder' => '0', 'class' => 'trim2 form-control']) ?></td>

                <td><label>Total</label><input type="text" id="total2" class="form-control" size="5" placeholder="0" readonly></td>
            </tr>
            <tr class="danger">
                <td><label>TRIM III</label></td> 

                <td><?= $form->field($model, 'julio')->input('number', ['style' => 'max-width:100px', 'placeholder' => '0', 'class' => 'trim3 form-control']) ?></td>

                <td><?= $form->field($model, 'agosto')->input('number', ['style' => 'max-width:100px', 'placeholder' => '0', 'class' => 'trim3 form-control']) ?></td>

                <td><?= $form->field($model, 'septiembre')->input('number', ['style' => 'max-width:100px', 'placeholder' => '0', 'class' => 'trim3 form-control']) ?></td>

                <td><label>Total</label><input type="text" id="total3" class="form-control" size="5" placeholder="0" readonly></td>
            </tr>
            <tr class="success">
                <td><label>TRIM IV</label></td>

                <td><?= $form->field($model, 'octubre')->input('number', ['style' => 'max-width:100px', 'placeholder' => '0', 'class' => 'trim4 form-control']) ?></td>

                <td><?= $form->field($model, 'noviembre')->input('number', ['style' => 'max-width:100px', 'placeholder' => '0', 'class' => 'trim4 form-control']) ?></td>

                <td><?= $form->field($model, 'diciembre')->input('number', ['style' => 'max-width:100px', 'placeholder' => '0', 'class' => 'trim4 form-control']) ?></td>

                <td><label>Total</label><input type="text" id="total4" class="form-control" size="5" placeholder="0" readonly></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><label>Total</label><input type="text" id="total" class="form-control" size="5" placeholder="0" readonly></td>
        </tbody>
        
    </table>

    <div class="form-group">

        <label>Sub-Total</label>

        <div class="input-group">
            <span class="input-group-addon">Bs.</span>
            <?= Html::input('text', 'sub-total','', ['placeholder' => 0, 'readonly' => true, 'class' => 'form-control', 'id' => 'subtotal']) ?>
        </div>
    </div>

    <div class="form-group">

        <label>IVA</label>

        <div class="input-group">
            <span class="input-group-addon">Bs.</span>
            <?= Html::input('text', 'iva','', ['placeholder' => 0, 'readonly' => true, 'class' => 'form-control', 'id' => 'iva']) ?>
        </div>

    </div>

    <div class="form-group">

        <label>Total</label>
        
        <div class="input-group">
            <span class="input-group-addon">Bs.</span>
            <?= Html::input('text', 'total','', ['placeholder' => 0, 'readonly' => true, 'class' => 'form-control', 'id' => 'total-total' ],['format' => ['number', 2]]) ?>
        </div>

    </div>

    <?= Html::activeHiddenInput($model, 'asignado') ?>

    <!--<?= $form->field($model, 'estatus')->dropDownList([1=>'Activo',0=>'Inactivo'],['prompt'=>'Seleccione']) ?>-->

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
<script type="text/javascript">
    jQuery(document).ready(function(){
        //llenar campo precio
        $('#material').change(function(){
        $.ajax({
            url: "<?= Url::to(['llenarprecio']) ?>",
            type: 'post',
            dataType: 'json',
            data: 
            {
               id: $("#material").val()
            },
            success: function (data) 
            {
                if(data!=0)
                {
                $('#accioncentralizadapedido-precio').val(parseFloat(data[0]['precio']));
                $('#accioncentralizadapedido-iva').val(parseFloat(data[0]['iva']));
                $('#iva_precio').val(parseFloat(data[0]['iva']));
                }
                else
                {
                $('#accioncentralizadapedido-precio').val(parseFloat(0));
                }
        
            }
        });
        });


        if($('#iva_precio').val()=="" && $("#material").val()!="" )
        { 
            initTotal();
            //Calcular
            calcular();
        }
        
        $('#material').on('change', function(){
            initTotal();
        });

        //TRIM I
        $('.trim1').on('input', function(){
            initTotal();
        });
        //TRIM II
        $('.trim2').on('input', function(){
            initTotal();
        });
        //TRIM III
        $('.trim3').on('input', function(){
            initTotal();
        });
        //TRIM IV
        $('.trim4').on('input', function(){
            initTotal();
        });

        //TOTAL
        $('.trim1, .trim2, .trim3, .trim4').on('change', function(){
            initTotal();
        });

        function trim1()
        {
        $('#total1').val(
        (Number($('#accioncentralizadapedido-enero').val()) ? parseInt($('#accioncentralizadapedido-enero').val()) : 0)+
        (Number($('#accioncentralizadapedido-febrero').val()) ? parseInt($('#accioncentralizadapedido-febrero').val()): 0)+
        (Number($('#accioncentralizadapedido-marzo').val()) ? parseInt($('#accioncentralizadapedido-marzo').val()) : 0)
         );
        
        }

        //TRIM II
        function trim2()
        {
        $('#total2').val(
        (Number($('#accioncentralizadapedido-abril').val()) ? parseInt($('#accioncentralizadapedido-abril').val()) : 0) +
        (Number($('#accioncentralizadapedido-mayo').val())  ? parseInt($('#accioncentralizadapedido-mayo').val()) : 0) +
        (Number($('#accioncentralizadapedido-junio').val()) ? parseInt($('#accioncentralizadapedido-junio').val()) : 0)
            );
        }

        //TRIM III
        function trim3()
        {
        $('#total3').val(
        (Number($('#accioncentralizadapedido-julio').val()) ? parseInt($('#accioncentralizadapedido-julio').val()) : 0)+
        (Number($('#accioncentralizadapedido-agosto').val()) ? parseInt($('#accioncentralizadapedido-agosto').val()) : 0)+
        (Number($('#accioncentralizadapedido-septiembre').val()) ? parseInt($('#accioncentralizadapedido-septiembre').val()) : 0)
            );
        }

        //TRIM IV
        function trim4()
        {
            $('#total4').val(
        (Number($('#accioncentralizadapedido-octubre').val()) ? parseInt($('#accioncentralizadapedido-octubre').val()) : 0)+
        (Number($('#accioncentralizadapedido-noviembre').val()) ? parseInt($('#accioncentralizadapedido-noviembre').val()) : 0)+
        (Number($('#accioncentralizadapedido-diciembre').val()) ? parseInt($('#accioncentralizadapedido-diciembre').val()) : 0)
            );
        }

        function calcular()
        {
            //variables
            var iva_precio=(Number($('#accioncentralizadapedido-iva').val()) ? $('#accioncentralizadapedido-iva').val() : 0 );
            var sub_total = $('#accioncentralizadapedido-precio').val() * $('#total').val();
            var iva = (sub_total  * iva_precio) / 100;
            var total = sub_total + iva;

            
            //Sub-total
            if(sub_total!=0)
            $('#subtotal').val(moneda(sub_total));
            //IVA
            if(iva!=0)
            $('#iva').val(moneda(iva));
            //Total
            if(total!=0)
            $('#total-total').val(moneda(total));
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

            calcular();
        }

    /**
     * Funcion que devuelve un numero separando los separadores de miles
     * Puede recibir valores negativos y con decimales
     */
    function moneda(numero)
    {
        // Variable que contendra el resultado final
        
        var resultado = "";
        numero= numero.toString();
        numero=numero.replace('.', ',');
        // Si el numero empieza por el valor "-" (numero negativo)
        if(numero[0]=="-")
        {
            // Cogemos el numero eliminando los posibles puntos que tenga, y sin
            // el signo negativo
            nuevoNumero=numero.replace(/\./g,'').substring(1);
        }else{
            // Cogemos el numero eliminando los posibles puntos que tenga
            nuevoNumero=numero.replace(/\./g,'');
        }
 
        // Si tiene decimales, se los quitamos al numero
        if(numero.indexOf(",")>=0)
            nuevoNumero=nuevoNumero.substring(0,nuevoNumero.indexOf(","));
 
        // Ponemos un punto cada 3 caracteres
        for (var j, i = nuevoNumero.length - 1, j = 0; i >= 0; i--, j++)
            resultado = nuevoNumero.charAt(i) + ((j > 0) && (j % 3 == 0)? ".": "") + resultado;
 
        // Si tiene decimales, se lo añadimos al numero una vez forateado con 
        // los separadores de miles
        if(numero.indexOf(",")>=0)
            resultado+=numero.substring(numero.indexOf(","));
 
        if(numero[0]=="-")
        {
            // Devolvemos el valor añadiendo al inicio el signo negativo
            return "-"+resultado;
        }else
        {
            return resultado;
        }
    }

    });
</script>