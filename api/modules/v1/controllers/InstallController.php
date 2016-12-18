<?php
namespace api\modules\v1\controllers;

use api\modules\v1\BaseController;
use api\modules\v1\models\InstallDetail;
use api\modules\v1\models\Install;

class InstallController extends BaseController
{

    public function actionFirst()
    {
        $this->saveClientInfo(true);
    }

    public function actionUpdate()
    {
        $this->saveClientInfo(false);
    }

    /**
     *
     * @param
     *            isFirst 是否是首次安装
     */
    private function saveClientInfo($isFirst)
    {
        $post = \Yii::$app->request->post();
        if (! empty($post)) {
            $install = Install::findOne([
                'ver_code' => $post['ver_code']
            ]);
            if (! empty($install)) {
                // 安装量+1
                if ($isFirst)
                    $install->first_install_times += 1;
                else
                    $install->update_install_times += 1;
                if ($install->save(false)) {
                    $post['install_id'] = $install->id;
                    $installDetail = new InstallDetail();
                    if ($installDetail->load($post, '') && $installDetail->validate()) {
                        $installDetail->save(); // 保存安装的客户端信息
                        parent::returnSuccess();
                    }
                }
            }
        }
        parent::returnError();
    }

    public function actionTest()
    {
        parent::returnSuccess();
    }
}
