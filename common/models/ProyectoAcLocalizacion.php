<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "proyecto_ac_localizacion".
 *
 * @property integer $id
 * @property integer $id_proyecto_ac
 * @property integer $id_pais
 * @property integer $id_estado
 * @property integer $id_municipio
 * @property integer $id_parroquia
 *
 * @property ProyectoAccionEspecifica $idProyectoAc
 */
class ProyectoAcLocalizacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'proyecto_ac_localizacion';
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
     //Escenarios
    const SCENARIO_INTERNACIONAL = 'Internacional';
    const SCENARIO_REGIONAL = 'Regional';
    const SCENARIO_COMUNAL = 'Comunal';
    const SCENARIO_OTROS = 'Otros';
    const SCENARIO_NACIONAL = 'Nacional';
    const SCENARIO_ESTADAL = 'Estadal';
    const SCENARIO_MUNICIPAL = 'Municipal';
    const SCENARIO_PARROQUIAL = 'Parroquial';

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return [
            self::SCENARIO_INTERNACIONAL => ['id_proyecto_ac', 'id_pais'],
            self::SCENARIO_REGIONAL => ['id_proyecto', 'id_pais'],
            self::SCENARIO_COMUNAL => ['id_proyecto', 'id_pais'],
            self::SCENARIO_OTROS => ['id_proyecto', 'id_pais'],
            self::SCENARIO_NACIONAL => ['id_proyecto_ac', 'id_pais'],
            self::SCENARIO_ESTADAL => ['id_proyecto_ac', 'id_pais', 'id_estado'],
            self::SCENARIO_MUNICIPAL => ['id_proyecto_ac', 'id_pais', 'id_estado', 'id_municipio'],
            self::SCENARIO_PARROQUIAL => ['id_proyecto_ac', 'id_pais', 'id_estado', 'id_municipio', 'id_parroquia'],
        ];
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_proyecto_ac', 'id_pais', 'id_estado', 'id_municipio', 'id_parroquia'], 'required'],
            [['id_proyecto_ac', 'id_pais', 'id_estado', 'id_municipio', 'id_parroquia'], 'integer'],
            [['id_proyecto_ac'], 'exist', 'skipOnError' => true, 'targetClass' => ProyectoAccionEspecifica::className(), 'targetAttribute' => ['id_proyecto_ac' => 'id']],
            //Escenarios
            [['id_proyecto', 'id_pais'], 'required', 'on' => self::SCENARIO_INTERNACIONAL],
            [['id_proyecto', 'id_pais'], 'required', 'on' => self::SCENARIO_NACIONAL],
            [['id_proyecto', 'id_pais', 'id_estado'], 'required', 'on' => self::SCENARIO_ESTADAL],
            [['id_proyecto', 'id_pais', 'id_estado', 'id_municipio'], 'required', 'on' => self::SCENARIO_MUNICIPAL],
            [['id_proyecto', 'id_pais', 'id_estado', 'id_municipio', 'id_parroquia'], 'required', 'on' => self::SCENARIO_PARROQUIAL],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_proyecto_ac' => 'Id Proyecto Ac',
            'id_pais' => 'Id Pais',
            'id_estado' => 'Id Estado',
            'id_municipio' => 'Id Municipio',
            'id_parroquia' => 'Id Parroquia',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdProyectoAc()
    {
        return $this->hasOne(ProyectoAccionEspecifica::className(), ['id' => 'id_proyecto_ac']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPais()
    {
        return $this->hasOne(Pais::className(), ['id' => 'id_pais']);
    }

    /**
     * @return string
     */
    public function getNombrePais()
    {
        if($this->idPais=="")
        {
            return null;
        }
        return $this->idPais->nombre;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdMunicipio()
    {
        return $this->hasOne(Municipio::className(), ['id' => 'id_municipio']);
    }

    /**
     * @return string
     */
    public function getNombreMunicipio()
    {
        
        if($this->idMunicipio=="")
        {
            return null;
        }
        return $this->idMunicipio->nombre;
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdEstado()
    {
        return $this->hasOne(Estados::className(), ['id' => 'id_estado']);
    }

    /**
     * @return string
     */
    public function getNombreEstado()
    {
        if($this->idEstado=="")
        {
            return null;
        }
        return $this->idEstado->nombre;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdParroquia()
    {
        return $this->hasOne(Parroquia::className(), ['id' => 'id_parroquia']);
    }
    /**
     * @return string
     */
    public function getNombreParroquia()
    {   
        if($this->idParroquia=="")
        {
            return null;
        }
        return $this->idParroquia->nombre;
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAeMeta()
    {
        return $this->hasOne(ProyectoAeMeta::className(), ['id_proyecto_ac_localizacion' => 'id']);
    }
    /**
     * Obtener la meta física.
     * @return int Meta de la acción específica
     */
    public function getMeta()
    {
        //Calcular la meta
        $meta = Yii::$app->db->createCommand("
            SELECT SUM(
                enero +
                febrero +
                marzo +
                abril +
                mayo +
                junio +
                julio +
                agosto +
                septiembre +
                octubre +
                noviembre +
                diciembre
            ) AS 'total'
            FROM
                proyecto_ae_meta
            WHERE
                id_proyecto_ac_localizacion = :proyecto_ac_localizacion", 
            [':proyecto_ac_localizacion' => $this->id])
        ->queryScalar();

        return $meta;
    }

     /**
     * funcion para encontrar las ubicaciones del proyecto asociado y mostrarlos en la acciones especifica
     * integer $proyecto
     * string $pais,$estado,$municipio
     * @return array de localizaciones
     */
    public function localizar($proyecto, $pais=NULL, $estado=NULL, $municipio=Null, $parroquia=NULL, $arreglo=NULL)
    {
        
        switch ($this->scenario) 
        {
            case 'Estadal':

                if($pais!=NULL)
                {
                    $buscar = ProyectoLocalizacion::find()
                    ->select(['id_pais','nombre as nombre'])
                    ->innerJoinWith('idPais', 'idPais.id=id_pais')
                    ->andwhere(['id_proyecto' =>$proyecto])
                    ->All();
                    foreach ($buscar as $key ) 
                    {
                        
                        $pais1[$key->id_pais]=$key->idPais->nombre;
                    }
                    
                    if(isset($pais1))
                    {
                        return $pais1;
                    }
                    else
                    {
                        return [];
                    }
                }
                else
                {
                    $buscar = ProyectoLocalizacion::find()
                    ->select(['id_estado','nombre as nombre'])
                    ->innerJoinWith('idEstado', 'idEestado.id=id_estado')
                    ->andwhere(['id_proyecto' =>$proyecto])
                    ->all();
                    foreach ($buscar as $key ) 
                    {
                        
                        $estados[$key->id_estado]=$key->idEstado->nombre;
                    }
                    
                    if(isset($estados))
                    {
                        return $estados;
                    }
                    else
                    {
                        return [];    
                    }
                    
                }

            break;

            case 'Municipal':

                if($pais!=NULL)
                {
                    $buscar = ProyectoLocalizacion::find()
                    ->select(['id_pais','nombre as nombre'])
                    ->innerJoinWith('idPais', 'idPais.id=id_pais')
                    ->andwhere(['id_proyecto' =>$proyecto])
                    ->All();
                    foreach ($buscar as $key ) 
                    {
                        
                        $pais1[$key->id_pais]=$key->idPais->nombre;
                    }
                    
                    if(isset($pais1))
                    {
                        return $pais1;
                    }
                    else
                    {
                        return [];
                    }
                }

                if($estado!=NULL)
                {
                    $buscar = ProyectoLocalizacion::find()
                    ->select(['id_estado','nombre as nombre'])
                    ->innerJoinWith('idEstado', 'idEestado.id=id_estado')
                    ->andwhere(['id_proyecto' =>$proyecto])
                    ->all();
                    foreach ($buscar as $key ) 
                    {
                        
                        $estados[$key->id_estado]=$key->idEstado->nombre;
                    }
                    
                    if(isset($estados))
                    {
                        return $estados;
                    }
                    else
                    {
                        return [];    
                    }
                    
                }

                if($municipio!=NULL)
                {
                    $buscar = ProyectoLocalizacion::find()
                    ->select(['concat(municipio.id_estado,"-",municipio.id) as id_municipio','municipio.nombre as nombre'])
                    ->innerJoinWith('idMunicipio', 'idMunicipio.id=id_municipio')
                    ->andwhere(['id_proyecto' =>$proyecto])
                    ->andwhere(['in', 'proyecto_localizacion.id_estado', $arreglo])
                    ->AsArray()
                    ->all();
                    
                    foreach ($buscar as $key )
                    {
                        
                        $municipios[$key['id_municipio']]=$key['nombre'];
                    }
                    
                    if(isset($municipios))
                    {
                        return $municipios;
                    }
                    else
                    {
                        return [];    
                    }
                    
                }

            break;

            case 'Parroquial':

                if($pais!=NULL)
                {
                    $buscar = ProyectoLocalizacion::find()
                    ->select(['id_pais','nombre as nombre'])
                    ->innerJoinWith('idPais', 'idPais.id=id_pais')
                    ->andwhere(['id_proyecto' =>$proyecto])
                    ->All();
                    foreach ($buscar as $key ) 
                    {
                        
                        $pais1[$key->id_pais]=$key->idPais->nombre;
                    }
                    
                    if(isset($pais1))
                    {
                        return $pais1;
                    }
                    else
                    {
                        return [];
                    }
                }

                if($estado!=NULL)
                {
                    $buscar = ProyectoLocalizacion::find()
                    ->select(['id_estado','nombre as nombre'])
                    ->innerJoinWith('idEstado', 'idEestado.id=id_estado')
                    ->andwhere(['id_proyecto' =>$proyecto])
                    ->all();
                    foreach ($buscar as $key ) 
                    {
                        
                        $estados[$key->id_estado]=$key->idEstado->nombre;
                    }
                    
                    if(isset($estados))
                    {
                        return $estados;
                    }
                    else
                    {
                        return [];    
                    }
                    
                }

                if($municipio!=NULL)
                {
                    //arreglo viene concatenado con estado y municipio


                    $buscar = ProyectoLocalizacion::find()
                    ->select(['concat(municipio.id_estado,"-",municipio.id) as id_municipio','municipio.nombre as nombre'])
                    ->innerJoinWith('idMunicipio', 'idMunicipio.id=id_municipio')
                    ->andwhere(['id_proyecto' =>$proyecto])
                    ->andwhere(['in', 'proyecto_localizacion.id_estado', $arreglo])
                    ->AsArray()
                    ->all();
                    
                    foreach ($buscar as $key )
                    {
                        
                        $municipios[$key['id_municipio']]=$key['nombre'];
                    }
                    
                    if(isset($municipios))
                    {
                        return $municipios;
                    }
                    else
                    {
                        return [];    
                    }
                    
                }

                if($parroquia!=NULL)
                {
                    //el arreglo viene estado con municipio hay que separarlo

                    if($arreglo!=NULL)
                    {
                        foreach ($arreglo as $key => $value) 
                        {
                            if($value!=NULL)
                            {
                                $valor=explode("-", $value);
                                $municipio[]=$valor[1];
                                $valor="";
                            }
                        }
                    }
                    

                    $buscar = ProyectoLocalizacion::find()
                    ->select(['concat(proyecto_localizacion.id_estado,"-",parroquia.id_municipio,"-",parroquia.id) as id_parroquia','parroquia.nombre as nombre'])
                    ->innerJoinWith('idParroquia', 'idParroquia.id=id_parroquia')
                    ->andwhere(['id_proyecto' =>$proyecto])
                    ->andwhere(['in', 'proyecto_localizacion.id_municipio', $municipio])
                    ->AsArray()
                    ->all();
                    
                    foreach ($buscar as $key )
                    {
                        
                        $parroquias[$key['id_parroquia']]=$key['nombre'];
                    }
                    
                    if(isset($parroquias))
                    {
                        return $parroquias;
                    }
                    else
                    {
                        return [];    
                    }
                    
                }

            break;
            
            default:
                $buscar = ProyectoLocalizacion::find()
                ->select(['id_pais','nombre as nombre'])
                ->innerJoinWith('idPais', 'idPais.id=id_pais')
                ->andwhere(['id_proyecto' =>$proyecto])
                ->All();
                if($buscar!=NULL)
                {
                    foreach ($buscar as $key => $value ) 
                    {   
                        
                        $pais[$value->id_pais]=$value->idPais->nombre;
                    }
                    return $pais;
                }
                else
                {
                    return [];

                };

            break;
                
        }

    }

    /**
    *Se guarda las localizaciones, esto es el el create de accion especifica
    *$params array
    *return boolean
    **/
    public function GuardarLocalizacion($params)
    {
        switch ($this->scenario) 
        {
            case 'Estadal':
                //Verificamos que existan estados que guardar
                if(isset($params['id_estado']) && $params['id_estado']!="")
                {
                    foreach ($params['id_estado'] as $key )
                    {
                        $model=new ProyectoAcLocalizacion;
                        $model->scenario='Estadal';
                        $model->id_proyecto_ac=$this->id_proyecto_ac;
                        $model->id_pais=$this->id_pais;
                        $model->id_estado=$key;
                        if(!$model->save())
                        {
                            return false;
                            exit();
                        }
                    };
                    return true;
                }
                else
                {
                    return false;
                }


            break;
            
            case 'Municipal':
                //Verificamos que existan Municipios que guardar
                if(isset($params['ProyectoAcLocalizacion']['id_municipio']) && $params['ProyectoAcLocalizacion']['id_municipio']!="")
                {
                    
                    foreach($params['ProyectoAcLocalizacion']['id_municipio'] as $key)
                    {
                    
                        $model=new ProyectoAcLocalizacion;
                        $model->scenario='Municipal';
                        $model->id_proyecto_ac=$this->id_proyecto_ac;
                        $model->id_pais=$this->id_pais;
                        //el id de municipio viene concatenado con el estado por lo q se hace un explode
                        $valores=explode("-", $key);
                        $model->id_estado=$valores[0];
                        $model->id_municipio=$valores[1];
                        if(!$model->save())
                        {
                            return false;
                            exit();
                        }
                    };
                    return true;
                }
                else
                {
                    return false;
                }


            break;

            case 'Parroquial':
                //Verificamos que existan Municipios que guardar
                if(isset($params['ProyectoAcLocalizacion']['id_municipio']) && $params['ProyectoAcLocalizacion']['id_parroquia']!="")
                {
                    
                    foreach($params['ProyectoAcLocalizacion']['id_parroquia'] as $key)
                    {
                    
                        $model=new ProyectoAcLocalizacion;
                        $model->scenario='Municipal';
                        $model->id_proyecto_ac=$this->id_proyecto_ac;
                        $model->id_pais=$this->id_pais;
                        //el id de parroquia viene concatenado con el estado y muncipio por lo q se hace un explode
                        $valores=explode("-", $key);
                        $model->id_estado=$valores[0];
                        $model->id_municipio=$valores[1];
                        $model->id_parroquia=$valores[2];
                        if(!$model->save())
                        {
                            return false;
                            exit();
                        }
                    };
                    return true;
                }
                else
                {
                    return false;
                }


            break;

            default:
            
                //ya se almaceno el pais en objeto por lo que solo hay que guardar
                if($this->save())
                {
                    return true;
                }
                else
                {
                    return false;
                }

            break;
        }
    }

    /*
    *Permite Agregar/Borrar las localizacion del combo select2 se da en el update de la accionespecifica
    * array $params
    * int $accion, $pais
    * string $scenario
    */
     function modificarLocalizacion($params,$accion,$scenario, $pais)
     {

        //verificamos el scenario
        switch ($scenario) 
        {
            case 'Estadal':
                
                if(!isset($params['id_estado']) || $params['id_estado']==null )
                {
                    $params['id_estado']=[];
                }
                //verificamos si esos id estaban
                $ace = ProyectoAcLocalizacion::find()
                ->select('id')
                ->where(['id_proyecto_ac' => $accion])
                ->andwhere(['not in', 'id_estado', $params['id_estado']])
                ->asArray()
                ->all();
                //si encontró algo deben ser eliminados
                if($ace!=null)
                {
                    foreach ($ace as $key => $value) 
                    {
                        $model_cambiar= ProyectoAcLocalizacion::findOne($value);
                        if(!$model_cambiar->delete())
                        {
                            return false;
                        }
                        

                    }
                }
                /*
                Ya se borraron ahora query para buscar si agregaron una unidad nueva,
                si es asi almacenar y guardar
                */
                $ace = ProyectoAcLocalizacion::find()
                        ->select('id_estado')
                        ->where(['id_proyecto_ac' => $accion])
                        ->andwhere(['in', 'id_estado', $params['id_estado']])
                        ->asArray()
                        ->all();
                /*
                Declaro arreglo donde se guardará los nuevos elementos agregados
                */
                $tabla[]=null;
                foreach ($ace as $key => $value) 
                {
                    $tabla[]=$value['id_estado'];
                };
                
                /*
                Guardo en $nuevo los elementos nuevos que se han agregado.
                */
                $nuevo=array_diff($params['id_estado'], $tabla);
                //se almacenan los elementos nuevos            
                foreach ($nuevo as $key => $value) 
                {
                    if($value!="")
                    {
                        $model2=new ProyectoAcLocalizacion;
                        $model2->id_pais=$pais;
                        $model2->scenario=$scenario;
                        $model2->id_proyecto_ac=$accion;
                        $model2->id_estado=$value;
                        if(!$model2->save())
                        {
                            return false;
                        }
                    }
                    
                };
                
                return true;

            break;
        
            case "Municipal":

                if(!isset($params['ProyectoAcLocalizacion']['id_municipio']) || $params['ProyectoAcLocalizacion']['id_municipio']==null )
                {
                    $params['ProyectoAcLocalizacion']['id_municipio']=[];
                    $municipio=[];
                }
                else
                {
                    
                    //el id de municipio viene concatenado con el estado por lo q se hace un explode
                    $i=0;
                     foreach($params['ProyectoAcLocalizacion']['id_municipio'] as $key)
                    {   
                        $valores=explode("-", $key);
                        $estado[$i]=$valores[0];
                        $municipio[$i]=$valores[1];
                        $i++;
                    }
                }
                //verificamos si esos id estaban
                $ace = ProyectoAcLocalizacion::find()
                ->select('id')
                ->where(['id_proyecto_ac' => $accion])
                ->andwhere(['not in', 'id_municipio', $municipio])
                ->asArray()
                ->all();
                //si encontró algo deben ser eliminados
                if($ace!=null)
                {
                    foreach ($ace as $key => $value) 
                    {
                        $model_cambiar= ProyectoAcLocalizacion::findOne($value);
                        if(!$model_cambiar->delete())
                        {
                            return false;
                        }
                        

                    }
                }
                /*
                Ya se borraron ahora query para buscar si agregaron una unidad nueva,
                si es asi almacenar y guardar
                */
                $ace = ProyectoAcLocalizacion::find()
                        ->select(['concat(id_estado , "-" , id_municipio) as id_municipio'])
                        ->where(['id_proyecto_ac' => $accion])
                        ->andwhere(['in', 'id_municipio', $municipio])
                        ->asArray()
                        ->all();
                /*
                Declaro arreglo donde se guardará los nuevos elementos agregados
                */
                $tabla[]=null;
                foreach ($ace as $key => $value) 
                {
                    $tabla[]=$value['id_municipio'];
                };
                
                /*
                Guardo en $nuevo los elementos nuevos que se han agregado.
                */
                $nuevo=array_diff($params['ProyectoAcLocalizacion']['id_municipio'], $tabla);
                //se almacenan los elementos nuevos
                foreach ($nuevo as $key => $value)
                {
                    if($value!="")
                    {
                        $model2=new ProyectoAcLocalizacion;
                        $model2->id_pais=$pais;
                        $model2->scenario=$scenario;
                        $model2->id_proyecto_ac=$accion;
                        $valor=explode("-",$value);
                        $model2->id_estado=$valor[0];
                        $model2->id_municipio=$valor[1];
                        $valor="";
                        if(!$model2->save())
                        {
                            return false;
                        }
                    }
                    
                };
                
                return true;

            break;

            case "Parroquial":

                if(!isset($params['ProyectoAcLocalizacion']['id_parroquia']) || $params['ProyectoAcLocalizacion']['id_parroquia']==null )
                {
                    $params['ProyectoAcLocalizacion']['id_parroquia']=[];
                    $parroquia=[];
                }
                else
                {
                    
                    //el id de municipio viene concatenado con el estado por lo q se hace un explode
                    $i=0;
                     foreach($params['ProyectoAcLocalizacion']['id_parroquia'] as $key)
                    {   
                        $valores=explode("-", $key);
                        $parroquia[$i]=$valores[2];
                        $i++;
                    }
                }
                //verificamos si esos id estaban
                $ace = ProyectoAcLocalizacion::find()
                ->select('id')
                ->where(['id_proyecto_ac' => $accion])
                ->andwhere(['not in', 'id_parroquia', $parroquia])
                ->asArray()
                ->all();
                //si encontró algo deben ser eliminados
                if($ace!=null)
                {
                    foreach ($ace as $key => $value) 
                    {
                        $model_cambiar= ProyectoAcLocalizacion::findOne($value);
                        if(!$model_cambiar->delete())
                        {
                            return false;
                        }
                        

                    }
                }
                /*
                Ya se borraron ahora query para buscar si agregaron una unidad nueva,
                si es asi almacenar y guardar
                */
                $ace = ProyectoAcLocalizacion::find()
                        ->select(['concat(id_estado , "-" , id_municipio, "-", id_parroquia) as id_parroquia'])
                        ->where(['id_proyecto_ac' => $accion])
                        ->andwhere(['in', 'id_parroquia', $parroquia])
                        ->asArray()
                        ->all();
                /*
                Declaro arreglo donde se guardará los nuevos elementos agregados
                */
                $tabla[]=null;
                foreach ($ace as $key => $value) 
                {
                    $tabla[]=$value['id_parroquia'];
                };
                
                /*
                Guardo en $nuevo los elementos nuevos que se han agregado.
                */
                $nuevo=array_diff($params['ProyectoAcLocalizacion']['id_parroquia'], $tabla);
                //se almacenan los elementos nuevos
                foreach ($nuevo as $key => $value)
                {
                    if($value!="")
                    {
                        $model2=new ProyectoAcLocalizacion;
                        $model2->id_pais=$pais;
                        $model2->scenario=$scenario;
                        $model2->id_proyecto_ac=$accion;
                        $valor=explode("-",$value);
                        $model2->id_estado=$valor[0];
                        $model2->id_municipio=$valor[1];
                        $model2->id_parroquia=$valor[2];
                        $valor="";
                        if(!$model2->save())
                        {
                            return false;
                        }
                    }
                    
                };
                
                return true;

            break;

            default :

            return true;

            break;
        };
      
        
    }

    /*
    **obtiene los estados, parroquia y municipios de la accion especifica
    **@integer $id
    **@return array or null
    */
    public function ObtenerLocalizaciones($id)
    {
        
        $localizaciones=ProyectoAcLocalizacion::find()
        ->select(['pais.nombre as pais', 'estados.nombre as estado', 'municipio.nombre as municipio', 'parroquia.nombre as parroquia'])
        ->leftJoin('pais', 'pais.id=id_pais')
        ->leftJoin('estados', 'estados.id=id_estado')
        ->leftJoin('municipio', 'municipio.id=id_municipio')
        ->leftJoin('parroquia', 'parroquia.id=id_parroquia')
        ->where(['id_proyecto_ac' => $id])
        ->groupBy(['pais.id','estados.id','municipio.id','parroquia.id'])
        ->asArray()
        ->all();
        if($localizaciones!=null)
        {
            return $localizaciones;
        }
        else
        {
            return null;
        }


    }

    /**
    *busca los municipios asociados a un id de estado
    *$estado integer
    *@return array 
    **/
    public function MunicipiosEstados($estado,$proyecto)
    {
        $buscar = ProyectoLocalizacion::find()
                    ->select(['concat(municipio.id_estado,"-",municipio.id) as id_municipio','municipio.nombre as name'])
                    ->innerJoinWith('idMunicipio', 'idMunicipio.id=id_municipio')
                    ->andwhere(['id_proyecto' =>$proyecto])
                    ->andwhere(['proyecto_localizacion.id_estado' =>$estado])
                    ->AsArray()
                    ->all();
                    
                    foreach ($buscar as $key )
                    {
                        
                        $municipios[]=['id' => $key['id_municipio'], 'name' => $key['name']];
                    }

                    
                    if(isset($municipios))
                    {
                        return $municipios;
                    }
                    else
                    {
                        return [];    
                    }
    }


    /**
    *busca las parroquiasasociados a un id de municipio
    *$municipio integer
    *@return array 
    **/
    public function ParroquiasMunicipios($municipio,$proyecto)
    {
        if($municipio!="")
        {
            foreach ($municipio as $key => $value) 
            {
                $valor=explode("-", $value);
                $municipio[]=$valor[1];
                $valor="";
            }
        }
        $buscar = ProyectoLocalizacion::find()
                    ->select(['concat(proyecto_localizacion.id_estado,"-",parroquia.id_municipio,"-",parroquia.id) as id_parroquia','parroquia.nombre as name'])
                    ->innerJoinWith('idParroquia', 'idParroquia.id=id_parroquia')
                    ->andwhere(['id_proyecto' =>$proyecto])
                    ->andwhere(['proyecto_localizacion.id_municipio' =>$municipio])
                    ->AsArray()
                    ->all();
                    
                    foreach ($buscar as $key )
                    {
                        
                        $parroquias[]=['id' => $key['id_parroquia'], 'name' => $key['name']];
                    }

                    
                    if(isset($parroquias))
                    {
                        return $parroquias;
                    }
                    else
                    {
                        return [];    
                    }
    }


}
