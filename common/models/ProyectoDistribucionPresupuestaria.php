<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "proyecto_distribucion_presupuestaria".
 *
 * @property integer $id
 * @property integer $id_accion_especifica
 * @property integer $id_partida
 * @property string $cantidad
 *
 * @property ProyectoAccionEspecifica $idAccionEspecifica
 * @property Partida $idPartida
 */
class ProyectoDistribucionPresupuestaria extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'proyecto_distribucion_presupuestaria';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_accion_especifica', 'id_partida', 'cantidad'], 'required'],
            [['id_accion_especifica', 'id_partida'], 'integer'],
            [['cantidad'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_accion_especifica' => 'Acción Específica',
            'id_partida' => 'Partida',
            'cantidad' => 'Cantidad',
            'nombreAccionEspecifica' => 'Acción Específica',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAccionEspecifica()
    {
        return $this->hasOne(ProyectoAccionEspecifica::className(), ['id' => 'id_accion_especifica']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNombreAccionEspecifica()
    {
        if($this->idAccionEspecifica == null)
        {
            return null;
        }

        return $this->idAccionEspecifica->nombre;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPartida()
    {
        return $this->hasOne(Partida::className(), ['id' => 'id_partida']);
    }
}
