<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\RankPattern */

$this->title = 'Create Rank Pattern';
$this->params['breadcrumbs'][] = ['label' => 'Rank Patterns', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rank-pattern-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
