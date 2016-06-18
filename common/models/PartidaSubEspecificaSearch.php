<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PartidaSubEspecifica;

/**
 * SeSearch represents the model behind the search form about `app\models\Se`.
 */
class PartidaSubEspecificaSearch extends PartidaSubEspecifica
{
    public $nombreEstatus;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cuenta', 'partida', 'generica', 'especifica', 'subespecifica', 'estatus'], 'integer'],
            [['nombre', 'nombreEstatus'], 'safe'],
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
        $query = PartidaSubEspecifica::find();

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
            'cuenta' => $this->cuenta,
            'partida' => $this->partida,
            'generica' => $this->generica,
            'especifica' => $this->especifica,
            'subespecifica' => $this->subespecifica,
            'estatus' => $this->estatus,
        ]);

        $query->andFilterWhere(['estatus' => $this->nombreEstatus]);
        $query->andFilterWhere(['like', 'nombre', $this->nombre]);

        return $dataProvider;
    }
}
