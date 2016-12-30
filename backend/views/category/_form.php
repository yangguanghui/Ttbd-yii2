<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'source_id')->textInput() ?>

    <?= $form->field($model, 'source_cate_id')->textInput() ?>

    <?= $form->field($model, 'source_cate_pid')->textInput() ?>

    <?= $form->field($model, 'source_cate_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'source_cate_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_last_level')->textInput() ?>

    <?= $form->field($model, 'rank_pattern_id')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
