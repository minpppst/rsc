<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "unidad_ejecutora".
 *
 * @property integer $id
 * @property string $codigo_ue
 * @property string $nombre
 *
 * @property AccionEspecificaProyecto[] $accionEspecificaProyectos
 */
class UnidadEjecutora extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'unidad_ejecutora';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo_ue', 'nombre'], 'required'],
            [['nombre'], 'string'],
            [['codigo_ue'], 'string', 'max' => 5],
            [['codigo_ue'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'codigo_ue' => 'Código UE',
            'nombre' => 'Nombre',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccionEspecificaProyectos()
    {
        return $this->hasMany(AccionEspecificaProyecto::className(), ['id_unidad_ejecutora' => 'id']);
    }
}
