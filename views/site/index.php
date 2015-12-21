<?php

/* @var $this yii\web\View */

$this->title = 'Registro, Segumiento y Control';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>¡Bienvenido <?= Yii::$app->user->identity->username ?>!</h1>
    </div>

    <div class="body-content">
    	<?php 
    		$authManager=Yii::$app->authManager;
    		$role=$authManager->getRole('registrador');
    		$permissions=$authManager->getPermissionsByRole($role->name);    		 
    		print_r($role);
    		echo "<br>";
    		print_r($permissions);
    	?>
    </div>
</div>
