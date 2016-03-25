<?php
namespace common\rbac;

use yii\rbac\Rule;
use common\models\UsuarioUe;
/**
 * Checks if authorID matches user passed via params
 */
class UeAsignadaRule extends Rule
{
    public $name = 'UeAsignada';

    /**
     * @param string|integer $user the user ID.
     * @param Item $item the role or permission that this rule is associated with
     * @param array $params parameters passed to ManagerInterface::checkAccess().
     * @return boolean a value indicating whether the rule permits the role or permission it is associated with.
     */
    public function execute($user, $item, $params)
    {
        /*
        $ue = UsuarioUe::findOne(['usuario' => $user]);

        if($user->role == 'admin')
        {
            return true;
        }
        else
        {
            if($ue != null)
             {
                return $ue->unidad_ejecutora == 600 ? true: false;
             }
        }
        
        return false;
        */
         
         return true;
    }
}
?>