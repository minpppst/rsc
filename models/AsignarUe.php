<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * @author John Martin <john.itvn@gmail.com>
 * @since 1.0.0
 */
class AsignarUe extends Model {

    public $usuarioId;
    public $unidadesEjecutoras = [];

    /**
     * 
     * @param mixed $userId The id of user use for assign
     * @param array $config 
     */
    public function __construct($usuarioId, $config = array()) {
        parent::__construct($config);
        $this->usuarioId = $usuarioId;
        foreach ($this->getUnidadesEjecutoras($usuarioId) as $unidades) {
            $this->unidadesEjecutoras[] = $unidades;
        }
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['usuarioId'], 'required'],
            [['unidadesEjecutoras'], 'default'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'usuarioId' => Yii::t('rbac', 'ID Usuario'),
            'unidadesEjecutoras' => Yii::t('rbac', 'Unidades Ejecutoras'),
        ];
    }

    /**
     * Save assignment data
     * @return boolean whether assignment save success
     */
    public function save() {
        //$this->authManager->revokeAll(intval($this->userId));
        if ($this->unidadesEjecutoras != null) {
            foreach ($this->unidadesEjecutoras as $unidad) {
                //$this->authManager->assign($this->authManager->getRole($role), $this->userId);
                $unidad->save();
            }
        }
        return true;
    }

    public function getUnidadesEjecutoras($usuario)
    {
        return UsuarioUe::find(['usuario' => $usuario]);
    }

}
