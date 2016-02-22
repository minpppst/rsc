<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ProyectoDistribucionPresupuestaria;

/**
 * ProyectoDistribucionPresupuestariaSearch represents the model behind the search form about `app\models\ProyectoDistribucionPresupuestaria`.
 */
class ProyectoDistribucionPresupuestariaSearch extends ProyectoDistribucionPresupuestaria
{
    //variables
    public $nombreAccionEspecifica;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_accion_especifica', 'id_partida'], 'integer'],
            [['cantidad'], 'number'],
            [['nombreAccionEspecifica'],'safe'],
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
        $query = ProyectoDistribucionPresupuestaria::find();
        // Join para la relacion
        $query->joinWith(['idAccionEspecifica']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        //Ordenamiento
        $dataProvider->sort->attributes['nombreAccionEspecifica'] = [
            'asc' => ['proyecto_accion_especifica.nombre' => SORT_ASC],
            'desc' => ['proyecto_accion_especifica.nombre' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'id_accion_especifica' => $this->id_accion_especifica,
            'id_partida' => $this->id_partida,
            'cantidad' => $this->cantidad,
        ]);
        $query->andFilterWhere(['like','accion_especifica.nombre',$this->nombreAccionEspecifica]);

        return $dataProvider;
    }
}
