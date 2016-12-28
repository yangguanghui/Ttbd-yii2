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
 *
 * @property Category $sourceCateP
 * @property Category[] $categories
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
            [['source_id', 'source_cate_id', 'source_cate_pid', 'is_last_level'], 'integer'],
            [['created_at'], 'safe'],
            [['source_cate_name'], 'string', 'max' => 8],
            [['source_cate_url'], 'string', 'max' => 128],
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
        ];
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSource()
    {
        return $this->hasOne(Source::className(), ['id' => 'source_id']);
    }
}
