<?php

namespace api\modules\v1\models;

use Yii;

/**
 * This is the model class for table "version".
 *
 * @property integer $id
 * @property integer $ver_code
 * @property string $ver_name
 * @property string $url
 */
class Version extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'version';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ver_code'], 'integer'],
            [['ver_name'], 'string', 'max' => 10],
            [['url'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'ver_code' => Yii::t('app', 'Ver Code'),
            'ver_name' => Yii::t('app', 'Ver Name'),
            'url' => Yii::t('app', '下载地址'),
        ];
    }
}
