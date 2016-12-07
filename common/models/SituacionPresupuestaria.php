<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "situacion_presupuestaria".
 *
 * @property integer $id
 * @property string $situacion
 */
class SituacionPresupuestaria extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'situacion_presupuestaria';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['situacion'], 'required'],
            [['situacion'], 'unique'],
            [['situacion'], 'string', 'max' => 25]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'situacion' => 'Situacion',
        ];
    }
}
