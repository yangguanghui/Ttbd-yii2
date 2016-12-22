<?php

namespace api\modules\v1\models;

use Yii;

/**
 * This is the model class for table "install".
 *
 * @property integer $id
 * @property integer $ver_code
 * @property string $ver_name
 * @property integer $first_install_times
 * @property integer $update_install_times
 *
 * @property InstallDetail[] $installDetails
 */
class Install extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'install';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'ver_code', 'first_install_times', 'update_install_times'], 'integer'],
            [['ver_name'], 'string', 'max' => 10],
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
            'first_install_times' => Yii::t('app', '首次安装次数'),
            'update_install_times' => Yii::t('app', '更新安装次数'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInstallDetails()
    {
        return $this->hasMany(InstallDetail::className(), ['install_id' => 'id']);
    }
}
