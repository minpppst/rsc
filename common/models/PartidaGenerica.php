<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "partida_generica".
 *
 * @property integer $cuenta
 * @property integer $partida
 * @property integer $generica
 * @property string $nombre
 * @property integer $estatus
 *
 * @property PartidaEspecifica[] $partidaEspecificas
 * @property PartidaPartida $cuenta0
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
            [['cuenta', 'partida', 'generica', 'nombre', 'estatus'], 'required'],
            [['estatus'], 'integer'],
            [['cuenta'], 'string', 'max' => 1],
            [['partida'], 'string', 'min' => 2, 'max' => 2],
            [['generica'], 'string', 'min' => 2, 'max' => 2],
            [['nombre'], 'string', 'max' => 60],
            [['cuenta', 'partida'], 'exist', 'skipOnError' => true, 'targetClass' => PartidaPartida::className(), 'targetAttribute' => ['cuenta' => 'cuenta', 'partida' => 'partida']],
            ['generica', 'match', 'pattern' => '/^[0-9][0-9]$/', 'message' => 'Debe escribir un número entre 00 y 99']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cuenta' => 'Cuenta',
            'partida' => 'Partida',
            'generica' => 'Generica',
            'nombre' => 'Nombre',
            'estatus' => 'Estatus',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartidaEspecificas()
    {
        return $this->hasMany(PartidaEspecifica::className(), ['cuenta' => 'cuenta', 'partida' => 'partida', 'generica' => 'generica']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuenta0()
    {
        return $this->hasOne(PartidaPartida::className(), ['cuenta' => 'cuenta', 'partida' => 'partida']);
    }

    /**
     * @return string
     */
    public function getNombreEstatus()
    {
        
        if($this->estatus === 1)
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
