<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "proyecto_asignar".
 *
 * @property integer $id
 * @property integer $usuario
 * @property integer $unidad_ejecutora
 * @property integer $accion_especifica
 *
 * @property UserAccounts $usuario0
 * @property UnidadEjecutora $unidadEjecutora
 */
class ProyectoAsignar extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'proyecto_asignar';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['usuario', 'unidad_ejecutora', 'accion_especifica'], 'required'],
            [['usuario', 'unidad_ejecutora', 'accion_especifica'], 'integer']
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
            'accion_especifica' => 'Accion Especifica',
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
