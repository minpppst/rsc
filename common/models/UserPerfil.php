<?php

namespace common\models;

use Yii;
use johnitvn\userplus\basic\models\UserAccounts;

/**
 * This is the model class for table "user_perfil".
 *
 * @property integer $id
 * @property integer $id_user
 * @property string $nombres
 * @property string $apellidos
 * @property string $correo
 * @property string $telefono_oficina
 * @property string $telefono_celular
 * @property string $fecha_creacion
 * @property string $fecha_modificacion
 *
 * @property UserAccounts $idUser
 */
class UserPerfil extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_perfil';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_user', 'nombres', 'apellidos', 'correo', 'telefono_oficina', 'telefono_celular'], 'required'],
            [['id_user'], 'integer'],
            [['fecha_creacion', 'fecha_modificacion'], 'safe'],
            [['nombres', 'apellidos'], 'string', 'max' => 100],
            [['correo'], 'string', 'max' => 45],
            [['correo'], 'email'],
            [['telefono_oficina', 'telefono_celular'], 'string', 'max' => 15],
            [['id_user'], 'unique'],
            [['id_user'], 'unique'],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => UserAccounts::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Id User',
            'nombres' => 'Nombres',
            'apellidos' => 'Apellidos',
            'correo' => 'Correo',
            'telefono_oficina' => 'Telefono Oficina',
            'telefono_celular' => 'Telefono Celular',
            'fecha_creacion' => 'Fecha Creacion',
            'fecha_modificacion' => 'Fecha Modificacion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUser()
    {
        return $this->hasOne(UserAccounts::className(), ['id' => 'id_user']);
    }
}
