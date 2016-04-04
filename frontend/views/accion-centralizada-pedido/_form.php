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

<div class="proyecto-pedido-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="form-group">

        <label>Material</label>

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

    </div>

    <?= $form->field($model, 'precio', [
        'inputTemplate' => '<div class="input-group"><span class="input-group-addon">Bs.</span>{input}</div>',
    ])->input('number', ['maxlength' => true, 'placeholder' => '0', 'readonly' => true]) ?>

    <!-- TRIMESTRES -->
    <table class="table table-bordered table-condensed table-striped">
        <tbody>
            <tr class="warning">
                <td><label>TRIM I</label></td>

                <td><?= $form->field($model, 'enero')->input('number', ['style' => 'max-width:100px', 'placeholder' => '0', 'class' => 'trim1']) ?></td>

                <td><?= $form->field($model, 'febrero')->input('number', ['style' => 'max-width:100px', 'placeholder' => '0', 'class' => 'trim1']) ?></td>

                <td><?= $form->field($model, 'marzo')->input('number', ['style' => 'max-width:100px', 'placeholder' => '0', 'class' => 'trim1']) ?></td>

                <td><label>Total</label><input type="text" id="total1" size="5" placeholder="0" readonly></td>
            </tr>
            <tr class="info">
                <td><label>TRIM II</label></td>

                <td><?= $form->field($model, 'abril')->input('number', ['style' => 'max-width:100px', 'placeholder' => '0', 'class' => 'trim2']) ?></td>                           

                <td><?= $form->field($model, 'mayo')->input('number', ['style' => 'max-width:100px', 'placeholder' => '0', 'class' => 'trim2']) ?></td>

                <td><?= $form->field($model, 'junio')->input('number', ['style' => 'max-width:100px', 'placeholder' => '0', 'class' => 'trim2']) ?></td>

                <td><label>Total</label><input type="text" id="total2" size="5" placeholder="0" readonly></td>
            </tr>
            <tr class="danger">
                <td><label>TRIM III</label></td> 

                <td><?= $form->field($model, 'julio')->input('number', ['style' => 'max-width:100px', 'placeholder' => '0', 'class' => 'trim3']) ?></td>

                <td><?= $form->field($model, 'agosto')->input('number', ['style' => 'max-width:100px', 'placeholder' => '0', 'class' => 'trim3']) ?></td>

                <td><?= $form->field($model, 'septiembre')->input('number', ['style' => 'max-width:100px', 'placeholder' => '0', 'class' => 'trim3']) ?></td>

                <td><label>Total</label><input type="text" id="total3" size="5" placeholder="0" readonly></td>
            </tr>
            <tr class="success">
                <td><label>TRIM IV</label></td>

                <td><?= $form->field($model, 'octubre')->input('number', ['style' => 'max-width:100px', 'placeholder' => '0', 'class' => 'trim4']) ?></td>

                <td><?= $form->field($model, 'noviembre')->input('number', ['style' => 'max-width:100px', 'placeholder' => '0', 'class' => 'trim4']) ?></td>

                <td><?= $form->field($model, 'diciembre')->input('number', ['style' => 'max-width:100px', 'placeholder' => '0', 'class' => 'trim4']) ?></td>

                <td><label>Total</label><input type="text" id="total4" size="5" placeholder="0" readonly></td>
            </tr>
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
            <?= Html::input('text', 'total','', ['placeholder' => 0, 'readonly' => true, 'class' => 'form-control', 'id' => 'total' ]) ?>
        </div>

    </div>

    <?= Html::activeHiddenInput($model, 'asignado') ?>

    <?= $form->field($model, 'estatus')->dropDownList([1=>'Activo',0=>'Inactivo'],['prompt'=>'Seleccione']) ?>

  
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
        data: {
           id: $("#material").val()
         },
        success: function (data) {
            if(data!=0){
            $('#accioncentralizadapedido-precio').val(parseFloat(data[0]['precio']));
            iva=parseFloat(data[0]['iva']);
            precio=parseFloat(data[0]['precio']);

            }
            else{
            $('#accioncentralizadapedido-precio').val(parseFloat(0));
                    }
    
                    }
                });
            });


        
        bandera=1;
        //TRIM I
        $('.trim1').on('change', function(){
            bandera=0;
            var sum=0;
            sum+=(Number($('#accioncentralizadapedido-enero').val()) ? parseInt($('#accioncentralizadapedido-enero').val()) : 0 );
            sum+=(Number($('#accioncentralizadapedido-febrero').val()) ? parseInt($('#accioncentralizadapedido-febrero').val()) : 0);
            sum+=(Number($('#accioncentralizadapedido-marzo').val()) ? parseInt($('#accioncentralizadapedido-marzo').val()) : 0);
            $('#total1').val(sum);
            total=0;
            total_total=0;
            total_iva=0;
            total+=(Number($('#total1').val()) ? parseInt($('#total1').val()) : 0);
            total+=(Number($('#total2').val()) ? parseInt($('#total2').val()) : 0);
            total+=(Number($('#total3').val()) ? parseInt($('#total3').val()) : 0);
            total+=(Number($('#total4').val()) ? parseInt($('#total4').val()) : 0);
            $('#subtotal').val(total_total=total * precio);
            $('#iva').val(total_iva=Math.round(((total*precio) * iva)/100));
            $('#total').val(Math.round(total_total+total_iva));

            });
        //TRIM II
        $('.trim2').on('change', function(){
        bandera=0;
           var sum1=0;
           sum1+=(Number($('#accioncentralizadapedido-abril').val()) ? parseInt($('#accioncentralizadapedido-abril').val()) : 0 );
           sum1+=(Number($('#accioncentralizadapedido-mayo').val()) ?  parseInt($('#accioncentralizadapedido-mayo').val()) :0 );
           sum1+=(Number($('#accioncentralizadapedido-junio').val()) ? parseInt($('#accioncentralizadapedido-junio').val()) : 0);
           $('#total2').val(sum1);    
           total=0;
           total_total=0;
           total_iva=0;   
           total+=(Number($('#total1').val()) ? parseInt($('#total1').val()) : 0);
           total+=(Number($('#total2').val()) ? parseInt($('#total2').val()) : 0);
           total+=(Number($('#total3').val()) ? parseInt($('#total3').val()) : 0);
           total+=(Number($('#total4').val()) ? parseInt($('#total4').val()) : 0);
           $('#subtotal').val(total_total=total * precio);
            $('#iva').val(total_iva=Math.round(((total*precio) * iva)/100));
            $('#total').val(Math.round(total_total+total_iva));
           });
        //TRIM III
        $('.trim3').on('change', function(){
           // $('#total3').val();
            var sum2=0;
            bandera=0;
            sum2+=(Number($('#accioncentralizadapedido-julio').val()) ? parseInt($('#accioncentralizadapedido-julio').val()) : 0 );
            sum2+=(Number($('#accioncentralizadapedido-agosto').val()) ? parseInt($('#accioncentralizadapedido-agosto').val()) : 0 );
            sum2+=(Number($('#accioncentralizadapedido-septiembre').val()) ? parseInt($('#accioncentralizadapedido-septiembre').val()) : 0 );
            $('#total3').val(sum2);
            total=0;
            total_total=0;
            total_iva=0;
            total+=(Number($('#total1').val()) ? parseInt($('#total1').val()) : 0);
            total+=(Number($('#total2').val()) ? parseInt($('#total2').val()) : 0);
            total+=(Number($('#total3').val()) ? parseInt($('#total3').val()) : 0);
            total+=(Number($('#total4').val()) ? parseInt($('#total4').val()) : 0);
            $('#subtotal').val(total_total=total * precio);
            $('#iva').val(total_iva=Math.round(((total*precio) * iva)/100));
            $('#total').val(Math.round(total_total+total_iva));
        
        });
        //TRIM IV
        $('.trim4').on('change', function(){
            bandera=0;
            var sum3=0;
            sum3+=(Number($('#accioncentralizadapedido-octubre').val()) ? parseInt($('#accioncentralizadapedido-octubre').val()) : 0 );
            sum3+=(Number($('#accioncentralizadapedido-noviembre').val()) ? parseInt($('#accioncentralizadapedido-noviembre').val()) : 0 );
            sum3+=(Number($('#accioncentralizadapedido-diciembre').val()) ? parseInt($('#accioncentralizadapedido-diciembre').val()) : 0 );
            $('#total4').val(sum3);
            total=0;
            total_total=0;
            total_iva=0;
            total+=(Number($('#total1').val()) ? parseInt($('#total1').val()) : 0);
            total+=(Number($('#total2').val()) ? parseInt($('#total2').val()) : 0);
            total+=(Number($('#total3').val()) ? parseInt($('#total3').val()) : 0);
            total+=(Number($('#total4').val()) ? parseInt($('#total4').val()) : 0);            
            $('#subtotal').val(total_total=total * precio);
            $('#iva').val(total_iva=Math.round(((total*precio) * iva)/100));
            $('#total').val(Math.round(total_total+total_iva));

       });

        //caso update
            if(bandera==1 && ($('#accioncentralizadapedido-enero').val()>0 || $('#accioncentralizadapedido-febrero').val()>0 || $('#accioncentralizadapedido-marzo').val()>0 || $('#accioncentralizadapedido-abril').val()>0 || $('#accioncentralizadapedido-mayo').val()>0 || $('#accioncentralizadapedido-junio').val()>0 || $('#accioncentralizadapedido-julio').val()>0 || $('#accioncentralizadapedido-agosto').val()>0 || $('#accioncentralizadapedido-septiembre').val()>0 || $('#accioncentralizadapedido-octubre').val()>0 || $('#accioncentralizadapedido-noviembre').val()>0 || $('#accioncentralizadapedido-diciembre').val()>0)){
                total=0;
                total_total=0;
                total_iva=0;
                
                $.ajax({
                url: "<?= Url::to(['llenarprecio']) ?>",
                type: 'post',
                dataType: 'json',
                data: {
                id: $("#material").val()
                },
                success: function (data) {
                if(data!=0){
                iva=parseFloat(data[0]['iva']);
                precio=parseFloat(data[0]['precio']);
                $('#total1').val(parseInt($('#accioncentralizadapedido-enero').val())+parseInt($('#accioncentralizadapedido-febrero').val())+parseInt($('#accioncentralizadapedido-marzo').val()));
                $('#total2').val(parseInt($('#accioncentralizadapedido-abril').val())+parseInt($('#accioncentralizadapedido-mayo').val())+parseInt($('#accioncentralizadapedido-junio').val()));
                $('#total3').val(parseInt($('#accioncentralizadapedido-julio').val())+parseInt($('#accioncentralizadapedido-agosto').val())+parseInt($('#accioncentralizadapedido-septiembre').val()));
                $('#total4').val(parseInt($('#accioncentralizadapedido-octubre').val())+parseInt($('#accioncentralizadapedido-noviembre').val())+parseInt($('#accioncentralizadapedido-diciembre').val()));
                total+=(Number($('#total1').val()) ? parseInt($('#total1').val()) : 0);
                total+=(Number($('#total2').val()) ? parseInt($('#total2').val()) : 0);
                total+=(Number($('#total3').val()) ? parseInt($('#total3').val()) : 0);
                total+=(Number($('#total4').val()) ? parseInt($('#total4').val()) : 0);            
                $('#subtotal').val(total_total=total * precio);
                $('#iva').val(total_iva=Math.round(((total*precio) * iva)/100));
                $('#total').val(Math.round(total_total+total_iva));

                }
                
                    }
                });

                
            
            }

            });
</script>