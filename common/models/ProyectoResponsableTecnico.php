<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "proyecto_responsable_tecnico".
 *
 * @property integer $id
 * @property string $nombre
 * @property integer $cedula
 * @property string $email
 * @property string $telefono
 * @property string $unidad_tecnica
 * @property integer $id_proyecto
 *
 * @property Proyecto $idProyecto
 */
class ProyectoResponsableTecnico extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'proyecto_responsable_tecnico';
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
            [['nombre', 'cedula', 'email', 'telefono', 'unidad_tecnica', 'id_proyecto'], 'required'],
            [['cedula', 'id_proyecto'], 'integer'],
            [['nombre', 'email', 'telefono', 'unidad_tecnica'], 'string', 'max' => 100],
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
    public function getIdProyecto()
    {
        return $this->hasOne(Proyecto::className(), ['id' => 'id_proyecto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUEjecutora()
    {
        return $this->hasOne(UnidadEjecutora::className(), ['id' => 'unidad_tecnica']);
    }
}
