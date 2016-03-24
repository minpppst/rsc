<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "objetivos_generales".
 *
 * @property integer $id
 * @property string $objetivo_general
 * @property integer $objetivo_estrategico
 *
 * @property ObjetivosEstrategicos $objetivoEstrategico
 */
class ObjetivosGenerales extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'objetivos_generales';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['objetivo_general', 'objetivo_estrategico'], 'required'],
            [['objetivo_general'], 'string'],
            [['objetivo_estrategico'], 'integer'],
            [['objetivo_estrategico'], 'exist', 'skipOnError' => true, 'targetClass' => ObjetivosEstrategicos::className(), 'targetAttribute' => ['objetivo_estrategico' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'objetivo_general' => 'Objetivo General',
            'objetivo_estrategico' => 'Objetivo Estrategico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjetivoEstrategico()
    {
        return $this->hasOne(ObjetivosEstrategicos::className(), ['id' => 'objetivo_estrategico']);
    }
}
