<?php

	namespace app\commands;

	use Yii;
	use yii \console\Controller;

	class RbacController extends Controller
	{
		public function actionInit()
	    {
	        $auth = Yii::$app->authManager;

	        //Crear usuarios
	        $crearUsuario = $auth->createPermission('crearUsuario');
	        $crearUsuario->description = 'Crear usuario';
	        $auth->add($crearUsuario);

	        //Editar usuarios
	        $editarUsuario = $auth->createPermission('editarUsuario');
	        $editarUsuario->description = 'Editar usuario';
	        $auth->add($editarUsuario);

	        //Eliminar usuarios
	        $eliminarUsuario = $auth->createPermission('eliminarUsuario');
	        $eliminarUsuario->description = 'Eliminar usuario';
	        $auth->add($eliminarUsuario);

	        // add "admin" role and give this role the "updatePost" permission
	        // as well as the permissions of the "author" role
	        $admin = $auth->createRole('admin');
	        $auth->add($admin);
	        $auth->addChild($admin, $crearUsuario);
	        $auth->addChild($admin, $editarUsuario);
	        $auth->addChild($admin, $eliminarUsuario);

	        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
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