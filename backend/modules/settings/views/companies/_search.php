<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\modules\settings\models\CompaniesSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="companies-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'company_id') ?>

    <?= $form->field($model, 'company_name') ?>

    <?= $form->field($model, 'company_email') ?>

    <?= $form->field($model, 'company_address') ?>

    <?= $form->field($model, 'logo') ?>

    <?php // echo $form->field($model, 'company_start_date') ?>

    <?php // echo $form->field($model, 'company_created_date') ?>

    <?php // echo $form->field($model, 'company_status') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
