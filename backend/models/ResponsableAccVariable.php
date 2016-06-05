<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "responsable_acc_variable".
 *
 * @property integer $id
 * @property string $nombre
 * @property integer $cedula
 * @property string $email
 * @property string $telefono
 * @property string $oficina
 * @property integer $id_variable
 */
class ResponsableAccVariable extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'responsable_acc_variable';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'cedula', 'email', 'telefono', 'oficina', 'id_variable'], 'required'],
            [['cedula', 'id_variable'], 'integer'],
            [['nombre', 'email', 'telefono'], 'string', 'max' => 45],
            [['oficina'], 'string', 'max' => 60],
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
}
