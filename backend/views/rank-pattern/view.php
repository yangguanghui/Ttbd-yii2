<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\RankPattern */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Rank Patterns', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rank-pattern-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'list_selector',
            'pos_pattern',
            'pic_url_pattern:url',
            'name_pattern',
            'brief_pattern',
            'detail_url_pattern:url',
            'rate_or_score',
            'rate_or_score_pattern',
            'up_or_down_pattern',
            'people1_pattern',
            'people2_pattern',
            'people3_pattern',
            'created_at',
        ],
    ]) ?>

</div>
