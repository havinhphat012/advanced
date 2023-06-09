<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use backend\models\Companies;
use kartik\select2\Select2;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var backend\models\Branches $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="branches-form">

    <?php $form = ActiveForm::begin([
        'id' => $model->formName(),
        'enableAjaxValidation' => true,
        'validationUrl' => Url::toRoute('branches/validation')
    ]); ?>

    <?= $form->field($model, 'companies_company_id')->widget(Select2::class, [
        'data' => ArrayHelper::map(Companies::find()->all(), 'company_id', 'company_name'),
        'options' => ['placeholder' => 'Select a state ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <?= $form->field($model, 'branch_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'branch_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'branch_status')->dropDownList(['active' => 'Active', 'inactive' => 'Inactive',], ['prompt' => 'Status']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

<?php
$script = <<< JS

$('form#{$model->formName()}').on('beforeSubmit', function (e)
{
    var \$form = $(this);
    $.post(
        \$form.attr('action'),
        \$form.serialize()
    )
        .done(function (result) {
            if(result == 1 )
                {
                    $(\$form).trigger("reset");
                    $.pjax.reload({container:'#branchesGrid'});
                }else
                    {
                        $("#message").html(result);
                    }
        }).fail(function ()
        {
            console.log("server error");
        });
    return false;
});

JS;
$this->registerJs($script);
?>
