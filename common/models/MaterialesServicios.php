<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "materiales_servicios".
 *
 * @property integer $id
 * @property string $cuenta
 * @property string $partida
 * @property string $generica
 * @property string $especifica
 * @property string $subespecifica
 * @property string $nombre
 * @property integer $unidad_medida
 * @property integer $presentacion
 * @property string $precio
 * @property integer $iva
 * @property integer $estatus
 *
 * @property AccionCentralizadaPedido[] $accionCentralizadaPedidos
 * @property Presentacion $presentacion0
 * @property UnidadMedida $unidadMedida
 * @property PartidaSubEspecifica $cuenta0
 * @property ProyectoPedido[] $proyectoPedidos
 */
class MaterialesServicios extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'materiales_servicios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cuenta', 'partida', 'generica', 'especifica', 'subespecifica', 'nombre', 'precio', 'iva', 'estatus'], 'required'],
            [['cuenta', 'partida', 'generica', 'especifica', 'subespecifica', 'unidad_medida', 'presentacion', 'iva', 'estatus'], 'integer'],
            [['precio'], 'number'],
            [['cuenta'], 'string', 'max' => 1],
            [['partida', 'generica', 'especifica', 'subespecifica'], 'string', 'max' => 2],
            [['nombre'], 'string', 'max' => 60],
            [['cuenta', 'partida', 'generica', 'especifica', 'subespecifica'], 'unique', 'targetAttribute' => ['cuenta', 'partida', 'generica', 'especifica', 'subespecifica'], 'message' => 'The combination of Cuenta, Partida, Generica, Especifica and Subespecifica has already been taken.'],
            [['presentacion'], 'exist', 'skipOnError' => true, 'targetClass' => Presentacion::className(), 'targetAttribute' => ['presentacion' => 'id']],
            [['unidad_medida'], 'exist', 'skipOnError' => true, 'targetClass' => UnidadMedida::className(), 'targetAttribute' => ['unidad_medida' => 'id']],
            [['cuenta', 'partida', 'generica', 'especifica', 'subespecifica'], 'exist', 'skipOnError' => true, 'targetClass' => PartidaSubEspecifica::className(), 'targetAttribute' => ['cuenta' => 'cuenta', 'partida' => 'partida', 'generica' => 'generica', 'especifica' => 'especifica', 'subespecifica' => 'subespecifica']],
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
            'generica' => 'Genérica',
            'especifica' => 'Específica',
            'subespecifica' => 'Subespecifica',
            'nombre' => 'Nombre',
            'unidad_medida' => 'Unidad de Medida',
            'presentacion' => 'Presentación',
            'precio' => 'Precio',
            'iva' => 'Iva',
            'estatus' => 'Estatus',
            'nombreUnidadMedida' => ' Unidad de Medida'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccionCentralizadaPedidos()
    {
        return $this->hasMany(AccionCentralizadaPedido::className(), ['id_material' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPresentacion0()
    {
        return $this->hasOne(Presentacion::className(), ['id' => 'presentacion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnidadMedida()
    {
        return $this->hasOne(UnidadMedida::className(), ['id' => 'unidad_medida']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuenta0()
    {
        return $this->hasOne(PartidaSubEspecifica::className(), ['cuenta' => 'cuenta', 'partida' => 'partida', 'generica' => 'generica', 'especifica' => 'especifica', 'subespecifica' => 'subespecifica']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProyectoPedidos()
    {
        return $this->hasMany(ProyectoPedido::className(), ['id_material' => 'id']);
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
