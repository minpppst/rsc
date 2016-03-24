<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ProyectoRegistrador;

/**
 * ProyectoRegistradorSearch represents the model behind the search form about `app\models\ProyectoRegistrador`.
 */
class ProyectoRegistradorSearch extends ProyectoRegistrador
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cedula', 'id_proyecto'], 'integer'],
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
        $query = ProyectoRegistrador::find();

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
            'id_proyecto' => $this->id_proyecto,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'telefono', $this->telefono]);

        return $dataProvider;
    }
}
