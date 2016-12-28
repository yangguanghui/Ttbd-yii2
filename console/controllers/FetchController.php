<?php
namespace console\controllers;

use yii\console\Controller;
use backend\models\Task;
use backend\models\Category;
include 'vendor/phpquery/phpQuery.php';

class FetchController extends Controller
{

    public function actionIndex()
    {
        $taskList = Task::find()->all();
        if ($taskList) {
            foreach ($taskList as $task) {
                \phpQuery::newDocumentFileHTML($task->url);
                $this->parseCateInfo($task);
            }
        }
    }

    public function parseCateInfo(Task $task, $content = null, $level = 0, $pid = 0)
    {
        $level ++;
        if ($level > 3)
            return;
        $cate_list_selector = "cate_list_selector$level";
        $cate_name_pattern = "cate_name_pattern$level";
        $cate_id_pattern = "cate_id_pattern$level";
        $cate_url_pattern = "cate_url_pattern$level";
        $cate_after_pattern = "cate_after_pattern$level";
        if (isset($task->$cate_list_selector) && $task->$cate_list_selector) {
            if ($content instanceof \phpQueryObject && is_array($content->elements) && count($content->elements) > 0) {
                $pq = $content;
            } else {
                $pq = pq($task->$cate_list_selector, $content);
            }
            if ($pq instanceof \phpQueryObject && is_array($pq->elements) && count($pq->elements) > 0) {
                foreach ($pq->elements as $v) {
                    if (empty($task->$cate_url_pattern)) {
                        $url = $v->getAttribute('href');
                    } else {
                        $url = pq($task->$cate_url_pattern, $v)->attr('href');
                    }
                    if (strpos($url, 'http') !== 0) {
                        $url = $v->baseURI . ltrim($url, './');
                    }
                    parse_str(@array_pop(explode('?', $url)));
                    $var = $task->$cate_id_pattern;
                    if (isset($$var)) {
                        $id = $$var;
                    } else {
                        $id = 0;
                    }
                    if (empty($task->$cate_name_pattern)) {
                        $name = trim($v->textContent);
                    } else {
                        $name = trim(pq($task->$cate_name_pattern, $v)->text());
                    }
                    if (empty($name)) {
                        throw new \Exception('name empty');
                    }
                    $source_id = $task->sourceName->id;
                    $category = Category::findOne([
                        'source_id' => $source_id,
                        'source_cate_id' => $id,
                        'source_cate_pid' => $pid
                    ]);
                    if (! $category) {
                        $category = new Category();
                        $category->source_id = $source_id;
                        $category->source_cate_id = $id;
                        $category->source_cate_name = $name;
                        $category->source_cate_pid = $pid;
                        $category->source_cate_url = $url;
                        $selector = "cate_list_selector" . ($level + 1);
                        if (! (isset($task->$selector) && $task->$selector)) {
                            $category->is_last_level = 1;
                        }
                        if (! $category->save()) {
                            throw new \Exception("category save error!");
                        }
                    }
                    // if ($category->is_last_level == 1) {
                    // return;
                    // }
                    if (isset($task->$cate_after_pattern) && $task->$cate_after_pattern) {
                        if ($task->$cate_after_pattern == "siblings()") {
                            $after_content = pq('', $v)->siblings();
                        } else {
                            $after_content = pq($task->$cate_after_pattern, $v);
                        }
                        $this->parseCateInfo($task, $after_content, $level, $id);
                    }
                    $this->parseCateInfo($task, $v, $level, $id);
                }
            }
            if ($pid > 0) {
                $this->parseCateInfo($task, $content, $level, $pid);
            }
        }
    }
}

