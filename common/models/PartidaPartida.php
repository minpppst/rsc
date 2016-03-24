<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "partida_partida".
 *
 * @property integer $id
 * @property integer $cuenta
 * @property integer $partida
 * @property string $nombre
 * @property integer $estatus
 *
 * @property Ge[] $ges
 * @property PartidaCuenta $cuenta0
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
            [['cuenta', 'partida', 'estatus'], 'integer'],
            [['nombre'], 'string', 'max' => 60]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cuenta' => 'Cuenta',
            'partida' => 'Partida',
            'nombre' => 'Nombre',
            'estatus' => 'Estatus',
            'nombreEstatus' => 'Estatus',
            'numeroCuenta' => 'Cuenta'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartidasGenericas()
    {
        return $this->hasMany(PartidaGenerica::className(), ['id_partida' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuentaPresupuestaria()
    {
        return $this->hasOne(CuentaPresupuestaria::className(), ['id' => 'cuenta']);
    }
    
    public function getNumeroCuenta()
    {
        return $this->cuentaPresupuestaria->cuenta;
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
