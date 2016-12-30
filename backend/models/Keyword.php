<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "keyword".
 *
 * @property integer $id
 * @property string $keyword
 *
 * @property RankDetail[] $rankDetails
 * @property RankDetail[] $rankDetails0
 * @property RankDetail[] $rankDetails1
 * @property RankDetail[] $rankDetails2
 */
class Keyword extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'keyword';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['keyword'], 'string', 'max' => 66],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'keyword' => 'Keyword',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRankDetails()
    {
        return $this->hasMany(RankDetail::className(), ['name_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRankDetails0()
    {
        return $this->hasMany(RankDetail::className(), ['people1_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRankDetails1()
    {
        return $this->hasMany(RankDetail::className(), ['people2_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRankDetails2()
    {
        return $this->hasMany(RankDetail::className(), ['people3_id' => 'id']);
    }
}
