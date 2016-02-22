<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "se".
 *
 * @property integer $id
 * @property integer $id_es
 * @property integer $codigo_se
 * @property string $nombre
 * @property integer $estatus
 *
 * @property MaterialesServicios[] $materialesServicios
 * @property Es $idEs
 */
class Se extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'se';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_es', 'codigo_se', 'nombre'], 'required'],
            [['id_es', 'codigo_se', 'estatus'], 'integer'],
            [['nombre'], 'string', 'max' => 60],
            ['codigo_se', 'match', 'pattern' => '/^[0-9][0-9]$/', 'message' => 'Debe escribir un número entre 00 y 99']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_es' => 'SE',
            'codigo_se' => 'ES',
            'nombre' => 'Nombre',
            'estatus' => 'Estatus',
            'nombreEstatus' => 'Estatus'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMaterialesServicios()
    {
        return $this->hasMany(MaterialesServicios::className(), ['id_se' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdEs()
    {
        return $this->hasOne(Es::className(), ['id' => 'id_es']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNombreEstatus()
    {
        if($this->estatus == 1)
        {
            return 'Activo';
        }

        return 'Inactivo';
    }
}
