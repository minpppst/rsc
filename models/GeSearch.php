<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Ge;

/**
 * GeSearch represents the model behind the search form about `app\models\Ge`.
 */
class GeSearch extends Ge
{
    public $codigoPartida;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_partida', 'codigo_ge', 'estatus'], 'integer'],
            [['nombre_ge', 'codigoPartida'], 'safe'],
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
        $query = Ge::find();
        // Join para la relacion
        $query->joinWith(['idPartida']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        //Ordenamiento
        $dataProvider->sort->attributes['codigoPartida'] = [
            'asc' => ['partida.partida' => SORT_ASC],
            'desc' => ['partida.partida' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'id_partida' => $this->id_partida,
            'codigo_ge' => $this->codigo_ge,
            'estatus' => $this->estatus,
        ]);

        $query->andFilterWhere(['like', 'nombre_ge', $this->nombre_ge]);
        $query->andFilterWhere(['partida.partida' => $this->codigoPartida]);

        return $dataProvider;
    }
}
