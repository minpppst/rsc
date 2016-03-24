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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'cedula', 'telefono', 'id_proyecto'], 'required'],
            [['cedula', 'id_proyecto'], 'integer'],
            [['nombre'], 'string', 'max' => 30],
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
            'email' => 'Email',
            'telefono' => 'Telefono',
            'id_proyecto' => 'Id Proyecto',
        ];
    }

    /**
     * @inheritdoc
     * @return ProyectoRegistradorQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProyectoRegistradorQuery(get_called_class());
    }
}
