<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ProyectoUsuarioAsignar;

/**
 * ProyectoAsignarSearch represents the model behind the search form about `app\models\ProyectoAsignar`.
 */
class ProyectoUsuarioAsignarSearch extends ProyectoUsuarioAsignar
{
    public $aprobado;
    //variables
    public $nombreue; //unidad ejecutora
    public $nombreproyecto; //proyecto
    public $proyecto_acc; //acciones especifica
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'usuario_id', 'proyecto_id', 'accion_especifica_id', 'estatus'], 'integer'],
            [['nombreue', 'nombreproyecto', 'proyecto_acc', 'aprobado'], 'safe'],
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
        $query = ProyectoUsuarioAsignar::find();
        //Join para la relacion
        $query->joinWith(['proyecto']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $dataProvider->sort->attributes['nombreproyecto'] = [
        'asc' => ['proyecto.nombre' => SORT_ASC],
        'desc' => ['proyecto.nombre' => SORT_DESC],
        ];
        
        $dataProvider->sort->attributes['proyecto_acc'] = [
        'asc' => ['proyecto_accion_especifica.nombre' => SORT_ASC],
        'desc' => ['proyecto_accion_especifica.nombre' => SORT_DESC],
        ];
        
        $dataProvider->sort->attributes['nombreue'] = [
        'asc' => ['unidad_ejecutora.nombre.nombre' => SORT_ASC],
        'desc' => ['unidad_ejecutora.nombre.nombre' => SORT_DESC],
        ];

        $query->andFilterWhere([
            'id' => $this->id,
            'usuario_id' => $this->usuario_id,
            'proyecto_id' => $this->proyecto_id,
            'accion_especifica_id' => $this->accion_especifica_id ,
            'proyecto_usuario_asignar.estatus' => $this->estatus          
        ]);

        $query->andFilterWhere(['proyecto.aprobado' => $this->aprobado]);
        $query->andFilterWhere(['like', 'proyecto.nombre', $this->nombreproyecto]);
        $query->andFilterWhere(['like', 'proyecto_accion_especifica.nombre', $this->proyecto_acc]);
        $query->andFilterWhere(['like', 'unidad_ejecutora.nombre', $this->nombreue]);

        return $dataProvider;
    }
}
