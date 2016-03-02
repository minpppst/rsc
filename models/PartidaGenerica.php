<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ge".
 *
 * @property integer $id
 * @property integer $id_partida
 * @property string $generica
 * @property string $nombre
 * @property integer $estatus
 *
 * @property Es[] $es
 * @property Partida $idPartida
 */
class PartidaGenerica extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'partida_generica';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_partida', 'generica', 'nombre', 'estatus'], 'required'],
            [['id_partida', 'estatus'], 'integer'],
            [['generica'], 'string', 'max' => 2],
            [['nombre'], 'string', 'max' => 60],
            ['generica', 'match', 'pattern' => '/^[0-9][0-9]$/', 'message' => 'Debe escribir un número entre 00 y 99']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_partida' => 'Partida',
            'generica' => 'Genérica',
            'nombre' => 'Nombre',
            'estatus' => 'Estatus',
            'codigoPartida' => 'Partida',
            'nombreEstatus' => 'Estatus',
            'cuenta' => 'Cuenta'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEs()
    {
        return $this->hasMany(Es::className(), ['id_ge' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPartida()
    {
        return $this->hasOne(PartidaPartida::className(), ['id' => 'id_partida']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodigoPartida()
    {
        if($this->idPartida == null)
        {
            return null;
        }

        return $this->idPartida->partida;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNombreEstatus()
    {
        if($this->estatus == 1)
        {
            return 'Activo';
        }

        return 'Inactivo';
    }

    /**
     * Colocar estatus en 0 "Inactivo"
     */
    public function desactivar()
    {
        $this->estatus = 0;
        $this->save();
    }

     /**
     * Colocar estatus en 1 "Activo"
     */
     public function activar()
     {
        $this->estatus = 1;
        $this->save();
     }

     /**
      * Activar o desactivar
      */
     public function toggleActivo()
     {
        if($this->estatus == 1)
        {
            $this->desactivar();
        }
        else
        {
            $this->activar();
        }

        return true;
     }
}
