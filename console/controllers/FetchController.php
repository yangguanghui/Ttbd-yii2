<?php
namespace console\controllers;

use yii\console\Controller;
use backend\models\Task;
use backend\models\Category;
use backend\models\RankPattern;
use backend\models\RankDetail;
use backend\models\Keyword;
include 'vendor/phpquery/phpQuery.php';
include 'vendor/Snoopy/Snoopy.class.php';

class FetchController extends Controller
{

    public function actionGetRank()
    {
        $snoopy = new \Snoopy();
        $categoryList = Category::findAll([
            'is_last_level' => 1
        ]);
        /** @var Category $category **/
        foreach ($categoryList as $category) {
            if($category->rank_pattern_id!=3) continue;
            $rankPattern = RankPattern::findOne($category->rank_pattern_id);
            if ($rankPattern) {
                $snoopy->fetch($category->source_cate_url);
                \phpQuery::newDocumentHTML($snoopy->results);
                // \phpQuery::newDocumentFileHTML($category->source_cate_url);
                $pq = pq($rankPattern->list_selector);
                if ($pq instanceof \phpQueryObject && is_array($pq->elements) && count($pq->elements) > 0) {
                    foreach ($pq->elements as $v) {
                        $rankDetail = new RankDetail();
                        $rankDetail->cate_id = $category->id;
                        $rankDetail->pos = pq($rankPattern->pos_pattern, $v)->text();
                        if (empty($rankDetail->pos)) {
                            continue;
                        }
                        $arr = \explode('--', $rankPattern->pic_url_pattern);
                        if ($arr && \is_array($arr) && count($arr) > 1) {
                            if ($arr[0] == "next") {
                                $pqNext = pq('', $v)->next();
                                if ($pqNext instanceof \phpQueryObject && is_array($pqNext->elements) && count($pqNext->elements) > 0) {
                                    $vNext = $pqNext->elements[0];
                                }
                                $rankDetail->pic_url = pq($arr[1], $vNext)->attr('src');
                            }
                        } else {
                            $rankDetail->pic_url = pq($rankPattern->pic_url_pattern, $v)->attr('src');
                        }
                        if (strpos($rankDetail->pic_url, 'http') !== 0) {
                            $rankDetail->pic_url = $v->baseURI . ltrim($rankDetail->pic_url, './');
                        }
                        $rankDetail->name = trim(pq($rankPattern->name_pattern, $v)->attr('title'));
                        if (empty($rankDetail->name)) {
                            continue;
                            // throw new \Exception('name empty' . $category->source_cate_url . " " . $pq->html());
                        }
                        $rankDetail->name_id = $this->getKeywordId($rankDetail->name);
                        if($rankPattern->people1_pattern){
                            $rankDetail->people1 = pq($rankPattern->people1_pattern, $v)->text();
                            if($rankDetail->people1){
                                $rankDetail->people1_id = $this->getKeywordId($rankDetail->people1);
                            }
                        }
                        if($rankPattern->people2_pattern){
                            $rankDetail->people2 = pq($rankPattern->people2_pattern, $v)->text();
                            if($rankDetail->people2){
                                $rankDetail->people2_id = $this->getKeywordId($rankDetail->people2);
                            }
                        }
                        if($rankPattern->people3_pattern){
                            $rankDetail->people3 = pq($rankPattern->people3_pattern, $v)->text();
                            if($rankDetail->people3){
                                $rankDetail->people3_id = $this->getKeywordId($rankDetail->people3);
                            }
                        }
                        $arr = \explode('--', $rankPattern->brief_pattern);
                        if ($arr && \is_array($arr) && count(\is_array($arr) > 1)) {
                            if ($arr[0] == "next") {
                                $pqNext = pq('', $v)->next();
                                if ($pqNext instanceof \phpQueryObject && is_array($pqNext->elements) && count($pqNext->elements) > 0) {
                                    $vNext = $pqNext->elements[0];
                                }
                                $rankDetail->brief = trim(pq($arr[1], $vNext)->text());
                            }
                        } else {
                            $rankDetail->brief = trim(pq($rankPattern->brief_pattern, $v)->text());
                        }
                        $rankDetail->detail_url = pq($rankPattern->detail_url_pattern, $v)->attr('href');
                        if ($rankPattern->rate_or_score_pattern) {
                            if ($rankPattern->rate_or_score == 1) {
                                $str = trim(pq($rankPattern->rate_or_score_pattern, $v)->attr('style'));
                            } else {
                                $str = pq($rankPattern->rate_or_score_pattern, $v)->html();
                            }
                            if (preg_match('|(\d+)|', $str, $r)) {
                                $rankDetail->rate_or_score = $r[1];
                            }
                        }
                        if ($rankPattern->up_or_down_pattern) {
                            $rankDetail->up_or_down = 0;
                            $str = pq($rankPattern->up_or_down_pattern, $v)->attr("class");
                            $arrUp = [
                                'icon-rise'
                            ];
                            $arrDown = [
                                'icon-fall'
                            ];
                            if (\in_array($str, $arrUp)) {
                                $rankDetail->up_or_down = 1;
                            } elseif (\in_array($str, $arrDown)) {
                                $rankDetail->up_or_down = - 1;
                            }
                        }
                        if (RankDetail::findOne([
                            'cate_id' => $rankDetail->cate_id,
                            'pos' => $rankDetail->pos
                        ])) {
                            $rankDetail->updated_at = date('Y-m-d H:i:s');
                            // if (false === $rankDetail->update()) {
                            // throw new \Exception(var_export($rankDetail->errors));
                            // }
                        } else {
                            if (! $rankDetail->insert()) {
                                throw new \Exception(\var_export($rankDetail->errors));
                            }
                        }
                    }
                }
            }
        }
    }

    public function getKeywordId($word)
    {
        $keyword = Keyword::findOne([
            'keyword' => $word
        ]);
        if ($keyword) {
            return $keyword->id;
        } else {
            $keyword = new Keyword();
            $keyword->keyword = $word;
            if (! $keyword->save()) {
                throw new \Exception(\var_export($keyword->errors));
            }
            return $keyword->id;
        }
    }

    public function actionGetCategory()
    {
        $snoopy = new \Snoopy();
        $taskList = Task::find()->all();
        if ($taskList) {
            foreach ($taskList as $task) {
                $snoopy->fetch($task->url);
                \phpQuery::newDocumentHTML($snoopy->results);
                // \phpQuery::newDocumentFileHTML($task->url);
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
                        'source_cate_pid' => $pid,
                        'source_cate_name' => $name
                    ]);
                    if (! $category) {
                        $category = new Category();
                        $category->source_id = $source_id;
                        $category->source_cate_id = $id;
                        $category->source_cate_name = $name;
                        $category->source_cate_pid = $pid;
                        $category->source_cate_url = $url;
                        $selector = "cate_list_selector" . ($level + 1);
                        $isLastLevel = ! (isset($task->$selector) && $task->$selector);
                        if ($isLastLevel) {
                            $category->is_last_level = 1;
                        }
                        if (! $category->save()) {
                            throw new \Exception("category save error!");
                        }
                        if ($isLastLevel) {
                            $this->getDetail($category);
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

    public function getDetail(Category $category)
    {}
}

