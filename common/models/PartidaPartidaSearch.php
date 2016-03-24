<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PartidaRamo;

/**
 * PartidaRamoSearch represents the model behind the search form about `app\models\PartidaRamo`.
 */
class PartidaPartidaSearch extends PartidaPartida
{
    public $numeroCuenta;
    public $nombreEstatus;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cuenta', 'partida', 'estatus'], 'integer'],
            [['nombre', 'numeroCuenta', 'nombreEstatus'], 'safe'],
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
        $query = PartidaPartida::find();
        // Join para la relacion
        $query->joinWith(['cuentaPresupuestaria']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        //Ordenamiento
        $dataProvider->sort->attributes['numeroCuenta'] = [
            'asc' => ['cuenta_presupuestaria.cuenta' => SORT_ASC],
            'desc' => ['cuenta_presupuestaria.cuenta' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'cuenta' => $this->cuenta,
            'partida' => $this->partida,
            'estatus' => $this->estatus,
        ]);

        $query->andFilterWhere(['estatus' => $this->nombreEstatus]);
        $query->andFilterWhere(['like', 'nombre', $this->nombre]);
        $query->andFilterWhere(['cuenta_presupuestaria.cuenta' => $this->numeroCuenta]);

        return $dataProvider;
    }
}
