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
    public $cuentapartida;
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
            [['nombre', 'precio', 'iva', 'estatus'], 'required'],
            [['cuenta', 'partida', 'generica', 'especifica', 'subespecifica', 'unidad_medida', 'presentacion', 'iva', 'estatus'], 'integer'],
            [['cuentapartida'], 'string'],
            [['cuentapartida'], 'partidaguardar'],
            [['precio'], 'number'],
            [['cuenta'], 'string', 'max' => 1],
            [['partida', 'generica', 'especifica', 'subespecifica'], 'string', 'max' => 2],
            [['nombre'], 'string', 'max' => 60],
            //[['cuenta', 'partida', 'generica', 'especifica', 'subespecifica'], 'unique', 'targetAttribute' => ['cuenta', 'partida', 'generica', 'especifica', 'subespecifica'], 'message' => 'The combination of Cuenta, Partida, Generica, Especifica and Subespecifica has already been taken.'],
            [['presentacion'], 'exist', 'skipOnError' => true, 'targetClass' => Presentacion::className(), 'targetAttribute' => ['presentacion' => 'id']],
            [['unidad_medida'], 'exist', 'skipOnError' => true, 'targetClass' => UnidadMedida::className(), 'targetAttribute' => ['unidad_medida' => 'id']],
            [['cuenta', 'partida', 'generica', 'especifica', 'subespecifica', 'cuentapartida'], 'exist', 'skipOnError' => true, 'targetClass' => PartidaSubEspecifica::className(), 'targetAttribute' => ['cuenta' => 'cuenta', 'partida' => 'partida', 'generica' => 'generica', 'especifica' => 'especifica', 'subespecifica' => 'subespecifica']],
            [['cuentapartida'], 'safe'],
        ];
    }

    public function partidaguardar()
    {
        $variables=explode('-', $this->cuentapartida);
        $this->cuenta=$variables[0];
        $this->partida=$variables[1];
        $this->generica=$variables[2];
        $this->especifica=$variables[3];
        $this->subespecifica=$variables[4];
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
            'nombreUnidadMedida' => ' Unidad de Medida',
            'nombrePresentacion' => 'Presentación',
            'precioBolivar' => 'Precio',
            'cuentapartida' => 'Partida',
            'ivaPorcentaje' => 'IVA'
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

    public function getPrecioBolivar()
    {
        if($this->precio == null)
        {
            return null;
        }
        return \Yii::$app->formatter->asCurrency($this->precio);
    }
    public function getIvaPorcentaje()
    {
        if($this->iva == null)
        {
            return null;
        }
        return $this->iva.'%' ;
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
     * @return string
     */
    public function getNombreUnidadMedida()
    {
        if($this->unidad_medida === null)
        {
            return null;
        }

        return isset($this->unidadMedida) ? $this->unidadMedida->unidad_medida : '';
    }

    /**
     * @return string
     */
    public function getNombrePresentacion()
    {
        if($this->presentacion === null)
        {
            return null;
        }

        return isset($this->presentacion0) ? $this->presentacion0->nombre : '';
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
