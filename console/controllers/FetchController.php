<?php
namespace console\controllers;

use yii\console\Controller;

include 'vendor/phpquery/phpQuery.php';

class FetchController extends Controller
{
    public function actionIndex()
    {
        \phpQuery::newDocumentFileHTML("http://top.baidu.com/boards");
        echo pq('title')->text();
    }
}

