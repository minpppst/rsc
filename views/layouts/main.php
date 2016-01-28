<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Registro, Seguimiento y Control',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $icons=[
        'inicio'=>'<span class="glyphicon glyphicon-home" aria-hidden="true"></span>',
        'proyecto'=>'<span class="glyphicon glyphicon-tasks" aria-hidden="true"></span>',
        'config'=>'<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>',
        'entrar'=>'<span class="glyphicon glyphicon-log-in" aria-hidden="true"></span>',
        'salir'=>'<span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>',
    ];
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'encodeLabels'=>false,
        'items' => [
            ['label' => $icons['inicio'].' Inicio', 'url' => ['/site/index']],
            ['label' => $icons['proyecto'].' Proyectos', 'url' => ['/proyecto/index'], 'visible' => Yii::$app->user->can('proyecto/index')],            
            ['label' => $icons['config'].' Configuración', 'url' => ['/site/configuracion'], 'visible' => Yii::$app->user->can('site/configuracion')],
            //['label' => 'Acerca de', 'url' => ['/site/about']],
            //['label' => 'Contacto', 'url' => ['/site/contact']],
            Yii::$app->user->isGuest ?
                ['label' => $icons['entrar'].' Entrar', 'url' => ['/user/security/login']] :
                [
                    'label' => $icons['salir'].' Salir (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/user/security/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ],
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'homeLink' => ['label' => 'Inicio', 'url' => ['/site/index']],
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
        
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; MINPPPST <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
