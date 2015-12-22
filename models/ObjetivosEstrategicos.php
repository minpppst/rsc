<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "objetivos_estrategicos".
 *
 * @property integer $id
 * @property string $objetivo_estrategico
 * @property integer $objetivo_nacional
 *
 * @property ObjetivosGenerales[] $objetivosGenerales
 */
class ObjetivosEstrategicos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'objetivos_estrategicos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['objetivo_estrategico', 'objetivo_nacional'], 'required'],
            [['objetivo_estrategico'], 'string'],
            [['objetivo_nacional'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'objetivo_estrategico' => 'Objetivo Estrategico',
            'objetivo_nacional' => 'Objetivo Nacional',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjetivosGenerales()
    {
        return $this->hasMany(ObjetivosGenerales::className(), ['objetivo_estrategico' => 'id']);
    }
}
