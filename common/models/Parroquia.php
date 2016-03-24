<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "parroquia".
 *
 * @property integer $id
 * @property string $nombre
 * @property integer $id_municipio
 *
 * @property ProyectoLocalizacion[] $proyectoLocalizacions
 */
class Parroquia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'parroquia';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'id_municipio'], 'required'],
            [['id_municipio'], 'integer'],
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
            'id_municipio' => 'Id Municipio',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProyectoLocalizacions()
    {
        return $this->hasMany(ProyectoLocalizacion::className(), ['id_parroquia' => 'id']);
    }

}
