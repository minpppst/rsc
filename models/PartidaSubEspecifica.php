<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "partida_sub_especifica".
 *
 * @property integer $id
 * @property integer $especifica
 * @property integer $sub_especifica
 * @property string $nombre
 * @property integer $estatus
 *
 * @property MaterialesServicios[] $materialesServicios
 * @property PartidaEspecifica $especifica0
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
            [['especifica', 'sub_especifica', 'nombre'], 'required'],
            [['especifica', 'estatus'], 'integer'],
            [['sub_especifica'], 'string', 'max' => 2],
            [['nombre'], 'string', 'max' => 60],
            ['sub_especifica', 'match', 'pattern' => '/^[0-9][0-9]$/', 'message' => 'Debe escribir un número entre 00 y 99']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'especifica' => 'Especifica',
            'sub_especifica' => 'Sub-Especifica',
            'nombre' => 'Nombre',
            'estatus' => 'Estatus',
            'nombreEstatus' => 'Estatus'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMaterialesServicios()
    {
        return $this->hasMany(MaterialesServicios::className(), ['id_se' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEspecifica0()
    {
        return $this->hasOne(PartidaEspecifica::className(), ['id' => 'especifica']);
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
