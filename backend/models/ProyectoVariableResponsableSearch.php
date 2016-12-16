<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ProyectoVariableResponsable;

/**
 * ProyectoVariableResponsableSearch represents the model behind the search form about `backend\models\ProyectoVariableResponsable`.
 */
class ProyectoVariableResponsableSearch extends ProyectoVariableResponsable
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cedula', 'oficina', 'id_variable'], 'integer'],
            [['nombre', 'email', 'telefono'], 'safe'],
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
        $query = ProyectoVariableResponsable::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'cedula' => $this->cedula,
            'oficina' => $this->oficina,
            'id_variable' => $this->id_variable,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'telefono', $this->telefono]);

        return $dataProvider;
    }
}
