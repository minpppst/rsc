<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\select2\Select2Asset;
use kartik\depdrop\DepDrop;
use kartik\depdrop\DepDropAsset;
use yii\helpers\Url;
DepDropAsset::register($this);

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

    <?php  //print_r($permisoSuperiorDatos); exit(); ?>
    <div class="form-group">
    <!-- permisos de orden superior, para ir filtrando los permisos y hacer el proceso mas usable-->
        <label>Permisos</label>
            <?= Select2::widget([
                        'theme' => Select2::THEME_KRAJEE,
                        'name' => 'Permisos Superiores',
                        
                        'data' => ArrayHelper::map($permisoSuperior,'name_corto','name_corto'),
                        'value' => isset($permisoSuperiorDatos) ? ArrayHelper::map($permisoSuperiorDatos, 'id', 'id') : '',
                        'options' => [
                            'placeholder' => 'Escriba para buscar el permiso',
                            'multiple' => true,
                            'id' => 'permiso_superior',
                        ],

                        'pluginOptions' => [
                        'allowClear' => true,
                        
                        ],
                        'addon' => [
                            'prepend' => [
                                'content' => '<span class="glyphicon glyphicon-option-vertical"></span>'
                            ]
                        ],
                ])
            ?>
            <div class="help-block"></div>        
    </div>

    

    <div class="form-group">

            <?php 
                echo $form->field($model, 'permissions')->widget(DepDrop::classname(),
                    [
                        'type'=>DepDrop::TYPE_SELECT2,
                        'data' => ArrayHelper::map($permissions,'name', 'description'),
                        'select2Options'=>
                        [
                            'pluginOptions'=>
                                [
                                    'allowClear'=>true
                                ],
                            'addon' => 
                            [
                                'prepend' => 
                                [
                                    'content' => '<span class="fa fa-key"></span>'
                                ]
                            ],
                        ],
                        'options' => 
                        [
                            'id'=>'id_usuario',
                            'prompt' => 'Seleccione Una Permiso',
                            'multiple' => true,

                        ],
                        'pluginOptions'=>
                        [
                            'depends'=>['permiso_superior'],
                            'loadingText' => 'Cargando Permisos ...',
                            'placeholder' => 'Seleccione Permisos...',
                            'url' => Url::to(['filtropermisos']),
                        ]
                    ])->label('Detalles Permiso');
            ?>
    </div>

    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton(Yii::t('rbac', 'Save'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>
