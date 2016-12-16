<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ProyectoVariableDesbloqueoMes;

/**
 * ProyectoDesbloqueoMesSearch represents the model behind the search form about `backend\models\ProyectoVariableDesbloqueoMes`.
 */
class ProyectoDesbloqueoMesSearch extends ProyectoVariableDesbloqueoMes
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_ejecucion', 'mes'], 'integer'],
            [['fecha_creacion', 'fecha_modificacion'], 'safe'],
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
        $query = ProyectoVariableDesbloqueoMes::find();

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
            'id_ejecucion' => $this->id_ejecucion,
            'mes' => $this->mes,
            'fecha_creacion' => $this->fecha_creacion,
            'fecha_modificacion' => $this->fecha_modificacion,
        ]);

        return $dataProvider;
    }
}
