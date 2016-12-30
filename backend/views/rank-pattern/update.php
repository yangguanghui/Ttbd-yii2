<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\RankPattern */

$this->title = 'Update Rank Pattern: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Rank Patterns', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rank-pattern-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
