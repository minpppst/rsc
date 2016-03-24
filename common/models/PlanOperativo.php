<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "plan_operativo".
 *
 * @property integer $id
 * @property string $plan_operativo
 */
class PlanOperativo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'plan_operativo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['plan_operativo'], 'required'],
            [['plan_operativo'], 'string', 'max' => 10]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'plan_operativo' => 'Plan Operativo',
        ];
    }
}
