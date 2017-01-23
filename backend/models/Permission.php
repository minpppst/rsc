<?php

//namespace johnitvn\rbacplus\models;
namespace backend\models;

use Yii;
use yii\rbac\Item;
use johnitvn\rbacplus\models\AuthItem;
/**
 * Description of Permistion
 *
 * @author John Martin <john.itvn@gmail.com>
 * @since 1.0.0
 */
class Permission extends AuthItem {

    protected function getType() {
        return Item::TYPE_PERMISSION;
    }

    public function attributeLabels() {
        $labels = parent::attributeLabels();
        $labels['name'] = Yii::t('rbac', 'Permission name');
        return $labels;
    }

    public static function find($name) {
        $authManager = Yii::$app->authManager;
        $item = $authManager->getPermission($name);
        return new self($item);
    }

    /*
    *Obtener los permisos de primer nivel. nombre que estan antes del "/"
    * @Return array $result
    */
    public function ObtenerPermisosNivelUno()
    {
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("
            SELECT  concat(substring_index(name, '/', '1'), '/') as name_corto
            FROM auth_item 
            group by name_corto
            ORDER BY name_corto asc"
            );

        $result = $command->queryAll();
        return $result;
    }

    /*
    *Obtener los permisos ya existentes de primer nivel. permisos nivel 1 asignados a un rol (update) "/"
    * @param string $role
    * @Return array $result
    */
    public function ObtenerPermisosNivelUnoUpdate($role)
    {
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("
            SELECT concat(substring_index(child, '/', '1'), '/') as id FROM `auth_item_child` WHERE parent in ('".$role."') group by id order by id asc");

        $result = $command->queryAll();
        return $result;
    }

    /*
    *Obtener los permisos por filtro
    * @Return array $result
    */
    public function ObtenerPermisosNivelUnoFiltro($permisos)
    {
        $connection = Yii::$app->getDb();
        //$sql = array('0'); // Stop errors when $words is empty

        foreach($permisos as $word)
        {
            
            $sql.= "name Like '".$word."%' or ";

        }
        $sql = substr($sql, 0, -1);
        $sql = substr($sql, 0, -2);

        //$sql = 'SELECT * FROM users WHERE '.implode(" OR ", $sql);
        $command = $connection->createCommand("
            SELECT  name as id, name
            FROM auth_item 
            where  ".$sql);
        $result = $command->queryAll();
        return $result;
    }

}
