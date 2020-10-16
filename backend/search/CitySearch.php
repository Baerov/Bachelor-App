<?php

namespace backend\search;

use backend\models\Dictionary;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\DictionaryDetail;

/**
 * DictionaryDetailSearch represents the model behind the search form about `backend\models\DictionaryDetail`.
 */
class CitySearch extends DictionaryDetail
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Id', 'Default', 'DictionaryId', 'Enabled'], 'integer'],
            [['Name', 'Code', 'Value'], 'safe'],
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
        $query = DictionaryDetail::find();

        // add conditions that should always apply here
        $query->andWhere(['DictionaryId' => Dictionary::CITY]);
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'Id' => $this->Id,
            'Default' => $this->Default,
            'DictionaryId' => Dictionary::CITY,
            'Enabled' => $this->Enabled,
        ]);

        $query->andFilterWhere(['like', 'Name', $this->Name])
            ->andFilterWhere(['like', 'Code', $this->Code])
            ->andFilterWhere(['like', 'Value', $this->Value]);

        $query->andWhere(['Enabled' => 1]);
        return $dataProvider;
    }
}
