<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

//cung cấp các thông tin về kiểu dữ liệu và mô tả cho các biến được sử dụng
/** @var yii\web\View $this */
/** @var backend\modules\settings\models\Companies $model */
/** @var yii\widgets\ActiveForm $form */
/** @var backend\models\Branches $branch */
?>

<div class="companies-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'company_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'file')->fileInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_status')->dropDownList([ 'active' => 'Active', 'inactive' => 'Inactive', ], ['prompt' => 'Status']) ?>

    <?= $form->field($branch, 'branch_name')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($branch, 'branch_address')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($branch, 'branch_status')->dropDownList([ 'active' => 'Active', 'inactive' => 'Inactive', ], ['prompt' => 'Status']) ?>



    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
