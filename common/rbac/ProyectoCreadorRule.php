<?php
	
	namespace common\rbac;
	use common\models\Proyecto;
	use yii\rbac\Rule;
	use Yii;

	/**
	 * Checks if authorID matches user passed via params
	 */
	class ProyectoCreadorRule extends Rule
	{
	    public $name = 'ProyectoCreador';

	    /**
	     * @param string|integer $user the user ID.
	     * @param Item $item the role or permission that this rule is associated with
	     * @param array $params parameters passed to ManagerInterface::checkAccess().
	     * @return boolean a value indicating whether the rule permits the role or permission it is associated with.
	     */
	    public function execute($user, $item, $params)
	    {
	       
	    //admin no deberia ser afectado por la regla
	    
	    	if(Yii::$app->user->can('sysadmin'))
	    	{
	    		return true;
	    	}
	    	else
	    	{
	       		$proyecto=Proyecto::findOne(Yii::$app->request->get('id'));
	     		return $proyecto->usuario_creacion==$user ? true : false;
	     	}

	    }
	}
?>