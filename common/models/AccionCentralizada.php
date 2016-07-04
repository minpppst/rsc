<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "accion_centralizada".
 *
 * @property integer $id
 * @property string $codigo_accion
 * @property string $codigo_accion_sne
 * @property string $nombre_accion
 * @property integer $estatus
 * @property integer $aprobado
 * @property string $fecha_inicio
 * @property string $fecha_fin
 *
 * @property AcVariable[] $acVariables
 */
class AccionCentralizada extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'accion_centralizada';
    }

    public function behaviors()
    {
        return [
            'bedezign\yii2\audit\AuditTrailBehavior'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        
        return [
            [['codigo_accion', 'codigo_accion_sne'],'unique'],
            [['aprobado'], 'integer'],
            [['codigo_accion', 'codigo_accion_sne', 'nombre_accion', 'estatus', 'fecha_inicio', 'fecha_fin'], 'required'],
            //[['fecha_inicio', 'fecha_fin'], 'date', 'format'=>'Y-m-d'],
            //['fecha_inicio', 'compare', 'compareAttribute'=>'fecha_fin','operator'=>'<', 'message'=>'Fecha Inicial Debe Ser Menor A Fecha Final'],
            //[['codigo_accion', 'codigo_accion_sne'], 'string', 'max' => 45],
            ['fecha_inicio', 'formato_fecha'],
            ['fecha_fin', 'formato_fecha'],
        ];
    }


    /**
     * @param string $attribute
     * @param array $params
     */
    public function formato_fecha($attribute,$params)
    {

        switch ($attribute) {
            case 'fecha_inicio':
                
            if (!preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $this->fecha_inicio))
                    {
                        $this->addError($attribute, "El Formato De Fecha Debe Ser 'dd/mm/yyyy' ");
                        //$mensaje="El Formato De Fecha Debe Ser 'dd/mm/yyyy' ";
                    }else{
                      
                      

                      $date = explode('/', $this->fecha_inicio);
                      $this->fecha_inicio=$date[2]."/".$date[1]."/".$date[0];
                      
                      //validando rango
                      $date = explode('/', $this->fecha_fin);
                      $fecha2=$date[2]."/".$date[1]."/".$date[0];
                      $fecha1 = new \DateTime($this->fecha_inicio);
                      $fecha2 = new \DateTime($fecha2);
                    if($fecha1>$fecha2)
                        $this->addError($attribute, "Fecha Inicio Debe Ser Menor A Fecha Fin ");

                    }


                break;

                case  'fecha_fin':

                if(!preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $this->fecha_fin))
            {
                         $this->addError($attribute, "El Formato De Fecha Debe Ser 'dd/mm/yyyy' ");
                        
                    }else{
                      $date = explode('/', $this->fecha_fin);
                      $this->fecha_fin=$date[2]."/".$date[1]."/".$date[0];
                     
                      
                    }

            break;
            default:
            
                break;
        }
  
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'codigo_accion' => 'Codigo Accion',
            'codigo_accion_sne' => 'Codigo Accion SNE',
            'nombre_accion' => 'Nombre Accion',
            'estatus' => 'Estatus',
            'aprobado' => 'Aprobado',
            'fecha_inicio' => 'Fecha Inicio',
            'fecha_fin' => 'Fecha Fin',
             'nombreEstatus' => 'Estatus'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcVariables()
    {
        return $this->hasMany(AcVariable::className(), ['id_ac' => 'id']);
    }

        public   function getnombreEstatus(){
                              return ($this->estatus == 1)? 'Activo':'Inactivo';
                      }





        public function desactivar()
    {
        $this->estatus = 0;
        $this->save(false);
    }

     /**
     * Colocar estatus en 1 "Activo"
     */
     public function activar()
     {
        $this->estatus = 1;
        $this->save(false);
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

      public function toggleAprobado()
     {
        if($this->aprobado == 1)
        {
            $this->aprobado = 0;
        }
        else
        {
            $this->aprobado = 1;
        }
         //solo en caso de modelos q tengan fecha
        $this->fecha_inicio = date_create($this->fecha_inicio);
        $this->fecha_fin = date_create($this->fecha_fin);

        $this->fecha_inicio=date_format($this->fecha_inicio, 'd/m/Y');
        $this->fecha_fin=date_format($this->fecha_fin, 'd/m/Y');
        
        $this->save();

        
        

        return true;
     }

     public function distribucionPresupuestaria()
    {
        //Contador para paginación
        $contar = Yii::$app->db->createCommand('
            SELECT COUNT(*) FROM `proyecto_accion_especifica` WHERE id_proyecto = :proyecto', 
            [':proyecto' => $this->id])
        ->queryScalar();

        //Construccion del query
        $sql = "
            SELECT
                pae.id AS 'id',
                pae.nombre AS 'nombre_accion',
                CONCAT(cp.cuenta,pp.partida) AS 'partida',
                SUM((
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
                ) * pedido.precio) AS 'total'
            FROM
                proyecto_accion_especifica pae, proyecto_asignar pa,
                materiales_servicios ms, proyecto_pedido pedido, partida_sub_especifica pse, 
                partida_especifica pe, partida_generica pg, partida_partida pp, cuenta_presupuestaria cp
            WHERE
                pae.id = :accion AND
                pae.id = pa.accion_especifica AND
                pa.id = pedido.asignado AND
                pedido.id_material = ms.id AND
                ms.id_se = pse.id AND
                pse.especifica = pe.id AND
                pe.generica = pg.id AND
                pg.id_partida = pp.id AND
                pp.cuenta = cp.id AND
                pedido.estatus = 1
            GROUP BY
                pae.id, 
                cp.cuenta, 
                pp.partida
        ";

        //Arreglo para el DataProvider
        $data = [];

        //Por cada accion especifica del proyecto
        foreach ($this->accionesEspecificas as $key => $value)
        {
            //Obtener los datos mediante el query
            $query = Yii::$app->db->createCommand($sql,[':accion' => $value->id])->queryAll();

            //Arreglo temporal
            $arreglo = [
                'id' => $value->id,
                'nombre_accion' => $value->nombre
            ];

            //Por cada resultado del query
            foreach ($query as $llave => $valor) 
            {
               //Se se coloca en el arreglo con formato de moenda
               $arreglo[$valor['partida']] = \Yii::$app->formatter->asCurrency($valor['total']);
            }

            $data[] = $arreglo;           
        }


        //DataProvider
        $dataProvider = new ArrayDataProvider([
            'allModels' => $data,
            'totalCount' => $contar,
            'pagination' => ['pageSize' => 10]
        ]);

        return $dataProvider;
    }




     

     public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            //Cambiar el formato de las fechas
            $formato = 'd/m/Y';
            $inicio = date_create_from_format($formato,$this->fecha_inicio);
            $fin = date_create_from_format($formato,$this->fecha_fin);

            if($inicio != false)
            {
                $this->fecha_inicio = date_format($inicio,'Y-m-d');
            }
            
            if($fin != false) 
            {
                $this->fecha_fin = date_format($fin,'Y-m-d');
            }
            
            return true;
        } else {
            return false;
        }
    }

}
