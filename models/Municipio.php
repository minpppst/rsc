<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "municipio".
 *
 * @property integer $id
 * @property string $nombre
 * @property integer $id_estado
 *
 * @property ProyectoLocalizacion[] $proyectoLocalizacions
 */
class Municipio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'municipio';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'id_estado'], 'required'],
            [['id_estado'], 'integer'],
            [['nombre'], 'string', 'max' => 45]
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
            'id_estado' => 'Id Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProyectoLocalizacions()
    {
        return $this->hasMany(ProyectoLocalizacion::className(), ['id_municipio' => 'id']);
    }

    /**
     * @inheritdoc
     * @return MunicipioQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MunicipioQuery(get_called_class());
    }
}
