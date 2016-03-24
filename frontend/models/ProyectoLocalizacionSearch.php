<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ProyectoLocalizacion;

/**
 * ProyectoLocalizacionSearch represents the model behind the search form about `app\models\ProyectoLocalizacion`.
 */
class ProyectoLocalizacionSearch extends ProyectoLocalizacion
{
    //variables
    public $nombrePais; 
    public $nombreEstado;
    public $nombreMunicipio;
    public $nombreParroquia;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_proyecto', 'id_pais', 'id_estado', 'id_municipio', 'id_parroquia'], 'integer'],
            [['nombrePais', 'nombreEstado', 'nombreMunicipio', 'nombreParroquia'],'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = ProyectoLocalizacion::find();
        // Join para la relacion
        $query->joinWith(['idPais']);
        $query->joinWith(['idEstado']);
        $query->joinWith(['idMunicipio']);
        $query->joinWith(['idParroquia']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        //Ordenamiento
        $dataProvider->sort->attributes['nombrePais'] = [
            'asc' => ['pais.nombre' => SORT_ASC],
            'desc' => ['pais.nombre' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['nombreEstado'] = [
            'asc' => ['estados.nombre' => SORT_ASC],
            'desc' => ['estados.nombre' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['nombreMunicipio'] = [
            'asc' => ['municipio.nombre' => SORT_ASC],
            'desc' => ['municipio.nombre' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['nombreParroquia'] = [
            'asc' => ['parroquia.nombre' => SORT_ASC],
            'desc' => ['parroquia.nombre' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,            
            'id_proyecto' => $this->id_proyecto,
            'id_pais' => $this->id_pais,
            'id_estado' => $this->id_estado,
            'id_municipio' => $this->id_municipio,
            'id_parroquia' => $this->id_parroquia,
        ]);
        //Filtros adicionales
        $query->andFilterWhere(['like','pais.nombre',$this->nombrePais]);
        $query->andFilterWhere(['like','estados.nombre',$this->nombreEstado]);
        $query->andFilterWhere(['like','municipio.nombre',$this->nombreMunicipio]);
        $query->andFilterWhere(['like','parroquia.nombre',$this->nombreParroquia]);

        return $dataProvider;
    }
}
