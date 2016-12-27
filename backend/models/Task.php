<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "task".
 *
 * @property integer $id
 * @property integer $source_id
 * @property string $name
 * @property string $url
 * @property string $cate_name_pattern1
 * @property integer $cate_id_pattern1
 * @property string $cate_url_pattern1
 * @property string $cate_name_pattern2
 * @property integer $cate_id_pattern2
 * @property string $cate_url_pattern2
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
            [['source_id', 'cate_id_pattern1', 'cate_id_pattern2'], 'integer'],
            [['name'], 'string', 'max' => 32],
            [['url'], 'string', 'max' => 256],
            [['cate_name_pattern1', 'cate_url_pattern1', 'cate_name_pattern2', 'cate_url_pattern2'], 'string', 'max' => 128],
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
            'name' => 'Name',
            'url' => 'Url',
            'cate_name_pattern1' => 'Cate Name Pattern1',
            'cate_id_pattern1' => 'Cate Id Pattern1',
            'cate_url_pattern1' => 'Cate Url Pattern1',
            'cate_name_pattern2' => 'Cate Name Pattern2',
            'cate_id_pattern2' => 'Cate Id Pattern2',
            'cate_url_pattern2' => 'Cate Url Pattern2',
        ];
    }
}
