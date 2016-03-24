<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "estados".
 *
 * @property integer $id
 * @property string $nombre
 * @property integer $id_pais
 *
 * @property ProyectoLocalizacion[] $proyectoLocalizacions
 */
class Estados extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'estados';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'id_pais'], 'required'],
            [['id_pais'], 'integer'],
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
            'id_pais' => 'Id Pais',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProyectoLocalizacions()
    {
        return $this->hasMany(ProyectoLocalizacion::className(), ['id_estado' => 'id']);
    }

    /**
     * @inheritdoc
     * @return EstadosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EstadosQuery(get_called_class());
    }
}
