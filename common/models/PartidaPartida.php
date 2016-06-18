<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "partida_partida".
 *
 * @property string $cuenta
 * @property string $partida
 * @property string $nombre
 * @property integer $estatus
 *
 * @property PartidaGenerica[] $partidaGenericas
 */
class PartidaPartida extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'partida_partida';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cuenta', 'partida', 'nombre'], 'required'],
            [['estatus'], 'integer'],
            [['cuenta'], 'string', 'max' => 1],
            [['partida'], 'string', 'min' => 2, 'max' => 2],
            [['nombre'], 'string', 'max' => 60],
            ['partida', 'match', 'pattern' => '/^[0-9][0-9]$/', 'message' => 'Debe escribir un número entre 00 y 99']
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
            'nombre' => 'Nombre',
            'estatus' => 'Estatus',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartidaGenericas()
    {
        return $this->hasMany(PartidaGenerica::className(), ['cuenta' => 'cuenta', 'partida' => 'partida']);
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
