<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ProyectoAeMeta */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proyecto-ae-meta-form">

    <?php $form = ActiveForm::begin(); ?>

     <?= Html::hiddenInput('id_proyecto_accion_especifica', '', ['id' => 'id_proyecto_accion_especifica']) ?>

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
  
	<?php if (!Yii::$app->request->isAjax): ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php endif; ?>

    <?php ActiveForm::end(); ?>
    
</div>
<script type="text/javascript">
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

    /** FUNCIONES **/

    function trim1()
    {
        $('#total1').val(
            parseInt($('#proyectoaemeta-enero').val())+
            parseInt($('#proyectoaemeta-febrero').val())+
            parseInt($('#proyectoaemeta-marzo').val())
        );
    }

    function trim2()
    {
        $('#total2').val(
            parseInt($('#proyectoaemeta-abril').val())+
            parseInt($('#proyectoaemeta-mayo').val())+
            parseInt($('#proyectoaemeta-junio').val())
        );
    }

    function trim3()
    {
        $('#total3').val(
            parseInt($('#proyectoaemeta-julio').val())+
            parseInt($('#proyectoaemeta-agosto').val())+
            parseInt($('#proyectoaemeta-septiembre').val())
        );
    }

    function trim4()
    {
        $('#total4').val(
            parseInt($('#proyectoaemeta-octubre').val())+
            parseInt($('#proyectoaemeta-noviembre').val())+
            parseInt($('#proyectoaemeta-diciembre').val())
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

</script>
