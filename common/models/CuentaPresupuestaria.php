<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cuenta_presupuestaria".
 *
 * @property string $cuenta
 * @property string $nombre
 */
class CuentaPresupuestaria extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cuenta_presupuestaria';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cuenta', 'nombre'], 'required'],
            [['cuenta'], 'string', 'max' => 1],
            [['nombre'], 'string', 'max' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cuenta' => 'Cuenta',
            'nombre' => 'Nombre',
        ];
    }
}
