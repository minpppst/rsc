<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\AccionCentralizadaAsignar;

/**
 * ProyectoAsignarSearch represents the model behind the search form about `app\models\ProyectoAsignar`.
 */
class AccionCentralizadaAsignarSearch extends AccionCentralizadaAsignar
{
    //variables
    public $nombreUe;
    public $nombreAe;
    public $accion_especifica_ue0;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'usuario'], 'integer'],
            [['accion_especifica_ue0'], 'safe']
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
        //$query->joinWith(['unidadEjecutora']);
        $query->joinWith(['accion_centralizada_ac_especifica_uej']);
        //$query->joinWith(['accion_centralizada_accion_especifica', 'accion_centralizada_ac_especifica_uej.id_ac_esp=accion_centralizada_accion_especifica.id']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        //Ordenamiento
        /*$dataProvider->sort->attributes['nombreUe'] = [
            'asc' => ['unidad_ejecutora.nombre' => SORT_ASC],
            'desc' => ['unidad_ejecutora.nombre' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['nombreAe'] = [
            'asc' => ['accion_centralizada_accion_especifica.nombre' => SORT_ASC],
            'desc' => ['accion_centralizada_accion_especifica.nombre' => SORT_DESC],
        ];
        */

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'usuario' => $this->usuario,
           // 'unidad_ejecutora' => $this->unidad_ejecutora,
           // 'accion_especifica' => $this->accion_especifica,            
        ]);

        $query->andFilterWhere(['accion_centralizada_asignar.estatus' => $this->estatus]);
        $query->andFilterWhere(['accion_centralizada_ac_especifica_uej.aprobado' => 0]);

        //$query->andFilterWhere(['like', 'unidad_ejecutora.nombre', $this->nombreUe]);
        //$query->andFilterWhere(['like', 'accion_centralizada_accion_especifica.nombre', $this->nombreAe]);

        return $dataProvider;
    }
}
