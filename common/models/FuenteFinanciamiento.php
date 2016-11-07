<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "fuente_financiamiento".
 *
 * @property integer $id
 * @property string $fuente
 *
 * @property ProyectoAccionEspecifica[] $proyectoAccionEspecificas
 */
class FuenteFinanciamiento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fuente_financiamiento';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fuente'], 'required'],
            [['fuente'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fuente' => 'Fuente',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProyectoAccionEspecificas()
    {
        return $this->hasMany(ProyectoAccionEspecifica::className(), ['fuente_financiamiento' => 'id']);
    }
}
