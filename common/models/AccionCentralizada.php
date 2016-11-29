<?php

namespace common\models;
use yii\data\ArrayDataProvider;
use common\components\Notification as Notificaciones;

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
    
    /**
     * Constante que guarda el nombre del evento
     */
    const EVENT_ACAPROBAR = 'Accion Centralizada Aprobado/Desaprobado';

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->on(self::EVENT_ACAPROBAR, [$this, 'notificacion']);
    }

    /**
    * Modelo behaviors para auditar o realizar reversos
    */
    public function behaviors()
    {
        return [
            'bedezign\yii2\audit\AuditTrailBehavior'
        ];
    }

    /**
     * Notificacion
     */
     public function notificacion($evento)
     {
        if($this->aprobado==1)
        {
            //puede darse el caso que este vacio el usuario de creacion
            if($this->usuario_creacion==null)
            {
                $this->usuario_creacion=Yii::$app->user->identity->id;
            }
            //se crea la notificacion, la primera al usuario que creo el proyecto
            Notificaciones::notify(Notificaciones::KEY_ACAPROBAR, $this->usuario_creacion, $this->id);
            //se crea la notificacion, la segunda para el usuario quien hace la aprobacion
            Notificaciones::notify(Notificaciones::KEY_ACAPROBAR, Yii::$app->user->identity->id, $this->id);
        }
        else
        {
            //puede darse el caso que este vacio el usuario de creacion
            if($this->usuario_creacion==null)
            {
                $this->usuario_creacion=Yii::$app->user->identity->id;
            }
            //se crea la notificacion, la primera al usuario que creo el proyecto
            Notificaciones::notify(Notificaciones::KEY_ACDESAPROBAR, $this->usuario_creacion, $this->id);
            //se crea la notificacion, la segunda para el usuario quien hace la aprobacion
            Notificaciones::notify(Notificaciones::KEY_ACDESAPROBAR, Yii::$app->user->identity->id, $this->id);   
        }
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
            ['fecha_inicio', 'validarFecha'],
            //['fecha_inicio', 'compare', 'compareAttribute'=>'fecha_fin','operator'=>'<'],
            
        ];
    }

    /**
    * Regla Validar Fecha inicio debe ser mayor Fecha fin
    */
    public function validarFecha()
    {   
        $fecha1=date(str_replace("/", "-", $this->fecha_inicio));
        $fecha2=date(str_replace("/", "-", $this->fecha_fin));
        if(strtotime($fecha1)>strtotime($fecha2))
        {
            $this->addError('fecha_inicio','Fecha Inicio no puede ser mayor a Fecha Fin');
            $this->addError('fecha_fin','Fecha Fin no puede ser menor a Fecha Inicio');
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

    /**
     * @return string
     */
    public   function getnombreEstatus()
    {
        return ($this->estatus == 1)? 'Activo':'Inactivo';
    }


    /**
     * Colocar estatus en 0 "DesaActivo"
     */
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

      public function getAccionesEspecificas()
    {
        return $this->hasMany(AcAcEspec::className(), ['id_ac_centr' => 'id']);
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
    /*
    / Mostrar las partidas de primer nivel unicamente
    /@return array
    */
    public function cabeceras(){

        //cabeceras
        $model=$this;
        $columnas=PartidaSubEspecifica::find()
        ->select([new \yii\db\Expression('concat(cuenta,partida) as partida')])
        ->where('cuenta in (4)')
        ->groupBy(new \yii\db\Expression('concat(cuenta,partida)'))
        ->asArray()
        ->all();
    
        $data[]=
        [
                'class' => 'kartik\grid\SerialColumn',
                'width' => '30px',
        ];
        $data[]=
        [
                'class' => 'kartik\grid\DataColumn',
                'width' => '30px',
                'attribute'=>'nombre_accion',
                'value' => function  ($model, $index, $dataColumn){
                    return ($model['nombre']);
         },
        ];
        foreach ($columnas as $key => $value) 
        {
            $data[]=
            [
               'class'=>'\kartik\grid\DataColumn',
               'attribute'=>$value['partida'],
               'value' => function  ($model, $index, $dataColumn, $dataProvider)
                           {
                                if (array_key_exists($dataProvider->attribute, $model)) return ($model[$dataProvider->attribute]);
                            }

            ];
           
        }

        return $data;
    }
    

    /**
    * Mostrar las acciones especificas y sus pedidos dividos por partidas sin iva
    *@return $dataProvider
    **/
    public function distribucionPresupuestaria()
    {

        //Contador para paginación
        $contar = Yii::$app->db->createCommand('
            SELECT COUNT(*) FROM `accion_centralizada_accion_especifica` WHERE id_ac_centr = :accion_central', 
            [':accion_central' => $this->id])
        ->queryScalar();

        //Construccion del query
        $sql = "
            SELECT
               a.id AS 'id',
               a.nombre AS 'nombre', 
               CONCAT(ms.cuenta,ms.partida) AS 'partida',
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
               accion_centralizada_accion_especifica a, accion_centralizada_asignar b,
               materiales_servicios ms, accion_centralizada_pedido pedido, accion_centralizada_ac_especifica_uej as f
            WHERE
               a.id = :accion AND
               a.id = f.id_ac_esp AND
               f.id = b.accion_especifica_ue AND
               b.id = pedido.asignado AND
               pedido.id_material = ms.id AND
               a.estatus = 1 AND
               pedido.estatus = 1
            GROUP BY
               a.id,
               a.nombre,
               ms.cuenta,
               ms.partida
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
                'nombre' => $value->nombre,
                

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

}
