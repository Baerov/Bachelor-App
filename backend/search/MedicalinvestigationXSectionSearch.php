<?php

namespace backend\search;

use backend\models\DictionaryDetail;
use backend\models\Internment;
use backend\models\User;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MedicalInvestigationXSection;
use yii\helpers\ArrayHelper;

/**
 * MedicalInvestigationXSectionSearch represents the model behind the search form about `backend\models\MedicalInvestigationXSection`.
 */
class MedicalInvestigationXSectionSearch extends MedicalInvestigationXSection
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Id', 'MedicalInvestigationId', 'UserId', 'SectionId', 'InternmentId', 'StatusId', 'Enabled'], 'safe'],
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
        $query = MedicalInvestigationXSection::find();
        $model = User::findOne(Yii::$app->user->getId());
        if ($model->type_id == DictionaryDetail::DOCTOR) {
            $query->andWhere(['in', 'SectionId', ArrayHelper::getColumn($model->getUserXSections()->all(), 'SectionId')]);
        }
        if ($model->type_id == DictionaryDetail::MEDICAL_ASSISTANT) {
            $query->andWhere(['in', 'SectionId', ArrayHelper::getColumn($model->getUserXSections()->all(), 'SectionId')]);
        }
        // add conditions that should always apply here
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
            'MedicalInvestigationId' => $this->MedicalInvestigationId,
            'UserId' => $this->UserId,
            'StatusId' => $this->StatusId,
            'InternmentId' => $this->InternmentId,
            'SectionId' => $this->SectionId,
            'Enabled' => $this->Enabled,
        ]);

        return $dataProvider;
    }
}
