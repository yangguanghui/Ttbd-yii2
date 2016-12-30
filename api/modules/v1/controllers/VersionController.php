<?php

namespace api\modules\v1\controllers;

use yii\rest\ActiveController;

class VersionController extends ActiveController
{
    public $modelClass = 'api\modules\v1\models\Version';
}
