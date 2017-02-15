<?php

namespace common\models;

use Yii;
use yii\data\ArrayDataProvider;

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
        
        if($this->estatus == 1)
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
        if($this->unidad_medida == null)
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
        if($this->presentacion == null)
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

     /**
      * Proceso para cambiar precio base y el precio de los requerimientos asociados a ese material
      */
     public function cambiarTodo()
     {
        //comenzamos con la transaccion
        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();
        $anio=date('Y');
        try
        {
          //guardamos sin validar datos
          $this->save(false);
          //cambiamos el precio de todos los requerimietos asociados a esos ms
          $connection->createCommand()->update('proyecto_pedido', ['precio' => $this->precio], ['YEAR(fecha_creacion)' => $anio, 'id_material' => $this->id])->execute();
          $connection->createCommand()->update('accion_centralizada_pedido', ['precio' => $this->precio], ['YEAR(fecha_creacion)' =>$anio, 'id_material' => $this->id])->execute();
            $transaction->commit();
            return true;
        }
        catch (Exception $e) 
        {
          $transaction->rollBack();
          return false;
        };
     }

      /**
      *reporte temporal de como quedaria el monto total de los pedidos por accinoes especificas
      */
      public function ResultadoTemporal()
      {
        //Construccion del query
        $sql = "
            SELECT
               a.nombre as 'proyecto - accion', pae.nombre as 'proyecto_accion',
               (
                    pedido.enero +
                    pedido.febrero +
                    pedido.marzo +
                    pedido.abril +
                    pedido.mayo +
                    pedido.junio +
                    pedido.julio +
                    pedido.agosto +
                    pedido.septiembre +
                    pedido.octubre +
                    pedido.noviembre +
                    pedido.diciembre
                ) * if(pedido.id_material=".$this->id.", ".$this->precio.", pedido.precio) as total
            FROM
               proyecto a, proyecto_accion_especifica pae, proyecto_usuario_asignar pa,
               materiales_servicios ms, proyecto_pedido pedido
            WHERE
               pae.id_proyecto = a.id AND
               pae.id = pa.accion_especifica_id AND
               pa.id = pedido.asignado AND
               pedido.id_material = ms.id 
               AND
               pedido.estatus = 1

               UNION 

            Select
              a.nombre_accion as 'proyecto - accion', b.nombre as 'proyecto_ac - accion_ac', 
              (
              (e.enero+
              e.febrero+
              e.marzo+
              e.abril+
              e.mayo+
              e.junio+
              e.julio+
              e.agosto+
              e.septiembre+
              e.octubre+
              e.noviembre+
              e.diciembre)* if(e.id_material=".$this->id.", ".$this->precio.", e.precio)) as total
              from accion_centralizada as a
              inner join accion_centralizada_accion_especifica as b on a.id=b.id_ac_centr
              inner join accion_centralizada_ac_especifica_uej as c on b.id=c.id_ac_esp
              inner join accion_centralizada_asignar as d on c.id=d.accion_especifica_ue
              inner join accion_centralizada_pedido as e on d.id=e.asignado
              where
              e.estatus = 1
          ";

      //Arreglo para el DataProvider
      $query = Yii::$app->db->createCommand($sql)->queryAll();
      //DataProvider
      $dataProvider = new ArrayDataProvider([
          'allModels' => $query,
        ]);
        return $dataProvider;
      }
}
