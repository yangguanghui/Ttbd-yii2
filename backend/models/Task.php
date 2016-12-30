<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "task".
 *
 * @property integer $id
 * @property string $source_name
 * @property string $url
 * @property string $cate_list_selector1
 * @property string $cate_name_pattern1
 * @property string $cate_id_pattern1
 * @property string $cate_url_pattern1
 * @property string $cate_list_selector2
 * @property string $cate_name_pattern2
 * @property string $cate_id_pattern2
 * @property string $cate_url_pattern2
 * @property string $cate_after_pattern2
 * @property string $cate_list_selector3
 * @property string $cate_name_pattern3
 * @property string $cate_id_pattern3
 * @property string $cate_url_pattern3
 * @property string $created_at
 *
 * @property Source $sourceName
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at'], 'safe'],
            [['source_name'], 'string', 'max' => 32],
            [['url'], 'string', 'max' => 256],
            [['cate_list_selector1', 'cate_name_pattern1', 'cate_id_pattern1', 'cate_url_pattern1', 'cate_list_selector2', 'cate_name_pattern2', 'cate_id_pattern2', 'cate_url_pattern2', 'cate_after_pattern2', 'cate_list_selector3', 'cate_name_pattern3', 'cate_id_pattern3', 'cate_url_pattern3'], 'string', 'max' => 128],
            [['source_name'], 'exist', 'skipOnError' => true, 'targetClass' => Source::className(), 'targetAttribute' => ['source_name' => 'name']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'source_name' => 'Source Name',
            'url' => 'Url',
            'cate_list_selector1' => 'Cate List Selector1',
            'cate_name_pattern1' => 'Cate Name Pattern1',
            'cate_id_pattern1' => 'Cate Id Pattern1',
            'cate_url_pattern1' => 'Cate Url Pattern1',
            'cate_list_selector2' => 'Cate List Selector2',
            'cate_name_pattern2' => 'Cate Name Pattern2',
            'cate_id_pattern2' => 'Cate Id Pattern2',
            'cate_url_pattern2' => 'Cate Url Pattern2',
            'cate_after_pattern2' => 'Cate After Pattern2',
            'cate_list_selector3' => 'Cate List Selector3',
            'cate_name_pattern3' => 'Cate Name Pattern3',
            'cate_id_pattern3' => 'Cate Id Pattern3',
            'cate_url_pattern3' => 'Cate Url Pattern3',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSourceName()
    {
        return $this->hasOne(Source::className(), ['name' => 'source_name']);
    }
}
