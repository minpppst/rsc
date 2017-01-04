<?php

namespace backend\models;
use common\models\UnidadEjecutora;

use Yii;

/**
 * This is the model class for table "proyecto_variable_responsable".
 *
 * @property integer $id
 * @property string $nombre
 * @property integer $cedula
 * @property string $email
 * @property string $telefono
 * @property integer $oficina
 * @property integer $id_variable
 *
 * @property UnidadEjecutora $oficina0
 * @property ProyectoVariables $idVariable
 */
class ProyectoVariableResponsable extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'proyecto_variable_responsable';
    }
    /*
    *Guargar los cambios hechos(auditoria)
    */
    public function behaviors()
    {
        return [
            'bedezign\yii2\audit\AuditTrailBehavior'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'cedula', 'email', 'telefono', 'oficina', 'id_variable'], 'required'],
            [['cedula', 'oficina', 'id_variable'], 'integer'],
            [['email'], 'email'],
            [['nombre', 'email', 'telefono'], 'string', 'max' => 45],
            [['oficina'], 'exist', 'skipOnError' => true, 'targetClass' => UnidadEjecutora::className(), 'targetAttribute' => ['oficina' => 'id']],
            [['id_variable'], 'exist', 'skipOnError' => true, 'targetClass' => ProyectoVariables::className(), 'targetAttribute' => ['id_variable' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'cedula' => 'Cedula',
            'email' => 'Email',
            'telefono' => 'Telefono',
            'oficina' => 'Oficina',
            'id_variable' => 'Id Variable',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOficina0()
    {
        return $this->hasOne(UnidadEjecutora::className(), ['id' => 'oficina']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdVariable()
    {
        return $this->hasOne(ProyectoVariables::className(), ['id' => 'id_variable']);
    }
}
