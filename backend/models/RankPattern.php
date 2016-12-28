<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "rank_pattern".
 *
 * @property integer $id
 * @property string $name
 * @property string $list_selector
 * @property string $pos_pattern
 * @property string $pic_url_pattern
 * @property string $name_pattern
 * @property string $brief_pattern
 * @property string $detail_url_pattern
 * @property integer $rate_or_score
 * @property string $rate_or_score_pattern
 * @property string $up_or_down_pattern
 * @property string $people1_pattern
 * @property string $people2_pattern
 * @property string $people3_pattern
 * @property string $created_at
 *
 * @property Category[] $categories
 */
class RankPattern extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rank_pattern';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rate_or_score'], 'integer'],
            [['created_at'], 'safe'],
            [['name'], 'string', 'max' => 24],
            [['list_selector', 'pos_pattern', 'pic_url_pattern', 'name_pattern', 'brief_pattern', 'detail_url_pattern', 'rate_or_score_pattern', 'up_or_down_pattern', 'people1_pattern', 'people2_pattern', 'people3_pattern'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'list_selector' => 'List Selector',
            'pos_pattern' => 'Pos Pattern',
            'pic_url_pattern' => 'Pic Url Pattern',
            'name_pattern' => 'Name Pattern',
            'brief_pattern' => 'Brief Pattern',
            'detail_url_pattern' => 'Detail Url Pattern',
            'rate_or_score' => 'Rate Or Score',
            'rate_or_score_pattern' => 'Rate Or Score Pattern',
            'up_or_down_pattern' => 'Up Or Down Pattern',
            'people1_pattern' => 'People1 Pattern',
            'people2_pattern' => 'People2 Pattern',
            'people3_pattern' => 'People3 Pattern',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['rank_pattern_id' => 'id']);
    }
}
