<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Emails $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="emails-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'receiver_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'receiver_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subject')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'attachment')->fileInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
