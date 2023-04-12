<?php

use backend\models\Branches;
use backend\models\Companies;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Departments $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="departments-form">

    <?php $form = ActiveForm::begin(); ?>

<!--    --><?php //= $form->field($model, 'companies_company_id')->textInput() ?>

    <?= $form->field($model, 'companies_company_id')->dropDownList(
        ArrayHelper::map(Companies::find()->all(), 'company_id', 'company_name'),
        [
                'prompt'=>'Select Company',
                'onchange'=>'
                $.post("index.php?r=branches/lists&id='.'"+$(this).val(), function( data ) {
                    $( "select#departments-branches_branch_id" ).html( data );
                });'
    ]);
    ?>

<!--    --><?php //= $form->field($model, 'branches_branch_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'branches_branch_id')->dropDownList(
        ArrayHelper::map(Branches::find()->all(), 'branch_id', 'branch_name'),
        [
            'prompt'=>'Select Branch',
        ]);
    ?>

    <?= $form->field($model, 'department_name')->textInput() ?>

    <?= $form->field($model, 'department_status')->dropDownList([ 'active' => 'Active', 'inactive' => 'Inactive', ], ['prompt' => 'Status']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
