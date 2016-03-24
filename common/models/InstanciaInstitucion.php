<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "instancia_institucion".
 *
 * @property integer $id
 * @property string $tipo
 */
class InstanciaInstitucion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'instancia_institucion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tipo'], 'required'],
            [['tipo'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tipo' => 'Tipo',
        ];
    }
}
