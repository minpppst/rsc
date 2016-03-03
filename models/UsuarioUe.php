<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuario_ue".
 *
 * @property integer $id
 * @property integer $usuario
 * @property integer $unidad_ejecutora
 *
 * @property UserAccounts $usuario0
 * @property UnidadEjecutora $unidadEjecutora
 */
class UsuarioUe extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuario_ue';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['usuario', 'unidad_ejecutora'], 'required'],
            [['usuario', 'unidad_ejecutora'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'usuario' => 'Usuario',
            'unidad_ejecutora' => 'Unidad Ejecutora',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario0()
    {
        return $this->hasOne(UserAccounts::className(), ['id' => 'usuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnidadEjecutora()
    {
        return $this->hasOne(UnidadEjecutora::className(), ['id' => 'unidad_ejecutora']);
    }
}
