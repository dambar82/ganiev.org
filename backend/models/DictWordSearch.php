<?php

namespace app\backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\backend\models\DictWord;

/**
 * DictWordSearch represents the model behind the search form of `app\backend\models\DictWord`.
 */
class DictWordSearch extends DictWord
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'accent','status','audio_status','edit_status','full_status'], 'integer'],
            [['word', 'italic', 'ending'], 'safe'],
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
        $query = DictWord::find();

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
            'id' => $this->id,
            'accent' => $this->accent,
            'status' => $this->status,
            'audio_status' => $this->audio_status,
            'edit_status' => $this->edit_status,
            'full_status' => $this->full_status,
        ]);

        $query->andFilterWhere(['like', 'word', $this->word.'%',false])
            ->andFilterWhere(['like', 'italic', $this->italic])
            ->andFilterWhere(['like', 'ending', $this->ending]);

        $query->orderBy(['word' => SORT_ASC]);

        return $dataProvider;
    }
}
