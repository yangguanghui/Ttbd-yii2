<?php

namespace api\modules\v1\models;

use Yii;

/**
 * This is the model class for table "install_detail".
 *
 * @property integer $id
 * @property integer $install_id
 * @property integer $os_type
 * @property string $product
 * @property string $device_id
 * @property integer $is_first
 * @property integer $created_at
 * @property integer $sdk_ver
 *
 * @property Install $install
 */
class InstallDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'install_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['install_id'], 'required'],
            [['install_id', 'os_type', 'is_first', 'created_at', 'sdk_ver'], 'integer'],
            [['product'], 'string', 'max' => 20],
            [['device_id'], 'string', 'max' => 40],
            ['created_at','default','value'=>time()],
            [['install_id'], 'exist', 'skipOnError' => true, 'targetClass' => Install::className(), 'targetAttribute' => ['install_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'install_id' => Yii::t('app', 'Install ID'),
            'os_type' => Yii::t('app', '操作系统类型：0-android 1-ios'),
            'product' => Yii::t('app', '产品型号'),
            'device_id' => Yii::t('app', '设备ID'),
            'is_first' => Yii::t('app', '是否首次安装'),
            'created_at' => Yii::t('app', 'Created At'),
            'sdk_ver' => Yii::t('app', 'Sdk Ver'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInstall()
    {
        return $this->hasOne(Install::className(), ['id' => 'install_id']);
    }
}
