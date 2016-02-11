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
            [['nombre'], 'string', 'max' => 60]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_es' => 'Id Es',
            'codigo_se' => 'Codigo Se',
            'nombre' => 'Nombre',
            'estatus' => 'Estatus',
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
}
