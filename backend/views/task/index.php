<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tasks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Task', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'source_name',
            'url:url',
            'cate_list_selector1',
            'cate_name_pattern1',
            // 'cate_id_pattern1',
            // 'cate_url_pattern1:url',
            // 'cate_list_selector2',
            // 'cate_name_pattern2',
            // 'cate_id_pattern2',
            // 'cate_url_pattern2:url',
            // 'cate_after_pattern2',
            // 'cate_list_selector3',
            // 'cate_name_pattern3',
            // 'cate_id_pattern3',
            // 'cate_url_pattern3:url',
            // 'created_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
