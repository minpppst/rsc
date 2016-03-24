<?php

namespace common\models;

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
        foreach ($this->getIdUnidadesEjecutoras($usuarioId) as $unidades) {
            $this->unidadesEjecutoras[] = $unidades->unidad_ejecutora;
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
     * Guardar asignacion
     * @return boolean 
     */
    public function save() {

        foreach($this->idUnidadesEjecutoras as $asignados)
        {
            $asignados->delete();
        }
        
        if (!empty($this->unidadesEjecutoras)) 
        {
            foreach ($this->unidadesEjecutoras as $unidad) 
            {                
                $unidadUe = new UsuarioUe();
                $unidadUe->usuario = $this->usuarioId;
                $unidadUe->unidad_ejecutora = $unidad;
                $unidadUe->save();
            }
        }

        return true;
    }

    public function getIdUnidadesEjecutoras()
    {
        return UsuarioUe::findAll(['usuario' => $this->usuarioId]);
    }

}
