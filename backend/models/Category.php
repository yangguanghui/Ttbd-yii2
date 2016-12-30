<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property integer $source_id
 * @property integer $source_cate_id
 * @property integer $source_cate_pid
 * @property string $source_cate_name
 * @property string $source_cate_url
 * @property string $created_at
 * @property integer $is_last_level 
 * @property integer $rank_pattern_id
 *
 * @property Category $sourceCateP
 * @property Category[] $categories
 * @property RankPattern $rankPattern
 * @property RankDetail[] $rankDetails 
 * @property Source $source
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['source_id', 'source_cate_id', 'source_cate_pid', 'is_last_level', 'rank_pattern_id'], 'integer'],
            [['created_at'], 'safe'],
            [['source_cate_name'], 'string', 'max' => 8],
            [['source_cate_url'], 'string', 'max' => 128],
            [['rank_pattern_id'], 'exist', 'skipOnError' => true, 'targetClass' => RankPattern::className(), 'targetAttribute' => ['rank_pattern_id' => 'id']],
            [['source_id'], 'exist', 'skipOnError' => true, 'targetClass' => Source::className(), 'targetAttribute' => ['source_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'source_id' => 'Source ID',
            'source_cate_id' => 'Source Cate ID',
            'source_cate_pid' => 'Source Cate Pid',
            'source_cate_name' => 'Source Cate Name',
            'source_cate_url' => 'Source Cate Url',
            'created_at' => 'Created At',
            'is_last_level' => 'Is Last Level',
            'rank_pattern_id' => 'Rank Pattern ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRankPattern()
    {
        return $this->hasOne(RankPattern::className(), ['id' => 'rank_pattern_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSource()
    {
        return $this->hasOne(Source::className(), ['id' => 'source_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRankDetails()
    {
        return $this->hasMany(RankDetail::className(), ['cate_id' => 'id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSourceCateP()
    {
        return $this->hasOne(Category::className(), ['source_cate_id' => 'source_cate_pid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['source_cate_pid' => 'source_cate_id']);
    }
}
