<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "partida_especifica".
 *
 * @property integer $cuenta
 * @property integer $partida
 * @property integer $generica
 * @property integer $especifica
 * @property string $nombre
 * @property integer $estatus
 *
 * @property PartidaGenerica $cuenta0
 * @property PartidaSubEspecifica[] $partidaSubEspecificas
 */
class PartidaEspecifica extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'partida_especifica';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cuenta', 'partida', 'generica', 'especifica', 'nombre', 'estatus'], 'required'],
            [['nombre'], 'string'],
            [['estatus'], 'integer'],
            [['partida', 'generica', 'especifica'], 'string', 'min' => 2,  'max' => 2],
            [['cuenta', 'partida', 'generica'], 'exist', 'skipOnError' => true, 'targetClass' => PartidaGenerica::className(), 'targetAttribute' => ['cuenta' => 'cuenta', 'partida' => 'partida', 'generica' => 'generica']],
            ['especifica', 'match', 'pattern' => '/^[0-9][0-9]$/', 'message' => 'Debe escribir un número entre 00 y 99']
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
            'especifica' => 'Especifica',
            'nombre' => 'Nombre',
            'estatus' => 'Estatus',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuenta0()
    {
        return $this->hasOne(PartidaGenerica::className(), ['cuenta' => 'cuenta', 'partida' => 'partida', 'generica' => 'generica']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartidaSubEspecificas()
    {
        return $this->hasMany(PartidaSubEspecifica::className(), ['cuenta' => 'cuenta', 'partida' => 'partida', 'generica' => 'generica', 'especifica' => 'especifica']);
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
