<?php

namespace api\controllers;

use yii\rest\ActiveController;

class UserController extends ActiveController
{
    public $modelClass = 'api\models\User';
    
//     public function actions(){
//         $actions = parent::actions();
//         unset($actions['index']);
//         return $actions;
//     }
    
//     public function actionIndex(){
//         echo "abc";
//     }
}
