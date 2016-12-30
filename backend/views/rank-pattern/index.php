<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rank Patterns';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rank-pattern-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Rank Pattern', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'list_selector',
            'pos_pattern',
            'pic_url_pattern:url',
            // 'name_pattern',
            // 'brief_pattern',
            // 'detail_url_pattern:url',
            // 'rate_or_score',
            // 'rate_or_score_pattern',
            // 'up_or_down_pattern',
            // 'people1_pattern',
            // 'people2_pattern',
            // 'people3_pattern',
            // 'created_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
