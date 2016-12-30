<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Task */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-view">

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
            'source_name',
            'url:url',
            'cate_list_selector1',
            'cate_name_pattern1',
            'cate_id_pattern1',
            'cate_url_pattern1:url',
            'cate_list_selector2',
            'cate_name_pattern2',
            'cate_id_pattern2',
            'cate_url_pattern2:url',
            'cate_after_pattern2',
            'cate_list_selector3',
            'cate_name_pattern3',
            'cate_id_pattern3',
            'cate_url_pattern3:url',
            'created_at',
        ],
    ]) ?>

</div>
