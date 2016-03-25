<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "objetivos_nacionales".
 *
 * @property integer $id
 * @property string $objetivo_nacional
 * @property integer $objetivo_historico
 */
class ObjetivosNacionales extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'objetivos_nacionales';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['objetivo_nacional', 'objetivo_historico'], 'required'],
            [['objetivo_nacional'], 'string'],
            [['objetivo_historico'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'objetivo_nacional' => 'Objetivo Nacional',
            'objetivo_historico' => 'Objetivo Historico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjetivoHistorico()
    {
        return $this->hasOne(ObjetivosHistoricos::className(), ['id' => 'objetivo_historico']);
    }
}
