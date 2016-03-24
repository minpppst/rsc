<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "proyecto_responsable".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $cedula
 * @property string $email
 * @property string $telefono
 * @property integer $id_proyecto
 *
 * @property Proyecto $idProyecto
 */
class ProyectoResponsable extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'proyecto_responsable';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'cedula', 'email', 'telefono', 'id_proyecto'], 'required'],
            [['cedula','id_proyecto'], 'integer'],
            [['nombre', 'email'], 'string', 'max' => 45],
            [['telefono'], 'string', 'max' => 14],
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
            'email' => 'Email',
            'telefono' => 'Telefono',
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
}
