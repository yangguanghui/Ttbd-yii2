<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Task */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="task-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'source_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cate_list_selector1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cate_name_pattern1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cate_id_pattern1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cate_url_pattern1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cate_list_selector2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cate_name_pattern2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cate_id_pattern2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cate_url_pattern2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cate_after_pattern2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cate_list_selector3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cate_name_pattern3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cate_id_pattern3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cate_url_pattern3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
