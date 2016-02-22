<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "partida".
 *
 * @property integer $id
 * @property integer $partida
 * @property string $nombre
 * @property integer $estatus
 *
 * @property ProyectoDistribucionPresupuestaria[] $proyectoDistribucionPresupuestarias
 */
class Partida extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'partida';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['partida', 'nombre', 'estatus'], 'required'],
            [['partida', 'estatus'], 'integer'],
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
            'partida' => 'Partida',
            'nombre' => 'Nombre',
            'estatus' => 'Estatus',
            'nombreEstatus' => 'Estatus'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProyectoDistribucionPresupuestarias()
    {
        return $this->hasMany(ProyectoDistribucionPresupuestaria::className(), ['id_partida' => 'id']);
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
