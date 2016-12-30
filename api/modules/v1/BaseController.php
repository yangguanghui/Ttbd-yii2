<?php
namespace api\modules\v1;

use yii\web\Controller;

class BaseController extends Controller
{

    public $enableCsrfValidation = false;

    const SUCCESS = 1;

    const ERROR = 0;

    protected function returnSuccess($data = NULL)
    {
        $value = [
            'code' => $this::SUCCESS,
            'msg' => '操作成功',
            'data' => $data
        ];
        exit(\json_encode($value));
    }

    protected function returnError($msg = NULL)
    {
        $value = [
            'code' => $this::ERROR,
            'msg' => $msg ? $msg : '操作失败',
            'data' => null
        ];
        exit(\json_encode($value));
    }

    protected function returnErrorCodeMsg($code, $msg)
    {
        $value = [
            'code' => $code,
            'msg' => $msg,
            'data' => null
        ];
        exit(\json_encode($value));
    }
}
