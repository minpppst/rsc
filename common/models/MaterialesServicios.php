<?php

namespace common\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "materiales_servicios".
 *
 * @property integer $id
 * @property integer $id_se
 * @property string $nombre
 * @property integer $unidad_medida
 * @property integer $presentacion
 * @property string $precio
 * @property integer $iva
 * @property integer $estatus
 *
 * @property Presentacion $presentacion0
 * @property PartidaSubEspecifica $idSe
 * @property UnidadMedida $unidadMedida
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
            [['id_se', 'nombre', 'unidad_medida', 'presentacion', 'precio', 'iva', 'estatus'], 'required'],
            [['id_se', 'unidad_medida', 'presentacion', 'iva', 'estatus'], 'integer'],
            [['precio'], 'number'],
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
            'id_se' => 'Partida Sub-Específica',
            'nombre' => 'Nombre',
            'unidad_medida' => 'Unidad de Medida',
            'nombreUnidadMedida' => 'Unidad de Medida',
            'presentacion' => 'Presentación',
            'precio' => 'Precio',
            'iva' => 'IVA',
            'estatus' => 'Estatus',
            'codigoSubEspecifica' => 'Específica',
            'nombrePresentacion' => 'Presentación',
            'precioBolivar' => 'Precio',
            'ivaPorcentaje' => 'IVA',
            'nombreEstatus' => 'Estatus'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPresentacion0()
    {
        return $this->hasOne(Presentacion::className(), ['id' => 'presentacion']);
    }

    public function getNombrePresentacion()
    {
        if($this->presentacion0 == null)
        {
            return null;
        }

        return $this->presentacion0->nombre;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdSe()
    {
        return $this->hasOne(PartidaSubEspecifica::className(), ['id' => 'id_se']);
    }

    public function getCodigoSubEspecifica()
    {
        if($this->id_se == null)
        {
            return null;
        }

        $this->idSe->sub_especifica;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnidadMedida()
    {
      return $this->hasOne(UnidadMedida::className(), ['id' => 'unidad_medida']);
    }

    /**
     * @return string
     */
    public function getNombreUnidadMedida()
    {
      if($this->unidad_medida == null)
      {
        return null;
      }

      return $this->unidadMedida->unidad_medida;

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
        if($this->estatus == 1)
        {
            return "Activo";
        }

        return "Inactivo";
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

      /**
       * Devolver el codigo presupuestario completo
       * del material o servicio.
       * @return string
       */
      public function getCodigoPresupuestario()
      {
         return 
            $this->idSe->especifica0->idGenerica->idPartida->numeroCuenta .''.
            $this->idSe->especifica0->idGenerica->idPartida->partida .''.
            $this->idSe->especifica0->idGenerica->generica .''.
            $this->idSe->especifica0->especifica .''. 
            $this->idSe->sub_especifica .'';
      }

    /** 
     * Devuelve el id de la partida sub-especifica
     * mediante el codigo presupuestario.
     * @param string $codigo Codigo presupuestario
     * @return integer $id ID de la partida sub-especifica
     */
    public function findIdSubEspecifica($codigo)
    {
        //Separar el codigo
        $cuenta = substr($codigo, 0, 1);
        $partida = substr($codigo, 1, 2);
        $generica = substr($codigo, 3, 2);
        $especifica = substr($codigo, 5, 2);
        $sub_especfica = substr($codigo, 7, 2);

        //construir el query
        $query = new Query;

        $query->select('pse.id AS id')
            ->from('cuenta_presupuestaria cp, partida_partida pp, partida_generica pg, partida_especifica pe, partida_sub_especifica pse')
            ->where('pse.especifica = pe.id AND pe.generica = pg.id AND pg.id_partida = pp.id AND pp.cuenta = cp.id
                    AND cp.cuenta = :cuenta AND pp.partida = :partida AND pg.generica = :generica AND pe.especifica = :especifica AND pse.sub_especifica = :sub_especfica')
            ->addParams([':cuenta'=>$cuenta,':partida'=>$partida,':generica'=>$generica,':especifica'=>$especifica,':sub_especfica'=>$sub_especfica]);

        $row = $query->one();

        return intval($row['id']); //Devuelve integer
    }
}
