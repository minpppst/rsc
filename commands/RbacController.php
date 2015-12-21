<?php

	namespace app\commands;

	use Yii;
	use yii \console\Controller;

	class RbacController extends Controller
	{
		public function actionInit()
	    {
	        $auth = Yii::$app->authManager;

	        //Ver Proyectos
	        $verProyecto = $auth->createPermission('verProyecto');
	        $verProyecto->description = 'Ver Proyecto';
	        $auth->add($verProyecto);

	        //Crear Proyectos
	        $crearProyecto = $auth->createPermission('crearProyecto');
	        $crearProyecto->description = 'Crear Proyecto';
	        $auth->add($crearProyecto);

	        //Editar Proyectos
	        $editarProyecto = $auth->createPermission('editarProyecto');
	        $editarProyecto->description = 'Editar Proyecto';
	        $auth->add($editarProyecto);

	        //Eliminar Proyectos
	        $eliminarProyecto = $auth->createPermission('eliminarProyecto');
	        $eliminarProyecto->description = 'Eliminar Proyecto';
	        $auth->add($eliminarProyecto);

	        // add "admin" role and give this role the "updatePost" permission
	        // as well as the permissions of the "author" role
	        $admin = $auth->createRole('registrador');
	        $auth->add($admin);
	        $auth->addChild($admin, $verProyecto);
	        $auth->addChild($admin, $crearProyecto);
	        $auth->addChild($admin, $editarProyecto);
	        $auth->addChild($admin, $eliminarProyecto);

	        // Assign roles to users. 1 is ID returned by IdentityInterface::getId()
	        // usually implemented in your User model.
	        $auth->assign($admin, 1);
	    }

	    public function actionAuthorRule()
	    {
	    	$auth = Yii::$app->authManager;

			// add the rule
			$rule = new \app\rbac\AuthorRule;
			$auth->add($rule);

			// add the "updateOwnPost" permission and associate the rule with it.
			$updateOwnPost = $auth->createPermission('updateOwnPost');
			$updateOwnPost->description = 'Update own post';
			$updateOwnPost->ruleName = $rule->name;
			$auth->add($updateOwnPost);

			// "updateOwnPost" will be used from "updatePost"
			$auth->addChild($updateOwnPost, $updatePost);

			// allow "author" to update their own posts
			$auth->addChild($author, $updateOwnPost);
	    }
	}
?>