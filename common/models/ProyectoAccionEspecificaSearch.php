<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ProyectoAccionEspecifica;

/**
 * ProyectoAccionEspecificaSearch represents the model behind the search form about `app\models\ProyectoAccionEspecifica`.
 */
class ProyectoAccionEspecificaSearch extends ProyectoAccionEspecifica
{
    //variables
    public $nombreUnidadEjecutora;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_proyecto', 'id_unidad_ejecutora'], 'integer'],
            [['codigo_accion_especifica', 'nombre', 'nombreUnidadEjecutora', 'fecha_inicio', 'fecha_fin'], 'safe'],
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
        $query = ProyectoAccionEspecifica::find();
        // Join para la relacion
        $query->joinWith(['idUnidadEjecutora']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        //Ordenamiento
        $dataProvider->sort->attributes['nombreUnidadEjecutora'] = [
            'asc' => ['unidad_ejecutora.nombre' => SORT_ASC],
            'desc' => ['unidad_ejecutora.nombre' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'proyecto_accion_especifica.id' => $this->id,
            'id_proyecto' => $this->id_proyecto,
            'id_unidad_ejecutora' => $this->id_unidad_ejecutora,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin,
        ]);

        $query->andFilterWhere(['like', 'codigo_accion_especifica', $this->codigo_accion_especifica])
            ->andFilterWhere(['like', 'nombre', $this->nombre]);
        $query->andFilterWhere(['like','unidad_ejecutora.nombre',$this->nombreUnidadEjecutora]);

        return $dataProvider;
    }
}
