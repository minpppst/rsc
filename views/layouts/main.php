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
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Inicio', 'url' => ['/site/index']],
            ['label' => 'Proyectos', 'url' => ['/proyecto/index'], 'visible' => Yii::$app->user->can('proyecto/index')],
            ['label' => 'Usuarios', 'url' => ['/user/manager'], 'visible' => !Yii::$app->user->isGuest],
            ['label' => 'Roles', 'url' => ['/rbac/role'], 'visible' => !Yii::$app->user->isGuest],
            ['label' => 'Reglas', 'url' => ['/rbac/rule'], 'visible' => !Yii::$app->user->isGuest],
            ['label' => 'Permisos', 'url' => ['/rbac/permission'], 'visible' => !Yii::$app->user->isGuest],
            ['label' => 'Asignacion de Rol', 'url' => ['/rbac/assignment'], 'visible' => !Yii::$app->user->isGuest],
            //['label' => 'Acerca de', 'url' => ['/site/about']],
            //['label' => 'Contacto', 'url' => ['/site/contact']],
            Yii::$app->user->isGuest ?
                ['label' => 'Entrar', 'url' => ['/user/security/login']] :
                [
                    'label' => 'Salir (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/user/security/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ],
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
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
