<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\AccionCentralizadaAsignar;

/**
 * AccionCentralziadaAsignarSearch represents the model behind the search form about `app\models\AccionCentralziadaAsignar`.
 */
class AccionCentralizadaAsignarSearch extends AccionCentralizadaAsignar
{
    //variables
    public $nombreue; //unidad ejecutora
    public $nombreacc; //accion centralizada
    public $nombreacc_acc; //acciones especifica

    /**
     * @inheritdoc
     */
 
    public function rules()
    {
        return [
            [['id', 'usuario'], 'integer'],
            [['nombreacc','nombreacc_acc','nombreue'], 'safe']
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
        $query->joinWith(["accion_centralizada_ac_especifica_uej.idUe", "accion_centralizada_ac_especifica_uej.idAccionEspecifica", "accion_centralizada_ac_especifica_uej.idAccionEspecifica.idAcCentr"]);
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
            'usuario' => $this->usuario,
            
        ]);
        $dataProvider->sort->attributes['nombreacc'] = [
        'asc' => ['accion_centralizada.nombre_accion' => SORT_ASC],
        'desc' => ['accion_centralizada.nombre_accion' => SORT_DESC],
        ];
        
        $dataProvider->sort->attributes['nombreacc_acc'] = [
        'asc' => ['accion_centralizada_accion_especifica.nombre' => SORT_ASC],
        'desc' => ['accion_centralizada_accion_especifica.nombre' => SORT_DESC],
        ];
        
        $dataProvider->sort->attributes['nombreue'] = [
        'asc' => ['unidad_ejecutora.nombre.nombre' => SORT_ASC],
        'desc' => ['unidad_ejecutora.nombre.nombre' => SORT_DESC],
        ];

        $query->andFilterWhere(['like', 'accion_centralizada.nombre_accion', $this->nombreacc]);
        $query->andFilterWhere(['like', 'accion_centralizada_accion_especifica.nombre', $this->nombreacc_acc]);
        $query->andFilterWhere(['like', 'unidad_ejecutora.nombre', $this->nombreue]);
        return $dataProvider;
    }
}
