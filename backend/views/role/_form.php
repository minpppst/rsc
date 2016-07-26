<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\select2\Select2Asset;

$rules = Yii::$app->authManager->getRules();
$rulesNames = array_keys($rules);
$rulesDatas = array_merge(['' => Yii::t('rbac', '(not use)')], array_combine($rulesNames, $rulesNames));

$authManager = Yii::$app->authManager;   
$permissions = $authManager->getPermissions();

Select2Asset::register($this);
?>

<div class="auth-item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 1]) ?>

    <?= $form->field($model, 'ruleName')->dropDownList($rulesDatas) ?>    

    <div class="form-group">

        <label>Permisos</label>

        <?= Select2::widget([
                'model' => $model,
                'theme' => Select2::THEME_KRAJEE,
                'name' => 'Permisos',
                'attribute' => 'permissions',
                'data' => ArrayHelper::map($permissions,'name','description'),
                'options' => [
                    'placeholder' => 'Escriba para buscar un permiso',
                    'multiple' => true,
                    //'id'=>'material'
                ],
                'pluginOptions' => [
                'allowClear' => true
                ],
                'addon' => [
                    'prepend' => [
                        'content' => '<span class="fa fa-key"></span>'
                    ]
                ],
            ])?>        
        <div class="help-block"></div>        
    </div>

    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton(Yii::t('rbac', 'Save'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>
