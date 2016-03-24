<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Proyecto;

/**
 * ProyectoSearch represents the model behind the search form about `app\models\Proyecto`.
 */
class ProyectoSearch extends Proyecto
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'estatus_proyecto', 'situacion_presupuestaria', 'sub_sector', 'plan_operativo', 'objetivo_general'], 'integer'],
            [['codigo_proyecto', 'codigo_sne', 'nombre', 'fecha_inicio', 'fecha_fin', 'descripcion'], 'safe'],
            [['monto_proyecto'], 'number'],
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
        $query = Proyecto::find();

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
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin,
            'estatus_proyecto' => $this->estatus_proyecto,
            'situacion_presupuestaria' => $this->situacion_presupuestaria,
            'monto_proyecto' => $this->monto_proyecto,
            'sub_sector' => $this->sub_sector,
            'plan_operativo' => $this->plan_operativo,
            'objetivo_general' => $this->objetivo_general,
        ]);

        $query->andFilterWhere(['like', 'codigo_proyecto', $this->codigo_proyecto])
            ->andFilterWhere(['like', 'codigo_sne', $this->codigo_sne])
            ->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion]);

        return $dataProvider;
    }
}
