<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\AccionCentralizadaAsignar;

/**
 * ProyectoAsignarSearch represents the model behind the search form about `app\models\ProyectoAsignar`.
 */
class AccionCentralizadaAsignarSearch extends ProyectoAsignar
{
    //variables
    public $nombreUe;
    public $nombreAe;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'usuario', 'unidad_ejecutora', 'accion_especifica'], 'integer'],
            [['nombreUe', 'nombreAe'], 'safe']
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
        $query = AccionCentralizadaAsignar::find();
        // Join para la relacion
        $query->joinWith(['unidadEjecutora']);
        $query->joinWith(['accionEspecifica']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        //Ordenamiento
        $dataProvider->sort->attributes['nombreUe'] = [
            'asc' => ['unidad_ejecutora.nombre' => SORT_ASC],
            'desc' => ['unidad_ejecutora.nombre' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['nombreAe'] = [
            'asc' => ['accion_centralizada_accion_especifica.nombre' => SORT_ASC],
            'desc' => ['accion_centralizada_accion_especifica.nombre' => SORT_DESC],
        ];


        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'usuario' => $this->usuario,
            'unidad_ejecutora' => $this->unidad_ejecutora,
            'accion_especifica' => $this->accion_especifica,            
        ]);

        $query->andFilterWhere(['accion_centralizada_asignar.estatus' => $this->estatus]);
        $query->andFilterWhere(['like', 'unidad_ejecutora.nombre', $this->nombreUe]);
        $query->andFilterWhere(['like', 'accion_centralizada_accion_especifica.nombre', $this->nombreAe]);

        return $dataProvider;
    }
}
