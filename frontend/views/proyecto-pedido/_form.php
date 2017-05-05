<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\bootstrap\ActiveForm;
use yii\web\JsExpression;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\ProyectoPedido */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="proyecto-pedido-form required">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_material')->widget(Select2::classname(), [
        'theme' => Select2::THEME_KRAJEE,
        'data' => ArrayHelper::map($materiales,'id','nombre'),
        'options' => [
                'placeholder' => 'Escriba para buscar un material o servicio',
            ],
        'pluginOptions' => [
            'allowClear' => true
        ],
        'addon' => [
            'prepend' => [
                'content' => '<span class="glyphicon glyphicon-cutlery"></span>'
            ]
        ],
        'pluginEvents' => [
        // Usar el arreglo JSON para colocar precio, iva, etc
            "select2:select" => "function() {
                var arreglo =  ".$precios.";
                $('#proyectopedido-precio').val(arreglo[$(this).val()]['precio']);
                $('#proyectopedido-iva').val(arreglo[$(this).val()]['iva']);
                $('#iva-porcentaje').val(arreglo[$(this).val()]['iva']);
            }",
        ]
    ]) ?>

    <?= $form->field($model, 'precio', [
        'inputTemplate' => '<div class="input-group"><span class="input-group-addon">Bs.</span>{input}</div>',
    ])->input('number', ['maxlength' => true, 'placeholder' => '0', 'readonly' => true]) ?>

    <?= $form->field($model, 'iva', [
        'inputTemplate' => '<div class="input-group"><span class="input-group-addon">%.</span>{input}</div>',
    ])->input('number', ['maxlength' => true, 'placeholder' => '0', 'readonly' => true]) ?>

    <?= Html::hiddenInput('iva-porcentaje', '', ['id' => 'iva-porcentaje']) ?>

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
            <?= Html::input('text', 'sub-total','', ['id' => 'sub-total', 'placeholder' => 0, 'readonly' => true, 'class' => 'form-control']) ?>
        </div>
    </div>

    <div class="form-group">

        <label>IVA</label>

        <div class="input-group">
            <span class="input-group-addon">Bs.</span>
            <?= Html::input('text', 'iva','', ['id' => 'iva', 'placeholder' => 0, 'readonly' => true, 'class' => 'form-control']) ?>

        </div>

    </div>

    <div class="form-group">

        <label>Total</label>
        
        <div class="input-group">
            <span class="input-group-addon">Bs.</span>
            <?= Html::input('text', 'total','', ['id' => 'total-total', 'placeholder' => 0, 'readonly' => true, 'class' => 'form-control']) ?>
        </div>

    </div>

    <?= Html::activeHiddenInput($model, 'asignado') ?>

	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
<script type="text/javascript">
    jQuery(document).ready(function(){

        //Totalizar
        initTotal();
        //Calcular
        calcular();

        /** EVENTOS **/

        $('#proyectopedido-id_material').on('change', function(){
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

        //PRECIO
        $('#proyectopedido-precio').on('change', function(){
            initTotal();
        });

        /** FUNCIONES **/

        function trim1()
        {
            $('#total1').val(
                parseInt($('#proyectopedido-enero').val())+
                parseInt($('#proyectopedido-febrero').val())+
                parseInt($('#proyectopedido-marzo').val())
            );
        }

        function trim2()
        {
            $('#total2').val(
                parseInt($('#proyectopedido-abril').val())+
                parseInt($('#proyectopedido-mayo').val())+
                parseInt($('#proyectopedido-junio').val())
            );
        }

        function trim3()
        {
            $('#total3').val(
                parseInt($('#proyectopedido-julio').val())+
                parseInt($('#proyectopedido-agosto').val())+
                parseInt($('#proyectopedido-septiembre').val())
            );
        }

        function trim4()
        {
            $('#total4').val(
                parseInt($('#proyectopedido-octubre').val())+
                parseInt($('#proyectopedido-noviembre').val())+
                parseInt($('#proyectopedido-diciembre').val())
            );
        }

        function calcular()
        {
            //variables
            var sub_total = $('#proyectopedido-precio').val() * $('#total').val();
            var iva = sub_total / 100 * $('#proyectopedido-iva').val();
            var total = sub_total + iva;

            //Sub-total
            $('#sub-total').val(moneda(sub_total));

            //IVA
            $('#iva').val(moneda(iva));

            //Total
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