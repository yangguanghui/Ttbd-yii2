<?php

namespace api\modules\v1\models;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property integer $id
 * @property string $title
 * @property string $brief
 * @property string $image_url
 * @property string $create_at
 * @property string $author
 * @property string $publish_at
 * @property integer $approval
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_at', 'publish_at'], 'safe'],
            [['approval'], 'integer'],
            [['title'], 'string', 'max' => 64],
            [['brief', 'image_url'], 'string', 'max' => 256],
            [['author'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'brief' => 'Brief',
            'image_url' => 'Image Url',
            'create_at' => 'Create At',
            'author' => 'Author',
            'publish_at' => 'Publish At',
            'approval' => 'Approval',
        ];
    }

    /**
     * @inheritdoc
     * @return NewsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new NewsQuery(get_called_class());
    }
}
