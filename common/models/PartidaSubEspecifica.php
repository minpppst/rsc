<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "partida_sub_especifica".
 *
 * @property string $cuenta
 * @property string $partida
 * @property string $generica
 * @property string $especifica
 * @property string $subespecifica
 * @property string $nombre
 * @property integer $estatus
 *
 * @property MaterialesServicios $materialesServicios
 * @property PartidaEspecifica $cuenta0
 */
class PartidaSubEspecifica extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'partida_sub_especifica';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cuenta', 'partida', 'generica', 'especifica', 'subespecifica', 'nombre', 'estatus'], 'required'],
            [['nombre'], 'string'],
            [['estatus'], 'integer'],
            [['cuenta'], 'string', 'max' => 1],
            [['partida', 'generica', 'especifica', 'subespecifica'], 'string', 'min' => 2,  'max' => 2],            
            [['cuenta', 'partida', 'generica', 'especifica'], 'exist', 'skipOnError' => true, 'targetClass' => PartidaEspecifica::className(), 'targetAttribute' => ['cuenta' => 'cuenta', 'partida' => 'partida', 'generica' => 'generica', 'especifica' => 'especifica']],
            ['subespecifica', 'match', 'pattern' => '/^[0-9][0-9]$/', 'message' => 'Debe escribir un número entre 00 y 99']
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
            'subespecifica' => 'Subespecifica',
            'nombre' => 'Nombre',
            'estatus' => 'Estatus',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMaterialesServicios()
    {
        return $this->hasOne(MaterialesServicios::className(), ['cuenta' => 'cuenta', 'partida' => 'partida', 'generica' => 'generica', 'especifica' => 'especifica', 'subespecifica' => 'subespecifica']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuenta0()
    {
        return $this->hasOne(PartidaEspecifica::className(), ['cuenta' => 'cuenta', 'partida' => 'partida', 'generica' => 'generica', 'especifica' => 'especifica']);
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
