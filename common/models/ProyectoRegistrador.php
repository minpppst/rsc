<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "proyecto_registrador".
 *
 * @property integer $id
 * @property string $nombre
 * @property integer $cedula
 * @property string $email
 * @property string $telefono
 * @property string $unidad_tecnica
 * @property integer $id_proyecto
 */
class ProyectoRegistrador extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'proyecto_registrador';
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
            [['nombre', 'cedula', 'telefono','unidad_tecnica', 'id_proyecto'], 'required'],
            [['cedula', 'id_proyecto'], 'integer'],
            [['nombre'], 'string', 'max' => 100],
            [['email'], 'string', 'max' => 80],
            [['telefono'], 'string', 'max' => 14],
            [['id_proyecto'], 'unique'],
            [['email'],'email'],
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
            'email' => 'Correo Electrónico',
            'telefono' => 'Telefono',
            'unidad_tecnica' => 'Unidad Tecnica',
            'id_proyecto' => 'Id Proyecto',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUEjecutora()
    {
        return $this->hasOne(UnidadEjecutora::className(), ['id' => 'unidad_tecnica']);
    }
}
