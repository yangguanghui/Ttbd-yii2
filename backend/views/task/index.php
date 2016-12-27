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
            'source_id',
            'name',
            'url:url',
            'cate_name_pattern1',
            // 'cate_id_pattern1',
            // 'cate_url_pattern1:url',
            // 'cate_name_pattern2',
            // 'cate_id_pattern2',
            // 'cate_url_pattern2:url',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
