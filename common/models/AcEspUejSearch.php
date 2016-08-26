<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\AcEspUej;

/**
 * AcEspUejSearch represents the model behind the search form about `app\models\AcEspUej`.
 */
class AcEspUejSearch extends AcEspUej
{

    public $nombre_central;
    public $nombre_acc;
    public $nombre_ue;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_ue', 'id_ac_esp'], 'integer'],
            [['nombre_central', 'nombre_acc', 'nombre_ue'], 'safe'],
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
        $query = AcEspUej::find();
        $query->joinWith(['idAccionEspecifica.idAcCentr','idAccionEspecifica','idUe']);
        

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
            'id_ue' => $this->id_ue,
            'id_ac_esp' => $this->id_ac_esp,
        ]);

        //Ordenamiento
        $dataProvider->sort->attributes['nombre_central'] = [
            'asc' => ['accion_centralizada.nombre_accion' => SORT_ASC],
            'desc' => ['accion_centralizada.nombre_accion' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['nombre_acc'] = [
            'asc' => ['accion_centralizada_accion_especifica.nombre' => SORT_ASC],
            'desc' => ['accion_centralizada_accion_especifica.nombre' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['nombre_ue'] = [
            'asc' => ['unidad_ejecutora.nombre' => SORT_ASC],
            'desc' => ['unidad_ejecutora.nombre' => SORT_DESC],
        ];

        $query->andFilterWhere(['like', 'accion_centralizada.nombre_accion', $this->nombre_central]);
        $query->andFilterWhere(['like', 'accion_centralizada_accion_especifica.nombre', $this->nombre_acc]);
        $query->andFilterWhere(['like', 'unidad_ejecutora.nombre', $this->nombre_ue]);

        return $dataProvider;
    }
}
