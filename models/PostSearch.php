<?php

namespace pendalf89\blog\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use pendalf89\blog\models\Post;
use yii\db\Query;

/**
 * PostSearch represents the model behind the search form about `pendalf89\blog\models\Post`.
 */
class PostSearch extends Post
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'type_id', 'views', 'publish_status', 'created_at', 'updated_at'], 'integer'],
            [['title', 'title_seo', 'alias', 'meta_description', 'preview', 'content'], 'safe'],
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
        $query = Post::find();
        $query->with('category', 'type');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'category_id' => $this->category_id,
            'type_id' => $this->type_id,
            'views' => $this->views,
            'publish_status' => $this->publish_status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'title_seo', $this->title_seo])
            ->andFilterWhere(['like', 'alias', $this->alias])
            ->andFilterWhere(['like', 'preview', $this->preview])
            ->andFilterWhere(['like', 'content', $this->content]);

        if ($this->meta_description === 'yes') {
            $query->andOnCondition('`meta_description` != ""');
        }

        if ($this->meta_description === 'no') {
            $query->andOnCondition('`meta_description` = ""');
        }

        return $dataProvider;
    }
}
