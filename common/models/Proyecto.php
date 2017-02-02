<?php

namespace common\models;

use backend\models\ProyectoVariables;
use Yii;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;
use common\components\Notification as Notificaciones;
/**
 * This is the model class for table "proyecto".
 *
 * @property integer $id
 * @property string $codigo_proyecto
 * @property string $nombre 
 * @property string $fecha_inicio 
 * @property string $fecha_fin
 * @property integer $estatus_proyecto
 * @property integer $situacion_presupuestaria
 * @property integer $monto_proyecto_actual
 * @property integer $monto_proyecto_anio_anteriores
 * @property integer $monto_total_proyecto_proximo_anios
 * @property integer $monto_financiar
 * @property string $monto_proyecto
 * @property string $descripcion
 * @property integer $sector
 * @property integer $sub_sector
 * @property integer $plan_operativo
 * @property integer $objetivo_general
 * @property string $politicas_ministeriales
 * @property integer $ambito
 * @property integer $aprobado
 * @property integer $estatus
 * @property integer $usuario_creacion
 *
 * @property ProyectoAccionEspecifica[] $proyectoAccionEspecificas
 * @property ProyectoAlcance[] $proyectoAlcances
 * @property ProyectoLocalizacion[] $proyectoLocalizacions
 * @property ProyectoRegistrador[] $proyectoRegistradors
 * @property ProyectoResponsable[] $proyectoResponsables
 * @property ProyectoResponsableAdministrativo[] $proyectoResponsableAdministrativos
 * @property ProyectoResponsableTecnico[] $proyectoResponsableTecnicos
 */
class Proyecto extends \yii\db\ActiveRecord
{

    /**
     * Constante que guarda el nombre del evento
     */
    const EVENT_APROBAR = 'Proyecto Aprobado/Desaprobado';

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->on(self::EVENT_APROBAR, [$this, 'notificacion']);
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'proyecto';
    }
    /*
    *Guargar los cambios hechos(auditoria)
    */
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
            [['nombre', 'fecha_inicio', 'fecha_fin', 'estatus_proyecto', 'situacion_presupuestaria', 'plan_operativo', 'objetivo_general', 'politicas_ministeriales', 'ambito', 'usuario_creacion', 'proyecto_plurianual', 'monto_financiar', 'descripcion_proyecto'], 'required'],
            [['nombre','politicas_ministeriales', 'descripcion_proyecto'], 'string'],
            [['fecha_inicio', 'fecha_fin'], 'safe'],
            [['estatus_proyecto', 'situacion_presupuestaria', 'sector', 'sub_sector', 'plan_operativo', 'objetivo_general', 'ambito', 'aprobado', 'estatus'], 'integer'],
            [[ 'monto_proyecto_actual', 'monto_financiar', 'monto_proyecto_anio_anteriores', 'monto_total_proyecto_proximo_anios'], 'number'],
            [['codigo_proyecto'], 'string', 'max' => 6],
            [['codigo_proyecto'], 'unique'],
            ['fecha_inicio', 'validarFecha'],
            
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
     * Notificacion
     */
     public function notificacion($evento)
     {
        if($this->aprobado==1)
        {
            //se crea la notificacion, la primera al usuario que creo el proyecto
            Notificaciones::notify(Notificaciones::KEY_APROBAR, $this->usuario_creacion, $this->id);
            //se crea la notificacion, la segunda para el usuario quien hace la aprobacion
            Notificaciones::notify(Notificaciones::KEY_APROBAR, Yii::$app->user->identity->id, $this->id);
        }
        else
        {
            //se crea la notificacion, la primera al usuario que creo el proyecto
            Notificaciones::notify(Notificaciones::KEY_DESAPROBAR, $this->usuario_creacion, $this->id);
            //se crea la notificacion, la segunda para el usuario quien hace la aprobacion
            Notificaciones::notify(Notificaciones::KEY_DESAPROBAR, Yii::$app->user->identity->id, $this->id);   
        }
     }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'codigo_proyecto' => 'Código Proyecto',
            'nombre' => 'Nombre Del Proyecto',
            'descripcion_proyecto' => 'Descripción Del Proyecto',
            'estatus_proyecto' => 'Estatus del Proyecto',
            'situacion_presupuestaria' => 'Situación Presupuestaria',
            'proyecto_plurianual' => '¿El Proyecto es Plurianual?',
            'monto_proyecto_actual' => 'Monto Proyecto Año En Curso',
            'monto_proyecto_anio_anteriores' => 'Monto Proyecto Años Anteriores',
            'monto_total_proyecto_proximo_anios' => 'Monto Total Proyecto en los Proximos Años',
            'monto_financiar' => 'Monto A Financiar',
            'sector' => 'Sector',
            'sub_sector' => 'Sub Sector',
            'plan_operativo' => 'Plan Operativo',
            'objetivo_general' => 'Objetivo General Del PNDES',
            'politicas_ministeriales' => 'Politicas Ministeriales',
            'ambito' => 'Ambito',
            'aprobado' => 'Aprobado',
            'estatus' => 'Estatus',
            'nombreEstatus' => 'Estatus',
            'nombrePlurianual' => '¿El Proyecto es Plurianual?',
            'usuario_creacion' => 'Usuario Creación'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProyectoLocalizacion()
    {
        return $this->hasMany(ProyectoLocalizacion::className(), ['id_proyecto' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocalizacions()
    {
        return $this->hasMany(Localizacion::className(), ['id_proyecto' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResponsableAdministrativos()
    {
        return $this->hasMany(ResponsableAdministrativo::className(), ['id_proyecto' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResponsableProyectos()
    {
        return $this->hasMany(ResponsableProyecto::className(), ['id_proyecto' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResponsableTecnicos()
    {
        return $this->hasMany(ResponsableTecnico::className(), ['id_proyecto' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAmbito()
    {
        return $this->hasOne(Ambito::className(), ['id' => 'ambito']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNombreAmbito()
    {
        return $this->idAmbito->ambito;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstatusProyecto()
    {
        return $this->hasOne(EstatusProyecto::className(), ['id' => 'estatus_proyecto']);
    }

    /**
     * @return string
     */
    public function getNombreEstatusProyecto()
    {
        if($this->estatus_proyecto === null)
        {
            return null;
        }

        return $this->estatusProyecto->estatus;
    }

    /**
     * @return string
     */
    public function getNombreEstatus()
    {
        if($this->estatus === 1)
        {
            return "Activo";
        }

        return "Inactivo";
    }
    /**
     * @return string
     */
    public function getNombrePlurianual()
    {
        if($this->proyecto_plurianual === 1)
        {
            return "Si";
        }
        else
        {
            return "No";
        }
    }

    /**
     * @return string
     */
    public function getNombreSector()
    {
        if($this->sector === null)
        {
            return null;
        }

        return $this->idSector->sector;
    }

    /**
     * @return string
     */
    public function getNombreSubSector()
    {
        if($this->sub_sector === null)
        {
            return null;
        }

        return $this->idSubSector->sub_sector;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdSector()
    {
        return $this->hasOne(Sector::className(), ['id' => 'sector']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdSubSector()
    {
        return $this->hasOne(SubSector::className(), ['id' => 'sub_sector']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegistrador()
    {
        return $this->hasOne(ProyectoRegistrador::className(), ['id_proyecto' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResponsable()
    {
        return $this->hasOne(ProyectoResponsable::className(), ['id_proyecto' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResponsableAdministrativo()
    {
        return $this->hasOne(ProyectoResponsableAdministrativo::className(), ['id_proyecto' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResponsableTecnico()
    {
        return $this->hasOne(ProyectoResponsableTecnico::className(), ['id_proyecto' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlcance()
    {
        return $this->hasOne(ProyectoAlcance::className(), ['id_proyecto' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccionesEspecificas()
    {
        return $this->hasMany(ProyectoAccionEspecifica::className(), ['id_proyecto' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
     public function getUsuarioCreacion()
    {
        return $this->hasOne(UserAccounts::className(), ['id' => 'usuario_creacion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
     public function getProyectoUsuarioAsignar()
    {
        return $this->hasOne(ProyectoUsuarioAsignar::className(), ['proyecto_id' => 'id']);
    }

    /**
     * Monto de la suma de todos los requerimientos del proyecto
     * @return null | integer total monto requerimiento
     */
     public function getMontoActual()
    {
        $total=ProyectoUsuarioAsignar::find()->select(['sum((enero+febrero+marzo+abril+mayo+junio+julio+agosto+septiembre+octubre+noviembre+diciembre)*precio) as total'])->innerJoin('proyecto_pedido', 'proyecto_usuario_asignar.id = proyecto_pedido.asignado')->where(['proyecto_usuario_asignar.proyecto_id' => $this->id])->asArray()->One();

        if($total!=null)
        {
            return $total['total'];
        }
        else
        {
            return null;
        }
    }

    /** Monto total de proyecto (años anteriores, años futuros y monto actual)
     * @return null | integer monto total de proyecto
     */
     public function getMontoTotalProyecto()
    {
        $total=$this->montoActual;

        if($total!=null)
        {
            return $total+$this->monto_proyecto_anio_anteriores+$this->monto_total_proyecto_proximo_anios;
        }
        else
        {
            return $this->monto_total_proyecto_proximo_anios+$this->monto_proyecto_anio_anteriores;
        }
    }

    /**
     * @return string
     */
    /*public function getBolivarMonto()
    {
        if($this->monto_proyecto === null)
        {
            return null;
        }

        return \Yii::$app->formatter->asCurrency($this->monto_proyecto);
    }*/

    /**
    * @param numeric $monto
    * @return string
    */
    public function BolivarMontos($monto)
    {
        if($monto === null)
        {
            return null;
        }

        return \Yii::$app->formatter->asCurrency($monto);
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
      * @return boolean
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
      * Aprobar
      * @return int 1 salvado, 2 error suma ponderacion, 3 error al guardar
      */
    public function toggleAprobado()
    {
        //caso desaprobar
        if($this->aprobado == 1)
        {
            $this->aprobado = 0;
            if($this->save())
            {
                return 1;
            }
            else
            {
                return 3;
            }
        }//aprobar
        else
        {
            $this->aprobado = 1;
            //se verifica si la suma de la ponderaciones de las acciones especificas de dicho proyecto es 1
            $comando = \Yii::$app->db->createCommand('SELECT SUM(ponderacion) FROM proyecto_accion_especifica WHERE id_proyecto = '.$this->id);
            $sum = $comando->queryScalar();

            if($sum==1)
            {
                if($this->save())
                {
                    return 1;
                }
                else
                {
                    return 3;
                }
            }
            else
            {
                return 2;
            }

        }
            
     }

     /**
     * DataProvider para la distribución presupuestaria
     * @return ArrayDataProvider $dataProvider
     */
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
               proyecto_accion_especifica pae, proyecto_usuario_asignar pa,
               materiales_servicios ms, proyecto_pedido pedido
            WHERE
               pae.id = :accion AND
               pae.id = pa.accion_especifica_id AND
               pa.id = pedido.asignado AND
               pedido.id_material = ms.id AND
               pedido.estatus = 1
            GROUP BY
               pae.id,
               pae.nombre,
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

    /**
     * Antes de guardar en BD
     */
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
        } 
        else 
        {
            return false;
        }
    }

    /**
    *
    *Proceso para eliminar todo lo relacionado con el proyecto por el admin.
    */
    public function eliminarTodo()
    {
        //buscamos las acciones especificas
        $accionesespecificas=$this->accionesEspecificas;
        if($accionesespecificas!=null)
        {
            
            foreach ($accionesespecificas as $key => $value2) 
            {
                //buscamos las asignaciones de esas acciones espcificas
                $asignaciones=ProyectoUsuarioAsignar::find()->where(['accion_especifica_id' =>$value2->id])->all();

                if($asignaciones!=null)
                {
                    //buscamos los pedidos de esas asignaciones
                    foreach ($asignaciones as $key => $value3)
                    {
                        $pedidos=$value3->proyectoPedidos;

                        if($pedidos!=null)
                        {
                            foreach ($pedidos as $key => $value4)
                            {
                                // se borra el pedido
                                $value4->delete();
                            }
                        }
                        //se borra la asignacion una vez que se borre los pedidos
                        
                        $value3->delete();
                    }//fin del while de buscar pedido
                } // fin del if de asignaciones

                //buscamos los proyectos variables
                $variables=ProyectoVariables::find()->where(['accion_especifica' =>$value2->id])->all();
                if($variables!=null)
                {
                    //buscamos las variables asociadas al proyecto
                    foreach ($variables as $key => $value5) 
                    {
                        //buscamos las localizaciones asociadas a esa variable
                        if($value5!=null)
                        {
                            $localizaciones=$value5->proyectoVariableLocalizacions;

                            foreach ($localizaciones as $key => $value6) 
                            {
                                if($value6!=null)
                                {
                                    //buscamos las programaciones y ejecuciones de esas variables
                                    foreach ($value6->proyectoVariableProgramacions as $key => $value7) 
                                    {
                                        $modelojecucion=ProyectoVariableEjecucion::find()->where(['id_programacion'=> $value7->id])->One();
                                        if($modelojecucion!=null)
                                        {
                                            //borrando la ejecucion
                                            $modelojecucion->delete();
                                        }
                                        //borrando la programacion
                                        $value7->delete();
                                    }

                                    $value6->delete();
                                }
                            }//fin del foreach de localizacion
                            //borrando variables
                            $value5->delete();
                        }//fin del foreach del variables
                    }
                }
                ProyectoAccionEspecifica::findOne($value2->id)->delete();
            }//fin del for de buscar acciones especificas
            
        }//fin de buscar acciones especificas

        //eliminado el proyecto
        if(Proyecto::findOne($this->id)->delete())
        {
            return true;
        }
        else
        {
            return false;
        }
        
    }

}
