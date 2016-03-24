<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "objetivos_historicos".
 *
 * @property integer $id
 * @property string $objetivo_historico
 */
class ObjetivosHistoricos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'objetivos_historicos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['objetivo_historico'], 'required'],
            [['objetivo_historico'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'objetivo_historico' => 'Objetivo Historico',
        ];
    }
}
