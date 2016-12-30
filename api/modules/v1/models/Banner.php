<?php

namespace api\modules\v1\models;

use Yii;

/**
 * This is the model class for table "banner".
 *
 * @property integer $id
 * @property string $text
 * @property string $action_uri
 * @property string $image_url
 * @property integer $rank
 */
class Banner extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'banner';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['image_url'], 'required'],
            [['rank'], 'integer'],
            [['text'], 'string', 'max' => 50],
            [['action_uri', 'image_url'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Text',
            'action_uri' => 'Action Uri',
            'image_url' => 'Image Url',
            'rank' => 'Rank',
        ];
    }

    /**
     * @inheritdoc
     * @return BannerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BannerQuery(get_called_class());
    }
}
