<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "partida_especifica".
 *
 * @property integer $id
 * @property integer $generica
 * @property string $especifica
 * @property string $nombre
 * @property integer $estatus
 *
 * @property Ge $idGe
 * @property Se[] $ses
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
            [['generica', 'especifica', 'nombre', 'estatus'], 'required'],
            [['generica', 'estatus'], 'integer'],
            [['especifica'], 'string', 'max' => 2],
            [['nombre'], 'string', 'max' => 60],
            ['especifica', 'match', 'pattern' => '/^[0-9][0-9]$/', 'message' => 'Debe escribir un número entre 00 y 99']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'generica' => 'Génerica',
            'especifica' => 'Especifica',
            'nombre' => 'Nombre',
            'estatus' => 'Estatus',
            'partidaGenerica' => 'Génerica',
            'nombreEstatus' => 'Estatus',
            'partida' => 'Partida'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdGenerica()
    {
        return $this->hasOne(PartidaGenerica::className(), ['id' => 'generica']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSes()
    {
        return $this->hasMany(Se::className(), ['id_es' => 'id']);
    }

    public function getPartidaPartida()
    {
        if($this->idGenerica == null)
        {
            return null;
        }

        return PartidaPartida::find()->where(['id' => $this->idGenerica->id_partida])->one()->partida;
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartidaGenerica()
    {
        if($this->idGenerica == null)
        {
            return null;
        }

        return $this->idGenerica->generica;
    }

    /**
     * @return string
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
