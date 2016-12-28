<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\RankPattern */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rank-pattern-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'list_selector')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pos_pattern')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pic_url_pattern')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_pattern')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'brief_pattern')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'detail_url_pattern')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rate_or_score')->textInput() ?>

    <?= $form->field($model, 'rate_or_score_pattern')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'up_or_down_pattern')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'people1_pattern')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'people2_pattern')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'people3_pattern')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
