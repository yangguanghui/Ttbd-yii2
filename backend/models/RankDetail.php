<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "rank_detail".
 *
 * @property integer $id
 * @property integer $cate_id
 * @property string $name
 * @property integer $name_id
 * @property integer $pos
 * @property string $pic_url
 * @property string $brief
 * @property string $detail_url
 * @property integer $rate_or_score
 * @property integer $up_or_down
 * @property string $people1
 * @property string $people2
 * @property string $people3
 * @property integer $people1_id
 * @property integer $people2_id
 * @property integer $people3_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Category $cate
 * @property Keyword $name0
 * @property Keyword $people10
 * @property Keyword $people20
 * @property Keyword $people30
 */
class RankDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rank_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cate_id'], 'required'],
            [['cate_id', 'name_id', 'pos', 'rate_or_score', 'up_or_down', 'people1_id', 'people2_id', 'people3_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 40],
            [['pic_url', 'brief', 'detail_url'], 'string', 'max' => 256],
            [['people1', 'people2', 'people3'], 'string', 'max' => 16],
            [['cate_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['cate_id' => 'id']],
            [['name_id'], 'exist', 'skipOnError' => true, 'targetClass' => Keyword::className(), 'targetAttribute' => ['name_id' => 'id']],
            [['people1_id'], 'exist', 'skipOnError' => true, 'targetClass' => Keyword::className(), 'targetAttribute' => ['people1_id' => 'id']],
            [['people2_id'], 'exist', 'skipOnError' => true, 'targetClass' => Keyword::className(), 'targetAttribute' => ['people2_id' => 'id']],
            [['people3_id'], 'exist', 'skipOnError' => true, 'targetClass' => Keyword::className(), 'targetAttribute' => ['people3_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cate_id' => 'Cate ID',
            'name' => 'Name',
            'name_id' => 'Name ID',
            'pos' => 'Pos',
            'pic_url' => 'Pic Url',
            'brief' => 'Brief',
            'detail_url' => 'Detail Url',
            'rate_or_score' => 'Rate Or Score',
            'up_or_down' => 'Up Or Down',
            'people1' => 'People1',
            'people2' => 'People2',
            'people3' => 'People3',
            'people1_id' => 'People1 ID',
            'people2_id' => 'People2 ID',
            'people3_id' => 'People3 ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCate()
    {
        return $this->hasOne(Category::className(), ['id' => 'cate_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getName0()
    {
        return $this->hasOne(Keyword::className(), ['id' => 'name_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeople10()
    {
        return $this->hasOne(Keyword::className(), ['id' => 'people1_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeople20()
    {
        return $this->hasOne(Keyword::className(), ['id' => 'people2_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeople30()
    {
        return $this->hasOne(Keyword::className(), ['id' => 'people3_id']);
    }
}
